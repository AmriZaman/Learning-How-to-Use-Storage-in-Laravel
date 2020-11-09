<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class artikel extends Controller
{

    public function index()
    {
      $jsonurl = "storage/data.json";
      $json = file_get_contents($jsonurl);
      $data = json_decode($json);


      return view('artikel',compact('data'));
    }


    public function create()
    {
        return view('artCreate');
    }



    public function show($id)
    {
      $jsonurl = "storage/data.json";
      $json = file_get_contents($jsonurl);
      $data = json_decode($json);
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



    public function update(Request $request, $id)
    {
      $jsonurl = "storage/data.json";
      $json = file_get_contents($jsonurl);
      $data = json_decode($json);
      for ($i = 0; $i < count($data); $i++) {
          if ($id == $data[$i]->title) {
              $data[$i]->title = $request->title;
              $data[$i]->author = $request->author;
              $data[$i]->content = $request->content;
              $data[$i]->datetime = date('Y-m-d H:i:s');
          }
      }
      file_put_contents($jsonurl, json_encode($data));
      return redirect(route('artikel.index'));
    }


    public function destroy($id)
    {
      $jsonurl = "storage/data.json";
      $json = file_get_contents($jsonurl);
      $data = json_decode($json);
      $datas = [];
      for ($i = 0; $i < count($data); $i++) {
          if ($id == $data[$i]->title) {
              continue;
          }
          array_push($datas, $data[$i]);
      }
      file_put_contents($jsonurl, json_encode($datas));
      return redirect(route('artikel.index'));
    }
}
