<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Order;

class CompanyController extends BaseController
{

    /**
     * company listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $companyArr = Company::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Company",
            "companyArr" => $companyArr
        ];

        return view('pages.admin.company.index')->with('dataArr', $dataArr);
    }

    /**
     * company add page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function companyAdd()
    {
        $dataArr = [
            "page_title" => "Add Company",
        ];

        return view('pages.admin.company.add_company')->with('dataArr', $dataArr);
    }

    /**
     * company store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function companyInsert(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
        ]);

        Company::create([
            'company_name' => $request->company_name
        ]);

        $log = "Created company name is ".$request->company_name;
        Self::insertUserLog($log);

        return redirect()->route('admin.company')->with([
            "message" => [
                "result" => "success",
                "msg" => "Company added successfully."
            ]
        ]);
    }

    /**
     * company edit page
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function companyEdit($id)
    {
        $companyArr = Company::find($id);
        $dataArr = [
            "page_title" => "Edit Company",
            "companyArr" => $companyArr
        ];

        return view('pages.admin.company.edit_company')->with('dataArr', $dataArr);
    }

    /**
     * company update
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function companyUpdate(Request $request, $id)
    {
        $companyArr = Company::find($id);

        $request->validate([
            'company_name' => 'required',
        ]);

        $updateArray['company_name'] = $request->company_name;
        Company::find($id)->update($updateArray);

        $log = $companyArr->company_name. " is updated to ".$request->company_name;
        Self::insertUserLog($log);

        return redirect()->route('admin.company')->with([
            "message" => [
                "result" => "success",
                "msg" => "Company updated successfully."
            ]
        ]);
    }

    /**
     * company remove
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function companyRemove($id)
    {
        $oreders = Order::where('company_name_id', $id)->count();
        $companyArr = Company::find($id);
        if (!$oreders) {
            $companyArr->delete();

        $log = $companyArr->company_name. " is deleted.";
        Self::insertUserLog($log);

            return redirect()->route('admin.company')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Company deleted successfully."
                ]
            ]);
        } else {
            return redirect()->route('admin.company')->with([
                "message" => [
                    "result" => "error",
                    "msg" => "Order exsist. Company can not be deleted."
                ]
            ]);
        }
    }
}
