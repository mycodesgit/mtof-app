<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>MTOF || Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uilibs/images/candoni-logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uilibs/images/candoni-logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uilibs/images/candoni-logo.png') }}">

    <link rel="stylesheet" href="{{ asset('uilibs/css/main.css') }}">
    
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('uilibs/plugins/toastr/toastr.min.css') }}">

    <style>
        /* Base Canvas Container for Background Particles */
        .bg-particles-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }

        /* Floating Animated Background Icons */
        .bg-particle {
            position: absolute;
            bottom: -50px;
            color: rgba(165, 57, 68, 0.11); /* Light red tint matching button */
            font-size: 1.8rem;
            animation: floatUp 15s infinite linear;
            pointer-events: none;
        }

        /* Varying positions, sizes, and delays for natural effect */
        .bg-particle:nth-child(1) { left: 10%; font-size: 2.2rem; animation-duration: 18s; animation-delay: 0s; }
        .bg-particle:nth-child(2) { left: 25%; font-size: 1.4rem; animation-duration: 12s; animation-delay: 2s; }
        .bg-particle:nth-child(3) { left: 45%; font-size: 2.5rem; animation-duration: 22s; animation-delay: 4s; }
        .bg-particle:nth-child(4) { left: 65%; font-size: 1.8rem; animation-duration: 16s; animation-delay: 1s; }
        .bg-particle:nth-child(5) { left: 85%; font-size: 2.0rem; animation-duration: 14s; animation-delay: 5s; }
        .bg-particle:nth-child(6) { left: 92%; font-size: 1.5rem; animation-duration: 19s; animation-delay: 3s; }

        @keyframes floatUp {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }
            15% {
                opacity: 0.6;
            }
            85% {
                opacity: 0.6;
            }
            100% {
                transform: translateY(-110vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Elevate Login Card over background particles */
        .login-card-wrapper {
            position: relative;
            z-index: 1;
        }

        /* Dark Mode Custom Overrides */
        [data-bs-theme="dark"] .bg-body-tertiary {
            background-color: #0f172a !important;
        }
        [data-bs-theme="dark"] .card {
            background-color: #1e293b !important;
            border-color: #334155 !important;
            color: #f8fafc !important;
        }
        [data-bs-theme="dark"] .form-control {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: #f8fafc !important;
        }
        [data-bs-theme="dark"] .form-control::placeholder {
            color: #64748b !important;
        }
        [data-bs-theme="dark"] .text-muted,
        [data-bs-theme="dark"] .text-secondary {
            color: #94a3b8 !important;
        }
        [data-bs-theme="dark"] .bg-primary-subtle {
            background-color: rgba(224, 82, 54, 0.15) !important;
        }
        [data-bs-theme="dark"] .bg-particle {
            color: rgba(248, 250, 252, 0.07); /* Subtle white glow in dark mode */
        }
    </style>
</head>

<body>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-body-tertiary p-3 position-relative overflow-hidden">
        
        {{-- Floating Background Icons / Particles --}}
        <div class="bg-particles-container">
            <i class="ti ti-shield bg-particle"></i>
            <i class="ti ti-lock bg-particle"></i>
            <i class="ti ti-key bg-particle"></i>
            <i class="ti ti-user-check bg-particle"></i>
            <i class="ti ti-settings bg-particle"></i>
            <i class="ti ti-checkup-list bg-particle"></i>
        </div>

        {{-- Theme Switcher Button (Top Right) --}}
        <div class="position-absolute top-0 end-0 p-3" style="z-index: 10;">
            <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle p-2" id="themeToggleBtn" title="Toggle Light/Dark Mode" style="width: 38px; height: 38px;">
                <i class="ti ti-moon fs-5" id="themeIcon"></i>
            </button>
        </div>

        <div class="container login-card-wrapper" style="max-width: 420px;">
            <div class="card border-1 shadow-lg rounded-4">
                <div class="card-body p-4 p-sm-5">
                    
                    {{-- System Logo --}}
                    <div class="text-center mb-4">
                        <div class="mb-3 d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle" style="width: 64px; height: 64px;">
                            <i class="ti ti-lock fs-2"></i>
                        </div>
                        <h4 class="fw-bold mb-1">Welcome Back</h4>
                        <p class="text-muted small">Sign in to your MTOF account</p>
                    </div>

                    <form action="{{ route('login.store') }}" method="post">
                        @csrf
                        {{-- Email Field --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-secondary">Email Address</label>
                            <div class="position-relative">
                                <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                                    <i class="ti ti-user fs-5"></i>
                                </span>
                                <input type="text" name="username" class="form-control ps-5 py-2-5" placeholder="username" style="padding-left: 2.75rem !important;">
                            </div>
                        </div>

                        {{-- Password Field --}}
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label fw-semibold small text-secondary mb-0">Password</label>
                                <a href="#" class="text-decoration-none small text-muted">Forgot password?</a>
                            </div>
                            <div class="position-relative">
                                <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                                    <i class="ti ti-key fs-5"></i>
                                </span>
                                <input type="password" name="password" class="form-control ps-5 pe-5 py-2-5" id="passwordInput" placeholder="••••••••" style="padding-left: 2.75rem !important;">
                                <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted p-1" id="togglePassword">
                                    <i class="ti ti-eye fs-5" id="passwordIcon"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Remember Me Checkbox --}}
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label small text-secondary" for="rememberMe">
                                Remember me on this device
                            </label>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="btn btn-primary w-100 py-2.5 fw-semibold rounded-3 mb-3 shadow-sm">
                            <i class="ti ti-login me-1"></i> Sign In
                        </button>
                    </form>

                    <div class="text-center">
                        <span class="text-muted small">Don't have an account?</span>
                        <a href="#" class="text-decoration-none small fw-semibold">Contact Administrator</a>
                    </div>

                </div>
            </div>

            {{-- Footer Note --}}
            <div class="text-center mt-4">
                <small class="text-muted">&copy; MTOF System. All rights reserved.</small>
            </div>
        </div>
    </div>

    {{-- JS Libraries --}}
    <script type="text/javascript" src="{{ asset('uilibs/js/main.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('uilibs/plugins/toastr/toastr.min.js') }}"></script>

    {{-- Page Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toastr Alerts
            @if(session('error'))
                toastr.error("{{ session('error') }}", "Error", {
                    closeButton: false,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 10000
                });
            @endif

            @if(session('success'))
                toastr.success("{{ session('success') }}", "Success", {
                    closeButton: false,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 10000
                });
            @endif

            // Dark/Light Theme Switcher Logic
            const themeToggleBtn = document.getElementById('themeToggleBtn');
            const themeIcon = document.getElementById('themeIcon');
            const htmlElement = document.documentElement;

            const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            setTheme(savedTheme);

            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', function () {
                    const currentTheme = htmlElement.getAttribute('data-bs-theme') || 'light';
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    setTheme(newTheme);
                });
            }

            function setTheme(theme) {
                htmlElement.setAttribute('data-bs-theme', theme);
                document.body.setAttribute('data-bs-theme', theme);
                localStorage.setItem('theme', theme);

                if (theme === 'dark') {
                    themeIcon.className = 'ti ti-sun fs-5 text-warning';
                } else {
                    themeIcon.className = 'ti ti-moon fs-5';
                }
            }

            // Password Show/Hide Toggle Logic
            const togglePasswordBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('passwordInput');
            const passwordIcon = document.getElementById('passwordIcon');

            if (togglePasswordBtn && passwordInput && passwordIcon) {
                togglePasswordBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    
                    if (isPassword) {
                        passwordIcon.classList.remove('ti-eye');
                        passwordIcon.classList.add('ti-eye-off');
                    } else {
                        passwordIcon.classList.remove('ti-eye-off');
                        passwordIcon.classList.add('ti-eye');
                    }
                });
            }
        });
    </script>
</body>
</html>