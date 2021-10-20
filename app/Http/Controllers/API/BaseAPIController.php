<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\General\PosCode;
use App\Models\General\PosDetail;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class BaseAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

    public $data = [];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __construct()
    {
        parent::__construct();

    }

    public function createImage($image_base64_string, $sub_folder)
    {
        if (empty($image_base64_string))
            return null;
        $folderPath   = "pos/$sub_folder/";
        $image_base64 = base64_decode($image_base64_string);
        $f            = finfo_open();
        $image_type   = finfo_buffer($f, $image_base64, FILEINFO_MIME_TYPE);
        $image_type   = (strpos($image_type, 'jpeg') > 0 ? 'jpg' : substr($image_type, -3));
        finfo_close($f);
        $file_name = $folderPath . uniqid() . '.' . $image_type;
        Storage::disk('local')->put("public/" . $file_name, $image_base64);

        return $file_name;
    }

    public function createImageFromFile($file, $sub_folder)
    {
        if (!$file)
            return null;
        $folderPath = "pos/$sub_folder/";
//        $file_name = uniqid() . '.' . $file->extension();
        $storagePath = Storage::disk('local')->put("public/" . $folderPath, $file);
        $storageName = basename($storagePath);

        return $folderPath . $storageName;

    }

    public function updateImageFromFile($file, $sub_folder, $old)
    {
        if (!$file)
            return $old;
        $folderPath = "pos/$sub_folder/";
//        $file_name = uniqid() . '.' . $file->extension();
        $storagePath = Storage::disk('local')->put("public/" . $folderPath, $file);
        $storageName = basename($storagePath);

        return $folderPath . $storageName;

    }


    public function createImage2($img)
    {
//        $folderPath = "images/";
////        $image_parts = explode(";base64,", $img);
////        $image_type_aux = explode("image/", $image_parts[0]);
//        //$image_type ='png';
//        $image_base64 = base64_decode($img);
//        $f = finfo_open();
//        $image_type = finfo_buffer($f, $image_base64, FILEINFO_MIME_TYPE);
//        $image_type = (strpos($image_type, 'jpeg') > 0 ? 'jpg' : substr($image_type, -3));
//        finfo_close($f);
//        $file = $folderPath . uniqid() . '.' . $image_type;
//        file_put_contents($file, $image_base64);
//        return $file;

        // your base64 encoded
        $img       = str_replace('data:image/png;base64,', '', $img);
        $img       = str_replace(' ', '+', $img);
        $imageName = storage_path() . '/' . str_random(10) . '.' . 'png';
        File::put($imageName, base64_decode($img));

        return $imageName;

    }

    public function sendResponse($data, $message, $internal_code = 200, $web_code = 200)
    {
        $headers  = [
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset'      => 'utf-8',
        ];
        $response = [
            'web_code'      => $web_code,
            'internal_code' => $internal_code,
            'message'       => $message,
            'data'          => $data,
        ];

        return response()->json($response, 200, $headers, JSON_UNESCAPED_UNICODE);
    }

    public function sendError($data = [], $internal_code = 10, $web_code = 401)
    {
        $headers  = [
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset'      => 'utf-8',
        ];
        $response = [
            'web_code'      => $web_code,
            'internal_code' => $internal_code,
            'message'       => config('error_codes')[$internal_code],
            'errors'        => $data,
        ];

        return response()->json($response, $web_code, $headers, JSON_UNESCAPED_UNICODE);
    }

    public function catchError($ex)
    {

        $headers  = [
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset'      => 'utf-8',
        ];
        $response = [
            'web_code'      => 500,
            'internal_code' => 500,
            'message'       => $ex->getMessage(),
            'data'          => ($ex->getTraceAsString()),
        ];

        return response()->json($response, 200, $headers, JSON_UNESCAPED_UNICODE);


    }

    public function validationError($validator)
    {
        return $this->sendError($validator->errors(), 2, 422);

    }

    public function codeOwnerError()
    {
        return $this->sendResponse([], config('error_codes')[10], 10);

    }

    public function posApprovedError($error = 12)
    {
        return $this->sendResponse([], config('error_codes')[$error], $error);
    }


    public function codeOwner($code)
    {
        $codeOwner = PosCode::where("poscode", $code)
            ->where("poscode", $code)->get()->first();

        return $codeOwner;

    }

    public function posApproved($code)
    {
        $posApproved = PosDetail::where("code", $code)
            ->where("supervisor_status", "approved")
            ->ofUser()
            ->get()->count();

        return $posApproved;

    }


    public function validationFirstError($validator, $code = 4)
    {
        return $this->sendError($validator->errors(), $code, 422);

    }

    public function unAuthError()
    {
        return $this->sendError([], 1, 403);

    }


}




