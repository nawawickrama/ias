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
                    <span class="link-title">Student Registration</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="patient">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('add-new-patient')}}" class="nav-link">Student Wizard</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('view-patients')}}" class="nav-link">Student Wizard</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
