@extends('layouts.app', ['title' => _lang('user_role'), 'modal' => 'lg'])
@section('page.header')
  <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> {{_lang('user_role')}}</h1>
          <p>A free and open source Bootstrap 4 admin template</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">{{_lang('user_role')}}</a></li>
        </ul>
      </div>
@stop
@section('content')
 <div class="tile">
  <div class="tile-body">
    {!! Form::open(['route' => 'admin.user.update', 'id'=>'content_form','files' => true, 'method' => 'POST']) !!}
    @method('PUT');
    <input type="hidden" name="id" value="{{$user->id}}">
    <fieldset class="mb-3" id="form_field">
     <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            {{ Form::label('surname', _lang('Prefix') , ['class' => 'col-form-label required']) }}

            {{ Form::text('surname', $user->surname, ['class' => 'form-control', 'placeholder' => 'Dr/Mr/Mrs','required'=>'']) }}
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            {{ Form::label('first_name', _lang('first_name') , ['class' => 'col-form-label required']) }}

            {{ Form::text('first_name', $user->first_name, ['class' => 'form-control', 'placeholder' => _lang('first_name'),'required'=>'']) }}
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            {{ Form::label('last_name', _lang('last_name') , ['class' => 'col-form-label required']) }}

            {{ Form::text('last_name', $user->last_name, ['class' => 'form-control', 'placeholder' => _lang('last_name'),'required'=>'']) }}
          </div>
        </div>
     </div>

     <div class="row">
        <div class="col-md-4">
            <div class="form-group">
            {{ Form::label('email', _lang('email') , ['class' => 'col-form-label required']) }}

            {{ Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => _lang('email'),'required'=>'']) }}
          </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
          {{ Form::label('role', _lang('role_name') , ['class' => 'col-form-label required']) }}
            {!! Form::select('role', $roles, $user->roles->first()->id, ['class' => 'form-control select', 'data-placeholder' => _lang('select_role')]); !!}
        </div>
      </div>

      <div class="col-md-4">
            <div class="form-group">
            {{ Form::label('username', _lang('user_name') , ['class' => 'col-form-label required']) }}

            {{ Form::text('username', $user->username, ['class' => 'form-control', 'placeholder' => _lang('user_name'),'required'=>'']) }}
          </div>
        </div>
     </div>
         @can('user.update')
        <div class="text-right">
            <button type="submit" class="btn btn-primary"  id="submit">{{_lang('update')}}<i class="icon-arrow-right14 position-right"></i></button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

           </div>
           @endcan
     <fieldset class="mb-3" id="form_field">
    {!!Form::close()!!}
  </div>
</div>
<!-- /basic initialization -->
@stop
@push('scripts')
<script src="{{ asset('js/pages/user.js') }}"></script>
@endpush

