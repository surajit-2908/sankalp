<?php

/**
 * @author Surajit
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\Models\ContactUs;
use Route;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbackArr = ContactUs::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Feedback",
            "feedbackArr" => $feedbackArr
        ];

        return view('pages.admin.feedback.feedback')->with('dataArr', $dataArr);
    }

    public function feedbackRemove($id)
    {
        ContactUs::where('id', $id)->delete();

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Feedback deleted successfully."
            ]
        ]);
    }
}
