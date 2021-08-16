<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $data = array('title'=>'profil');
        return view('user.index',$data);
    }

    public function setting(){
        $data = array('title'=>'setting');
        return view('user.setting',$data);
      
    }
}
