@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Снять позиции123456</h1>
@stop

@section('content')
    <div class="content">
        <div class="box">

            <table id="example2" class="table table-bordered table-hover">

                <tbody>
                <tr>
                    <td><label>Название</label></td>
                    <td><input type="text" name="name" class="form-control" value="{{$data->name}}" /></td>
                </tr>
                <tr>
                    <td><label>Сайт</label></td>
                    <td><input type="text" name="website" class="form-control" value="{{$data->website}}" /></td>
                </tr>
                <tr>
                    <td><label>Номер телефона в международном формате</label></td>
                    <td><input type="text" name="international_phone_number" class="form-control" value="{{$data->international_phone_number}}"</td>
                </tr>
                <tr>
                    <td><label>Город</label></td>
                    <td><input type="text" name="city" class="form-control" value="{{$data['cats_cities']->name}}"></td>
                </tr>
                <tr>
                    <td><label>Адрес</label></td>
                    <td><input type="text" name="address" class="form-control" value="{{$data->address}}"</td>
                </tr>
                <tr>
                    <td><label>Рейтинг Google</label></td>
                    <td><input type="text" name="rating" class="form-control" value="{{$data->rating}}"</td>
                </tr>
                <tr>
                    <td><label>Часы работы</label></td>
                    <td>
                        <textarea name="hours" rows="8" cols="50">{{$data->hours}}</textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button type="button" class="btn btn-primary">Сохранить</button></td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>


    <script>
        function getMessage(){
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