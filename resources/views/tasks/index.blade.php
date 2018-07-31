@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li>Список задач</li>

    </ol>
    <div class="box">
        <div class="box-header with-border">
            <h1 class="box-title">Список Задач</h1>


            <!-- /.box-tools -->
        </div>
        <div class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box">

                        <div class="box-body with-border">

                            <table id="borders" class="table table-border">
                                <thead>
                                <tr>
                                    <th>Задача</th>
                                    <th>Статус</th>
                                    <th>Категория</th>
                                    <th>Страна</th>
                                    <th>Время обновления</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="2"> <?php echo $data->render(); ?></td>
                                </tr>
                                @foreach ($data as $Task)

                                    <td>{!! $Task->name !!}</td>

                                    <td>
                                        <span class="label label-primary">{!! $Task->status !!}</span>
                                    </td>
                                    <td>
                                        {!! $Task->cats['name'] !!}
                                    </td>
                                    <td>
                                        {!! $Task->countries['name'] !!}
                                    </td>
                                    <td>
                                        {!! $Task->updated_at !!}
                                    </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </div>


@stop