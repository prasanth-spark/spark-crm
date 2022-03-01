@extends('../layout/base')

@section('body')
    <body class="main">
        @yield('content')
        @include('../layout/components/dark-mode-switcher')

        <!-- BEGIN: JS Assets-->
        

        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="{{ mix('dist/js/app.js') }}"></script>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



       
    <script>  
       toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }    
                @if(Session::has('success'))
                const toastHTML = '{{Session::get('success')}}';
                toastr["success"](toastHTML);
                @php Session::forget('success'); @endphp
                @endif
                @if(Session::has('error'))
                const toastHTML = '{{Session::get('error')}}';
                toastr["error"](toastHTML);
                @php Session::forget('error'); @endphp
                @endif
</script> 

        
        <!-- END: JS Assets-->

        @yield('script')
    </body>
@endsection

