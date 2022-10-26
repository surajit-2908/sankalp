<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Order;

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
        $dataArr = [
            "page_title" => "Add Order",
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
            'name' => 'required',
        ]);

        Order::create([
            'name' => $request->name
        ]);

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
        Order::find($id)->update($updateArray);

        return redirect()->route('admin.order')->with([
            "message" => [
                "result" => "success",
                "msg" => "Order updated successfully."
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
        Order::find($id)->delete();

        return redirect()->route('admin.order')->with([
            "message" => [
                "result" => "success",
                "msg" => "Order deleted successfully."
            ]
        ]);
    }
}
