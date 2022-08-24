<?php

use App\Libraries\Common;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Tutor;

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }
}

if (!function_exists('uploadLibrary')) {
    function uploadLibrary($image)
    {
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $storage = 'public/';
        $image->storeAs($storage, $imageName);
        return $imageName;
    }
}

if (!function_exists('getFileFromPath')) {
    // function getFileFromPath($images, $path = '')
    // {
    //     $file_list = array();
    //     foreach ($images as $image) {
    //         $image->path = $path;
    //         $file_path = $image->image_path;
    //         $info = pathinfo($file_path);

    //         if (file_exists(public_path($path . $image->image))) {
    //             $size = File::size(public_path($path . $image->image));
    //             $mimeType = File::mimeType(public_path($path . $image->image));
    //             $file_list[] = array(
    //                 'name' => $info['basename'],
    //                 'size' => $size,
    //                 'path' => $file_path,
    //                 'url' => $image->path,
    //                 'type' => $mimeType
    //             );
    //         }
    //     }
    //     return json_encode($file_list);
    // }
}

function convertFormat($images)
{
    // $file_list = array();
    // foreach ($images as $image) {
    //     $path = 'uploads/' . $image->id . '/';
    //     $path = 'uploads/' . $image->id . '/';
    //     $image->path = $path;
    //     $file_path = $image->getFullUrl();
    //     $info = pathinfo($file_path);
    //     if (file_exists(public_path($path . $image->file_name))) {
    //         $size = File::size(public_path($path . $image->file_name));
    //         $mimeType = File::mimeType(public_path($path . $image->file_name));
    //         $file_list[] = array(
    //             'name' => $info['basename'],
    //             'size' => $size,
    //             'path' => $file_path,
    //             'url' => $image->path,
    //             'type' => $mimeType
    //         );
    //     }
    // }
    // return json_encode($file_list);
}

function thumbnail($url = '', $with = 300, $height = 300, $t = 1)
{
    if (empty($url)) {
        $url = 'img/no-image.jpg';
    }
    $url = urldecode($url);
    $url = parse_url($url, PHP_URL_PATH);
    $url = ltrim($url, '/');

    return route('frontend.thumbnail', ['file' => $url, 'width' => $with, 'height' => $height, 't' => $t]);
}

function getUrlImage($value = '', $default = 'img/no-image.jpg', $with = 300, $height = 300)
{
    if (empty($value)) {
        $url = $default;
        return asset($url);
    }

    $path = 'storage/' . $value;
    if (file_exists(public_path($path))) {
        return thumbnail(asset($path));
    }

    return asset($default);
}

function getUrlFile($value = '', $default = 'storage/imgs/no-image.jpg')
{
    $path = 'storage/' . $value;
    if (file_exists(public_path($path))) {
        return asset($path);
    }

    return asset($default);
}

function validateDate($date, $format = 'Y-m-d')
{
    if ($date == "24:00") {
        return true;
    }
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.

    return ($d && $d->format($format) === $date) || ($d && "0" . $d->format($format) === $date);
}

if (!function_exists('checkExitsReferralCode')) {
    // function checkExitsReferralCode($code)
    // {
    //     $code = Common::clearXSS($code);
    //     $user = User::where('my_referral_code', $code)->first();
    //     if ($user) {
    //         return true;
    //     }
    //     $tutor = Tutor::where('my_referral_code', $code)->first();
    //     if ($tutor) {
    //         return true;
    //     }
    //     return false;
    // }
}

if (!function_exists('converHoureToAddZero')) {
    function converHoureToAddZero($hour)
    {
        $arr = explode(":", $hour);
        if (intval($arr[0]) < 10 && intval($arr[0][0]) != 0) {
            $arr[0] = "0" . $arr[0];
        }
        return implode(":", $arr);
    }
}
