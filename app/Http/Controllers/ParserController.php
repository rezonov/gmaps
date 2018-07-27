<?php

/*
    Cities - модель городов. Таблица citites
    Objects - модель самих объектов. Таблица objects

    Таблица cats_objects - связующая таблица между категориями и объектами

    Photos - модель фотографий. Таблица photos
    Reviews - модель отзывов. Таблица reviews
 */

namespace App\Http\Controllers;

use App\Cats;
use App\Cats__Objects;
use App\Cities;
use App\Objects;
use App\Photos;
use App\Reviews;
use Illuminate\Http\Request;

class ParserController extends Controller
{
    //
    public function __construct()
    {
        /* Ключ Google Maps */

        $this->key = 'AIzaSyDvtBNEDFJYw5mbc8zUQx4Q0CS-o6vxc70';
    }

    public function test()
    {
        return view('form');
    }

    /*
     * Функция Query
     * Делает 200 мест
     *
     * city = Запрос из поля город
     * prof = Запрос из поля профессия
     *
     *
     */

    public function Query($city, $prof)
    {

        /*
        * Получаем координаты по названию города
        */
        $options = array(
            "http"=>array(
                "header"=>"User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n" // i.e. An iPad
            )
        );



        $city_url = 'https://maps.googleapis.com/maps/api/place/textsearch/json?key=' . $this->key . '&query=' . urlencode($city);
        $ar = file_get_contents($city_url);

        $res = json_decode($ar);
        $lat = $res->results[0]->geometry->location->lat;
        $lot = $res->results[0]->geometry->location->lng;

        /*
                * Сохраняем город
        */


        $City = Cities::firstOrNew(['name' => $city]);
        $City->lat = $lat;
        $City->lng = $lat;
        $City->save();


        $C = Cities::all();

        /* Собираем до 200 позиций по координатам */
        $options = array(
            "http"=>array(
                "header"=>"User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n" // i.e. An iPad
            )
        );

        $context = stream_context_create($options);
        $url = 'https://maps.googleapis.com/maps/api/place/radarsearch/json?location=' . $lat . ',' . $lot . '&key=' . $this->key . '&keyword=' . trim($prof) . '&radius=50000';
        $array = file_get_contents($url, false, $context);

        $res = json_decode($array);

        $result['farray'] = $res->results;
        $result['id_city'] = $City->id;
        echo json_encode($result);
    }

    /*
     * Функция обработки одного места
     * place_id = place_id Места Google
     * photos_count = значение на ограничение количества фотографий
     * reviews_count = значние на ограничение количества отзывов
     *
     * Object => Таблица objects - Основная информация о объектах
     * Reviews => Таблица reviews - Таблица отзывов
     */


    public function Pre_Insert_Result($place_id, $photos_count, $reviews_count, $url, $query, $city)
    {
        /*Остановка для Google Maps, чтобы не получить бан */

        sleep(2);

        $Revs = array();

        $url_sec = 'https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $place_id . '&key=' . $this->key . '&language=ru';

        $array = file_get_contents($url_sec);
        $result2 = json_decode($array);


        /*
         * Если запрос не пустой
         */
        if ($result2->status == 'OVER_QUERY_LIMIT') {
            echo json_encode($result2);
        } else {
            /* Работаем */
            $Cat = Cats::firstOrNew(['url' => $url]);
            $Cat->name = $query;
            $Cat->save();


            $result = $result2->result;

            $final = new Objects;
            $final->name = $result->name;
            $final->place_id = $result->place_id;
            $final->website = (!empty($result->website) ? $result->website : '');

            $final->international_phone_number = (!empty($result->international_phone_number) ? $result->international_phone_number : '');
            $final->hours = (!empty($result->opening_hours->weekday_text) ? implode("\n", $result->opening_hours->weekday_text) : '');

            foreach ($result->address_components as $e) {
                if ($e->types[0] == 'postal_code') {
                    $final->index = $e->long_name;
                }
                if ($e->types[0] == 'locality') {
                    /*
                * Сохраняем город
                */


                    $final->city = $city;
                }
            }
            $final->lat = $result->geometry->location->lat;
            $final->lon = $result->geometry->location->lng;
            $final->address = $result->formatted_address;
            $final->rating = (!empty($result->rating) ? $result->rating : '');

            $final->save();
            dump($final->_id);
            $CO = Cats__Objects::firstOrCreate(['id_object' => $final->id, 'id_cat' => $Cat->id]);
            $CO->save();
            $g = 0;
            if (!empty($result->reviews)) {

                foreach ($result->reviews as $k) {
                    $g++;
                    if (($g < $reviews_count) and (strlen($k->text) > 300)) {
                        $reviews = new Reviews();
                        $reviews->id_place = $final->id;
                        $rev['author'] = $k->author_name;
                        $rev['rating'] = $k->rating;
                        $rev['text'] = $k->text;
                        $rev['time'] = $k->time;
                        $reviews->author = $k->author_name;
                        $reviews->rating = $k->rating;
                        $reviews->text = $k->text;
                        $reviews->time = $k->time;
                        $reviews->save();
                        $Revs[] = $rev;
                    }
                }
            }

            if (!empty($result->photos)) {
                $c = 0;
                foreach ($result->photos as $ph) {
                    $c++;
                    if ($c < $photos_count) {
                        $url_photo = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=1000&photoreference=' . $ph->photo_reference . '&key=' . $this->key;
                        $im = file_get_contents($url_photo);

                        /* Сохраняем файл */

                        file_put_contents(public_path() . '/catalog/' . $final->id . '_' . $c . '.png', $im);
                        $Photos = new Photos();
                        $Photos->id_place = $final->id;
                        $Photos->filename = '/catalog/' . $final->id . '_' . $c . '.png';
                        $Photos->save();
                    }
                }
            }
            $ResT = array();
            $ResT['final'] = $final;
            $ResT['reviews'] = $Revs;
            $ResT['url'] = $url_sec;

            echo json_encode($ResT);
        }
    }


}