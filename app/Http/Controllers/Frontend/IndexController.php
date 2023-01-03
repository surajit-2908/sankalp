<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Enquiry;
use App\Models\Order;
use App\Models\Tracking;
use App\Models\Product;
use App\Models\Category;
use App\Models\PageMetaTag;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryEmail;
use App\Mail\OrderTrackingEmail;

class IndexController extends BaseController
{

    /**
     * Home page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $metaTag = PageMetaTag::find(1);
        return view('pages.frontend.index', compact('metaTag'));
    }

    /**
     * enquiry page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function aboutUs()
    {
        $metaTag = PageMetaTag::find(2);
        return view('pages.frontend.about_us', compact('metaTag'));
    }

    /**
     * enquiry page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function product($cat_slug)
    {
        $metaTag = PageMetaTag::find(4);
        $category = Category::where('slug', $cat_slug)->first();
        $products = Product::whereStatus('1')->where('cat_id', $category->id)->orWhere('sub_cat_id', $category->id)->get();

        return view('pages.frontend.product', compact('products', 'category', 'metaTag'));
    }

    /**
     * enquiry page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function productDetails($product_slug)
    {
        $metaTag = PageMetaTag::find(5);
        $productDetail = Product::whereSlug($product_slug)->first();

        return view('pages.frontend.product_details', compact('productDetail', 'metaTag'));
    }

    /**
     * enquiry page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function enquiry()
    {
        $metaTag = PageMetaTag::find(3);
        return view('pages.frontend.enquiry', compact('metaTag'));
    }

    /**
     * enquiry save
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function saveEnquiry(Request $request)
    {
        $this->validate(
            $request,
            [
                'company_name' => 'required',
                'key_person' => 'required',
                'email' => 'required|email',
                'country' => 'required',
                'phone' => 'required',
                'industry' => 'required',
                'enquiry' => 'required',
                'captcha' => 'required|captcha'
            ],
            ['captcha.captcha' => 'Invalid captcha code.']
        );
        if (captcha_check($request->captcha) == false) {
            return redirect()->back()->with([
                "message" => [
                    "result" => "error",
                    "msg" => "Invalid captcha code."
                ]
            ]);
        }

        $input = $request->all();
        Enquiry::create($input);

        // sending new enquiry mail to admin
        $enquiryDetails                  =   [];
        $enquiryDetails['company_name']  =   $request->company_name;
        $enquiryDetails['key_person']    =   $request->key_person;
        $enquiryDetails['email']         =   $request->email;
        $enquiryDetails['country']       =   $request->country;
        $enquiryDetails['phone']         =   $request->phone;
        $enquiryDetails['industry']      =   $request->industry;
        $enquiryDetails['enquiry']       =   $request->enquiry;
        Mail::send(new EnquiryEmail($enquiryDetails));

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Your message has been sent successfully."
            ]
        ]);
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img('flat')]);
    }

    /**
     * showTrackingDetails
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showTrackingDetails(Request $request)
    {
        $input = $request->all();

        $order = Order::where('invoice_number', $input['invoice_number'])->first();
        if ($order) {
            Tracking::create($input);

            // sending new tracking mail to admin
            $trackingDetails                  =   [];
            $trackingDetails['invoice_number'] =   $request->invoice_number;
            $trackingDetails['email']         =   $request->email;
            Mail::send(new OrderTrackingEmail($trackingDetails));
        }
        return view('pages.frontend.ajax_track', compact('order'));
    }
}
