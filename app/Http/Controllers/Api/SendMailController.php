<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AwsSesMailable;

class SendMailController extends Controller
{
    /**
     * sendMail function
     * メールを送信、レスポンスを返す
     * @param Request $request
     * @return json
     */
    public function sendMail(Request $request)
    {
        $to = config('mail.to.address');
        Mail::to($to)->send(new AwsSesMailable($request->params));
        return response()->json([], 200);
    }
}
