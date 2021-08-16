<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Kategori;
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemproduk = Produk::orderBy('created_at','desc')->paginate(20);
        $data = array('title'=>'produk','itemproduk'=>$itemproduk);
        return view('produk.index',$data)->with('no',($request->input('page',1) -1)*20);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $itemproduk = Produk::orderBy('created_at','asc')->get();
        $data = array('title'=>'form produk','itemkategori'=>$itemkategori);
        return view('produk.create',$data);
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
            'kode_produk'=>'required|unique:produk',
            'nama_produk'=>'required',
            'slug_produk'=>'required',
            'deskrispsi_produk'=>'required',
            'kategori_id'=>'required',
            'qty'=>'required|numeric',

        ]);
        $itemuser = $request->user();
        $slug =\Str::slug($request->slug_produk);
            $inputan = $request->all();
            $inputan['slug_produk'] = $slug;
            $inputan['user_id'] = $itemuser->id;
            $inputan['status'] = 'publish';

            $itemproduk = Produk::create($inputan);
            return redirect()->route('produk.index')->with('success','data berhasil di upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
         $itemproduk = Produk::findOrFail($id);
        $data = array('title'=>'produk','itemproduk'=>$itemproduk);
        return view('produk.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemproduk = Produk::findOrFail('nama_kategori','asc')->paginate(20);
        $data = array('title'=>'produk');
        return view('produk.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'kode_produk'=>'required|unique:produk,id,'.$id,
            'nama_produk'=>'required',
            'slug_produk'=>'required',
            'nama_produk'=>'required',
            'deskripsi_produk'=>'required',
            'kategori_id'=>'required',
            'qty' => 'required|numeric',
            'satuan' => 'required',
            'harga' => 'required|numeric'
            
            
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $itemproduk = Produk::findOrFail($id);
       if($itemproduk->delete()){
        return back()->with('error','data gagal hapus');
       } else{
        return back()->with('success','data berhasil hapus'); 
       }
    }
    public function uploadimage(Request $request) {
        $this->validate($request, [
            'image' => 'required|images|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'produk_id' => 'required',
        ]);
        $itemuser = $request->user();
        $itemproduk = Produk::where('user_id', $itemuser->id)
                                ->where('id', $request->produk_id)
                                ->first();
        if ($itemproduk) {
            $fileupload = $request->file('image');
            $folder = 'asset/images';
            $itemgambar = (new ImageController)->upload($fileupload, $itemuser, $folder);
            $inputan = $request->all();
            $inputan['foto'] = $itemgambar->url;
            \App\ProdukImage::create($inputan);
            $itemproduk->update($inputan);
            return back()->with('success', 'Image berhasil diupload');
        } else {
            return back()->with('error', 'Kategori tidak ditemukan');
        }
        return back()->with('error', 'produk tidak ditemukan');
    }

    public function deleteimage(Request $request, $id) {
   
        $itemprodukimage = \App\ProdukImage::findOrFail($id);
        $itemproduk = Produk::findOrFail($itemprodukimage->produk_id);
        $itemgambar = \App\Image::where('url',$itemprodukimage->foto)->first();
        if ($itemgambar) {
      \Storage::delete($itemgambar->url);
      $itemgambar->delete();
        }
        $itemprodukimage->delete();
        $itemsisaprodukimage = \App\ProdukImage::where('produk_id',$itemproduk->id)->first();
        if($itemsisaprodukimage){
        $itemgambar->update(['foto'=>$itemprodukimage->foto]);


        }else{
            $itemgambar->update(['foto'=>$itemprodukimage->foto]);
        }

        
    }

    public function loadasync($id){
        $itemproduk = Produk::findOrFail($id);
        $respon =[
            'status'=>'success',
            'msg'=>'data tidak ditemukan',
            'itemproduk'=>$itemproduk
        ];
        return response()->json($respon,200);
    }

    
}
