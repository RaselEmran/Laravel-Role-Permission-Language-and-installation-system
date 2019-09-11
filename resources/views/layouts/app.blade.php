<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">>
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title .' | '. config('app.name', 'Satt ') :  config('app.institue_name', config('app.name', 'Satt'))}}</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/css/parsley.css')}}">

    <!-- /global stylesheets -->

    @stack('admin.css')
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
   @include('_partials.admin.navbar')
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    @include('_partials.admin.sidebar')
    <main class="app-content">
       <div style="position: absolute;top: 55%;left: 50%;z-index:100; display: none;" id="loader">
        <img src="{{asset('img/loading.gif')}}" alt="">
        </div>
         @section('page.header')
         @show

     @section('content')
     @show
    </main>

            <!-- /page content -->
        @if(isset($modal))
        <!-- Remote source -->
        <div id="modal_remote" class="modal fade border-top-success rounded-top-0" tabindex="-1"  data-backdrop="static">
            <div class="modal-dialog modal-{{ $modal }}">
                <div class="modal-content">
                    <div class="modal-header bg-light border-grey-300">
                        <h5 class="modal-title">{{$title}}</h5>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>
                    <div id="modal-loader" style="display: none; text-align: center;"> <img src="{{ asset('img/loading.gif') }}"> </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
        <!-- /remote source -->
        @endif
    <!-- Essential javascripts for application to work-->
    <script src="{{asset('backend/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('backend/js/popper.min.js')}}"></script>
    <script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/js/page.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{asset('backend/js/plugins/pace.min.js')}}"></script>
    <script src="{{ asset('backend/js/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('backend/js/plugins/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/plugins/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/plugins/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/plugins/sweetalert.min.js')}}"></script>
     <script src="{{asset('backend/js/toastr.min.js')}}"></script>
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 </script>
 <script src="{{asset('js/main.js')}}"></script>
<!-- /core JS files -->
@stack('scripts')

  </body>
</html>