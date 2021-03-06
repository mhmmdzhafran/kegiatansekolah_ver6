@extends('layouts.template')

@section('title')
    Admin - Buat Pengguna PPK
@endsection

@section('content')
    <h1>Edit User PPK</h1>

    <span id="notification_error"></span>

    @if (Session::has('username_already_picked'))
        <b class="bg-danger" style="color: white">{{ session('username_already_picked') }}</b>
    @endif

    {!! Form::open(['method' => 'PUT', 'action' =>['AdminUserController@update', $user->id], 'files'=>true, 'class' => 'form-update']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', $user->name , ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::text('email', $user->email , ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('role_id', 'Role:') !!}
        {!! Form::select('role_id', array('' => 'Choose Options') + $roles , null , ['class' => 'form-control']) !!}
    </div>

    {{-- <div class="form-group">
        {!! Form::label('photo_id', 'Insert a Photo:') !!}
        {!! Form::file('photo_id', null , ['class' => 'form-control']) !!}
    </div> --}}

    <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Simpan User', ['class' => 'btn btn-primary submit']) !!}
    </div>
    {!! Form::close() !!}

      <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-lg-12 col-sm-12">
            <div class="modal_success">
            <img src="{{ asset('success/success_indicator.gif') }}" alt="" width="300" height="300">
            </div>
        <p class="success" style="text-align: center"></p>
        </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn_close">OK</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
    <script>
        //add ajax disini cuy
        var element = '';
        $(document).on('click', '.submit', function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('[name = "_token"]').val()
                }
            });
            $.ajax({
                url: $(".form-update").attr('action'),
                method: 'PUT',
                data: $(".form-update").serialize(),
                success: function(result){
                    $("#notification_error").empty();
                    $(".success").empty();
                    $(".success").append('User PPK Telah Diubah dan Berhasil Disimpan');
                    window.scrollTo(0,0);
                    $("#staticBackdrop").modal();
                    $(".btn_close").on('click', function(){
                        var link = '{{route("admin.user.index")}}';
                        window.location.assign(link);
                    });
                },
                error: function(result){
                    //result.error diterima
                    $("#notification_error").empty();
                    $(".success").empty();
                    var value_error = $.parseJSON(result.responseText);
                    element = '<div class="alert alert-danger">';
                    $.each(value_error.errors, function(key, value){
                        element+= '<li class="ml-3">'+value+'</li>';
                    });
                    element += '</div>';
                    window.scrollTo(0,0);
                    document.getElementById("notification_error").innerHTML = element;
                }
            });
        })
    </script>
@endsection
