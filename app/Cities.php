<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Cities extends Eloquent
{
    //
    protected $collection = 'cities';

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id', 'country_id');
    }

    public function regions()
    {
        return $this->belongsTo(Regions::class, 'regiod_id', 'region_id');
    }

    protected $fillable = ['name'];

    public function ImportFromFile()
    {
        $file_name = public_path() . '/disk/_cities.csv';
        $row = 0;
        $n=0;
        $handle = fopen($file_name, "r");
      /*  while (!feof($handle))    {
            $bufer = fread($handle,1048576);
            $n+=substr_count($bufer,"\r");
        }
echo $n;*/
        while (!feof($handle)) {
            $data = fgetcsv($handle, 0, ";");
            if (($data !== FALSE) and (!is_null($data) != null)) {
                //   dump($data);
              //  echo $row . ":" . $data[0];
                if ($row > 0) {
                    echo "Вошли";
                    // && isset($data[3]) && isset($data[2]) && isset($data[4])
                    if (isset($data[0])) {
                        $City = new Cities();
                        $City->city_id = $data[0];
                        $City->country_id = $data[1];
                        $City->regiod_id = $data[3];
                        $City->name = $data[4];
                        $City->name_en = $data[12];
                        $City->save();
                        echo ":Записали ".utf8_encode($data[4])."\n";
                    }
                    //   dump($City);


                }
                $row++;

            } else {
                echo "!".$data."!\n";
                $buffer = fgets($handle, 60000);
                echo "Значение сломанной строки:!". $buffer."!\n";
            }
        }

        echo "Закончили чтение файла";
    }
}