<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\OTPVerificationController;
use Mail;
use App\Mail\EmailManager;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->user()->email != null) {
            return $request->user()->hasVerifiedEmail()
                            ? redirect($this->redirectPath())
                            : view('auth.verify');
        }
        else {
            $otpController = new OTPVerificationController;
            $otpController->send_code($request->user());
            return redirect()->route('verification');
        }
    }


    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

    public function verification_confirmation($code){
        $user = User::where('verification_code', $code)->first();
        if($user != null){
            $user->email_verified_at = Carbon::now();
            $user->save();
            auth()->login($user, true);
            flash(translate('Your email has been verified successfully'))->success();
            if($user->referred_by != null) {
                $referredByUser = User::findOrFail($user->referred_by, ['email']);
                $array['view'] = 'emails.newsletter';
                $array['subject'] = "Gi???i thi???u th??nh vi??n " . $user->id . " ????ng k?? ???? x??c th???c";
                $array['from'] = env('MAIL_USERNAME');
                $array['content'] = "B???n ???? gi???i thi???u th??nh c??ng cho th??nh vi??n #" . $user->id;

                try {
                    Mail::to($referredByUser->email)->queue(new EmailManager($array));
                } catch (\Exception $e) {
                    dd($e);
                }
            }
        }
        else {
            flash(translate('Sorry, we could not verifiy you. Please try again'))->error();
        }

        return redirect()->route('dashboard');
    }
}
