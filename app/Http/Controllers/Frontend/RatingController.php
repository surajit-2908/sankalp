<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\User;
use App\Models\UserAddress;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Storage;
use DB;

class RatingController extends BaseController
{

    /**
     * my rating Review page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function myRatingReview()
    {
        $ratings = Rating::where(['user_id' => Auth::id()])->orderByDesc('created_at')->get();
        return view('pages.frontend.profile.my_rating_reviews', compact('ratings'));
    }

    /**
     * rating Review page
     * @param mixed $booking_number
     * @param mixed $product_slug
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ratingReview($booking_number, $product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        $rating = Rating::where(['user_id' => Auth::id(), 'order_number' => $booking_number, 'product_id' => $product->id])->first();
        return view('pages.frontend.profile.rating_reviews', compact('product', 'rating', 'booking_number'));
    }

    /**
     * save Review
     * @param mixed $product_id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function saveReview(Request $request, $booking_number, $product_id)
    {
        $request->validate([
            'rating' => 'required',
            'description' => 'required',
        ]);

        $rating = Rating::where(['user_id' => Auth::id(), 'order_number' => $booking_number, 'product_id' => $product_id])->first();
        if ($rating) {
            $rating->update([
                'user_id'      => Auth::id(),
                'order_number' => $booking_number,
                'product_id'   => $product_id,
                'rating'       => $request->rating,
                'title'        => $request->title,
                'description'  => $request->description
            ]);
            return redirect()->route('user.my.rating.review')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Your rating & review updated successfully."
                ]
            ]);
        } else {
            Rating::create([
                'user_id'      => Auth::id(),
                'order_number' => $booking_number,
                'product_id'   => $product_id,
                'rating'       => $request->rating,
                'title'        => $request->title,
                'description'  => $request->description
            ]);
            return redirect()->route('user.my.orders')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Thanks for your rating & review."
                ]
            ]);
        }
    }

    /**
     * remove rating
     * @param mixed $ratingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeRating($ratingId)
    {
        Rating::find($ratingId)->delete();

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Rating deleted successfully."
            ]
        ]);
    }
}
