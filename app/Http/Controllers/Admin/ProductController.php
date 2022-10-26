<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Variation;
use App\Models\VariationOption;
use App\Models\Rating;
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
        $brandArr = Brand::orderBy('name')->get();
        $parentCategoryArr = Category::where('parent_id', '0')->orderBy('name')->get();

        $dataArr = [
            "page_title" => "Add Product",
            "brandArr" => $brandArr,
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
            // 'sub_cat_id' => 'required',
            'brand_id' => 'required',
            // 'short_description' => 'required',
            'long_description' => 'required',
            'feautres' => 'required',
            'shopping_returns' => 'required',
            'quantity' => 'required',
            'selling_price' => 'required',
            'selling_offer_price' => 'required',
            'banner_image' => 'required|mimes:jpeg,png,jpg|max:2048',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            DB::beginTransaction();

            //upload banner image
            $banner_image = $request->banner_image;
            $bannerFilename = "";
            if ($banner_image) {
                $uploadedFileBanner = $banner_image;
                $bannerFilename = time() . "." . $uploadedFileBanner->getClientOriginalExtension();

                self::uploadImageToStorage(self::PRODUCT_PIC, $uploadedFileBanner, $bannerFilename);
            }
            $productInsert = Product::create([
                'title' => $request->title,
                // 'slug' => $slug,
                'cat_id' => $request->cat_id,
                'sub_cat_id' => $request->sub_cat_id,
                'brand_id' => $request->brand_id,
                // 'short_description' => $request->short_description,
                'long_description' => nl2br($request->long_description),
                'feautres' => nl2br($request->feautres),
                'shopping_returns' => nl2br($request->shopping_returns),
                'quantity' => $request->quantity,
                'available_quantity' => $request->quantity,
                'selling_price' => $request->selling_price,
                'selling_offer_price' => $request->selling_offer_price,
                'image' => $bannerFilename,
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

                    //preview image upload------------------------
                    if (!Storage::makeDirectory('public/' . self::PRODUCT_PREVIEW_PIC)) {
                        throw new \Exception('Could not create the directory');
                    }

                    $thumb_image  = $img;
                    $image_resize = Image::make($thumb_image->getRealPath());
                    $image_resize->resize(500, 550);
                    $image_resize->save(public_path('storage/' . self::PRODUCT_PREVIEW_PIC . '/' . $filename));

                    //thumb image upload------------------------
                    if (!Storage::makeDirectory('public/' . self::PRODUCT_THUMB_PIC)) {
                        throw new \Exception('Could not create the directory');
                    }

                    $thumb_image       = $img;
                    $image_resize = Image::make($thumb_image->getRealPath());
                    $image_resize->resize(100, 100);
                    $image_resize->save(public_path('storage/' . self::PRODUCT_THUMB_PIC . '/' . $filename));

                    ProductImage::create([
                        'product_id' => $productInsert->id,
                        'image_name' => $filename,
                        'thumb_image_name' => $filename,
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
        $brandArr = Brand::orderBy('name')->get();
        $parentCategoryArr = Category::where('parent_id', '0')->orderBy('name')->get();
        $subCategoryArr = Category::where('parent_id', $productArr->cat_id)->orderBy('name')->get();

        $dataArr = [
            "page_title" => "Edit Product",
            "productArr" => $productArr,
            "brandArr" => $brandArr,
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
            // 'sub_cat_id' => 'required',
            'brand_id' => 'required',
            // 'short_description' => 'required',
            'long_description' => 'required',
            'feautres' => 'required',
            'shopping_returns' => 'required',
            'quantity' => 'required',
            'selling_price' => 'required',
            'selling_offer_price' => 'required',
            'banner_image' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'image' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            DB::beginTransaction();

            //upload banner image
            $banner_image = $request->banner_image;
            $bannerFilename = $productArr->image;
            if ($banner_image) {
                $uploadedFileBanner = $banner_image;
                $bannerFilename = time() . "." . $uploadedFileBanner->getClientOriginalExtension();

                self::updateImageToStorage($productArr->image, self::PRODUCT_PIC, $uploadedFileBanner, $bannerFilename);
            }
            $slug = str_slug($request->title) . "-" . $id;
            $productArr->update([
                'title' => $request->title,
                'slug' => $slug,
                'cat_id' => $request->cat_id,
                'sub_cat_id' => $request->sub_cat_id,
                'brand_id' => $request->brand_id,
                // 'short_description' => $request->short_description,
                'long_description' => nl2br($request->long_description),
                'feautres' => nl2br($request->feautres),
                'shopping_returns' => nl2br($request->shopping_returns),
                'quantity' => $request->quantity,
                'available_quantity' => $request->quantity,
                'selling_price' => $request->selling_price,
                'selling_offer_price' => $request->selling_offer_price,
                'image' => $bannerFilename,
            ]);

            //upload gallery image
            $img = $request->image;
            if ($img) {
                foreach ($img as $img) {

                    //image upload
                    $uploadedFile = $img;
                    $filename = rand('111111', '999999') . time() . "." . $uploadedFile->getClientOriginalExtension();

                    self::uploadImageToStorage(self::PRODUCT_PIC, $uploadedFile, $filename);


                    //preview image upload------------------------
                    if (!Storage::makeDirectory('public/' . self::PRODUCT_PREVIEW_PIC)) {
                        throw new \Exception('Could not create the directory');
                    }

                    $thumb_image       = $img;
                    $image_resize = Image::make($thumb_image->getRealPath());
                    $image_resize->resize(500, 550);
                    $image_resize->save(public_path('storage/' . self::PRODUCT_PREVIEW_PIC . '/' . $filename));

                    //thumb image upload------------------------
                    if (!Storage::makeDirectory('public/' . self::PRODUCT_THUMB_PIC)) {
                        throw new \Exception('Could not create the directory');
                    }

                    $thumb_image       = $img;
                    $image_resize = Image::make($thumb_image->getRealPath());
                    $image_resize->resize(100, 100);
                    $image_resize->save(public_path('storage/' . self::PRODUCT_THUMB_PIC . '/' . $filename));


                    ProductImage::create([
                        'product_id' => $id,
                        'image_name' => $filename,
                        'thumb_image_name' => $filename,
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
                Storage::disk('public')->delete(self::PRODUCT_PREVIEW_PIC . '/' . $img->image_name);
                Storage::disk('public')->delete(self::PRODUCT_THUMB_PIC . '/' . $img->thumb_image_name);
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
            Storage::disk('public')->delete(self::PRODUCT_PREVIEW_PIC . '/' . $productImg->image_name);
            Storage::disk('public')->delete(self::PRODUCT_THUMB_PIC . '/' . $productImg->thumb_image_name);
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
     * change product featured status
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productFeaturedStatus($id)
    {
        $product = Product::find($id);

        $featured = $product->featured ? "0" : "1";

        $updateArr['featured'] = $featured;
        $product->update($updateArr);

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Product featured status changed successfully."
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

    /**
     * variations listing
     * @param integer $unique_id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getVar($unique_id)
    {
        $variationArr = Variation::orderBy('name')->get();

        $dataArr = [
            "variationArr" => $variationArr,
            "unique_id" => $unique_id,
        ];

        return view('pages.admin.product.ajax_variation')->with('dataArr', $dataArr);
    }

    /**
     * variation options listing
     * @param integer $variation_id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getVarOpt($variation_id)
    {
        $variationOptArr = VariationOption::where('variation_id', $variation_id)->orderBy('name')->get();

        $dataArr = [
            "variationOptArr" => $variationOptArr,
            "variation_id" => $variation_id,
        ];

        return view('pages.admin.product.ajax_variation_option')->with('dataArr', $dataArr);
    }


    /**
     * delete product rating
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productRatingRemove($id)
    {
        Rating::find($id)->delete();

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Rating deleted successfully."
            ]
        ]);
    }
}
