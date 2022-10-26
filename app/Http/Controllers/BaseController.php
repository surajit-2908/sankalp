<?php

/**
 * @author Samim
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Storage;


class BaseController extends Controller
{
    const PRODUCT_PIC = 'product_image';
    const PRODUCT_THUMB_PIC = 'product_thumb_image';
    const PRODUCT_PREVIEW_PIC = 'product_preview_image';
    const ONLINE_TRAINING_FILE = 'online_training_file';
    const USER_PIC = 'user_image';
    const TESTIMONIAL_PIC = 'testimonial_image';
    const CONTENT_PIC = 'content_image';

    /**
     * update image
     * @param mixed $link
     * @return string
     */
    public function getYoutubeVideoId($link)
    {
        $video_id = explode("?v=", $link);
        if (empty($video_id[1]))
            $video_id = explode("/v/", $link);

        $video_id = explode("&", $video_id[1]);
        $video_id = $video_id[0];

        return $video_id;
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

    /**
     * braintree gateway
     * @return \Braintree\Gateway
     */
    public function braintreeInit()
    {
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        return $gateway;
    }
}
