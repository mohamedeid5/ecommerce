<?php

namespace App\Services;

use App\Models\UserVerificationCode;

class MobileVerficationService{

    public function setVerificationCode($user) {

        $code = mt_rand(10000, 99999);

        UserVerificationCode::whereNotNull('user_id')->where('user_id', $user->id)->delete();

        // save code to database
       return UserVerificationCode::create([
            'user_id' => $user->id,
            'code' => $code,
        ]);

    }

    public function getSmsVerifyMessage($code)
    {
        $message = 'your verification code is ' . $code;

        return $message;
    }

}
