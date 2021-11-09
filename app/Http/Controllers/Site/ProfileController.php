<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\MobileRequest;
use App\Http\Requests\Site\ProfileRequest;
use App\Http\Requests\Site\VerificationCodeRequest;
use App\Services\MobileVerficationService;
use App\Services\SMSGatewayService;
use App\Models\UserVerificationCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    /**
     * Method general
     *
     * @return view
     */
    public function general()
    {
        $user = auth('web')->user();

        return view('site.profile.general', compact('user'));
    }

    /**
     * Method generalStore
     *
     * @param Request $request
     *
     * @return Redirect
     */
    public function generalStore(ProfileRequest $request)
    {

        if($request->password == null) {
            $request['password'] = auth()->user()->password;
        } else {
            $request['password'] = bcrypt($request->password);
        }

        $user = User::find(auth()->user()->id);

        $user->update($request->only(['name', 'email', 'password', 'mobile']));

        return redirect()->back()->with('success', 'profile updated successfuly');
    }


}
