@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{$d->name}}</h1>
@stop

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Информация</h3>
                    </div>

                    <div class="box-body">

                      <li>{!! $d->name !!}</li>


                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Шаблоны</h3>
                    </div>

                    <div class="box-body">

                        <a class="btn btn-app btn-xs" href="/daughters/{!! $d->id !!}/template/main"><i class="fa fa-edit"></i>
                           Главная
                        </a>

                        <a class="btn btn-app btn-xs" href="/daughters/edit/{!! $d->id !!}"><i class="fa fa-edit"></i>
                            Штат
                        </a>
                        <a class="btn btn-app" href="/daughters/control/{!! $d->id !!}"><i class="fa fa-eye"></i>
                            Город
                        </a>
                        <a class="btn btn-app btn-xs" href="/daughters/edit/{!! $d->id !!}"><i class="fa fa-edit"></i>
                            Категория
                        </a>
                        <a class="btn btn-app btn-xs" href="/daughters/edit/{!! $d->id !!}"><i class="fa fa-edit"></i>
                            Компания
                        </a>


                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$d->name}}</h3>
                    </div>

                    <div class="box-body">

                        <a class="btn btn-app btn-xs" href="/daughters/edit/{!! $d->id !!}"><i class="fa fa-edit"></i>
                            Шаблоны
                        </a>

                        <a class="btn btn-app" href="/daughters/control/{!! $d->id !!}"><i class="fa fa-eye"></i>
                            Категории
                        </a>
                        <a class="btn btn-app btn-xs" href="/daughters/edit/{!! $d->id !!}"><i class="fa fa-edit"></i>
                            Города
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function getMessage() {
            alert("here");
            /* $.ajax({
                 type:'POST',
                 url:'/getmsg',
                 data:'_token = <?php echo csrf_token() ?>',
                success:function(data){
                    $("#msg").html(data.id);
                }
            });*/
        }
    </script>
@endsection