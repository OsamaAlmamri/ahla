<?php


namespace App\Http\Controllers\API;

use App\Http\Resources\ProblemsCategoriesResourse;
use App\Models\General\Governorate;
use App\Http\Resources\GovernorateResourse;
use App\Models\POS\ProblemCategory;
use Exception;
use Illuminate\Http\Request;
use Validator;

class ProjectApiController extends BaseAPIController
{
    public function __construct()
    {
//        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function error_codes()
    {
        return $this->sendResponse(config('error_codes'), '  error codes  ');

    }



}




