<?php

namespace App\Http\Controllers;

use App\Cats;
use App\Cats__Objects;
use App\Objects;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    public function __construct()
    {

    }

    public function index()
    {
        $Catalog = Cats::all();

        if (count($Catalog) > 0) {
            foreach ($Catalog as $CC) {
                $data[] = $CC;
            }
            $d = array(
                "data" => $Catalog
            );
        } else {
            $d = array();
        }
        return view('catalog')->with($d);
    }

    public function show($id)
    {
        // $Catalog = Cats::where("id",$id)->get();
        $Catalog = Cats::find($id)->get();
        dump($Catalog);
        if (count($Catalog) > 0) {
            foreach ($Catalog as $CC) {
                $data[] = $CC;
            }
            $d = array(
                "data" => $Catalog[0]
            );
        } else {
            $d = array();
        }

        return view('catedit')->with($d);

    }

    public function catalog_objects($id) {
        $Catalog = Objects::with('cats_objects')->whereHas('cats_objects', function($q) use ($id) {

            $q->where('id_cat',$id);
        })->orderBy('-created_at')->get();

        foreach ($Catalog as $C) {
            $final_array[] = $C;

            //dump($Catalog->id_cat);
        }

        $d = array(
            "data" => $final_array
        );
        $Catalog = Cats::find($id);
        dump($Catalog->name);

        return view('catalogs/catview')->with($d);


    }


    public function delete($id)
    {
        $Catalog = Cats::find($id);
        dump($Catalog);
        $Catalog->delete();
        return json_decode($Catalog);
    }

}
