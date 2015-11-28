<?php namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Validator;

use App\Http\Controllers\UtilityController;
use App\Http\Model\HttpRequest\HttpRequest;

class PasswordController extends Controller {
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

    // Held the current using API version for this Controller
    private static $API_VERSION = "1.0";
    // Sync with the String in the Android Application
    protected static $error_email_not_exist = "error_email_not_exist";
    protected static $error_email_validation_failed = "error_email_validation_failed";
    protected static $error_access_denied = "error_access_denied";


    /**
     * Create a new password controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
     * @return void
     */
    public function __construct(Guard $auth, PasswordBroker $passwords)
    {
        $this->auth = $auth;
        $this->passwords = $passwords;
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return Response to the Api call
     * Copied a set of PostEmail from ResetPassword TraitClass
     * Customized for the Api response handler diff from web
     */
    public function postEmailApi(Request $request) {
        // Get public access key and user access key from GET
        $arrRequest = array('email'=> $request->query('email'));
        $public_access_key = $request->query('api_key');
        $status_code = HttpRequest::$REQUEST_SUCCESS_CODE;
        $status = true;
        $success = false;
        $errors = "";

        // Get android callback
        $android_callback = $request->query('caller');
        // If the Api Key is invalid
        if(UtilityController::validateApiKey($public_access_key)) {
            //Validate the email
            $validator = Validator::make($arrRequest, ['email' => 'required|email']);
            if($validator->fails() && $status_code === HttpRequest::$REQUEST_SUCCESS_CODE) {
                $errors = "Email validation failed";
                $status_code = HttpRequest::$VALIDATION_FAILED_CODE;
                $status = false;
            }
            //Done validate for api key and email input
            if($status) {
                // Sent Reset Link
                $response = $this->sendResetEmail($request);
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        $success = true;
                        break;

                    case Password::INVALID_USER:
                        $success = false;
                        $errors = "Email is not exist";
                        break;
                }
            }
        }
        else {
            $errors = "Access Denied";
            $status_code = HttpRequest::$ACCESS_DENIED_CODE;
            $status = false;
        }

        $arrResponse = array(
            'api_ver' => self::$API_VERSION,
            'caller' => $android_callback,
            'error' => $errors,
            'status_code' => $status_code,
            'status' => $status,
            'success' => $success
        );
        return $arrResponse;
    }

}