@extends('layouts.app', ['title' => _lang('language'), 'modal' => 'lg'])
@section('page.header')
  <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> {{_lang('language')}}</h1>
          <p>A free and open source Bootstrap 4 admin template</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">{{_lang('language')}}</a></li>
        </ul>
      </div>
@stop
@section('content')
<!-- Basic initialization -->
  <div class="row">
        <div class="col-md-12">
          <div class="tile">
            
            <div class="tile-body">
      {!! Form::open(['route' => ['admin.language.update',$id], 'id'=>'content_form','files' => true, 'method' => 'POST']) !!}
        @method('patch')
       <div class="row">
     @foreach($language as $key=>$lang)
      <div class="col-md-6">
      {{ Form::label('language_name', ucwords($key) , ['class' => 'col-form-label required']) }}
      <input type="text" class="form-control" name="language[{{ str_replace(' ','_',$key) }}]" value="{{ $lang }}" required>
      </div>
        @endforeach
             </div>

        <div class="text-right mt-2">
        <button type="submit" class="btn btn-primary"  id="submit">{{_lang('translation')}}<i class="icon-arrow-right14 position-right"></i></button>
        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

       </div>
       {!!Form::close()!!}
          </div>
      </div>
  </div>
<!-- /basic initialization -->
@stop
@push('scripts')
<script type="text/javascript" src="{{asset('backend/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('js/pages/setting.js') }}"></script>
@endpush

