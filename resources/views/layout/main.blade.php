@extends('../layout/base')

@section('body')
    <body class="main">
        @yield('content')
        @include('../layout/components/dark-mode-switcher')

        <!-- BEGIN: JS Assets-->
        

        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#tasklist').DataTable({
                "processing": true,
                "serverSide": true,
                paging: true,
                "searching": true,
                "ordering": false,
                "info": true,
                "lengthChange": true,
                "bProcessing": true,
                "bServerSide": true,
                "destroy": true,
                "sAjaxSource": "task-pagination",

                columns: [
                    { data: "id"},
                    { data: "date" },
                    { data: "project_name" },
                    { data: "task_module" },
                    { data: "estimated_hours"},
                    { data: "worked_hours"},
                    { data: "task_status"},
                    { data: "actions" },
                ],
            } );
        } );
        </script>
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

