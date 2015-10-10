<?php

namespace App\Http\Model\Mails;

use Illuminate\Database\Eloquent\Model;

class SendMail extends Model
{
    /**
     * @param $oriInputs
     * To avoid unnecessary input into the email
     * @return only allow field for email
     */
    public function preProcessInput($oriInputs)
    {
        $data = array();

        $data['from'] = array_get($oriInputs, 'from');
        $data['to'] = array_get($oriInputs, 'to');
        $data['cc'] = array_get($oriInputs, 'cc');
        $data['subject'] = array_get($oriInputs, 'subject');
        $data['content'] = array_get($oriInputs, 'content');

        return $data;
    }
    public function send($inputs)
    {
        $inputs = $this->preProcessInput($inputs);
        $inputs = array(
            'from'=>'flip@honeyspear.com',
            'to'=>'mvpchen7@gmail.com',
            'subject'=>'Testing Mail',
            'content'=>'Testing email 123',
        );
        Mail::send('resetMail',$inputs,function($message) use ($inputs)
        {
            $message->from($inputs['from']);
            $message->to($inputs['to']);
            $message->subject($inputs['subject']);
            $message->content($inputs['content']);
        });
    }
}
