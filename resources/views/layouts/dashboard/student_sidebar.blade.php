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
            <li class="nav-item nav-category">General</li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('studentDashboard')}}" role="button" aria-expanded="false"
                   aria-controls="emails">
                    <i class="link-icon text-success" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Registration Process</li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('studentInformation')}}" role="button" aria-expanded="false"
                   aria-controls="emails">
                    <i class="link-icon text-primary" data-feather="user"></i>
                    <span class="link-title">Student Information</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('candidateDocument')}}" role="button" aria-expanded="false"
                   aria-controls="emails">
                    <i class="link-icon text-danger" data-feather="file-plus"></i>
                    <span class="link-title">Documents</span>
                </a>
            </li>
            @php
                $candidateFormDetails = \Illuminate\Support\Facades\Auth::user()->candidate->forms;
                $aafInfo = $candidateFormDetails->where('form_id', 1)->first();
                $lgoInfo = $candidateFormDetails->where('form_id', 2)->first();
            @endphp
            @if(count($candidateFormDetails) > 0)
                <li class="nav-item nav-category">Applications</li>
                @if(isset($aafInfo))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('aaf')}}" role="button" aria-expanded="false"
                           aria-controls="emails">
                            <i class="link-icon text-warning" data-feather="book-open"></i>
                            <span class="link-title">AAF Form</span>
                        </a>
                    </li>
                @endif
                @if($lgoInfo)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('lgo')}}" role="button" aria-expanded="false"
                           aria-controls="emails">
                            <i class="link-icon text-success" data-feather="book"></i>
                            <span class="link-title">LGO Form</span>
                        </a>
                    </li>
                @endif
            @endif
            <li class="nav-item nav-category">Payments</li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('payments-manager')}}" role="button" aria-expanded="false"
                   aria-controls="emails">
                    <i class="link-icon text-primary" data-feather="credit-card"></i>
                    <span class="link-title">Payments Manager</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
