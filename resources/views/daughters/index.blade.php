@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Снять позиции123456</h1>
@stop

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">

                    </div>

                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Название</th>
                                <th>Адрес</th>
                                <th>Кнопки</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($data))
                                @php $c = 0;
                                @endphp
                                @foreach ($data as $d)
                                    <tr>
                                        <td>@php $c++; echo $c;
                                        @endphp.</td>
                                        <td><a href="cat/{!! $d->id !!}">{!! $d->name !!}</a></td>
                                        <td><a href="{!! $d->address !!}">{!! $d->address !!}</a></td>
                                        <td>
                                            <a class="btn btn-app btn-xs" href="/daughters/edit/{!! $d->id !!}"><i class="fa fa-edit"></i>
                                                                    Редактировать
                                            </a>

                                            <a class="btn btn-app" href="/daughters/control/{!! $d->id !!}"><i class="fa fa-eye"></i>
                                                Управлять
                                            </a>

                                            <button class="btn-primary btn deleteProduct" data-id="{{ $d->id }}"
                                                    data-token="{{ csrf_token() }}">Удалить
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script>


        $(".deleteProduct").click(function () {
            var id = $(this).data("id");
            var token = $(this).data("token");
            $.ajax(
                {
                    url: "cat/delete/" + id,
                    method: "GET",
                    dataType: "JSON",
                    token: token,
                    data: {
                        "id": id,
                    },
                    success: function (data) {

                        console.log(data);
                    }
                });


        });


    </script>
@endsection