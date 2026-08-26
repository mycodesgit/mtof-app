@extends('layouts.app')

@section('title')
    MTOF - Dashboard
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="mb-6">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h4 fw-bold mb-1" style="letter-spacing: -0.02em;">Dashboard Overview</h1>
                        <p class="text-muted small mb-0">System metrics, application trends, and daily activity logs.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('report.index') }}" class="btn btn-sm btn-secondary px-3 shadow-sm rounded-2">
                            <i class="ti ti-file-excel me-1"></i> Export Data
                        </a>
                        <a href="{{ route('applicant.index') }}" class="btn btn-sm btn-dark px-3 shadow-sm rounded-2">
                            <i class="ti ti-plus me-1"></i> New Registration
                        </a>
                    </div>
                </div>

                <!-- Top KPI Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-xl-3 col-sm-6">
                        <div class="card card-animate p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small fw-medium">Total Registered</span>
                                <i class="ti ti-users text-muted fs-5"></i>
                            </div>
                            <div class="h2 fw-bold mb-1">{{ number_format($appcount ?? 0) }}</div>
                            <small class="text-muted"><span class="text-success fw-semibold"><i class="ti ti-arrow-up-right"></i> Active</span> total applications</small>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6">
                        <div class="card card-animate p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small fw-medium">Validated Franchises</span>
                                <i class="ti ti-file-check text-muted fs-5"></i>
                            </div>
                            <div class="h2 fw-bold mb-1">{{ number_format($validatedCount ?? 0) }}</div>
                            <small class="text-muted"><span class="text-success fw-semibold"><i class="ti ti-check"></i> Validated</span> & operational</small>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6">
                        <div class="card card-animate p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small fw-medium">Signatories</span>
                                <i class="ti ti-signature text-muted fs-5"></i>
                            </div>
                            <div class="h2 fw-bold mb-1">{{ number_format($signcount ?? 0) }}</div>
                            <small class="text-muted"><span class="fw-semibold">Active</span> authorized officers</small>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6">
                        <div class="card card-animate p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small fw-medium">System Users</span>
                                <i class="ti ti-users-group text-muted fs-5"></i>
                            </div>
                            <div class="h2 fw-bold mb-1">{{ number_format($userCount ?? 0) }}</div>
                            <small class="text-muted"><span class="fw-semibold">Staff</span> accounts active</small>
                        </div>
                    </div>
                </div>

                <!-- Chart + Dynamic Calendar Row -->
                <div class="row g-3 mb-4">
                    <!-- Chart Widget -->
                    <div class="col-lg-9">
                        <div class="card card-animate p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="fw-bold mb-0">Franchise Analytics</h6>
                                    <small class="text-muted">Monthly breakdown of registrations for {{ date('Y') }}</small>
                                </div>
                            </div>
                            <div style="height: 260px;">
                                <canvas id="franchiseChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Calendar Widget -->
                    <div class="col-lg-3">
                        <div class="card card-animate p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0"><i class="ti ti-calendar me-1"></i> Calendar</h6>
                                <small class="text-muted fw-semibold" id="calendarMonthYear"></small>
                            </div>
                            <div class="shadcn-calendar">
                                <div class="row g-1 text-center text-muted small fw-semibold mb-2">
                                    <div class="col">Su</div><div class="col">Mo</div><div class="col">Tu</div>
                                    <div class="col">We</div><div class="col">Th</div><div class="col">Fr</div><div class="col">Sa</div>
                                </div>
                                <div id="calendarDaysContainer"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Summary Cards -->
                <div class="marquee-wrapper mb-4">
    <div class="marquee-content">
        <!-- FIRST SET OF CARDS -->
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100">
                <small class="text-muted fw-medium d-block mb-1">Expired OR/CR</small>
                <h5 class="fw-bold mb-0">{{ $expiredOrCrCount ?? 0 }}</h5>
            </div>
        </div>
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100">
                <small class="text-muted fw-medium d-block mb-1">Private</small>
                <h5 class="fw-bold mb-0">{{ $privateCount ?? 0 }}</h5>
            </div>
        </div>
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100">
                <small class="text-muted fw-medium d-block mb-1">Both (Pvt/Exp)</small>
                <h5 class="fw-bold mb-0">{{ $bothCount ?? 0 }}</h5>
            </div>
        </div>
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100">
                <small class="text-muted fw-medium d-block mb-1">Released</small>
                <h5 class="fw-bold mb-0">{{ $releasedCount ?? 0 }}</h5>
            </div>
        </div>
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100">
                <small class="text-muted fw-medium d-block mb-1">Validated</small>
                <h5 class="fw-bold mb-0">{{ $validatedCount ?? 0 }}</h5>
            </div>
        </div>
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100">
                <small class="text-muted fw-medium d-block mb-1">Revoked</small>
                <h5 class="fw-bold mb-0">{{ $revokedCount ?? 0 }}</h5>
            </div>
        </div>
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100 bg-danger-subtle border-danger-subtle">
                <small class="text-danger fw-medium d-block mb-1">Expired Franchise</small>
                <h5 class="fw-bold mb-0 text-danger">{{ $expiredFranchiseCount ?? 0 }}</h5>
            </div>
        </div>

        <!-- DUPLICATE SET (Ensures seamless infinite loop) -->
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100">
                <small class="text-muted fw-medium d-block mb-1">Expired OR/CR</small>
                <h5 class="fw-bold mb-0">{{ $expiredOrCrCount ?? 0 }}</h5>
            </div>
        </div>
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100">
                <small class="text-muted fw-medium d-block mb-1">Private</small>
                <h5 class="fw-bold mb-0">{{ $privateCount ?? 0 }}</h5>
            </div>
        </div>
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100">
                <small class="text-muted fw-medium d-block mb-1">Both (Pvt/Exp)</small>
                <h5 class="fw-bold mb-0">{{ $bothCount ?? 0 }}</h5>
            </div>
        </div>
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100">
                <small class="text-muted fw-medium d-block mb-1">Released</small>
                <h5 class="fw-bold mb-0">{{ $releasedCount ?? 0 }}</h5>
            </div>
        </div>
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100">
                <small class="text-muted fw-medium d-block mb-1">Validated</small>
                <h5 class="fw-bold mb-0">{{ $validatedCount ?? 0 }}</h5>
            </div>
        </div>
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100">
                <small class="text-muted fw-medium d-block mb-1">Revoked</small>
                <h5 class="fw-bold mb-0">{{ $revokedCount ?? 0 }}</h5>
            </div>
        </div>
        <div class="marquee-card">
            <div class="card card-animate p-3 text-center h-100 bg-danger-subtle border-danger-subtle">
                <small class="text-danger fw-medium d-block mb-1">Expired Franchise</small>
                <h5 class="fw-bold mb-0 text-danger">{{ $expiredFranchiseCount ?? 0 }}</h5>
            </div>
        </div>
    </div>
