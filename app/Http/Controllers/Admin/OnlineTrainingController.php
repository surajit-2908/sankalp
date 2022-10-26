<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\OnlineTraining;
use App\Models\OnlineTrainingRating;
use Storage;

class OnlineTrainingController extends BaseController
{

    /**
     * online training listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $onlineTrainingArr = OnlineTraining::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Online Training",
            "onlineTrainingArr" => $onlineTrainingArr
        ];

        return view('pages.admin.online_training.index')->with('dataArr', $dataArr);
    }

    /**
     * OnlineTraining detail
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onlineTrainingDetail($id)
    {
        $OnlineTrainingDetail = OnlineTraining::find($id);

        $dataArr = [
            "page_title" => "Online Training Details",
            "OnlineTrainingDetail" => $OnlineTrainingDetail
        ];

        return view('pages.admin.online_training.online_training_detail')->with('dataArr', $dataArr);
    }

    /**
     * online training add page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onlineTrainingAdd()
    {
        $dataArr = [
            "page_title" => "Add Online Training",
        ];

        return view('pages.admin.online_training.add_online_training')->with('dataArr', $dataArr);
    }

    /**
     * online training store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onlineTrainingInsert(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'hours' => 'required',
            'description' => 'required',
            'price' => 'required',
            'selling_price' => 'required',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt | max:500000',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048'
        ]);

        $img = $request->image;
        if ($img) {
            $uploadedFile = $img;
            $filename = time() . "." . $uploadedFile->getClientOriginalExtension();

            self::uploadImageToStorage(self::ONLINE_TRAINING_FILE, $uploadedFile, $filename);
        }

        $video = $request->video;
        if ($video) {
            $uploadedVideoFile = $video;
            $videoFilename = time() . rand('1111', '9999') . "." . $uploadedVideoFile->getClientOriginalExtension();

            self::uploadImageToStorage(self::ONLINE_TRAINING_FILE, $uploadedVideoFile, $videoFilename);
        }

        // $link = $request->youtube_url;
        // $youtube_video_id = self::getYoutubeVideoId($link);
        OnlineTraining::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'hours' => $request->hours,
            'description' => $request->description,
            'price' => $request->price,
            'selling_price' => $request->selling_price,
            'image' => $filename,
            'video' => @$videoFilename,
            // 'youtube_video_id' => $youtube_video_id,
            // 'youtube_url' => $request->youtube_url,
        ]);

        return redirect()->route('admin.online.training')->with([
            "message" => [
                "result" => "success",
                "msg" => "Online Training added successfully."
            ]
        ]);
    }

    /**
     * online training edit page
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onlineTrainingEdit($id)
    {
        $onlineTrainingArr = OnlineTraining::find($id);
        $dataArr = [
            "page_title" => "Edit Online Training",
            "onlineTrainingArr" => $onlineTrainingArr,
        ];

        return view('pages.admin.online_training.edit_online_training')->with('dataArr', $dataArr);
    }

    /**
     * online training update
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onlineTrainingUpdate(Request $request, $id)
    {
        $onlineTrainingArr = OnlineTraining::find($id);

        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'hours' => 'required',
            'description' => 'required',
            'price' => 'required',
            'selling_price' => 'required',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt | max:500000',
            'image' => 'nullable|mimes:jpeg,png,jpg|max:2048'
        ]);

        $img = $request->image;
        if ($img) {
            $uploadedFile = $img;
            $filename = time() . "." . $uploadedFile->getClientOriginalExtension();

            self::updateImageToStorage($onlineTrainingArr->image, self::ONLINE_TRAINING_FILE, $uploadedFile, $filename);
            $updateArray['image'] = $filename;
        }

        $video = $request->video;
        if ($video) {
            $uploadedVideoFile = $video;
            $videoFilename = time() . rand('1111', '9999') . "." . $uploadedVideoFile->getClientOriginalExtension();

            self::updateImageToStorage($onlineTrainingArr->video, self::ONLINE_TRAINING_FILE, $uploadedVideoFile, $videoFilename);
            $updateArray['video'] = $videoFilename;
        }

        // $link = $request->youtube_url;
        // $youtube_video_id = self::getYoutubeVideoId($link);

        $updateArray['title'] = $request->title;
        $updateArray['sub_title'] = $request->sub_title;
        $updateArray['hours'] = $request->hours;
        $updateArray['description'] = $request->description;
        $updateArray['price'] = $request->price;
        $updateArray['selling_price'] = $request->selling_price;
        // $updateArray['youtube_video_id'] = $youtube_video_id;
        // $updateArray['youtube_url'] = $request->youtube_url;
        $onlineTrainingArr->update($updateArray);

        return redirect()->route('admin.online.training')->with([
            "message" => [
                "result" => "success",
                "msg" => "Online Training updated successfully."
            ]
        ]);
    }

    /**
     * online training remove
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onlineTrainingRemove($id)
    {
        $onlineTrainig = OnlineTraining::find($id);
        if (!is_null($onlineTrainig)) {
            Storage::disk('public')->delete(self::ONLINE_TRAINING_FILE . '/' . $onlineTrainig->image);
            Storage::disk('public')->delete(self::ONLINE_TRAINING_FILE . '/' . $onlineTrainig->video);
        }
        $onlineTrainig->delete();

        return redirect()->route('admin.online.training')->with([
            "message" => [
                "result" => "success",
                "msg" => "Online Training deleted successfully."
            ]
        ]);
    }


    /**
     * change online training bottom status
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function bottomStatus($id)
    {
        $onlineTraining = OnlineTraining::find($id);

        $bottom_item = $onlineTraining->bottom_item ? "0" : "1";

        $updateArr['bottom_item'] = $bottom_item;
        $onlineTraining->update($updateArr);

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Show in bottom status changed successfully."
            ]
        ]);
    }


    /**
     * delete Online Training rating
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onlineTrainingRatingRemove($id)
    {
        OnlineTrainingRating::find($id)->delete();

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Rating deleted successfully."
            ]
        ]);
    }
}
