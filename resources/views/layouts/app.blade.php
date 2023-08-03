<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('backend/') }}/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('backend/') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('backend/') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('backend/') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    {{-- <!-- Datatable CSS -->
    <link href="{{ asset('backend/') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <!-- loader--> --}}
    <link href="{{ asset('backend/') }}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('backend/') }}/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('backend/') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('backend/') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="{{ asset('backend/') }}/assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('backend/') }}/assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
<link rel="stylesheet" href="{{ asset('backend/') }}/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="{{ asset('backend/') }}/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="{{ asset('backend/') }}/assets/css/header-colors.css" />
    <!-- Seletc 2 CSS -->
    <link href="{{ asset('backend/') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('backend/') }}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />

    <link href="{{ asset('backend/') }}/assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet" />
    <link href="{{ asset('backend/') }}/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
    <!-- Tag css -->
    <link href="{{ asset('backend/') }}/assets/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />
    <!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    <title> FinTech Admin Dashboard</title>
    @stack('css')
    <style>
        .common_btn {
            position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
    }
    .page-item.active .common_btn {
    z-index: 3;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
    </style>
</head>

<body>

    @guest
    @else
    <!--wrapper-->
    <div class="wrapper">
        <!--start page wrapper -->

        @include('admin.partial.admin_topbar')
        @include('admin.partial.admin_sidebar')
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2023. All right reserved.</p>
        </footer>
    </div>
    @endguest
    @yield('admin_content')
    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('backend/') }}/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('backend/') }}/assets/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- include summernote js -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script src="{{ asset('backend/') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('backend/') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('backend/') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ asset('backend/') }}/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    {{-- <!--Datatable JS-->
    <script src="{{ asset('backend/') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend/') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('backend/') }}/assets/js/table-datatable.js"></script> --}}

    <script src="{{ asset('backend/') }}/assets/js/index.js"></script>
    <!--app JS-->
    <script src="{{ asset('backend/') }}/assets/js/app.js"></script>
    <!--Select 2 JS-->
    <script src="{{ asset('backend/') }}/assets/plugins/select2/js/select2.min.js"></script>
    <script src="{{ asset('backend/') }}/assets/js/form-select2.js"></script>
    <!--Sweet alert JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--File upload  JS-->
    <script src="{{ asset('backend/') }}/assets/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
    <script src="{{ asset('backend/') }}/assets/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
    <script src="{{ asset('backend/') }}/assets/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
    <script src="{{ asset('backend/') }}/assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
    <script src="{{ asset('backend/') }}/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
    <script src="{{ asset('backend/') }}/assets/js/form-file-upload.js"></script>
    <!-- tag js -->
    <script src="{{ asset('backend/') }}/assets/plugins/input-tags/js/tagsinput.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

     <script>
      @if(Session::has('messege'))
        var type="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'info':
                 toastr.info("{{ Session::get('messege') }}");
                 break;
            case 'success':
                toastr.success("{{ Session::get('messege') }}");
                break;
            case 'warning':
               toastr.warning("{{ Session::get('messege') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('messege') }}");
                break;
        }
      @endif
   </script>

<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
           swal({
             title: "Are you Want to delete?",
             text: "Once Delete, This will be Permanently Delete!",
             icon: "warning",
             buttons: true,
             dangerMode: true,
           })
           .then((willDelete) => {
             if (willDelete) {
                  window.location.href = link;
             } else {
               swal("Safe Data!");
             }
           });
       });
</script>

    {{-- <script>
        $(document).on("click", "#delete", function(e){
            e.preventDefault();
               swal({
                 title: "Are you Want to delete?",
                 text: "Once Delete, This will be Permanently Delete!",
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
               })
               .then((willDelete) => {
                 if (willDelete) {
                       $(e.target).closest('form').submit()
                 } else {
                   swal("Safe Data!");
                 }
               });
           });
   </script> --}}

   <script>
    $(document).ready(function() {
    $('#summernote, #summernote').summernote({
        height: 280,
    });
  });
  $(document).ready(function() {
    $('#summernotetwo, #summernotetwo').summernote({
        height: 280,
    });
  });
</script>


    @stack('js')
</body>

</html>
