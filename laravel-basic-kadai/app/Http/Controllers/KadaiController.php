<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KadaiController extends Controller
{
    public function index(){
        return view('posts.index');
    }
}
