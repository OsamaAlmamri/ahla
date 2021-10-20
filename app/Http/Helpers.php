<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;




function createImageFromFile($file, $sub_folder)
{
    if (!$file)
        return null;
    $folderPath = "pos/$sub_folder/";
//        $file_name = uniqid() . '.' . $file->extension();
    $storagePath = Storage::disk('local')->put("public/" . $folderPath, $file);
    $storageName = basename($storagePath);

    return $folderPath . $storageName;

}


function getVisitsProblemCategoriesInfo($type = "all")
{
    $types = [
        'problem'  => __('problem'),
        'requests' => __('requests'),
        'news'     => __('news'),
        'other'    => __('other'),
    ];


    if ($type == "all") {
        return $types;
    } else {
        return $types[$type];
    }

}

function convertToHoursMins($time, $format = '%02d:%02d')
{
    if ($time < 1) {
        return 0;
    }
    $hours   = floor($time / 60);
    $minutes = ($time % 60);

    return sprintf($format, $hours, $minutes);
}

function getMaxCode($code)
{

    return sprintf("%05d", $code * 1000) + 1000;
}

function getFilterValue($class_name)
{

    $queryFilters   = \request()->query('filters');
    $decodedFilters = collect(json_decode(base64_decode($queryFilters), true));
    $computed       = $decodedFilters->map(function ($filter) {
        $class = explode('\\', $filter['class']);

        return array('class' => end($class), 'value' => $filter['value']);
    });
    $x              = array_search($class_name, array_column(json_decode($computed, true), 'class'));

//    return  $computed;
    return ($x == false) ? $x : $computed[$x]['value'];

}

function getResourseNameToReturnValue($deafult)
{

    $queryFilters = request()->viaResource;

    return ($queryFilters == null) ? $deafult : $queryFilters . '/' . request()->viaResourceId;


}


function openJSONFile($code)
{
    $jsonString = [];
    if (File::exists(base_path('resources/lang/' . $code . '.json'))) {
        $jsonString = file_get_contents(base_path('resources/lang/' . $code . '.json'));
        $jsonString = json_decode($jsonString, true);
    }

    return $jsonString;
}

/**
 * Save JSON File
 * @return Response
 */
function saveJSONFile($code, $data)
{
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/' . $code . '.json'), stripslashes($jsonData));
}


if (!function_exists('notify_users')) {

    function notify_users($title, $body, $user_ids, $notification)
    {
        $token = \App\User::whereIn('id', array_unique($user_ids))
            ->where('fcm_token', '!=', null)->pluck('fcm_token')->toArray();
        $users = \App\User::whereIn('id', array_unique($user_ids))->get();
        $notification->users()->attach($users);
        if (isset($token) && !is_null($token)) {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60 * 20);
            $notificationBuilder = new PayloadNotificationBuilder($title);
            $notificationBuilder->setBody($body)
                ->setSound('default');
            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['a_data' => 'my_data']);
            $option           = $optionBuilder->build();
            $fcm_notification = $notificationBuilder->build();
            $data             = $dataBuilder->build();
            foreach ($token as $tok)
                $downstreamResponse = FCM::sendTo($tok, $option, $fcm_notification, $data);
            //   foreach ($users as $user) {
            //       broadcast(new NewNotificationUser($notification , $user));
            //       $user->notifications()->attach($notification);
            //   }
            return true;
        }

        return false;
    }


}


if (!function_exists('resizeUploadImage')) {
    function resizeUploadImage($upload, $path, $resize_width = 200, $resize_height = 230)
    {
        if (!file_exists($path)) {
            mkdir($path, 666, true);
        }
        $filename = rand() . time() . '.' . $upload->getClientOriginalExtension();
        $filePath = $path . '/' . $filename;
        $thumb    = Image::make($upload)->resize($resize_width, $resize_height)->encode($upload->getClientOriginalExtension(), 75);
        $thumb->save(public_path($filePath));

        return $filePath;
    }
}

if (!function_exists('webpUploadImage')) {
    function webpUploadImage($upload, $path)
    {
        if (!file_exists($path)) {
            mkdir($path, 666, true);
        }
        $filename = rand() . time() . '.' . $upload->getClientOriginalExtension();
        $filePath = $path . '/' . $filename;
        $thumb    = Image::make($upload)->encode($upload->getClientOriginalExtension(), 75);
        $thumb->save(public_path($filePath));

        return $filePath;
    }
}

if (!function_exists('deleteImage')) {
    function deleteImage($path)
    {
        if (file_exists($path)) {
            $delete = File::delete($path);
            if ($delete) return 1;
        }

        return 0;
    }
}

if (!function_exists('resizeUpdateImage')) {
    function resizeUpdateImage($upload, $path, $resize_width = 200, $resize_height = 230)
    {
        $name     = $upload->getClientOriginalName();
        $name     = substr($name, 0, strpos($name, '.'));
        $filePath = $path . '/' . $name . $upload->getClientOriginalExtension();
        $thumb    = Image::make($upload)->resize($resize_width, $resize_height)->encode($upload->getClientOriginalExtension(), 75);
        $thumb->save(public_path($filePath));
        if (File::exists($path . '/' . $upload->getClientOriginalName())) {
            File::delete($path . '/' . $upload->getClientOriginalName());
        }

        return $filePath;
    }
}

?>
