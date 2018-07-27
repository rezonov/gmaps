@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Снять позиции123456</h1>
@stop

@section('content')
    <div class="content">
        <div class="box">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Название</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($data))
                    @foreach ($data as $d)
                        <tr>
                            <td><a href="cat/{!! $d->id !!}">{!! $d->name !!}</a></td>
                            <td>
                                <button class="btn-primary deleteProduct" data-id="{{ $d->id }}"
                                        data-token="{{ csrf_token() }}">Delete Task
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
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