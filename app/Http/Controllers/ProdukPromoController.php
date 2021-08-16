<?php

namespace App\Http\Controllers;

use App\Produk;
use App\ProdukPromo;
use Illuminate\Http\Request;

class ProdukPromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itempromo= ProdukPromo::orderBy('id','desc')->paginate(20);
     $data = array('title'=>'produk promo','itempromo'=>$itempromo);
     return view('promo.index',$data)->with('no',($request->input('page',1) -1)*20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemproduk=Produk::orderBy('nama_produk','desc')->where('status','publish')->get();
        $data = array('title'=>'produk promo','itemproduk'=>$itemproduk);
        return view('promo.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'kode_produk'=>'required|unique:produk,id,'.$id,
            'produk_id',
            'harga_awal',
            'harga_akhir',
            'diskon_persen',
            'diskon_nominal',
            'user_id',
            
        ]);
        $itemproduk = Produk::findOrFail($id);
        $slug =\Str::slug($request->slug_produk);
        $validasislug = Produk::where('id','!=',$id)->where('slug_produk',$slug)->first();
        if($validasislug){
            return back()->with('error','slug sudah ada');
        } else{
            $inputan = $request->all();
            $inputan['slug'] = $slug;
            $itemproduk->update($inputan);
            return redirect()->route('produk.index')->with('success','data berhasil di upload');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProdukPromo  $produkPromo
     * @return \Illuminate\Http\Response
     */
    public function show(ProdukPromo $produkPromo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProdukPromo  $produkPromo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itempromo = ProdukPromo::findOrFail($id);
        $data = array('title'=>'produk');
        return view('promo.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProdukPromo  $produkPromo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'produk_id'=>'required',
            'harga_awal'=>'required',
            'harga_akhir'=>'required',
            'diskon_persen'=>'required',
            'diskon_nominal'=>'required',
          
            
            
        ]);
        $itempromo = ProdukPromo::findOrFail($id);
        $slug =\Str::slug($request->slug_produk);
        $validasislug = ProdukPromo::where('produk_id',$request->produk_id)->where('id','!=',$itempromo->id)->first();
        if($cekpromo){
            
            return back()->with('error','data sudah ada');
        } else{

            $inputan = $request->user();
            $inputan = $request->all();
            $inputan['user_id'] = $itemuser->id;
            $itempromo->update($inputan);
            return redirect()->route('promo.index')->with('success','data berhasil di upload');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProdukPromo  $produkPromo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itempromo = ProdukPromo::findOrFail($id);
        if($itempromo->delete()){
            
            return back()->with('success','data berhasil di hapus');
        }else{
            return back()->with('error','data gagal di hapus ');
        }
    }
}
