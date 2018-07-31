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
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th width="1px">#</th>
                                    <th>Название</th>
                                    <th width="50px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data))
                                    @php $c = 0; @endphp
                                    @foreach ($data as $d)
                                        <tr>
                                            <td align="center">@php $c++; echo $c; @endphp</td>
                                            <td>
                                                @if($d->parent_level == 1)
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                @endif
                                                @if($d->parent_level == 2)
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                @endif

                                                <a href="cat/{!! $d->id !!}">{!! $d->name !!}</a>
                                            </td>
                                            <td>

                                                <a class="deleteProduct" data-id="{{ $d->id }}"
                                                   data-token="{{ csrf_token() }}">Удалить
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Название</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">

            </div>
        </div>
    </div>


    <script>
        $(function () {
            $('#example2').DataTable();
        });
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