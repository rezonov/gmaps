@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Шаблон для дочернего сайта</h1>
@stop

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Шаблон для {!! $template !!}</h3>
                    </div>
                    <div class="box-body with-border">
                        <div class="info-box">
                            <ul>Паттерны</ul>
                            <li>!!address!! = Адрес</li>
                            <li>!!city!! = Город</li>
                            <li>!!hours!! = Расписание</li>
                        </div>

                        @extends('templates.editor')
                        <textarea>
        @if(isset($data))
                                {!! $data !!}
                            @endif
    </textarea>
                        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
                        <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
                        <script>
                            $('textarea').ckeditor();
                            // $('.textarea').ckeditor(); // if class is prefered.
                        </script>
                    </div>
                </div>
            </div>

        </div>

    </div>



@stop