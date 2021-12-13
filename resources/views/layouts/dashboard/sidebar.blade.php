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
                <a href="../../dashboard-one.html" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Student Management</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Student Requests</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('pending-requests')}}" class="nav-link">Pending Requests</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('approved-requests')}}" class="nav-link">Approved Requests</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('waiting-requests')}}" class="nav-link">Waiting Requests</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('rejected-requests')}}" class="nav-link">Rejected Requests</a>
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
                            <a href="{{route('pending-requests')}}" class="nav-link">General Settings</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('approved-requests')}}" class="nav-link">SMTP Settings</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('waiting-requests')}}" class="nav-link">Waiting Requests</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('rejected-requests')}}" class="nav-link">Rejected Requests</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>