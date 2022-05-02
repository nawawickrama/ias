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
            <li class="nav-item nav-category">Registration</li>
            <li class="nav-item">
                <a class="nav-link"  href="{{route('studentWizard')}}" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="file-plus"></i>
                    <span class="link-title">Profile Complete</span>
                </a>

            </li>
        </ul>
    </div>
</nav>
