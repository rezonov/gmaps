@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="/daughters/control/{!! $daughters->id !!}"> {!! $daughters->name !!}</a></li>
        <li class="active">Шаблон {!! $template !!}</li>
    </ol>
    <div class="box">
        <div class="box-header with-border">
            <h1 class="box-title">Шаблон {!! $template !!}</h1>


            <!-- /.box-tools -->
        </div>
        <div class="content">

            <div class="row">
                <div class="col-md-9">
                    <div class="box">

                        <div class="box-body with-border">


                            <form method="POST" action="/daughters/template/save">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{!! $id !!}">
                                <input type="hidden" name="template" value="{!! $template !!}"/>
                                @extends('templates.editor')
                                <textarea name="content">
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
                                <div class="form-control">
                                    <select>
                                        @foreach($pages as $p)
                                            <option value="{!! $p->id !!}">{!! $p->title->rendered !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="box">

                        <div class="box-body with-border">



                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>


@stop