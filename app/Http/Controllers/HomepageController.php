<?php

namespace App\Http\Controllers;
 use App\Produk;
 use App\Kategori;
 use App\ProdukPromo;
use App\Wishlist;
use Auth;
use Illuminate\Http\Request;


class HomepageController extends Controller
{

    public function index() {
        $itemproduk = Produk::orderBy('created_at','desc')->get();
        $itempromo = ProdukPromo::orderBy('created_at','desc')->get();
        $itemkategori = Kategori::orderBy('nama_kategori','asc')->get();
        $data = array('title' => 'Homepage','itemproduk'=>$itemproduk,'itempromo'=>$itempromo,'itemkategori'=>$itemkategori);
        return view('homepage.index', $data);
    }

    public function kategori(){
        $itemkategori = Kategori::orderBy('nama_produk','desc')->get();
        $itemproduk = Produk::orderBy('created_at','desc')->get();
        $data = array('title'=>'kategori','itemkategori'=>$itemkategori,'itemproduk'=>$itemproduk);
        return view('homepage.kategori',$data);
    }

    public function kategoribyslug(Request $request,$slug){
        $itemkategori = Kategori::orderBy('nama_kategori','asc')->where('status','publish')->first;
        $itemproduk = Produk::orderBy('nama_produk','desc')->where('status','publish')->whereHas('kategori',function($q) use ($slug){
        $q->where('slug_kategori',$slug);
    })->paginate(18);
    $listkategori = Kategori::orderBy('nama_kategori','asc')->where('status','publish')->get();
    $itemkategori = Kategori::orderBy('nama_kategori','asc')->where('status','publish')->first;
    if($itemkategori){
        $data = array('title'=>'kategori','itemkategori'=>$itemkategori,'itemproduk'=>$itemproduk,'listkategori'=>$listkategori);
        return view('homepage.kategori',$data)->with('no',($request->input('page')-1)*18);
    } else{
        return abort('404');
    }
       
        
    }
    public function produk(Request $request){
        $itemproduk = Produk::orderBy('nama_produk','desc')->where('status','publish')->paginate(18);
        $listkategori = Kategori::orderBy('nama_produk','desc')->where('status','publish')->paginate(18);
        $data = array('title'=>'kategori','itemproduk'=>$itemproduk,'listkategori'=>$listkategori);
        return view('homepage.produk',$data)->with('no',($request->input('page')-1)*18);
    }
    public function produkperkategori(){
        $data = array('title'=>'kategori');
        return view('.homepage.produkperkategori',$data);
    }
    public function produkdetail($id){
        
        $itemproduk = Produk::where('slug_produk',$id)->where('status','publish')->first();
        if($itemproduk){
            if(Auth::user()){
                $itemuser=Auth::user();
                $itemwishlist = Wishlist::where('produk_id',$itemproduk->id)->where('user_id',$itemuser->id)->first();
            }
            $data = array('title'=>'kategori','itemproduk'=>$itemproduk,'itemwishlist'=>$itemwishlist);
        }else{
            $data = array('title'=>$itemproduk->nama_produk,'itemproduk'=>$itemproduk);
        }
            return view('homepage.produkdetail.',$data);
     
        

    }


}