</div>

                <!-- Recent Registrations Table -->
                <div class="card card-animate">
                    <div class="card-header bg-transparent border-bottom p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold mb-0">Recent Applicants</h6>
                            <small class="text-muted">Latest registered applicants in the system</small>
                        </div>
                        <a href="{{ route('applicant.index') ?? '#' }}" class="btn btn-sm btn-outline-dark rounded-2">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="border-bottom">
                                <tr class="text-muted small fw-semibold">
                                    <th class="ps-3">NAME</th>
                                    <th>BARANGAY</th>
                                    <th>PLATE / ENGINE</th>
                                    <th>MAKE & COLOR</th>
                                    <th>STATUS</th>
                                    <th>REGISTERED</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentApplicants as $applicant)
                                    <tr class="border-bottom">
                                        <td class="ps-3 fw-semibold">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm rounded-circle text-primary fw-bold d-flex align-items-center justify-content-center me-3" style="width: 38px; height: 38px;">
                                                    {{ strtoupper(substr($applicant->fname ?? 'A', 0, 1)) }}
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-semibold">{{ $applicant->fname }} {{ $applicant->mname }} {{ $applicant->lname }}</h6>
                                                    <small class="text-muted">ID: {{ $applicant->mtof_id ?? 'N/A' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted small">{{ $applicant->brgy ?? 'N/A' }}</td>
                                        <td>
                                            <span class="shadcn-badge me-1">{{ $applicant->plate_no ?? 'No Plate' }}</span>
                                            <small class="text-muted d-block mt-1">{{ $applicant->motor_no ?? 'N/A' }}</small>
                                        </td>
                                        <td class="small">{{ $applicant->mtof_make ?? 'N/A' }} <span class="text-muted">({{ $applicant->mtof_color ?? 'N/A' }})</span></td>
                                        <td>
                                            @switch($applicant->status)
                                                @case('Validated')
                                                    <span class="shadcn-badge bg-success-subtle text-success border-success-subtle">Validated</span>
                                                    @break
                                                @case('Released')
                                                    <span class="shadcn-badge bg-primary-subtle text-primary border-primary-subtle">Released</span>
                                                    @break
                                                @case('Expired OR/CR')
                                                    <span class="shadcn-badge bg-warning-subtle text-warning border-warning-subtle">Expired OR/CR</span>
                                                    @break
                                                @case('Revoked')
                                                    <span class="shadcn-badge bg-danger-subtle text-danger border-danger-subtle">Revoked</span>
                                                    @break
                                                @default
                                                    <span class="shadcn-badge bg-secondary-subtle text-secondary border-secondary-subtle">{{ $applicant->status ?? 'Pending' }}</span>
                                            @endswitch
                                        </td>
                                        <td class="text-muted small">{{ $applicant->created_at ? $applicant->created_at->format('M d, Y') : 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">No applicant records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Chart.js Execution using json_encode for safe array conversion
            const htmlElement = document.documentElement;

            // Helper to get bar color based on Bootstrap data-bs-theme attribute
            function getChartBarColor() {
                const isDarkMode = htmlElement.getAttribute('data-bs-theme') === 'dark';
                return isDarkMode ? '#aaabac' : '#18181b'; // White-gray (#e4e4e7) for dark mode, dark (#18181b) for light mode
            }

            const liveChartData = @json($chartData ?? array_fill(0, 12, 0));
            const ctx = document.getElementById('franchiseChart').getContext('2d');

            const franchiseChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Registrations',
                        data: liveChartData,
                        backgroundColor: getChartBarColor(),
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false } },
                        y: { 
                            grid: { color: '#f4f4f5' },
                            ticks: { precision: 0 }
                        }
                    }
                }
            });

            // Watch for data-bs-theme attribute changes when the theme button is clicked
            const themeObserver = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'data-bs-theme') {
                        franchiseChart.data.datasets[0].backgroundColor = getChartBarColor();
                        franchiseChart.update();
                    }
                });
            });

            themeObserver.observe(htmlElement, { 
                attributes: true, 
                attributeFilter: ['data-bs-theme'] 
            });

            // 2. Interactive Client-side Calendar Engine
            function renderLiveCalendar() {
                const container = document.getElementById('calendarDaysContainer');
                const title = document.getElementById('calendarMonthYear');
                const now = new Date();

                const year = now.getFullYear();
                const month = now.getMonth();
                const today = now.getDate();

                const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                title.textContent = `${monthNames[month]} ${year}`;

                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const prevMonthDays = new Date(year, month, 0).getDate();

                let html = '<div class="row g-1 text-center">';
                let cellCount = 0;

                // Previous month padding days
                for (let i = firstDay - 1; i >= 0; i--) {
                    html += `<div class="col"><div class="shadcn-calendar-day muted">${prevMonthDays - i}</div></div>`;
                    cellCount++;
                }

                // Current month days
                for (let day = 1; day <= daysInMonth; day++) {
                    if (cellCount % 7 === 0 && cellCount !== 0) {
                        html += '</div><div class="row g-1 text-center mt-1">';
                    }
                    const isActive = day === today ? 'active' : '';
                    html += `<div class="col"><div class="shadcn-calendar-day ${isActive}">${day}</div></div>`;
                    cellCount++;
                }

                // Next month padding days
                let nextDay = 1;
                while (cellCount % 7 !== 0) {
                    html += `<div class="col"><div class="shadcn-calendar-day muted">${nextDay}</div></div>`;
                    nextDay++;
                    cellCount++;
                }

                html += '</div>';
                container.innerHTML = html;
            }

            renderLiveCalendar();
        });
    </script>
@endsection