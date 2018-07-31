<?php

namespace App\Http\Controllers;

use App\Cats;
use App\Cities;
use App\Country;
use App\Objects;
use App\Regions;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    public function __construct()
    {

    }

    public function index()
    {
        $Catalog = Cats::orderBy('_id')->orderBy('parent_level', 'ASC')->get();
        dump($Catalog);
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
        $Catalog = Cats::where(['_id' => $id])->with('parents')->first();
        dump($Catalog);
        return view('catedit')->with(['data' => $Catalog]);

    }

    public function catalog_objects($id)
    {
        $Catalog = Objects::with('cats_objects')->whereHas('cats_objects', function ($q) use ($id) {

            $q->where('id_cat', $id);
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

    public function ImportFromFile()
    {
        $file_name = public_path() . '/disk/_cities.csv';
        $row = 0;

        $handle = fopen($file_name, "r");
        while (!feof($handle)) {
            $data = fgetcsv($handle, 0, ";");
            if ($data !== FALSE) {
                //   dump($data);
                //  echo $row . ":" . $data[0];
                if ($row < 222264) {
                    echo "Вошли";
                    // && isset($data[3]) && isset($data[2]) && isset($data[4])
                    if (isset($data[0])) {
                        $City = new Cities();
                        $City->city_id = $data[0];
                        $City->country_id = $data[1];
                        $City->regiod_id = $data[3];
                        $City->name = mb_convert_encoding($data[4], "utf-8", "windows-1251");
                        $City->save();
                        echo ":Записали";
                    }
                    //   dump($City);


                }
                $row++;

            } else {
                echo "!" . $data . "!\n";
                $buffer = fgets($handle, 60000);
                echo "Значение сломанной строки:!" . $buffer . "!\n";
            }
        }

        echo "Закончили чтение файла";
    }

    public function readfile_with_regions()
    {
        // Размер куска - 128 байт
        $file_name = public_path() . '/region.csv';
        $row = 0;

        $handle = fopen($file_name, "r");
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $num = count($data);
            if ($row > 0) {

                $City = new Regions();

                $City->regiod_id = $data[0];
                $City->country_id = $data[1];
                $City->city_id = $data[2];
                $City->name = mb_convert_encoding($data[3], "utf-8", "windows-1251");
                $City->save();
            }
            $row++;
        }
    }

    public function readfile_with_country()
    {
        // Размер куска - 128 байт
        $file_name = public_path() . '/country.csv';
        $row = 0;

        $handle = fopen($file_name, "r");
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $num = count($data);
            if ($row > 0) {

                $City = new Country();

                $City->country_id = $data[0];
                $City->city_id = $data[1];
                $City->name = mb_convert_encoding($data[2], "utf-8", "windows-1251");
                $City->save();
            }
            $row++;
        }
    }


    public function config_cities()
    {
        $Cities = Cities::where('name', 'LIKE', 'A%')->orderBy('name', 'ASC')->with('regions')->with('countries')->paginate(100);


        return view('config/cities')->with(["data" => $Cities]);
    }

    public function config_regions()
    {
        $Regions = Regions::with('countries')->orderBy('name', 'ASC')->paginate(200);

        return view('config/cities')->with(["data" => $Regions]);
    }

    public function config_country()
    {
        $Country = Country::orderBy('name', 'ASC')->paginate(100);
        return view('config/cities')->with(["data" => $Country]);
    }

    public function delete($id)
    {
        $Catalog = Cats::find($id);
        dump($Catalog);
        $Catalog->delete();
        return json_decode($Catalog);
    }

}

class FileReader
{
    protected $handler = null;
    protected $fbuffer = array();

    public function __construct($filename)
    {
        if (!($this->handler = fopen($filename, "rb")))
            throw new Exception("Cannot open the file");
    }

    public function Read($count_line = 10)
    {
        if (!$this->handler)
            throw new Exception("Invalid file pointer");

        while (!feof($this->handler)) {
            $this->fbuffer[] = fgets($this->handler);
            $count_line--;
            if ($count_line == 0) break;
        }

        return $this->fbuffer;
    }

    public function SetOffset($line = 0)
    {
        if (!$this->handler)
            throw new Exception("Invalid file pointer");

        while (!feof($this->handler) && $line--) {
            fgets($this->handler);
        }
    }
}