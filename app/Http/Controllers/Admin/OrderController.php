<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Company;

class OrderController extends BaseController
{

    /**
     * Order listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $orderArr = Order::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Order",
            "orderArr" => $orderArr
        ];

        return view('pages.admin.order.index')->with('dataArr', $dataArr);
    }

    /**
     * Order add page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function orderAdd()
    {
        $companies = Company::get();
        $dataArr = [
            "page_title" => "Add Order",
            "companyName" => $companies,
        ];

        return view('pages.admin.order.add_order')->with('dataArr', $dataArr);
    }

    /**
     * Order store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function orderInsert(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required',
            'company_name_id' => 'required',
            'quantity' => 'required',
        ]);

        $order = Order::create([
            'invoice_number' => $request->invoice_number,
            'company_name_id' => $request->company_name_id,
            'quantity' => $request->quantity,
        ]);

        $log = "Created order invoice number: " . $request->invoice_number . " & company: " . $order->getComapanyName->company_name;
        Self::insertUserLog($log, $order->id);

        return redirect()->route('admin.order')->with([
            "message" => [
                "result" => "success",
                "msg" => "Order added successfully."
            ]
        ]);
    }

    /**
     * Order edit page
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function orderEdit($id)
    {
        $orderArr = Order::find($id);
        $dataArr = [
            "page_title" => "Edit Order",
            "orderArr" => $orderArr
        ];

        return view('pages.admin.order.edit_order')->with('dataArr', $dataArr);
    }

    /**
     * Order update
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function orderUpdate(Request $request, $id)
    {
        $orderArr = Order::find($id);

        $request->validate([
            'name' => 'required',
        ]);


        $updateArray['name'] = $request->name;
        $orderArr->update($updateArray);

        return redirect()->route('admin.order')->with([
            "message" => [
                "result" => "success",
                "msg" => "Order updated successfully."
            ]
        ]);
    }

    /**
     * Order update
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function orderStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $items = implode(',', $request->items);

        $orderArr = Order::find($id);

        // if ($orderArr->$status)
        //     $status_val = "";
        // else

        $collumn = $status . '_items';
        $arr = explode(',', $orderArr->$collumn);
        $diff = array_diff($request->items, $arr);
        $item = $diff ?  "number " .implode(',', $diff) : "no";

        $status_val = now();

        $updateArray[$status] = $status_val;
        $updateArray[$status . '_items'] = $items;
        $updateArray[$status . '_remarks'] = $request->remarks;
        $orderArr->update($updateArray);

        $remarks = $request->remarks ? ", remarks: " . $request->remarks : '';

        $log = "Order with invoice number: " . $orderArr->invoice_number . ".. " . $item . " items" . $remarks . ", status updated to " . ucwords(str_replace('_', ' ', $status));
        Self::insertUserLog($log, $id);

        return redirect()->route('admin.order')->with([
            "message" => [
                "result" => "success",
                "msg" => "Order status updated successfully."
            ]
        ]);
    }

    /**
     * Order remove
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function orderRemove($id)
    {
        $order = Order::find($id);
        $order->delete();

        $log = "Order with invoice number " . $order->invoice_number . " & company " . $order->getComapanyName->company_name . " is deleted.";
        Self::insertUserLog($log, $id);

        return redirect()->route('admin.order')->with([
            "message" => [
                "result" => "success",
                "msg" => "Order deleted successfully."
            ]
        ]);
    }
}
