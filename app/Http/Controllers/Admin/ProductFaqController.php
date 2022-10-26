<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\ProductFaq;
use DB;

class ProductFaqController extends BaseController
{
    /**
     * manage product feature
     * @param integer $product_id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($product_id)
    {
        $productFaqArr = ProductFaq::where('product_id', $product_id)->get();

        $dataArr = [
            "page_title" => "Product Faq",
            "productFaqArr" => $productFaqArr,
            "product_id" => $product_id,
        ];

        return view('pages.admin.product.product_faq')->with('dataArr', $dataArr);
    }

    /**
     * product variant update
     * @param param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ProductFaqUpdate(Request $request, $productId)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        try {
            DB::beginTransaction();

            //delete existing
            // ProductFaq::where('product_id', $productId)->delete();

            foreach ($request->question as $key => $question) {
                if ($question && $request->answer[$key]) {
                    ProductFaq::create([
                        'product_id' => $productId,
                        'question' => $question,
                        'answer' => $request->answer[$key],
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }


        return redirect()->route('admin.product')->with([
            "message" => [
                "result" => "success",
                "msg" => "Product Faq updated successfully."
            ]
        ]);
    }

    /**
     * delete product variant
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ProductFaqRemove(Request $request)
    {
        $response = [
            'jsonrpc'   => '2.0'
        ];

        $remove = ProductFaq::find($request->product_faq_id)->delete();

        if ($remove) {
            $check = ProductFaq::where('product_id', $request->product_id)->count();
            $response['status'] = "success";
            $response['check'] = $check;
            return response()->json($response, 200);
        } else {
            $response['status'] = "error";
            return response()->json($response, 200);
        }
    }
}
