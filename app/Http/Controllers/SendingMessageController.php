<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SendMessageRequest;
use App\Message;

class SendingMessageController extends Controller
{
    public function postMessage(SendMessageRequest $request)
    {
        $model = new Message;
        $model->subject = $request->subject;
        $model->content = $request->message;
        $model->save();
        return ['notification' => 'Message has been successfully sent.'];
    }
}
