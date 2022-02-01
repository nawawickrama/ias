@php
$user = Auth::user();
@endphp

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            IAS<span> College</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            @can('email-send.create')
                <li class="nav-item">
                    <a href="{{ route('send-mail') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Send Email</span>
                    </a>
                </li>
            @endcan

            @if ($user->can('pending-request.view') || $user->can('selected-request.view') || $user->can('selected-under-condition-request.view') || $user->can('rejected-request.view'))
                <li class="nav-item nav-category">Student Management</li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#emails" role="button" aria-expanded="false"
                        aria-controls="emails" id="req-ex">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Student Requests</span> &nbsp;
                        <div class="spinner-grow spinner-grow-sm text-white invisible pending-header-req" role="status">
                            <span
                                class="badge badge-light badge-pill bg-warning text-black text-header-indicater"></span>
                        </div>
                        <i class="link-arrow" data-feather="chevron-down" id="toggle-indicater"></i>
                    </a>
                    <div class="collapse" id="emails">
                        <ul class="nav sub-menu">

                            @can('pending-request.view')
                                <li class="nav-item">
                                    <a href="{{ route('pending-requests') }}" class="nav-link">Pending Requests
                                        &nbsp;
                                        <div class="spinner-grow spinner-grow-sm text-white invisible pending-sub-req"
                                            role="status">
                                            <span
                                                class="badge badge-light badge-pill bg-danger text-white text-sub-indicater"></span>
                                        </div>
                                    </a>
                                </li>
                            @endcan

                            @can('selected-request.view')
                                <li class="nav-item">
                                    <a href="{{ route('approved-requests') }}" class="nav-link">Selected
                                        Requests</a>
                                </li>
                            @endcan

                            @can('selected-under-condition-request.view')
                                <li class="nav-item">
                                    <a href="{{ route('waiting-requests') }}" class="nav-link">Selected Under
                                        Condition</a>
                                </li>
                            @endcan

                            @can('rejected-request.view')
                                <li class="nav-item">
                                    <a href="{{ route('rejected-requests') }}" class="nav-link">Rejected
                                        Requests</a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
            @endif

            @if ($user->can('user.create') || $user->can('user.view') || $user->can('role.create') || $user->can('role.view') || $user->can('model-role.view') || $user->can('model-role.create') || $user->can('agent.view') || $user->can('agent.create'))
                <li class="nav-item nav-category">User Management</li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#userser" role="button" aria-expanded="false"
                        aria-controls="emails">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">User Settings</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="userser">
                        <ul class="nav sub-menu">
                            @can('user.create', 'user.view')
                                <li class="nav-item">
                                    <a href="{{ route('role_get') }}" class="nav-link">Role Management</a>
                                </li>
                            @endcan

                            @if ($user->can('role.create') || $user->can('role.view'))
                                <li class="nav-item">
                                    <a href="{{ route('permission_role_get') }}" class="nav-link">Permission
                                        Management</a>
                                </li>
                            @endif

                            @if ($user->can('model-role.view') || $user->can('model-role.create'))

                                <li class="nav-item">
                                    <a href="{{ route('user-settings') }}" class="nav-link">User Management</a>
                                </li>
                            @endif


                            @if ($user->can('agent.view') || $user->can('agent.create'))
                                <li class="nav-item">
                                    <a href="{{ route('agents') }}" class="nav-link">Agents Details</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if ($user->can('smtp-setting.create') || $user->can('smtp-setting.view'))
                <li class="nav-item nav-category">Web Settings</li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#settings" role="button"
                        aria-expanded="false" aria-controls="emails">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Settings</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="settings">
                        <ul class="nav sub-menu">
                            @if ($user->can('smtp-setting.create') || $user->can('smtp-setting.view'))
                                <li class="nav-item">
                                    <a href="{{ route('smtp') }}" class="nav-link">SMTP Settings</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>

<script>
    $('document').ready(function() {
        auto();

        setInterval(() => {
            indicator();
        }, 2000);

    });

    function indicator() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('check_pending_cpf') }}",
            type: 'POST',
            dataType: "json",
            success: function(data) {
                if (data > 0) {

                    $('#req-ex').click(function() {
                        let area = $(this).attr('aria-expanded');

                        if (area == 'false') {
                            // alert(1);
                            $('.text-sub-indicater').text(data);
                            $('.pending-sub-req').removeClass('invisible');

                            $('.text-header-indicater').text('');
                            $('.pending-header-req').class('invisible');
                        } else {
                            $('.text-header-indicater').text(data);
                            $('.pending-header-req').removeClass('invisible');

                            $('.text-sub-indicater').text('');
                            $('.pending-sub-req').class('invisible');
                        }
                    });
                }
            }
        });
    };

    function auto() {

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('check_pending_cpf') }}",
            type: 'POST',
            dataType: "json",
            success: function(data) {
                if (data > 0) {
                    let ss = $('#req-ex').attr('aria-expanded');

                    if (ss == 'false') {
                        // alert(1);
                        $('.text-header-indicater').text(data);
                        $('.pending-header-req').removeClass('invisible');

                        $('.text-sub-indicater').text('');
                        $('.pending-sub-req').class('invisible');
                    } else {
                        $('.text-sub-indicater').text(data);
                        $('.pending-sub-req').removeClass('invisible');

                        $('.text-header-indicater').text('');
                        $('.pending-header-req').class('invisible');
                    }
                }
            }
        });

    };
</script>
