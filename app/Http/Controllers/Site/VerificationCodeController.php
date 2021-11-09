<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\MobileRequest;
use App\Http\Requests\Site\VerificationCodeRequest;
use App\Services\MobileVerficationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerificationCodeController extends Controller
{

    public $mobileVerficationService;

    /**
     * Method __construct
     *
     * @param MobileVerficationService $mobileVerficationService
     *
     * @return void
     */
    public function __construct(MobileVerficationService $mobileVerficationService)
    {
        $this->mobileVerficationService = $mobileVerficationService;
    }

    /**
     * Method index
     *
     * @return view
     */
    public function index()
    {
        return view('site.profile.mobile');
    }

    /**
     * Method sendCode
     *
     * @param MobileRequest $request
     *
     * @return void
     */
    public function sendCode(Request $request)
    {
        $validaor = Validator::make($request->all(), [
            'mobile' => 'required|numeric',
        ]);

        if($validaor->fails()) {
            return response()->json($validaor->errors());
        }

        $this->mobileVerficationService->sendCode($request->mobile);
    }

    /**
     * Method verify
     *
     * @param VerificationCodeRequest $request
     *
     * @return redirect
     */
    public function verify(VerificationCodeRequest $request)
    {
        $check = $this->mobileVerficationService->checkOTPCode($request->code);

        if($check) {
            return redirect()->route('profile.mobile')->with('success', 'mobile added successfuly');
        } else {
            return redirect()->back()->with('error', 'wrong code');
        }
    }
}
