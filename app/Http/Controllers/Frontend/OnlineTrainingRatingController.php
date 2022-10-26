<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\OnlineTraining;
use App\Models\OnlineTrainingRating;
use App\Models\OnlineTrainingBooking;
use Illuminate\Support\Facades\Auth;

class OnlineTrainingRatingController extends BaseController
{

    /**
     * my rating Review page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function myRatingReview()
    {
        $ratings = OnlineTrainingRating::where(['user_id' => Auth::id()])->orderByDesc('created_at')->get();
        return view('pages.frontend.profile.online_training_rating_reviews', compact('ratings'));
    }

    /**
     * rating Review page
     * @param mixed $booking_number
     * @param mixed $onlineTraining_id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ratingReview($booking_number, $online_training_id)
    {
        $onlineTraining = OnlineTraining::find($online_training_id);
        $rating = OnlineTrainingRating::where(['user_id' => Auth::id(), 'order_number' => $booking_number])->first();
        return view('pages.frontend.profile.add_online_training_rating_reviews', compact('onlineTraining', 'rating', 'booking_number'));
    }

    /**
     * save Review
     * @param mixed $product_id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function saveReview(Request $request, $booking_number)
    {
        $request->validate([
            'rating' => 'required',
            'description' => 'required',
        ]);

        $rating = OnlineTrainingRating::where(['user_id' => Auth::id(), 'order_number' => $booking_number])->first();
        $onlineTraining = OnlineTrainingBooking::where(['booking_number' => $booking_number])->first();
        if ($rating) {
            $rating->update([
                'user_id'      => Auth::id(),
                'order_number' => $booking_number,
                'online_training_id' => $onlineTraining->online_training_id,
                'rating'       => $request->rating,
                'title'        => $request->title,
                'description'  => $request->description
            ]);
            return redirect()->route('user.online.training.rating.review')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Your rating & review updated successfully."
                ]
            ]);
        } else {
            OnlineTrainingRating::create([
                'user_id'      => Auth::id(),
                'order_number' => $booking_number,
                'online_training_id' => $onlineTraining->online_training_id,
                'rating'       => $request->rating,
                'title'        => $request->title,
                'description'  => $request->description
            ]);
            return redirect()->route('user.online.training.orders')->with([
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
        OnlineTrainingRating::find($ratingId)->delete();

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Rating deleted successfully."
            ]
        ]);
    }
}
