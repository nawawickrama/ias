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
            <li class="nav-item">
                <a href="{{route('send-mail')}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Send Email</span>
                </a>
            </li>
            <li class="nav-item nav-category">Student Management</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails" id="req-ex">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Student Requests</span> &nbsp;
                    <div class="spinner-grow spinner-grow-sm text-white invisible pending-header-req" role="status">
                        <span class="badge badge-light badge-pill bg-warning text-black text-header-indicater"></span>
                    </div>
                    <i class="link-arrow" data-feather="chevron-down" id="toggle-indicater"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('pending-requests')}}" class="nav-link">Pending Requests &nbsp;
                                <div class="spinner-grow spinner-grow-sm text-white invisible pending-sub-req" role="status">
                                    <span class="badge badge-light badge-pill bg-danger text-white text-sub-indicater"></span>
                                </div>
                            </a>
                            
                        </li>
                        <li class="nav-item">
                            <a href="{{route('approved-requests')}}" class="nav-link">Selected Requests</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('waiting-requests')}}" class="nav-link">Selected Under Condition</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('rejected-requests')}}" class="nav-link">Rejected Requests</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">User Management</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#userser" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">User Settings</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="userser">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('user-settings')}}" class="nav-link">Staff</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('agents')}}" class="nav-link">Agents</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Web Settings</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#settings" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Settings</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="settings">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('smtp')}}" class="nav-link">SMTP Settings</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script>
    $('document').ready(function(){
        indicator();

        setInterval(() => {
            indicator();
        }, 5000);

    });

    function indicator(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ route('check_pending_application') }}",
            type:'POST',
            dataType:"json",
            success:function(data){
                if(data > 0){

                    $('#req-ex').click(function(){
                        let area = $(this).attr('aria-expanded');

                        if(area == 'false'){
                            // alert(1);
                            $('.text-sub-indicater').text(data);
                            $('.pending-sub-req').removeClass('invisible');

                            $('.text-header-indicater').text('');
                            $('.pending-header-req').class('invisible');
                        }else{
                            $('.text-header-indicater').text(data);
                            $('.pending-header-req').removeClass('invisible');

                            $('.text-sub-indicater').text('');
                            $('.pending-sub-req').class('invisible');
                        }
                    });
                    
                    $('.text-header-indicater').text(data);
                    $('.pending-header-req').removeClass('invisible');
                }
            }
        });
    }
</script>