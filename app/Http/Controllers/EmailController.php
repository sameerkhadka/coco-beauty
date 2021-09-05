<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class EmailController extends Controller
{
    public function email(){
        $data = [];
        Mail::send('email.template', $data , function($message) use ($data)
        {
            $message->from('test@keronevatravel.com','Test Mail');
            $message->to(['er.kshitizshrestha@gmail.com','kulchan.yogesh2@gmail.com', 'yogesh@hueshine.com', 'sameer@hueshine.com','sameerkhadka3@gmail.com' ], 'This is Test');
        });
    }
}
