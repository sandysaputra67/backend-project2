<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
 public function index(){
     $data = array('title'=>'dashboard');
     return view('Dashboard.index',$data);
 }
}
