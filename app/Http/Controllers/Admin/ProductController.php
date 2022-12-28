<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use DB;

class ProductController extends BaseController
{

    /**
     * product listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $productArr = Product::orderByDesc('created_at')->get();

        $dataArr = [
            "page_title" => "Product",
            "productArr" => $productArr
        ];

        return view('pages.admin.product.index')->with('dataArr', $dataArr);
    }

    /**
     * product detail
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productDetail($id)
    {
        $productDetail = Product::find($id);

        $dataArr = [
            "page_title" => "Product Details",
            "productDetail" => $productDetail
        ];

        return view('pages.admin.product.product_detail')->with('dataArr', $dataArr);
    }

    /**
     * add product
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productAdd()
    {
        $parentCategoryArr = Category::where('parent_id', '0')->orderBy('name')->get();

        $dataArr = [
            "page_title" => "Add Product",
            "parentCategoryArr" => $parentCategoryArr,
        ];

        return view('pages.admin.product.add_product')->with('dataArr', $dataArr);
    }

    /**
     * save product
     * @param param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productInsert(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cat_id' => 'required',
            'description' => 'required',
            'features' => 'required',
            'brochure' => 'required|mimes:pdf',
            'youtube_link' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            DB::beginTransaction();

            if ($request->brochure) {
                //brochure upload
                $uploadedBrochure = $request->brochure;
                $brochureFilename = rand('111111', '999999') . time() . "." . $uploadedBrochure->getClientOriginalExtension();

                self::uploadImageToStorage(self::BROCHURE, $uploadedBrochure, $brochureFilename);
            }

            $productInsert = Product::create([
                'title' => $request->title,
                'cat_id' => $request->cat_id,
                'sub_cat_id' => $request->sub_cat_id,
                'description' => nl2br($request->description),
                'operation' => $request->operation,
                'features' => $request->features,
                'applications' => $request->applications,
                'special_options' => $request->special_options,
                'technical_specifications' => $request->technical_specifications,
                'youtube_link' => $request->youtube_link,
                'brochure' => $brochureFilename,
            ]);

            $slug = str_slug($request->title) . "-" . $productInsert->id;
            $productInsert->update([
                'slug' => $slug,
            ]);


            //upload gallery image
            $img = $request->image;
            if ($img) {
                foreach ($img as $img) {

                    //image upload
                    $uploadedFile = $img;
                    $filename = rand('111111', '999999') . time() . "." . $uploadedFile->getClientOriginalExtension();

                    self::uploadImageToStorage(self::PRODUCT_PIC, $uploadedFile, $filename);

                    ProductImage::create([
                        'product_id' => $productInsert->id,
                        'image_name' => $filename
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
                "msg" => "Product added successfully."
            ]
        ]);
    }

    /**
     * edit product
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productEdit($id)
    {
        $productArr = Product::find($id);
        $parentCategoryArr = Category::where('parent_id', '0')->orderBy('name')->get();
        $subCategoryArr = Category::where('parent_id', $productArr->cat_id)->orderBy('name')->get();

        $dataArr = [
            "page_title" => "Edit Product",
            "productArr" => $productArr,
            "parentCategoryArr" => $parentCategoryArr,
            "subCategoryArr" => $subCategoryArr,
        ];

        return view('pages.admin.product.edit_product')->with('dataArr', $dataArr);
    }

    /**
     * update product
     * @param integer $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productUpdate(Request $request, $id)
    {
        $productArr = Product::find($id);

        $request->validate([
            'title' => 'required',
            'cat_id' => 'required',
            'description' => 'required',
            'features' => 'required',
            'youtube_link' => 'required',
            'image' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            DB::beginTransaction();

            $slug = str_slug($request->title) . "-" . $id;
            $updateArr = [
                'title' => $request->title,
                'slug' => $slug,
                'cat_id' => $request->cat_id,
                'sub_cat_id' => $request->sub_cat_id,
                'description' => nl2br($request->description),
                'operation' => $request->operation,
                'features' => $request->features,
                'applications' => $request->applications,
                'special_options' => $request->special_options,
                'technical_specifications' => $request->technical_specifications,
                'youtube_link' => $request->youtube_link
            ];

            if ($request->brochure) {
                //brochure upload
                $uploadedBrochure = $request->brochure;
                $brochureFilename = rand('111111', '999999') . time() . "." . $uploadedBrochure->getClientOriginalExtension();

                self::uploadImageToStorage(self::BROCHURE, $uploadedBrochure, $brochureFilename);
                $updateArr['brochure'] = $brochureFilename;
            }

            $productArr->update($updateArr);

            //upload gallery image
            $img = $request->image;
            if ($img) {
                foreach ($img as $img) {

                    //image upload
                    $uploadedFile = $img;
                    $filename = rand('111111', '999999') . time() . "." . $uploadedFile->getClientOriginalExtension();

                    self::uploadImageToStorage(self::PRODUCT_PIC, $uploadedFile, $filename);

                    ProductImage::create([
                        'product_id' => $id,
                        'image_name' => $filename
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
                "msg" => "Product updated successfully."
            ]
        ]);
    }

    /**
     * delete product
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productRemove($id)
    {
        $productImgArr = ProductImage::where('product_id', $id)->get();
        if (!empty($productImgArr)) {
            foreach ($productImgArr as $img) {
                Storage::disk('public')->delete(self::PRODUCT_PIC . '/' . $img->image_name);
            }
        }
        Product::find($id)->delete();

        return redirect()->route('admin.product')->with([
            "message" => [
                "result" => "success",
                "msg" => "Product deleted successfully."
            ]
        ]);
    }

    /**
     * delete image
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function imgRemove(Request $request)
    {
        $response = [
            'jsonrpc'   => '2.0'
        ];

        $productImg = ProductImage::find($request->img_id);

        if (!is_null($productImg)) {
            Storage::disk('public')->delete(self::PRODUCT_PIC . '/' . $productImg->image_name);
        }
        $remove = $productImg->delete();

        if ($remove) {
            $check = ProductImage::where('product_id', $request->product_id)->count();
            $response['status'] = "success";
            $response['check'] = $check;
            return response()->json($response, 200);
        } else {
            $response['status'] = "error";
            return response()->json($response, 200);
        }
    }


    /**
     * change product status
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productStatus($id)
    {
        $product = Product::find($id);

        $status = $product->status ? "0" : "1";

        $updateArr['status'] = $status;
        $product->update($updateArr);

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Product status changed successfully."
            ]
        ]);
    }

    /**
     * sub category listing
     * @param integer $cat_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubCat($cat_id)
    {
        $sub_cat = Category::where('parent_id', $cat_id)->get();
        $response['sub_cat'] = $sub_cat;
        $response['total'] = count($sub_cat);
        return response()->json($response);
    }
}
