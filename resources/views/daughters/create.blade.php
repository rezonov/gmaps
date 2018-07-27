@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Создать дочерний сайт</h1>
@stop

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Создание новой дочки</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="box-body">

                        <form method="POST">
                        {{ csrf_field() }}
                        <!-- поля формы -->
                            <div class="form-group">
                                <label for="inputNameDaughter">Название дочернего сайта</label>
                                <input type="text" name="inputNameDaughter" class="form-control" id="inputNameDaughter"
                                       placeholder="Введите название" @isset ($d->name)value= "{!! $d->name !!}"
                                        @endisset
                                >
                            </div>
                            @isset ($d->id)
                            <input type="hidden" name="id" value = {!!  $d->id !!} />
                            @endisset
                            <div class="form-group">
                                <label for="inputAddressDaughter">URL сайта ( с https )</label>
                                <input type="text" name="inputAddressDaughter" class="form-control"
                                       id="inputAddressDaughter" placeholder="Введите адрес" @isset ($d->address)value= {!! $d->address !!}
                                        @endisset>
                            </div>
                            <div class="form-group">
                                <label for="inputLoginDaughter">Логин администратора</label>
                                <input type="text" name="inputLoginDaughter" class="form-control"
                                       id="inputAddressDaughter" placeholder="Введите логин" @isset ($d->login)value= {!! $d->login !!}
                                        @endisset>
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordDaughter">Пароль администратора</label>
                                <input type="text" name="inputPasswordDaughter" class="form-control"
                                       id="inputAddressDaughter" placeholder="Введите пароль" @isset ($d->password)value= {!! $d->password !!}
                                        @endisset>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                        </table>
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