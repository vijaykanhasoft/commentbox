<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Comment;
class CommentController extends Controller
{
    public function store(Request $request)
    {
        //validation for comment 
        $request->validate([
            'comment' => 'required',
        ]);

        //create comment entry in database
        Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'repliable_id' => Auth::user()->id,
            'repliable_type'=>'App\Comment',
            'parent_id' => $request->input('parent_id') ?? 0,
        ]);

        //redirect to home page
        return redirect('/home');
    }

    public function destroy($id)
    {
        //delete comment and subcomment
        Comment::where('id',$id)->orWhere('parent_id',$id)->delete();
        return redirect('/home');
    }
}
