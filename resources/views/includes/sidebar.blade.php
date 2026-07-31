@php
    $current_route=request()->route()->getName();

    $applicantActive = in_array($current_route, ['applicant.index']) ? 'active' : '';
    $signatoryActive = in_array($current_route, ['signatory.index']) ? 'active' : '';
    $settingsActive = in_array($current_route, ['settings.index']) ? 'active' : '';
@endphp

<ul class="nav flex-column">
    <li class="px-4 py-2">
        <small class="nav-text" style="color: #919191 !important">Main</small>
    </li>
    <li>
        <a class="nav-link {{ $current_route=='dashboard.index'?'active':''}}" href="{{ route('dashboard.index') }}">
            <i class="ti ti-layout-grid"></i><span class="nav-text">Dashboard</span>
        </a>
    </li>
    
    <li>
        <a class="nav-link {{ $applicantActive}}" href="{{ route('applicant.index') }}">
            <i class="ti ti-users"></i><span class="nav-text">Applicants</span>
        </a>
    </li>
    
    <li>
        <a class="nav-link {{ $signatoryActive }}" href="{{ route('signatory.index') }}">
            <i class="ti ti-signature"></i><span class="nav-text">Signatories</span>
        </a>
    </li>

    <li class="px-4 py-2">
        <small class="nav-text" style="color: #919191 !important">Report Management</small>
    </li>
    <li>
        <a class="nav-link" href="#">
            <i class="ti ti-file"></i><span class="nav-text">Reports</span>
        </a>
    </li>

    <li class="px-4 py-2">
        <small class="nav-text" style="color: #919191 !important">User Management</small>
    </li>
    <li>
        <a class="nav-link" href="#">
            <i class="ti ti-user-plus"></i><span class="nav-text">Users</span>
        </a>
    </li>
    <li>
        <a class="nav-link {{ $settingsActive }}" href="{{ route('settings.index') }}">
            <i class="ti ti-settings"></i><span class="nav-text">Settings</span>
        </a>
    </li>
    
    
</ul>