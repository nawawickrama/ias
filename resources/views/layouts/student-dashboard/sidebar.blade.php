<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Speedo<span> Tech</span>
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
                <a class="nav-link" data-toggle="collapse" href="#patient" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Patients</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="patient">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('add-new-patient')}}" class="nav-link">Add new patient</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('view-patients')}}" class="nav-link">View patients</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#appointment" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Appointments</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="appointment">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('book-appointment')}}" class="nav-link">Add new appointment</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('view-appointments')}}" class="nav-link">View Appointments</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('calender') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Calender</span>
                </a>
            </li>
            <li class="nav-item nav-category">Practice Details</li>
            <li class="nav-item">
                <a href="{{ route('practice-profile') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Practice Profile</span>
                </a>
            </li>
            <li class="nav-item nav-category">Process Claim</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#claim" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Claims</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="claim">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('add-new-claim')}}" class="nav-link">Add new claim</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('view-claims')}}" class="nav-link">View Claims</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Script</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#script" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Scripts</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="script">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('add-new-script')}}" class="nav-link">Add new Script</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('view-scripts')}}" class="nav-link">View Scripts</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Reports</li>
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