<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HasherContract $hasher)
    {
        $this->hasher = $hasher;
        $this->middleware('guest');
    }

    /**
     * Display the password reset view for the given request. Point being to be able to provide more accurate
     * errors when things fail. This is ridiculous and should be built-in.
     *
     * If the request is invalid (email, token [exact or timed]), display the link request form.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string|null $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $email, $token = null)
    {
        $rec = PasswordReset::where('email', base64_decode($email))->first();

        if (!$rec) {
            return redirect()->route('password.request')->withErrors(
                ['invalid' => 'Unknown email address. Please try again.']
            );
        }

        $valid = $this->hasher->check($request->token, $rec->token) &&
                 $rec->created_at > Carbon::now()->subMinutes(config('auth.passwords.users.expire'));
        if (!$valid){
            return redirect()->route('password.request')->withInput()->withErrors(
                ['invalid'=>'Unknown or expired reset token. Please try again.']
            );
        }

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $rec->email]
        );
    }

}
