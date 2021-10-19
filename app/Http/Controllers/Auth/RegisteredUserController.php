<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\MobileVerficationService;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\SMSGatewayService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{

    protected $mobileSms;

    public function __construct(MobileVerficationService $mobileSms)
    {
        $this->mobileSms = $mobileSms;
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'mobile' => ['required', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
        ]);

        event(new Registered($user));

        $verificationData = $this->mobileSms->setVerificationCode($user);

        $message = $this->mobileSms->getSmsVerifyMessage($verificationData->code);

        app(SMSGatewayService::class)->send($user->mobile, $message);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function index()
    {
        return view('site.sms.index');
    }

    public function verificationCode()
    {
        return view('auth.verification-code');
    }

    public function verificationCodePost(Request $request)
    {
        return $request;
    }

}
