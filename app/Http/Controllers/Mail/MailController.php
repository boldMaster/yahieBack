<?php

namespace App\Http\Controllers\Mail;

use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\Mails\SendMail;

class MailController extends Controller
{
    /**
     * @param Request $request
     * @throws string
     */
    public function sendMail(Request $request){
        $objSendMail = new SendMail();
        try {
            $objSendMail->send($request);
        } catch (Exception $exception) {
            throw new Exception ('emails.email_send_fail', 500);
        }
    }
}
