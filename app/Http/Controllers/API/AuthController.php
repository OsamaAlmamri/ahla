<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Rules\MatchOldPassword;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class AuthController extends BaseAPIController
{
    public function __construct()
    {
//        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        try {
            $credential_phone    = ['phone' => $request->email, 'password' => $request->password];
            $credential_email    = ['email' => $request->email, 'password' => $request->password];

            if ($token = JWTAuth::attempt($credential_email))
                return $this->respondWithToken($token);
            elseif ($token = JWTAuth::attempt($credential_phone))
                return $this->respondWithToken($token);
            else
                return $this->unAuthError();

        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $match = new MatchOldPassword;

            $validator = Validator::make($request->all(), [
                'current_password' => ['required', $match],
                'new_password'     => ['required'],
            ], [
                'current_password.required' => 'كلمة  المرور الحالية مطلوبة',
                'new_password.required'     => 'كلمة  المرور الجديدة مطلوبة',
                'new_confirm_password.same' => 'كلمة  المرور الجديدة غير متطابقة ',
            ]);
            if ($validator->fails()) {
                return $this->validationFirstError($validator, 4);
            }
            $user = auth()->user();
            $user->update(['password' => Hash::make($request->new_password)]);

            return $this->sendResponse(1, 'تم تغيير كلمة المرور بنجاح ');
        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }

    public function me(\Illuminate\Http\Request $request)
    {
        try {
//            $user = JWTAuth::parseToken()->authenticate();

            return $this->sendResponse(new UserResource(auth()->user()), "بيانات المستخدم");

        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }


    public function logout()
    {
        try {
            auth('api')->logout();
            $this->sendResponse(0, "تم تسجيل الحروج بنجاح");
        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }


    public function refresh()
    {
        try {
            return $this->respondWithToken(auth()->refresh());
        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }

    protected function respondWithToken($token)
    {
        $user = JWTAuth::user();
        if ($user->active == 0)
            return $this->sendError([], 5);
        $data = [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'users'        => new UserResource($user),
        ];

        return $this->sendResponse($data, "تم تسجيل الدخول بنجاح");
    }
}
