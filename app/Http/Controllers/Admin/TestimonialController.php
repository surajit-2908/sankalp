<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Storage;

class TestimonialController extends BaseController
{

    /**
     * Testimonial listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $testimonialArr = Testimonial::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Testimonial",
            "testimonialArr" => $testimonialArr
        ];

        return view('pages.admin.content.testimonial.index')->with('dataArr', $dataArr);
    }

    /**
     * Testimonial add page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function testimonialAdd()
    {
        $dataArr = [
            "page_title" => "Add Testimonial",
        ];

        return view('pages.admin.content.testimonial.add_testimonial')->with('dataArr', $dataArr);
    }

    /**
     * Testimonial store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function testimonialInsert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'comment' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048',
        ]);

        //upload banner image
        $image = $request->image;
        $filename = "";
        if ($image) {
            $uploadedFile = $image;
            $filename = time() . "." . $uploadedFile->getClientOriginalExtension();

            self::uploadImageToStorage(self::TESTIMONIAL_PIC, $uploadedFile, $filename);
        }
        Testimonial::create([
            'name'          => $request->name,
            'designation'   => $request->designation,
            'comment'       => nl2br($request->comment),
            'image'         => $filename,
        ]);

        return redirect()->route('admin.testimonial')->with([
            "message" => [
                "result" => "success",
                "msg" => "Testimonial added successfully."
            ]
        ]);
    }

    /**
     * Testimonial edit page
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function testimonialEdit($id)
    {
        $testimonialArr = Testimonial::find($id);
        $dataArr = [
            "page_title" => "Edit Testimonial",
            "testimonialArr" => $testimonialArr
        ];

        return view('pages.admin.content.testimonial.edit_testimonial')->with('dataArr', $dataArr);
    }

    /**
     * Testimonial update
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function testimonialUpdate(Request $request, $id)
    {
        $testimonialArr = Testimonial::find($id);

        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'comment' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ]);

        //upload image
        $image = $request->image;
        $filename = $testimonialArr->image;
        if ($image) {
            $uploadedFile = $image;
            $filename = time() . "." . $uploadedFile->getClientOriginalExtension();

            self::updateImageToStorage($testimonialArr->image, self::TESTIMONIAL_PIC, $uploadedFile, $filename);
        }

        $updateArray['name'] = $request->name;
        $updateArray['designation'] = $request->designation;
        $updateArray['comment'] = nl2br($request->comment);
        $updateArray['image'] = $filename;
        Testimonial::find($id)->update($updateArray);

        return redirect()->route('admin.testimonial')->with([
            "message" => [
                "result" => "success",
                "msg" => "Testimonial updated successfully."
            ]
        ]);
    }

    /**
     * Testimonial remove
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function testimonialRemove($id)
    {
        $testimonial = Testimonial::find($id);

        if (!is_null($testimonial)) {
            Storage::disk('public')->delete(self::TESTIMONIAL_PIC . '/' . $testimonial->image);
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonial')->with([
            "message" => [
                "result" => "success",
                "msg" => "Testimonial deleted successfully."
            ]
        ]);
    }
}
