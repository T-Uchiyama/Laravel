<?php

namespace App\Http\Controllers;

use Validator;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommentsController extends Controller
{
    public function store()
    {
        $rules = [
            'commenter' => 'required',
            'comment' => 'required',
        ];
        
        $messages = array(
            'commenter.required' => 'タイトルを正しく入力してください。',
            'comment.required' => '本文を正しく入力してください。',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);
        
        if ($validator->passes()) {
            $comment = new Comment();
            $comment->commenter = Input::get('commenter');
            $comment->comment = Input::get('comment');
            $comment->article_id = Input::get('article_id');
            $comment->save();
            
            return redirect()->back()->with('message', '投稿が完了致しました。');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}
