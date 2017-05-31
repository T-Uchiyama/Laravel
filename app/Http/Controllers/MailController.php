<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Mail;
use App\Mail\MailShipped;

class MailController extends Controller
{
    /**
     * メール送信処理
     * @param  Request $request 
     * @return redirector       入力画面へリダイレクト
     */
    public function send(Request $request)
    {
        // TODO : アドレス指定したものに対するセキュリティ設定をGoogle側で解除すればおそらく飛ぶ
        Mail::to('XXX@gmail.com')->send(new MailShipped($request));
    }
}
