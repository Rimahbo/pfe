<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\EmailService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    protected $request;
    function __construct(Request $request){
        $this->request =$request;
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    public function existEmail(){
        $Email = $this->request->input('email');
        $user = User::where('email',$Email)->first();


    $response = "";
    ($user) ? $response ="exist" : $response ="not_exist";
    return response()->json([
        'code'=> 200,
        'response'=> $response
    ]);
    }

    public function activation_Code($token){
        $user = User::where('activation_token',$token)->first();
        if(!$user){
            return redirect()->route('login')->with('danger','This token does not match any user!');

        }
        if($this->request->isMethod('post')){
            $code = $user->activation_code;
            $activation_code = $this->request->input('activation-code');
            if($activation_code != $code){
                return back()->with([
                    'danger' => 'This activation code is invalid!',

                    'activation_code' => $activation_code
                ]);
            }else{
                DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'is_verified'=> 1,
                    'activation_code' =>'',
                    'activation_token' =>'',
                    'email_verified_at' => new \DateTimeImmutable,
                    'updated_at' => new \DateTimeImmutable

                ]);
                return redirect()->route('login')->with('success','your email address has been verified!');
            }

        }
        return view('auth.activation_code', [
            'token' =>$token
        ]);
    }
    public function userChecker(){
        $activation_token = Auth::user()->activation_token;
        $is_verified = Auth::user()->is_verified;
        if($is_verified != 1){
            Auth::logout();
            return redirect()-> route('app_activation_code',['token' => $activation_token])
                ->with('warning','your account is not activate yet, please check your mail-box and activate your account or resend the confirmation message .');

        }else{
            return redirect()-> route('app_dashboard');


        }

    }
    public function resendActivationCode($token){
        $user = User::where('activation_token',$token)->first();
        $email = $user->email;
        $name = $user->name;
        $activation_token = $user->activation_token;
        $activation_code = $user->activation_code;
        $emailSend = new EmailService;
        $subject = "activate your account";


        $emailSend->sendEmail($subject,$email,$name, true,$activation_code,$activation_token );
        return redirect()->route('app_activation_code',['token'=>$token])->with('success','You have just resent a new activation code.');

    }

    public function activationAccountLink($token){
        $user = User::where('activation_token',$token)->first();
        if(!$user){
            return redirect()->route('login')->with('danger','This token does not match any user!');

        }

            DB::table('users')
            ->where('id', $user->id)
            ->update([
                'is_verified'=> 1,
                'activation_code' =>'',
                'activation_token' =>'',
                'email_verified_at' => new \DateTimeImmutable,
                'updated_at' => new \DateTimeImmutable

            ]);
        return redirect()->route('login')->with('success','your email address has been verified!');


    }
    public function activationAccountChangeEmail($token)
    {   $user = User::where('activation_token',$token)->first();

        if($this->request->isMethod('post')){
            $new_email = $this-> request->input('new-email');
            $user_existe = User::where('email', $new_email)->first();
            if($user_existe){
                return back()->with([
                    'danger' => 'This email address is already in use! Please enter a different email address!',
                    'new-email' => $new_email
                ]);

            }else{
                DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'email' => $new_email,
                    'updated_at' => new \DateTimeImmutable

                ]);
                $activation_code= $user->activation_code;
                $activation_token= $user->activation_token;
                $name= $user->name;

                $emailSend = new EmailService;
                $subject = "activate your account";


                $emailSend->sendEmail($subject,$new_email,$name, true,$activation_code,$activation_token );
                return redirect()->route('app_activation_code',['token'=>$token])->with('success','You have just resent a new activation code.');

                }
        }else{
            return view('auth.activation_account_change_email', ['token'=>$token]);

        }
    }
    public function forgotPassword(){
        if($this->request->isMethod('post')){
            $email = $this->request->input('email');
            $user = DB::table('users')->where('email',$email)->first();
            if($user){



            }else{
                $message = 'the email you entered does not exist!';
                return back()->withInput()->withErrors(['email'=>$message]);
            }




        }

        return view('auth.forgot_password');
    }
}
