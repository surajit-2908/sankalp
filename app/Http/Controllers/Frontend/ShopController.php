<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController as BaseController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\ProductVariation;
use App\Models\Variation;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class ShopController extends BaseController
{

    /**
     * shop page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function shop($cat_slug = null)
    {
        $categoryArr = Category::where(['parent_id' => '0'])->orderBy('name')->get();
        $productArr = Product::where(['status' => '1']);
        $top_link = "";
        $filter_cat = "";
        if ($cat_slug) {
            $category = Category::where('slug', $cat_slug)->first();
            $category_id = $category->id;
            $productArr->where(function ($query) use ($category_id) {
                $query->where('cat_id', $category_id)
                    ->orWhere('sub_cat_id', $category_id);
            });

            if (@$category->getPcat) {
                $top_link = "> " . $category->getPcat->name . " > " . $category->name;
            } else {
                $top_link = "> " . $category->name;
            }
            $filter_cat = $category;
        }
        $productArr = $productArr->orderBy('created_at', 'DESC')->paginate(30);
        return view('pages.frontend.shop', compact('productArr', 'categoryArr', 'top_link', 'filter_cat'));
    }

    /**
     * product detail page
     * @param mixed $product_slug
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productDetail($product_slug)
    {
        $productDetail = Product::where(['slug' => $product_slug, 'status' => '1'])->first();
        $testimonialArr = Testimonial::orderBy('created_at', 'DESC')->get();
        if ($productDetail) {
            if ($productDetail->sub_cat_id) {
                $products = Product::where(['sub_cat_id' => $productDetail->sub_cat_id, 'status' => '1'])->get();
                $slug = $productDetail->getSubCat->slug;
            } else {
                $products = Product::where(['cat_id' => $productDetail->cat_id, 'status' => '1'])->where('id', '!=', $productDetail->id)->get();
                $slug = $productDetail->getCat->slug;
            }
            $product_qnt = Cart::where(['user_id' => Auth::id(), 'product_id' => $productDetail->id])->sum('quantity');
            $productVarIdArr = ProductVariation::where('product_id', $productDetail->id)->pluck('variation_id');
            $productVarIdArr = $productVarIdArr->toArray();
            $varrArr = Variation::whereIn('id', $productVarIdArr)->pluck('name');
            $jsonArr = json_encode($varrArr);
            $avail_quan = $productDetail->quantity - $product_qnt;

            return view('pages.frontend.product_details', compact('productDetail', 'products', 'slug', 'jsonArr', 'avail_quan', 'testimonialArr'));
        } else
            return redirect()->route('index');
    }

    /**
     * cart page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function cart()
    {
        $user_carts = Cart::where(['user_id' => Auth::id()])->get();
        $setting = Setting::first();
        $sub_total = 0;
        return view('pages.frontend.cart', compact('user_carts', 'sub_total', 'setting'));
    }

    /**
     * cart page
     * @param \Illuminate\Http\Request $request
     * @param mixed $product_id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addCart(Request $request, $product_id)
    {
        $response = [
            'jsonrpc'   => '2.0'
        ];

        $cart = Cart::where(['user_id' => Auth::id(), 'product_id' => $product_id, 'variation_combination' => json_encode($request->variation_combination)])->first();
        if ($cart) {
            $cart->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'variation_combination' => json_encode($request->variation_combination),
                'quantity' => $request->quantity,
            ]);
        }
        $product_qnt = Cart::where(['user_id' => Auth::id(), 'product_id' => $product_id])->sum('quantity');
        $product = Product::find($product_id);
        $available_quan = $product->quantity - $product_qnt;

        $user_cart = Cart::where(['user_id' => Auth::id()])->count();
        $response['status'] = "success";
        $response['user_cart'] = $user_cart;
        $response['available_quan'] = $available_quan;
        return response()->json($response);
    }

    /**
     * buy now process
     * @param \Illuminate\Http\Request $request
     * @param mixed $product_id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function buyNow(Request $request, $product_id)
    {
        $cart = Cart::where(['user_id' => Auth::id(), 'product_id' => $product_id, 'variation_combination' => json_encode($request->variation_combination)])->first();
        if ($cart) {
            $cart->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'variation_combination' => json_encode($request->variation_combination),
                'quantity' => $request->quantity,
            ]);
        }

        $userAdd = UserAddress::whereUserId(Auth::id())->count();
        if ($userAdd) {
            return redirect()->route('check.out');
        } else {
            Session::put('addAddr');
            return redirect()->route('user.manage.address');
        }
    }


    /**
     * delete cart item
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function removeCartItem(Request $request)
    {
        $response = [
            'jsonrpc'   => '2.0'
        ];

        $cartItem = Cart::find($request->cart_id);
        // $setting = Setting::first();
        if ($cartItem)
            $cartItem->delete();
        // $cart_count = Cart::where('user_id', Auth::id())->count();
        // $sub_total = $request->sub_total - $request->product_price;

        // $vat = ($setting->vat / 100) * $sub_total;
        // $not_avail = $request->not_avail;
        // if ($not_avail)
        //     $not_avail--;

        // $response['status'] = "success";
        // $response['sub_total_string'] = "$" . number_format($sub_total, 2);
        // $response['total_string'] = "$" . number_format(($sub_total + $vat + $setting->shipping_charge), 2);
        // $response['sub_total'] = $sub_total;
        // $response['cart_count'] = $cart_count;
        // $response['not_avail'] = $not_avail;
        // $response['vat_string'] = "$" . number_format($vat, 2);
        // return response()->json($response, 200);

        $user_carts = Cart::where(['user_id' => Auth::id()])->get();
        $setting = Setting::first();
        $sub_total = 0;
        return view('pages.frontend.ajax_cart', compact('user_carts', 'sub_total', 'setting'));
    }

    /**
     * cart item change quantity
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function changeQuantity(Request $request)
    {
        $response = [
            'jsonrpc'   => '2.0'
        ];

        $cartItem = Cart::find($request->cart_id);
        // $setting = Setting::first();
        if ($cartItem) {
            // $recentPrice = $cartItem->getProduct->selling_offer_price * $cartItem->quantity;
            // $sub_total = $request->sub_total - $recentPrice;
            // $updatedPrice = $cartItem->getProduct->selling_offer_price * $request->quantity;
            // $sub_total = $sub_total + $updatedPrice;

            $cartItem->update(['quantity' => $request->quantity]);
        }

        // $vat = ($setting->vat / 100) * $sub_total;

        // $response['status'] = "success";
        // $response['sub_total'] = $sub_total;
        // $response['sub_total_string'] = "$" . number_format($sub_total, 2);
        // $response['total_string'] = "$" . number_format(($sub_total + $vat + $setting->shipping_charge), 2);
        // $response['product_price'] = $updatedPrice;
        // $response['product_price_string'] = "$" . number_format($updatedPrice, 2);
        // $response['vat_string'] = "$" . number_format($vat, 2);
        // return response()->json($response, 200);

        $user_carts = Cart::where(['user_id' => Auth::id()])->get();
        $setting = Setting::first();
        $sub_total = 0;
        return view('pages.frontend.ajax_cart', compact('user_carts', 'sub_total', 'setting'));
    }

    /**
     * cart item change quantity
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function changeQuantityChckOut(Request $request)
    {
        $response = [
            'jsonrpc'   => '2.0'
        ];

        $cartItem = Cart::find($request->cart_id);
        // $setting = Setting::first();
        if ($cartItem) {
            // $recentPrice = $cartItem->getProduct->selling_offer_price * $cartItem->quantity;
            // $sub_total = $request->sub_total - $recentPrice;
            // $updatedPrice = $cartItem->getProduct->selling_offer_price * $request->quantity;
            // $sub_total = $sub_total + $updatedPrice;

            $cartItem->update(['quantity' => $request->quantity]);
        }

        // $vat = ($setting->vat / 100) * $sub_total;

        // $response['status'] = "success";
        // $response['sub_total'] = $sub_total;
        // $response['sub_total_string'] = "$" . number_format($sub_total, 2);
        // $response['total_string'] = "$" . number_format(($sub_total + $vat + $setting->shipping_charge), 2);
        // $response['product_price'] = $updatedPrice;
        // $response['product_price_string'] = "$" . number_format($updatedPrice, 2);
        // $response['vat_string'] = "$" . number_format($vat, 2);
        // return response()->json($response, 200);

        $user_cart = Cart::where(['user_id' => Auth::id()])->get();
        $userAddresses = UserAddress::whereUserId(Auth::id())->get();
        $setting = Setting::first();
        $sub_total = 0;

        return view('pages.frontend.ajax_checkout', compact('user_cart', 'sub_total', 'userAddresses', 'setting'));
    }
}
