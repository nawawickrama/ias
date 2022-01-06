<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{url('assets/vendors/core/core.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/jquery-tags-input/jquery.tagsinput.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/dropify/dist/dropify.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/fonts/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/demo_1/style.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <script src="{{url('assets/vendors/core/core.js')}}"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="{{url('assets/images/favicon.png')}}" />
</head>

<body>
@yield('content')
@include('layouts.aleart.msg')
@include('sweetalert::alert')

    <script src="{{url('assets/js/select2.js')}}"></script>
    <script src="{{url('assets/vendors/select2/select2.min.js')}}"></script>
    <script src="{{url('assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{url('assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{url('assets/vendors/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{url('assets/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
    <script src="{{url('assets/vendors/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>
    <script src="{{url('assets/vendors/dropzone/dropzone.min.js')}}"></script>
    <script src="{{url('assets/vendors/dropify/dist/dropify.min.js')}}"></script>
    <script src="{{url('assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{url('assets/vendors/moment/moment.min.js')}}"></script>
    <script src="{{url('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js')}}"></script>
    <script src="{{url('assets/vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{url('assets/js/template.js')}}"></script>
    <script src="{{url('assets/js/form-validation.js')}}"></script>
    <script src="{{url('assets/js/bootstrap-maxlength.js')}}"></script>
    <script src="{{url('assets/js/inputmask.js')}}"></script>
    <script src="{{url('assets/js/typeahead.js')}}"></script>
    <script src="{{url('assets/js/tags-input.js')}}"></script>
    <script src="{{url('assets/js/dropzone.js')}}"></script>
    <script src="{{url('assets/js/dropify.js')}}"></script>
    <script src="{{url('assets/js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{url('assets/js/datepicker.js')}}"></script>
    <script src="{{url('assets/js/timepicker.js')}}"></script>
    <script src="{{url('assets/vendors/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{url('assets/vendors/promise-polyfill/polyfill.min.js')}}"></script>
    <script src="{{url('assets/js/sweet-alert.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>