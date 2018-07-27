<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatsController extends Controller
{
    //
    public function ShowCatalog()
    {
        $Catalog = Cats::all();
        foreach ($Catalog as $CC) {
            echo $CC->name;
        }
    }
}
