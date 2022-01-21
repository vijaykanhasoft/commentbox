<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /* get comment with the replies and User*/ 
        $comments=Comment::where(['parent_id'=> 0])
                        ->orderBy('created_at','desc')
                        ->get();
        return view('home',compact('comments'));
    }
}
