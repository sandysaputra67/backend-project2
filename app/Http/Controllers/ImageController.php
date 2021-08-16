<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Kategori;

class ImageController extends Controller
{
public function index(Request $request){
    $itemuser = $request->user();
    $itemgambar =Image::where('user_id',$itemuser->id)->paginate(20);
    $data = array('title'=>$itemgambar);
    return view('image.index',$data)->with('no',($request->input('page',1)-1)*20);

}
}
