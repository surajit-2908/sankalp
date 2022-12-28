<?php

/**
 * @author Samim
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Storage;
use Auth;
use App\Models\UserLog;


class BaseController extends Controller
{
    const PRODUCT_PIC = 'product_image';
    const BROCHURE = 'brochure';

    /**
     * user log
     * @param string $log
     * @return string
     */
    public function insertUserLog($log, $order_id = 0)
    {
        $user = Auth::guard('admin')->user();
        if ($user->admin_type != 'A') {
            UserLog::create([
                'user_id' => $user->id,
                'order_id' => $order_id,
                'log' => $log
            ]);
        }
    }

    /**
     * update image
     * @param mixed $folder
     * @param mixed $uploadedFile
     * @param string $filename
     * @return void
     */
    public function uploadImageToStorage($folder, $uploadedFile, $filename)
    {
        if (!Storage::makeDirectory('public/' . $folder)) {
            throw new \Exception('Could not create the directory');
        }

        Storage::disk('public')->putFileAs(
            $folder,
            $uploadedFile,
            $filename
        );
    }

    /**
     * update image
     * @param mixed $image
     * @param mixed $folder
     * @param mixed $uploadedFile
     * @param string $filename
     * @return void
     */
    public function updateImageToStorage($image, $folder, $uploadedFile, $filename)
    {
        if (!Storage::makeDirectory('public/' . $folder)) {
            throw new \Exception('Could not create the directory');
        }
        if (!is_null($image)) {
            Storage::disk('public')->delete($folder . '/' . $image);
        }

        Storage::disk('public')->putFileAs(
            $folder,
            $uploadedFile,
            $filename
        );
    }

    /**
     * Generate random integer of the given length
     * @param int $length
     * @return int $result
     */
    public function generateOtp($length)
    {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }
}
