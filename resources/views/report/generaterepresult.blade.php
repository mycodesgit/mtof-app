@extends('layouts.app')

@section('title')
    MTOF - Reports Center
@endsection

@section('body')
    <div class="row g-4">
        <!-- Page Header & Global Controls -->
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h1 class="h4 fw-bold mb-1">Franchise & Application Reports</h1>
                <p class="text-muted small mb-0">Filter, extract, and print official MTOF permit and compliance records.</p>
            </div>
            <div class="d-flex gap-2">
                <button type="button" onclick="window.print()" class="btn btn-sm btn-white border shadow-sm px-3">
                    <i class="ti ti-printer me-1"></i> Print Page
                </button>
                <a href="{{ route('report.index', array_merge(request()->query(), ['export' => 'excel'])) }}" class="btn btn-sm btn-success shadow-sm px-3">
                    <i class="ti ti-file-spreadsheet me-1"></i> Export Excel
                </a>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-12">
                <div class="card card-animate">
                    <div class="card-header pt-3">
                        <h6 class="card-title">
                            <i class="ti ti-search"></i> Search to Generate
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('report.store') }}" id="reportgen">
                            <div class="form-group">
                                <div class="row g-3">
                                    <!-- Franchise Status Filter -->
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">Franchise Status:</label>
                                        <select name="status" class="form-select form-select-sm bg-light">
                                            <option value="">All Statuses</option>
                                            <option value="Validated" {{ request('status') == 'Validated' ? 'selected' : '' }}>Validated</option>
                                            <option value="Released" {{ request('status') == 'Released' ? 'selected' : '' }}>Released</option>
                                            <option value="Expired OR/CR" {{ request('status') == 'Expired OR/CR' ? 'selected' : '' }}>Expired OR/CR</option>
                                            <option value="Private" {{ request('status') == 'Private' ? 'selected' : '' }}>Private</option>
                                            <option value="Revoked" {{ request('status') == 'Revoked' ? 'selected' : '' }}>Revoked</option>
                                        </select>
                                    </div>

                                    <!-- Month Dropdown (01 - 12) -->
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">Month:</label>
                                        <select class="form-select form-select-sm bg-light" name="month">
                                            <option value="">All Months</option>
                                            @foreach(range(1, 12) as $m)
                                                @php 
                                                    $monthVal = sprintf('%02d', $m); 
                                                    $monthName = date('F', mktime(0, 0, 0, $m, 1));
                                                @endphp
                                                <option value="{{ $monthVal }}" {{ request('month') == $monthVal ? 'selected' : '' }}>
                                                    {{ $monthVal }} - {{ $monthName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Year Dropdown -->
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold">Year:</label>
                                        <select class="form-select form-select-sm bg-light" name="year">
                                            <option value="">All Years</option>
                                            @php
                                                $currentYear = date('Y');
                                                $startYear = $currentYear - 10;
                                            @endphp
                                            @for($y = $currentYear; $y >= $startYear; $y--)
                                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                                    {{ $y }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-md-3 d-flex align-items-end">
                                        <button type="submit" class="btn btn-success btn-sm w-100">
                                            <i class="ti ti-search me-1"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="page-header mt-5" style="border-bottom: 1px solid #04401f;"></div>

                        <div class="table-responsive">
                            <table id="gnrtdreports" class="table table-hover" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>MTOF ID</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Brgy.</th>
                                        <th>Tin</th>
                                        <th>Make</th>
                                        <th>Color</th>
                                        <th>Cc</th>
                                        <th>Motor No.</th>
                                        <th>Chassis No.</th>
                                        <th>Plate No.</th>
                                        <th>Drivers Name</th>
                                        <th>Drivers License</th>
                                        <th>Date Acquired</th>
                                        <th>Valid</th>
                                        <th>Body No.</th>
                                        <th>Route</th>
                                        <th>Color Code</th>
                                        <th>Date Issued</th>
                                        <th>Date Expired</th>
                                        <th>Or Date</th>
                                        <th>Processor Name</th>
                                        <th>Status</th>
                                        <th>Status1</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($reports ?? [] as $item)
                                        <tr>
                                            <td>{{ $item->mtof_id ?? $item->id }}</td>
                                            <td>{{ $item->fname ?? 'N/A' }}</td>
                                            <td>{{ $item->mname ?? 'N/A' }}</td>
                                            <td>{{ $item->lname ?? 'N/A' }}</td>
                                            <td>{{ $item->brgy ?? 'N/A' }}</td>
                                            <td>{{ $item->tin_no ?? 'N/A' }}</td>
                                            <td>{{ $item->mtof_make ?? 'N/A' }}</td>
                                            <td>{{ $item->mtof_color ?? 'N/A' }}</td>
                                            <td>{{ $item->cc ?? 'N/A' }}</td>
                                            <td>{{ $item->motor_no ?? 'N/A' }}</td>
                                            <td>{{ $item->chassis_no ?? 'N/A' }}</td>
                                            <td>{{ $item->plate_no ?? 'N/A' }}</td>
                                            <td>{{ $item->driver_name ?? 'N/A' }}</td>
                                            <td>{{ $item->driver_license ?? 'N/A' }}</td>
                                            <td>{{ $item->date_acquired ? \Carbon\Carbon::parse($item->date_acquired)->format('M d, Y') : 'N/A' }}</td>
                                            <td>{{ $item->valid_until ?? 'N/A' }}</td>
                                            <td>{{ $item->body_no ?? 'N/A' }}</td>
                                            <td>{{ $item->route ?? 'N/A' }}</td>
                                            <td>{{ $item->color_code ?? 'N/A' }}</td>
                                            <td>{{ $item->date_issued ? \Carbon\Carbon::parse($item->date_issued)->format('M d, Y') : 'N/A' }}</td>
                                            <td>{{ $item->date_expired ? \Carbon\Carbon::parse($item->date_expired)->format('M d, Y') : 'N/A' }}</td>
                                            <td>{{ $item->or_date ? \Carbon\Carbon::parse($item->or_date)->format('M d, Y') : 'N/A' }}</td>
                                            <td>{{ $item->processor_name ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge bg-secondary-subtle text-secondary px-2 py-1">
                                                    {{ $item->status ?? 'Pending' }}
                                                </span>
                                            </td>
                                            <td>{{ $item->status1 ?? 'N/A' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="25" class="text-center py-4 text-muted">
                                                No generated reports found for the selected filter parameters.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection