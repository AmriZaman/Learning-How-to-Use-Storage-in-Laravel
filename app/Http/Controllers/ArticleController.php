<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

define("DATA","public/data.json");

class ArticleController extends Controller
{
    #=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=#
    #        JSON FUNCTIONAL CRUD START       #
    #=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=#
    public function baca(){
        if ( Storage::disk('local')->has(DATA) ) {
            $data = Storage::get(DATA);
        }else{
            $data = Storage::disk('local')->put(DATA, json_encode([]));
        }
        $array = json_decode($data);
        return $array;
    }
    public function perbarui(Request $request, $id){
        $data  = $this->baca();
        $datas = [];
        for ($i = 0; $i < count($data); $i++) {
            if ($id == $data[$i]->title) {
                $data[$i]->title = $request->title;
                $data[$i]->author = $request->author;
                $data[$i]->content = $request->content;
                $data[$i]->datetime = date('Y-m-d H:i:s');
            }
            array_push($datas, $data[$i]);
        }
        if ( Storage::disk('local')->put(DATA, json_encode($datas, JSON_PRETTY_PRINT)) ) {
            return true;
        }
        return false;
    }
    public function simpan(Request $request){
        $data = $this->baca();
        $array_baru = array(
          'title'       => $request->title,
          'author'      => $request->author,
          'content'     => $request->content,
          'datetime'    => date('Y-m-d H:i:s')
        );
        $data[] = $array_baru;
        if ( Storage::disk('local')->put(DATA, json_encode($data, JSON_PRETTY_PRINT)) ) {
            return true;
        }
        return false;
    }
    public function hapus($id){
        $data = $this->baca();
        $datas = [];
        for ($i = 0; $i < count($data); $i++) {
            if ($id == $data[$i]->title) {
                continue;
            }else{
                array_push($datas, $data[$i]);
            }
        if ( Storage::disk('local')->put(DATA, json_encode($datas, JSON_PRETTY_PRINT)) ) {
            return true;
        }
        return false;
        }
    }
    #=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=#
    #         JSON FUNCTIONAL CRUD END        #
    #=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=#

    public function index()
    {
        $data = $this->baca();
        return view('artikel',compact('data'));
    }

    public function create()
    {
        return view('artikelCreate');
    }

    public function store(Request $request)
    {
        if ( $this->simpan($request) ) {
            return redirect()->route('article.index');
        }
        return redirect()->route('article.create');
    }

    public function show($id)
    {
        $data = $this->baca();
        $datareal=[];
        foreach ($data as $d){
            if ($id==$d->title){
                $datareal=$d;
                break;
            }
        }
        if (!$datareal){
            abort(404);
        }
        return view('artikelFull',compact('datareal'));
    }

    public function edit($id)
    {
        $data = $this->baca();
        $datareal=[];
        foreach ($data as $d){
            if ($id==$d->title){
                $datareal=$d;
                break;
            }
        }
        if (!$datareal){
            abort(404);
        }
        return view('artikelUpdate',compact('datareal'));
    }

    public function update(Request $request, $id)
    {
        $this->perbarui($request, $id);
        return redirect()->route('article.index');
    }

    public function destroy($id)
    {
        $this->hapus($id);
        return redirect(route('article.index'));
    }
}
