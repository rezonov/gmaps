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
                        <?php echo $data->render(); ?>
                        <table class="table table-bordered table-hover" id="cities">
                            <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th width="30%">Название</th>
                                @if(isset($data[0]->countries))
                                    <th width="30%">Страна</th>

                                @endif
                                @if(isset($data[0]->regions))
                                <th width="30%">Регионы</th>
                                    @endif

                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($data))
                                @php $c = 0;
                                @endphp
                                @foreach ($data as $d)
                                    <tr>
                                        <td>@php $c++; echo $c;
                                            @endphp.
                                        </td>
                                        <td><a href="cat/{!! $d->id !!}">{!! $d->name !!}</a></td>
                                        @if(isset($d->countries))
                                            <td><a href="cat/{!! $d->id !!}">{!! $d->countries['en'] !!}</a></td>
                                        @endif
                                        @if(isset($d->regions))
                                            <td><a href="cat/{!! $d->id !!}">{!! $d->regions['en_name'] !!}</a></td>
                                        @endif

                                    </tr>
                                @endforeach
                            @endif


                            </tbody>
                            <tfoot>
                            <tr>
                                <th width="10px">#</th>
                                <th>Название</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                        <?php echo $data->render(); ?>
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