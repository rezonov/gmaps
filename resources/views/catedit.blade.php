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
                    <td><label>Название</label></td>
                    <td><input type="text" name="name" class="form-control" value="{{$data->name}}" /></td>
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