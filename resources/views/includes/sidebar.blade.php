@php
    $current_route=request()->route()->getName();

    $applicantActive = in_array($current_route, ['applicant.index']) ? 'active' : '';
    $documentsActive = in_array($current_route, ['document.index']) ? 'active' : '';
    $signatoryActive = in_array($current_route, ['signatory.index']) ? 'active' : '';
    $positionActive = in_array($current_route, ['position.index']) ? 'active' : '';
    $userActive = in_array($current_route, ['users.index']) ? 'active' : '';
    $reportActive = in_array($current_route, ['report.index', 'report.store']) ? 'active' : '';
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
    @if(in_array(Auth::guard('web')->user()->role, [1]))
        <li>
            <a class="nav-link {{ $documentsActive}}" href="{{ route('document.index') }}">
                <i class="ti ti-file"></i><span class="nav-text">Documents</span>
            </a>
        </li>
        
        <li>
            <a class="nav-link {{ $signatoryActive }}" href="{{ route('signatory.index') }}">
                <i class="ti ti-signature"></i><span class="nav-text">Signatories</span>
            </a>
        </li>

        <li>
            <a class="nav-link {{ $positionActive }}" href="{{ route('position.index') }}">
                <i class="ti ti-table"></i><span class="nav-text">Positions</span>
            </a>
        </li>
    @endif

    <li class="px-4 py-2">
        <small class="nav-text" style="color: #919191 !important">Report Management</small>
    </li>
    <li>
        <a class="nav-link {{ $reportActive }}" href="{{ route('report.index') }}">
            <i class="ti ti-file"></i><span class="nav-text">Reports</span>
        </a>
    </li>

    @if(in_array(Auth::guard('web')->user()->role, [1]))
        <li class="px-4 py-2">
            <small class="nav-text" style="color: #919191 !important">User Management</small>
        </li>
        <li>
            <a class="nav-link {{ $userActive }}" href="{{ route('users.index') }}">
                <i class="ti ti-user-plus"></i><span class="nav-text">Users</span>
            </a>
        </li>
        <li>
            <a class="nav-link {{ $settingsActive }}" href="{{ route('settings.index') }}">
                <i class="ti ti-settings"></i><span class="nav-text">Settings</span>
            </a>
        </li>
    @endif
</ul>