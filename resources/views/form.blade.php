@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div id="app">

    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="name">Url Категории:</label>
            <input type="text" class="form-control" name="name" id="url">
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="name">Область:</label>
            <input type="text" class="form-control" name="name" id="prof">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="price">Город:</label>
            <input type="text" class="form-control" name="price" id="city">
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="price">Количество отзывов:</label>
            <input type="text" class="form-control" name="reviews" id="reviews" value="3">
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="price">Количество фотографий:</label>
            <input type="text" class="form-control" name="photos" id="photos" value="3">
        </div>
    </div>


    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <button id="go" class="btn btn-success" onclick="Parse()">Поиск</button>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <table id="results">
                <tr>
                    <td colspan="10">Результаты</td>
                </tr>
            </table>

        </div>
    </div>

</div>


<script>
    function Parse() {
        var city = $("#city").val();
        var prof = $("#prof").val();
        var reviews = $('#reviews').val();
        var photos = $('#photos').val();
        var url = $('#url').val();
        $.ajax({
            url: '/query/' + city + '/' + prof

        }).done(function (data) {
            var Obj = jQuery.parseJSON(data);

            Obj.farray.forEach(function (e) {
                console.log(e.id_city);
                var url = '/result/' + e.place_id + '/' + reviews + '/' + photos + '/' + url + '/' + prof + '/' + Obj.id_city;
                console.log(url);
                $.ajax({
                    url: url

                }).done(function (eData) {
                    var eObj = jQuery.parseJSON(eData);
                    console.log(eObj);

                    $('#results tr:last').after('<tr><td>' + eObj.final.name + '<br />' + eObj.final.address + '</td></tr>');

                })

            });

        })
    };
</script>

<script src="{{ asset('js/app.js') }}"></script>
@stop

