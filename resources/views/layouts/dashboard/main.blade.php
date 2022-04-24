<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ url('assets/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/dropzone/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/dropify/dist/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/demo_1/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/jquery-steps/jquery.steps.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="{{ url('assets/vendors/core/core.js') }}"></script>

    <link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
<div class="main-wrapper">
    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('Student'))
        @include('layouts.dashboard.student_sidebar')
    @else
        @include('layouts.dashboard.sidebar')
    @endif
    <div class="page-wrapper">
        <nav class="navbar">
            <a href="#" class="sidebar-toggler">
                <i data-feather="menu"></i>
            </a>
            <div class="navbar-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown nav-notifications">
                        @php
                            $notify_count = count(Auth::user()->unreadNotifications);
                        @endphp
                        @if($notify_count)
                            <span class="badge badge-primary" style="border-radius: 30px;">{{$notify_count}}</span>
                        @endif

                        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="bell"></i>
                            @if( $notify_count)
                                <div class="indicator">
                                    <div class="circle"></div>
                                </div>
                            @endif
                        </a>


                        <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <p class="mb-0 font-weight-medium">{{$notify_count}} New Notifications</p>
                                <a href="{{route('mark_as_read_notification', 'all')}}" class="text-muted">Clear all</a>
                            </div>
                            <div class="dropdown-body" id="notificationPanel">
                                @foreach(Auth::user()->unreadNotifications as $notify)
                                    <a href="{{route('mark_as_read_notification',$notify)}}" class="dropdown-item">
                                        <div class="icon">
                                            <i data-feather="layers"></i>
                                        </div>
                                        <div class="content">
                                            <p>{{$notify->data['info']}}</p>
                                            <p class="sub-text text-muted">{{$notify->data['time']}}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="dropdown-footer d-flex align-items-center justify-content-center">
                                <a href="javascript:;">View all</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown nav-profile">
                        <a class="nav-link dropdown-toggle" href="{{ route('profile') }}" id="profileDropdown"
                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="https://via.placeholder.com/30x30" alt="profile">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <div class="dropdown-header d-flex flex-column align-items-center">
                                <div class="figure mb-3">
                                    <img src="https://via.placeholder.com/80x80" alt="">
                                </div>
                                <div class="info text-center">
                                    <p class="name font-weight-bold mb-0">{{ Auth::user()->name }}</p>
                                    <p class="email text-muted mb-3">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <div class="dropdown-body">
                                <ul class="profile-nav p-0 pt-3">
                                    <li class="nav-item">
                                        <a href="{{ route('profile') }}" class="nav-link">
                                            <i data-feather="user"></i>
                                            <span>Profile</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('logout') }}" class="nav-link">
                                            <i data-feather="log-out"></i>
                                            <span>Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="page-content">
            @yield('content')
            @include('layouts.aleart.msg')
            @include('sweetalert::alert')
        </div>
        <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
            <p class="text-muted text-center text-md-left">Copyright © 2021 <a href="https://www.iaos.de"
                                                                               target="_blank">IAS College</a>. All
                rights reserved</p>
            <p class="text-muted text-center text-md-left mb-0 d-none d-md-block">v{{ config('app.version') }}
            </p>
            {{-- <p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i> of Laravel</p> --}}
        </footer>
    </div>
</div>

<!-- activity Modal -->
<div class="modal fade" id="activityLog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Activity Lead</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="activityContainer">

            </div>
        </div>
    </div>
</div>

