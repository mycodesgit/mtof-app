<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uilibs/images/candoni-logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uilibs/images/candoni-logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uilibs/images/candoni-logo.png') }}">

    <link rel="stylesheet" href="{{ asset('uilibs/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('uilibs/css/custom.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/fontawesome-free-V6/css/all.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- DataTables  -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/fullcalendar/fullcalendar.css') }}">
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = savedTheme || (systemPrefersDark ? 'dark' : 'light');
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>
</head>

<body>
    <div id="overlay" class="overlay"></div>
    <!-- TOPBAR -->
    <nav id="topbar" class="navbar bg-white border-bottom fixed-top topbar px-3">
        <button id="toggleBtn" class="d-none d-lg-inline-flex btn btn-light btn-icon btn-sm ">
            <i class="fas fa-bars"></i>
        </button>

        <!-- MOBILE -->
        <button id="mobileBtn" class="btn btn-light btn-icon btn-sm d-lg-none me-2">
            <i class="ti ti-layout-sidebar-left-expand"></i>
        </button>
        <div>
            <!-- Navbar nav -->
            <ul class="list-unstyled d-flex align-items-center mb-0 gap-1">
                <li>
                    <button id="themeToggleBtn" class="btn btn-light btn-icon rounded-circle me-2" title="Toggle theme">
                        <i id="themeIcon" class="ti ti-sun"></i>
                    </button>
                </li>
                <!-- Dropdown -->
                <li class="ms-3 dropdown">
                    <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('uilibs/images/user.png') }}" alt="" class="avatar avatar-sm rounded-circle" /> {{ Auth::guard('web')->user()->fname }} {{ Auth::guard('web')->user()->lname }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 200px;">
                        <div>
                            <div class="d-flex gap-3 align-items-center border-dashed border-bottom px-3 py-3">
                                <img src="{{ asset('uilibs/images/user.png') }}" alt="" class="avatar avatar-md rounded-circle" />
                                <div>
                                    <h5 class="mb-0 small">{{ Auth::guard('web')->user()->email }}</h5>
                                    @php
                                        $roles = [
                                            1 => 'Super Admin',
                                            2 => 'Administrator',
                                            3 => 'Staff',
                                        ];

                                        $userRole = Auth::guard('web')->user()->role;
                                    @endphp
                                    <p class="mb-0 small text-warning">{{ $roles[$userRole] ?? 'Unknown Role' }}</p>
                                </div>
                            </div>
                            <div class="p-3 d-flex flex-column gap-1 medium lh-lg">
                                <a href="{{ route('accountseting.index') }}" class="text-secondary">
                                    <i class="ti ti-settings"></i> <span>Account Settings</span>
                                </a>
                                <a href="#!" class="text-success">
                                    <i class="ti ti-message"></i><span> Chat Message</span>
                                </a>
                                <a href="{{ route('logout') }}" class="text-danger">
                                    <i class="ti ti-logout"></i><span> Signout</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </li>
            </ul>
        </div>

    </nav>

    <!-- SIDEBAR -->
    <aside id="sidebar" class="sidebar">
        <div class="logo-area">
            <div class="d-inline-flex">
                @if(isset($settings) && $settings->logosys)
                    <img src="{{ asset('storage/' . $settings->logosys) }}" alt="System Logo" width="24">
                @else
                    <img src="{{ asset('uilibs/images/systemsetting.webp') }}" alt="logo" width="24">
                @endif
                <span class="logo-text ms-2" style="font-weight: bold">
                    {{ $appSetting->application_headername ?? 'System' }}
                </span>
            </div>
        </div>
        @include('includes.sidebar')

    </aside>

    <!-- MAINmainCONTENT -->
    <main id="content" class="content py-10">
        <div class="container-fluid">
            @yield('body')

            <div class="row">
                <div class="col-12">
                    <footer class="text-center py-2 mt-6 text-secondary fixed-bottom bg-white" style="z-index: 99">
                        <p class="mb-0">&copy; MTOF System V2. All rights reserved.</p>
                    </footer>
                </div>
            </div>

        </div>
    </main>

    <!-- Bootstrap JS -->

    <script type="text/javascript" src="{{ asset('uilibs/js/main.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('uilibs/plugins/jquery/jquery.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('uilibs/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('uilibs/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/fullcalendar/fullcalendar.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('uilibs/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('uilibs/plugins/toastr/toastr.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('uilibs/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('uilibs/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Validation JS -->
    <script src="{{ asset('uilibs/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script>
        $(function () {
            $('.select2').each(function () {
                $(this).select2({
                    dropdownParent: $(this).closest('.modal')
                });
            });

            $('.select2bs4').each(function () {
                $(this).select2({
                    theme: 'bootstrap4',
                    dropdownParent: $(this).closest('.modal')
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            const cards = document.querySelectorAll('.card-animate');

            cards.forEach((card, index) => {
                // Pass index to CSS delay dynamically
                card.style.transitionDelay = `${index * 80}ms`;
                
                // Use requestAnimationFrame for smooth execution
                requestAnimationFrame(() => {
                    card.classList.add('show');
                });
            });
        });
        $('#collegeID').on('change', function () {
            var data = $('#collegeID').select2('data');
            var color = data[0].element.getAttribute('data-color');
            
            $('#eventcolor').val(color);
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const themeBtn = document.getElementById('themeToggleBtn');
            const themeIcon = document.getElementById('themeIcon');
            const htmlElement = document.documentElement;

            function updateIcon(theme) {
                if (themeIcon) {
                    // Updated so Sun shows when Dark mode is active (click to switch to light)
                    themeIcon.className = theme === 'dark' ? 'ti ti-sun text-warning' : 'ti ti-moon';
                }
            }

            // Sync icon with current attribute on load
            const currentTheme = htmlElement.getAttribute('data-bs-theme') || 'light';
            updateIcon(currentTheme);

            // Toggle logic on click
            if (themeBtn) {
                themeBtn.addEventListener('click', function () {
                    const activeTheme = htmlElement.getAttribute('data-bs-theme');
                    const newTheme = activeTheme === 'dark' ? 'light' : 'dark';

                    htmlElement.setAttribute('data-bs-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    updateIcon(newTheme);
                });
            }
        });
    </script>
    
    @if (request()->routeIs('applicant.index'))
        @include('scripts.applicantjs')
    @endif
    @if (request()->routeIs('document.index'))
        @include('scripts.documentjs')
    @endif
    @if (request()->routeIs('signatory.index'))
        @include('scripts.signatoryjs')
    @endif
    @if (request()->routeIs('position.index'))
        @include('scripts.positionjs')
    @endif
    @if (request()->routeIs('report.store'))
        @include('scripts.reportsjs')
    @endif
    @if (request()->routeIs('users.index'))
        @include('scripts.usersjs')
    @endif
    @if (request()->routeIs('settings.index'))
        @include('scripts.logofaviconjs')
        @include('scripts.appnamejs')
    @endif
</body>

</html>