<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Client;
use App\ClientSetting;
use App\ClientUser;
use Validator;

class ClientController extends Controller{

    use SendsPasswordResetEmails;
    use ResetsPasswords;

    public function __construct(){
        date_default_timezone_set('Asia/Riyadh');
        $this->middleware("auth:client")->except("login", "do_login", "showLinkRequestForm", "sendResetLinkEmail", "showResetForm", "reset", "register", "do_register");
        $this->middleware("guest:client")->only("login", "do_login", "showLinkRequestForm", "sendResetLinkEmail", "showResetForm", "reset", "register", "do_register");
    }

    // Auth

    public function register(){
        return view("client.auth.register");
    }

    public function do_register(Request $request){
        $this->validator($request->all())->validate();


        $client           = new Client;
        $client->name     = $request->name;
        $client->plan_id  = 1;
        $client->status     = 1;
        $client->save();

        $clientUser             = new ClientUser;
        $clientUser->client_id  = $client->id;
        $clientUser->name       = $request->name;
        $clientUser->email      = $request->email;
        $clientUser->mobile     = $request->mobile;
        $clientUser->password   = bcrypt($request->password);
        $clientUser->default    = 1;
        $clientUser->status     = 1;
        $clientUser->role_id    = 0;
        $clientUser->save();

        /*$setting    = ClientSetting::where("client_id", $client->id)->where("key", "default_lang")->first();
        if($setting){
            \Session::forget('locale');
            \Session::put('locale', $setting->value);
            \App::setlocale($setting->value);
        }*/
        \Session::forget('locale');
        \Session::put('locale', "ar");
        \App::setlocale("ar");
        \Session::put('myclient', $client);

        Auth::guard("client")->attempt(["email" => $request->email, "password" => $request->password], true);

        $request->session()->regenerate();

        return redirect()->route("wizard")->with("success", "مبروك لقد تم تسجيل حسابكم بنجاح");
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255', 'unique:client_users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:client_users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Login page for client dashboard
     *
     * @return a view client login
     */
    public function login(){
        return view("client.auth.login");
    }

    /**
     * Login into  client dashboard
     * @param Request $request
     * @return void
     */
    public function do_login(Request $request){
        $request->validate([
            'email'     => 'required|string',
            'password'  => 'required|string',
        ]);
        $credentials    = ['email' => $request->email, 'password' => $request->password, "status"=>1];
        $client_user           = ClientUser::where("email", $request->email)->first();
        if(!$client_user or !$client_user->client or @$client_user->client->status!=1){
            throw ValidationException::withMessages(['email' => [trans('auth.failed')]]);
        }
        if(Auth::guard("client")->attempt($credentials, $request->filled('remember'))){
            Auth::guard("web")->logout();
            $request->session()->forget("web");
            $client_user= Auth::guard("client")->user();
            $setting    = ClientSetting::where("client_id", $client_user->client_id)->where("key", "default_lang")->first();
            if($setting){
                \Session::forget('locale');
                \Session::put('locale', $setting->value);
                \App::setlocale($setting->value);
            }else{
                \Session::forget('locale');
                \Session::put('locale', "ar");
                \App::setlocale("ar");
            }
            \Session::put('myclient', $client_user->client);
            $request->session()->regenerate();
            return redirect()->route("client.home");
        }else{
            throw ValidationException::withMessages(['email' => [trans('auth.failed')]]);
        }
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker("clients");
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return "client";
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request){
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Logout from client dashboard
     *
     * @param  Request  $request
     * @return redirect to login page
     */
    public function logout(Request $request){
        Auth::guard("client")->logout();
        $request->session()->forget("client");

        return redirect()->route("login");
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request){
        $request->validate(['email' => 'required|email']);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * Reset password form
     *
     *
     * @return a view to the reset client password form
     */
    public function showLinkRequestForm(){
        return view('client.auth.passwords.email');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm($token = null){
        return view('client.auth.passwords.reset')->with(
            ['token' => $token]
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password){
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        Auth::guard("client")->login($user);
    }

}