<!-- edit model -->
<div class="modal fade bd-example-modal-lg" id="editModel" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Lead</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('edit_lead') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Sur Name :</label>
                            <input type="text" name="sur_name" id="edit_form_sur_name" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">First Name :</label>
                            <input type="text" name="first_name" id="edit_form_first_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Whatsapp No :</label>
                            <input type="text" name="whatsapp_no" id="edit_form_whatsapp"
                                   placeholder="Without country code. - XXXXXXXXXX" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Contact No :</label>
                            <input type="text" name="contact_no" id="edit_form_contact"
                                   placeholder="With country code. - +1XXXXXXXXXX" class="form-control">
                        </div>
                    </div>
                    @isset($couses)
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Course :</label>
                                <select name="course_id" class="form-control" id="edit_form_course">
                                    <option value="">Select Course</option>
                                    @foreach ($couses as $course)
                                        <option value="{{ $course->course_id }}">{{ $course->course_code }} -
                                            {{ $course->course_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Intake :</label>
                                <input type="number" name="intake_year" id="edit_form_intake_year" class="form-control">
                            </div>
                        </div>
                    @endisset
                    @isset($countries)
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Country :</label>
                                <select name="country_id" class="form-control" id="edit_form_country">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->nicename }} -
                                            {{ $country->iso3 }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">city :</label>
                                <input type="text" name="city_id" id="edit_form_city_id" class="form-control">
                            </div>
                        </div>
                    @endisset
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Email :</label>
                            <input type="email" name="email" id="edit_form_email" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Source :</label>
                            <select name="source" class="form-control" id="edit_form_sourcr">
                                <option value="Facebook">Facebook</option>
                                <option value="Google My Business">Google My Business</option>
                                <option value="Youtube">Youtube</option>
                                <option value="Whatsapp">Whatsapp</option>
                                <option value="Official Website">Official Website</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="">Comment :</label>
                        <textarea name="comment" class="form-control" id="edit_form_comment" cols="30"
                                  rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="lead_id" id="lead_id_edit_form">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Lead</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- reminder Modal -->
<div class="modal fade" id="setReminder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('setReminder') }}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="">Set reminder :</label>
                    <input type="datetime-local" class="form-control" value="" name="reminderTime">

                    <label for="">Note :</label>
                    <input type="text" class="form-control" value="" name="note">

                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="lead_id" id="lead_id_set_reminder">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Reminder</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ url('assets/js/select2.js') }}"></script>
<script src="{{ url('assets/vendors/select2/select2.min.js') }}"></script>
<script src="{{ url('assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ url('assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ url('assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
<script src="{{ url('assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
<script src="{{ url('assets/vendors/dropzone/dropzone.min.js') }}"></script>
<script src="{{ url('assets/vendors/dropify/dist/dropify.min.js') }}"></script>
<script src="{{ url('assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ url('assets/vendors/moment/moment.min.js') }}"></script>
<script src="{{ url('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
<script src="{{ url('assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ url('assets/js/template.js') }}"></script>
<script src="{{ url('assets/js/form-validation.js') }}"></script>
<script src="{{ url('assets/js/bootstrap-maxlength.js') }}"></script>
<script src="{{ url('assets/js/inputmask.js') }}"></script>
<script src="{{ url('assets/js/typeahead.js') }}"></script>
<script src="{{ url('assets/js/tags-input.js') }}"></script>
<script src="{{ url('assets/js/dropzone.js') }}"></script>
<script src="{{ url('assets/js/dropify.js') }}"></script>
<script src="{{ url('assets/js/bootstrap-colorpicker.js') }}"></script>
<script src="{{ url('assets/js/datepicker.js') }}"></script>
<script src="{{ url('assets/js/timepicker.js') }}"></script>
<script src="{{ url('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ url('assets/vendors/promise-polyfill/polyfill.min.js') }}"></script>
<script src="{{ url('assets/js/sweet-alert.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ url('assets/js/wizard.js') }}"></script>
<script src="{{ url('assets/vendors/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
<script src="{{ url('assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>

<script src="{{url('js/leads.js')}}"></script>

<script>
    $(document).ready(function () {

        var table = $('#datatable-basic').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
            ],
            lengthMenu: [
                [10, 50, 100, 500, 1000, 5000, -1],
                ['10 rows', '50 rows', '100 rows', '500 rows', '1000 rows', '5000 rows', 'Show all']
            ],
            "order": [
                [0, "desc"]
            ],

        });
    });
</script>
</body>

</html>
