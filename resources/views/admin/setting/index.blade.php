@extends('layouts.app', ['title' => _lang('setting'), 'modal' => false])
@section('page.header')
  <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> {{_lang('setting')}}</h1>
          <p>A free and open source Bootstrap 4 admin template</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">{{_lang('setting')}}</a></li>
        </ul>
      </div>
@stop
@section('content')
<!-- Basic initialization -->
  <div class="row">
      <div class="col-md-12">
         <div class="tile">
            <div class="tile-body">
             <div class="bs-component">

              <ul class="nav nav-pills nav-justified" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="pill" href="#home">{{_lang('home')}}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#menu1">{{_lang('logo')}}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#menu2">{{_lang('basic')}}</a>
                </li>
              </ul>

  <!-- Tab panes -->
  {!! Form::open(['route' => 'admin.setting', 'id' => 'content_form','files' => true, 'method' => 'POST']) !!}
              <div class="tab-content">
                <div id="home" class="container tab-pane active">
                   <div class="row">
                     <div class="col-md-6">
                       {{ Form::label('company_name', _lang('company_name') , ['class' => 'col-form-label ']) }}
                       {{ Form::text('company_name', get_option('company_name'), ['class' => 'form-control', 'placeholder' => _lang('company_name')]) }}
                     </div>
                     <div class="col-md-6">
                       {{ Form::label('site_title', _lang('title') , ['class' => 'col-form-label ']) }}
                      {{ Form::text('site_title', get_option('site_title'), ['class' => 'form-control', 'placeholder' => _lang('title')]) }}
                     </div>
                     <div class="col-md-6">
                       {{ Form::label('email', _lang('email') , ['class' => 'col-form-label ']) }}
                      {{ Form::text('email', get_option('email'), ['class' => 'form-control', 'placeholder' => _lang('email')]) }}
                     </div>
                     <div class="col-md-6">
                       {{ Form::label(_lang('phone'), _lang('phone') , ['class' => 'col-form-label ']) }}
                       {{ Form::text('phone',get_option('phone'), ['class' => 'form-control', 'placeholder' => _lang('phone')]) }}
                     </div>
                     <div class="col-md-6">
                       {{ Form::label('alt_phone', _lang('alernative_phone') , ['class' => 'col-form-label ']) }}
                       {{ Form::text('alt_phone', get_option('alt_phone'), ['class' => 'form-control', 'placeholder' => _lang('alernative_phone')]) }}
                     </div>
                     <div class="col-md-6">
                       {{ Form::label('start_date', _lang('starting_date') , ['class' => 'col-form-label ']) }}
                       {{ Form::text('start_date', get_option('start_date'), ['class' => 'form-control date', 'placeholder' => _lang('starting_date')]) }}
                     </div>
                     <div class="col-md-6">
                       {{ Form::label('timezone', _lang('timezone') , ['class' => 'col-form-label ']) }}
                        <select name="timezone" class="form-control select">
                        @foreach (tz_list() as $key=> $time)
                        <option  value="{{$time['zone']}}">{{ $time['diff_from_GMT'] . ' - ' . $time['zone']}}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class="col-md-6">
                        {{ Form::label('language', _lang('language') , ['class' => 'col-form-label ']) }}
                        <select name="language" class="form-control select">
                        {!! load_language( get_option('language') ) !!}
                        </select>
                     </div>
                     <div class="col-md-6">
                       {{ Form::label('land_mark', _lang('land_mark') , ['class' => 'col-form-label']) }}
                        {{ Form::text('land_mark', get_option('land_mark'), ['class' => 'form-control', 'placeholder' => _lang('land_mark')]) }}
                     </div>
                     <div class="col-md-6">
                        {{ Form::label('address', _lang('address') , ['class' => 'col-form-label']) }}
                        {{ Form::textarea('address', get_option('address'), ['class' => 'form-control', 'rows'=>3]) }}
                     </div>
                   </div>
                </div>
                <div id="menu1" class="container tab-pane fade">
                 <div class="row">
                   <div class="col-md-6">
                     {{ Form::label('logo', _lang('logo') , ['class' => 'col-form-label']) }}
                     <input type="file" name="logo">
                     @if(get_option('logo'))
                        <input type="hidden" name="oldLogo" value="{{get_option('logo')}}">
                      @endif

                   </div>

                   <div class="col-md-6">
                     {{ Form::label('favicon', _lang('favicon') , ['class' => 'col-form-label']) }}
                     <input type="file" name="favicon">
                      @if(get_option('favicon'))
                        <input type="hidden" name="oldfavicon" value="{{get_option('favicon')}}">
                      @endif
                   </div>

                 </div> 
                </div>
                <div id="menu2" class="container tab-pane fade"><br>
                 <div class="row">
                    <div class="col-md-6">
                       {{ Form::label('fb', _lang('facebook_link') , ['class' => 'col-form-label ']) }}
                       {{ Form::text('fb', get_option('fb'), ['class' => 'form-control ', 'placeholder' => _lang('facebook_link')]) }}
                     </div>
                      <div class="col-md-6">
                       {{ Form::label('twiter', _lang('twiter') , ['class' => 'col-form-label ']) }}
                       {{ Form::text('twiter', get_option('twiter'), ['class' => 'form-control ', 'placeholder' => _lang('twiter')]) }}
                     </div>

                      <div class="col-md-6">
                       {{ Form::label('youtube', _lang('youtube') , ['class' => 'col-form-label ']) }}
                       {{ Form::text('youtube', get_option('youtube'), ['class' => 'form-control ', 'placeholder' => _lang('youtube')]) }}
                     </div>

                      <div class="col-md-6">
                       {{ Form::label('linkedin', _lang('linkedin') , ['class' => 'col-form-label ']) }}
                       {{ Form::text('linkedin', get_option('linkedin'), ['class' => 'form-control ', 'placeholder' => _lang('linkedin')]) }}
                     </div>
                 </div>
                </div>
              </div>
                 <div class="text-right mr-2">
                  <button type="submit" class="btn btn-primary"  id="submit">{{_lang('update_setting')}}</button>
                  <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

                 </div>
      {!!Form::close()!!}
            </div>
            </div>
        </div>
      </div>
  </div>
<!-- /basic initialization -->
@stop
@push('scripts')
<script src="{{ asset('js/pages/setting.js') }}"></script>
@endpush

