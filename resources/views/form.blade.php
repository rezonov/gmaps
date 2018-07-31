@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Запуск Робота</h1>
@stop

@section('content')
    <div id="app">
        <div class="content">
            <div class="box box-primary">
                <div class="box-header box-primary with-border">
                    <h3 class="box-title">Настройки</h3>
                </div>

                <div class="box-body">

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">


                                <div class="form-group col-md-12">

                                    <label for="name">Страна:</label>

                                    <select class="form-control js-example-basic-multiple" id="country" name="country">
                                        @foreach ($country as $c)
                                            <option value="{!! $c->country_id !!}">{!! $c->name !!}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <!--    <div class="form-group col-md-4">

                                        <label for="name">Регион:</label>

                                        <select class="form-control" name="region" id="region">

                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">

                                        <label for="name">Город:</label>

                                        <select class="form-control js-example-basic-multiple" name="city" id="city">

                                        </select>
                                    </div>-->
                                <div class="form-group col-md-12">
                                    <label for="cat">Категория</label>
                                    <select class="form-control" name="cat" id="cat" multiple="multiple">
                                        <option value="all">Все </option>
                                        @foreach ($cats as $c)

                                            <option value="{!! $c->_id !!}">
                                                @if ($c->parent_level == 1)
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                @endif
                                                @if ($c->parent_level ==2)
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                @endif
                                                {!! $c->name !!}
                                            </option>

                                        @endforeach
                                    </select>
                                    </label>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="price">Количество отзывов:</label>
                                    <input type="text" class="form-control" name="reviews" id="reviews" value="3">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="price">Количество фотографий:</label>
                                    <input type="text" class="form-control" name="photos" id="photos" value="3">
                                </div>
                                <div class="form-group col-md-12">
                                    <button id="go" class="btn btn-success" style="width:200px" onclick="Parse()">
                                        Поиск
                                    </button>
                                </div>
                            </div>


                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <table id="results" class="table table-border">
                                    <thead>
                                    <tr>
                                        <th width="3px">#</th>
                                        <th>Город</th>
                                        <th>Регион</th>
                                        <th>Страна</th>
                                        <th>Категория</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>


                </div>
            </div>


            <script>
                $(document).ready(function () {
                    $('#cat').select2();
                    $('.js-example-basic-multiple').select2();


                });


                function Parse() {

                    var country = $("#country").val();
                    var cat = $("#cat").val();
                    var reviews = $('#reviews').val();
                    var photos = $('#photos').val();
                    $.ajax({

                        url: '{{ route('robot.create_task') }}',
                        type: "POST",
                        data: {'country': country, 'cat': cat, 'reviews': reviews, 'photos': photos},
                        headers: {

                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

                        },

                        success: function (data) {

                            var data2 = JSON.parse(data);
                            $('#results > tbody').children('tr').remove();

                            $.each(data2, function (index, value) {
                                var html = '<tr>' +
                                    '<td>' + index + '</td>' +
                                    '<td>' + value.city_name + '</td>' +
                                    '<td>' + value.region_name + '</td>' +
                                    '<td>' + value.country_name + '</td>' +
                                    '<td>' + value.cat + '</td>' +
                                    '<td>' + value.status + '</td>' +
                                    '</tr>';

                                $('#results').append(html);
                            });


                        },
                        errir: function () {
                            alert("error");
                        }
                    })
                };
            </script>

            <script src="{{ asset('js/app.js') }}"></script>
@stop

