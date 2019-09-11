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
<!-- Basic initialization -->
  <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
        {!! Form::open(['route' => 'admin.user.role.update', 'id'=>'content_form','files' => true, 'method' => 'POST']) !!}
        <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            {{ Form::label('name',  _lang('Role Name') , ['class' => 'col-form-label required']) }}

            {{ Form::text('name', $role->name, ['class' => 'form-control', 'placeholder' =>  _lang('role_name'),'required'=>'']) }}
            <input type="hidden" name="id" value="{{$role->id}}">
          </div>
        </div>
        </div>
        <div class="row">
        <h2>{{_lang('Permission')}}</h2>
       <table class="table table-bordered">
        @foreach (split_name($permissions) as $key => $element)
      <tr>
        <td rowspan ="{{count($element)+1}}">{!! $key !!}</td>
        <td rowspan="{{count($element)+1}}">
        <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input select_all" id="select_all_{{$key}}" data-id="{{$key}}">
        <label class="custom-control-label" for="select_all_{{$key}}">{{_lang('select_all')}}</label>
          </div>
        </td>
      </tr>
           @foreach ($element as $per)
           <tr>

            <td>
             <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input {{$key}}" id="{{$per}}" multiple="multiple" name="permissions[]" value="{{$per}}" {{in_array($per, $role_permissions)?'checked':''}}>
        <label class="custom-control-label" for="{{$per}}">{{tospane($per)}}</label>
          </div>

            </td>
           </tr>
          @endforeach
         @endforeach
       </table>
        </div>
        @can('role.update')
     <div class="text-right">
        <button type="submit" class="btn btn-primary"  id="submit">{{_lang('update_permission')}}<i class="icon-arrow-right14 position-right"></i></button>
        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

       </div>
     @endcan

    {!!Form::close()!!}
             </div>
          </div>
      </div>
  </div>
<!-- /basic initialization -->
@stop
@push('scripts')
<script src="{{ asset('js/pages/role.js') }}"></script>
<script>
  $(document).on('click','.select_all',function(){
    var id =$(this).data('id');
    if (this.checked) {
      $("."+id).prop('checked', true);
    } else{
      $("."+id).prop('checked', false);
    }
  });
</script>
@endpush

