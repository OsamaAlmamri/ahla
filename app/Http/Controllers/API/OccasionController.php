<?php

namespace App\Http\Controllers\API;

use App\Events\PosDetailEvent;
use App\Http\Resources\OccasionResource;
use App\Http\Resources\PosCodeResourse;
use App\Http\Resources\PosDetailResourse;
use App\Http\Resources\PosImportantDataResourse;
use App\Http\Resources\UserResource;
use App\Http\Resources\VisitorsResource;
use App\Models\General\PosCode;
use App\Models\General\PosDetail;
use App\Models\General\User;
use App\Models\Occasion;
use App\Models\POS\ActivationNumber;
use App\Models\POS\RoadPlan;
use App\Models\Visitor;
use App\Observers\VisitorsObserver;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;

class OccasionController extends BaseAPIController
{

    public function __construct()
    {
//        $this->middleware('auth:api', ['except' => ['login']]);
        ini_set('max_execution_time', 0);
        ini_set('post_max_size', "100M");
    }

    public function occasion(Request $request)
    {
        try {
            $devlopers = Occasion::paginate(10);
            OccasionResource::collection($devlopers);

            return $this->sendResponse($devlopers, "Occasion");
        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }


    public function visitors(Request $request)
    {
        try {
            if (isset($request->ccasion_id) and $request->ccasion_id > 0)
                $devlopers = Visitor::where('ccasion_id', $request->ccasion_id)->paginate(10);
            else
                $devlopers = Visitor::paginate(10);
            VisitorsResource::collection($devlopers);

            return $this->sendResponse($devlopers, "Visitor");
        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }

    public function reports(Request $request)
    {
        try {
            if (isset($request->ccasion_id) and $request->ccasion_id > 0)
                $oc = Occasion::find($request->ccasion_id);
            else
                $oc = Occasion::get()->last();
            $o = new OccasionResource($oc);

            return $this->sendResponse($o, "Visitor");
        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }


    public function change_status(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'qr_code' => ['required'],
                'type' => ['required'],
            ]);
            if ($validator->fails()) {
                return $this->validationError($validator);

            }
            $visitor = Visitor::where('qr_code', $request->qr_code)->get()->first();

            if ($visitor == null)
                         return $this->sendResponse([], "in vaild ", 500);
            if ($request->type == 'is_login' and $visitor->is_login == 0)
                $add = ['is_login' => 1, 'login_time' => now()];
            elseif ($request->type == 'have_food' and $visitor->have_food == 0)
                $add = ['have_food' => 1, 'food_time' => now()];
            elseif ($request->type == 'is_send')
                $add = ['is_send' => 1];
            else
                $add = ['is_send' => 1];
            $r = $visitor->update($add);
            $visitor = new VisitorsResource($visitor);
            return $this->sendResponse($visitor, "status change successfully");
        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }


}
