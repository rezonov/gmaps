<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Cats extends Eloquent
{
    //
    protected $collection = 'cats';

    protected $fillable = ['name', 'url'];


    public function cats_objects()
    {
        return $this->belongsTo(Cats__Objects::class, 'id_object', '_id');
    }

    public function parents()
    {
        return $this->belongsTo(Cats::class, 'parent', '_id');
    }

    public function ImportFromFile()
    {
        $file_name = public_path() . '/disk/YMarket-categories-utf8.csv';
        $row = 0;
        $n = 0;
        $handle = fopen($file_name, "r");
        /*  while (!feof($handle))    {
              $bufer = fread($handle,1048576);
              $n+=substr_count($bufer,"\r");
          }
  echo $n;*/
        while (!feof($handle)) {
            $data = fgetcsv($handle, 0, "/");
            if (($data !== FALSE) and (!is_null($data) != null)) {
                //   dump($data);
                //  echo $row . ":" . $data[0];

                if (count($data) == 0) {
                    echo $row . " : " . count($data) . " - " . $data . "\n";
                    $row++;
                    $Cats = new Cats();
                    $Cats->name = trim($data[0]);
                    $Cats->save();
                }

                if (count($data) == 1) {
                    echo $row . " : " . count($data) . " - " . $data[0] . "\n";
                    $row++;
                    $Cats = new Cats();
                    $Cats->name = trim($data[0]);

                    $Cats->save();
                }
                if (count($data) == 2) {
                    echo "ПерваяСуб " . $row . " : " . count($data) . " - " . $data[1] . "\n";
                    $Cat = Cats::where('name', '=', trim($data[0]))->first();
                    $parent = ($Cat->id);
                    $Cats = new Cats();
                    $Cats->name = trim($data[1]);
                    $Cats->parent = $parent;
                    $Cats->parent_level = '1';
                    $Cats->save();
                }
                if (count($data) == 3) {
                    echo "II) " . $row . " : " . count($data) . " - " . $data[2] . " I)" . $data[1] . "\n";
                    $Cat = Cats::firstorCreate(['name' => trim($data[1])]);
                    echo $Cat->id . "\n";
                    $parent = ($Cat->id);
                    $Cats = new Cats();
                    $Cats->name = trim($data[2]);
                    $Cats->parent = $parent;
                    $Cats->parent_level = '2';
                    $Cats->save();
                }

            } else {
                echo "!" . $data . "!\n";
                $buffer = fgets($handle, 60000);
                echo "Значение сломанной строки:!" . $buffer . "!\n";
            }
        }

        echo "Закончили чтение файла";
    }
}
