<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use App\Models\UserVerificationCode;
use App\Http\Requests\Site\VerificationCodeRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MobileVerficationService {

    /**
     * Method setVerificationCode
     *
     * @param $user
     *
     * @return UserVerificationCode
     */
    public function setVerificationCode($user) {

        $code = mt_rand(10000, 99999);

        UserVerificationCode::whereNotNull('user_id')->where('user_id', $user->id)->delete();

        // save code to database
       return UserVerificationCode::create([
            'user_id' => $user->id,
            'code' => $code,
        ]);
    }

    /**
     * Method getSmsVerifyMessage
     *
     * @param $code
     *
     * @return message
     */
    public function getSmsVerifyMessage($code)
    {
        $message = 'your verification code is ' . $code;

        return $message;
    }

    /**
     * Method sendCode
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function sendCode($mobile)
    {

        $mobileVerifiction = new MobileVerficationService();

        $verificationData = $mobileVerifiction->setVerificationCode(auth()->user());

        $message = $mobileVerifiction->getSmsVerifyMessage($verificationData->code);

        app(SMSGatewayService::class)->send($mobile, $message);

        session(['mobile' => $mobile]);

    }

     /**
     * Method reciveCode
     *
     * @param Request $request
     *
     * @return bool
     */
    public function checkOTPCode($code) {

        $userCode= UserVerificationCode::where('user_id', auth()->user()->id)->first();

        if ($userCode->code == $code) {

            $user = User::find(auth()->user()->id);

            $user->update([
                'mobile_verified_at' => Carbon::now(),
                'mobile' => session('mobile'),
            ]);

            request()->session()->forget('mobile');

            UserVerificationCode::where('user_id', $user->id)->delete();

            return true;

        } else {
            return false;

        } // end if

    }

}
