<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use App\Models\Variation;
use DB;

class ProductVariantController extends BaseController
{
    /**
     * manage product variant
     * @param integer $product_id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($product_id)
    {
        $variationArr = Variation::orderBy('name')->get();
        $productVariationArr = ProductVariation::where('product_id', $product_id)->get();

        $dataArr = [
            "page_title" => "Product Variation",
            "variationArr" => $variationArr,
            "productVariationArr" => $productVariationArr,
            "product_id" => $product_id,
        ];

        return view('pages.admin.product.product_variant')->with('dataArr', $dataArr);
    }

    /**
     * product variant update
     * @param param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productVariantUpdate(Request $request, $productId)
    {
        $request->validate([
            'variation_id' => 'required',
            'variation_option_string' => 'required',
        ]);

        try {
            DB::beginTransaction();

            //delete existing
            ProductVariation::where('product_id', $productId)->delete();

            $variation_filter_id = array_filter($request->variation_id);
            $variation_id = array_unique($variation_filter_id);
            if ($variation_id) {
                foreach ($variation_id as $value) {
                    $variation_option_id = array_unique($request->variation_option_string[$value]);
                    $variation_option_string = implode(",", $variation_option_id);
                    ProductVariation::create([
                        'product_id' => $productId,
                        'variation_id' => $value,
                        'variation_option_string' => $variation_option_string,
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
                "msg" => "Product Validation updated successfully."
            ]
        ]);
    }

    /**
     * delete product variant
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function variantRemove(Request $request)
    {
        $response = [
            'jsonrpc'   => '2.0'
        ];

        $remove = ProductVariation::find($request->product_variant_id)->delete();

        if ($remove) {
            $check = ProductVariation::where('product_id', $request->product_id)->count();
            $response['status'] = "success";
            $response['check'] = $check;
            return response()->json($response, 200);
        } else {
            $response['status'] = "error";
            return response()->json($response, 200);
        }
    }
}
