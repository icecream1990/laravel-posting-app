<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(){

    $posts = DB::table('laravel_basic_kadai')->get();   

        return view('posts.index',compact('posts'));
    }
}
