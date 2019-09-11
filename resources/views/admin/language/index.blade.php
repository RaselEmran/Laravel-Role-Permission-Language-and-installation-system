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
            <h3 class="tile-title">
              <button type="button" class="btn btn-info" id="content_managment" data-url ="{{ route('admin.language.create') }}"><i class="icon-stack-plus mr-2"></i>{{_lang('create')}}</button>
            </h3>
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>{{_lang('language')}}</th>
                    <th>{{_lang('edit_tarnslation')}}</th>
                    <th>{{_lang('remove')}}</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach(get_language_list() as $language)
                <tr>
                <td>{{ ucwords($language) }}</td>
                  <td>
                    <a href="{{ route('admin.language.edit',$language) }}" class="btn btn-info"><i class="icon-pencil7"></i>{{_lang('translate')}}</a>
                  </td>
                 <td>
                    <a href="#" class="btn btn-danger" id="delete_item" data-id ="{{$language}}" data-url="{{route('admin.language.delete',$language) }}">{{_lang('trash')}}</a>
                 </td>
                </tr>
                @endforeach
                </tbody>
               </table>
             </div>
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

