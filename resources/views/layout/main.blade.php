@extends('../layout/base')
<script type="text/javascript" src="{{URL::asset('dist/js/datatables/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('dist/js/datatables/dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('dist/js/datatables/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('dist/js/datatables/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('dist/js/datatables/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('dist/js/datatables/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('dist/js/datatables/buttons.html5.min.js')}}"></script>
<link href="{{ asset('dist/css/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('dist/css/datatables/buttons.dataTables.min.css') }}" rel="stylesheet">


@section('body')
    <body class="main">
        @yield('content')
        @include('../layout/components/dark-mode-switcher')

        <!-- BEGIN: JS Assets-->
        

        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="{{ mix('dist/js/app.js') }}"></script> 
        <!-- <script type="text/javascript" src="{{URL::asset('dist/js/jquery.min.js')}}"></script> -->




        @yield('script')
    </body>
@endsection

