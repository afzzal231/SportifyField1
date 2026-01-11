<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SportifyField - Booking Lapangan Olahraga')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="nav-wrapper">
                <div class="logo">
                    <a href="{{ route('home') }}" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="{{ asset('images/Navbar.png') }}" alt="SportifyField Logo" class="logo-img">
                        <span class="logo-text">SportifyField</span>
                    </a>
                </div>
                <nav class="nav-menu">
                    <a href="{{ route('home') }}"
                        class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                    <a href="{{ route('fields.index') }}"
                        class="nav-link {{ request()->routeIs('fields.*') ? 'active' : '' }}">Lapangan</a>
                    @auth
                        @if (Auth::user()->email === 'superadmin@gmail.com')
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                                Admin
                            </a>
                        @endif
                    @endauth


                </nav>
                <div class="nav-actions">
                    @auth
                        <div class="user-menu active" style="position: relative; display: flex; align-items: center;">
                            <div class="user-profile" onclick="toggleDropdown()"
                                style="cursor: pointer; display: flex; align-items: center; gap: 10px;">
                                <div class="user-avatar text-white"
                                    style="width: 35px; height: 35px; background-color: #DC2626; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; overflow: hidden;">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    @endif
                                </div>
                                <span class="user-name"
                                    style="font-weight: 500; color: #333;">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down" style="font-size: 12px; color: #666;"></i>
                            </div>
                            <div id="userDropdown" class="user-dropdown-menu">
                                <a href="{{ route('dashboard') }}" class="dropdown-item">
                                    <i class="fas fa-user" style="width: 20px;"></i>
                                    <span>Profil Saya</span>
                                </a>
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                        <i class="fas fa-tachometer-alt" style="width: 20px;"></i>
                                        <span>Admin Dashboard</span>
                                    </a>
                                @endif
                                @if(Auth::user()->role === 'owner')
                                    <a href="{{ route('owner.dashboard') }}" class="dropdown-item">
                                        <i class="fa-solid fa-house" style="width: 20px;"></i>
                                        <span>Lapangan Saya</span>
                                    </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-btn"
                                        style="width: 100%; border:none; background:none; text-align:left; cursor: pointer; color: #DC2626;">
                                        <i class="fas fa-right-from-bracket" style="width: 20px;"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-link"
                            style="color: #374151; text-decoration: none; font-weight: 500;">Login</a>
                        <a href="{{ route('register') }}"
                            style="background: #DC2626; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600;">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @if (session('success'))
            <!-- Success Popup Modal -->
            <div id="successPopup" class="popup-overlay" onclick="closePopup('successPopup')">
                <div class="popup-content popup-success" onclick="event.stopPropagation()">
                    <button class="popup-close" onclick="closePopup('successPopup')">&times;</button>
                    <div class="popup-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <p class="popup-message">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <!-- Error Popup Modal -->
            <div id="errorPopup" class="popup-overlay" onclick="closePopup('errorPopup')">
                <div class="popup-content popup-error" onclick="event.stopPropagation()">
                    <button class="popup-close" onclick="closePopup('errorPopup')">&times;</button>
                    <div class="popup-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <p class="popup-message">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <div class="footer-logo">SportifyField</div>
                    <p class="footer-description">Platform terpercaya Anda untuk memesan fasilitas olahraga. Memudahkan
                        booking venue dengan mudah.</p>
                </div>
                <div class="footer-column">
                    <h4>Kontak Kami</h4>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>info@sportifyfield.com</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+62 812-3456-7890</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Bandung, Indonesia</span>
                    </div>
                </div>
                <div class="footer-column">
                    <h4>Ikuti Kami</h4>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <p>© {{ date('Y') }} SportifyField. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function (e) {
            const dropdown = document.getElementById('userDropdown');
            const userMenu = e.target.closest('.user-menu');
            if (!userMenu && dropdown && dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        });

        // Popup functions
        function closePopup(id) {
            const popup = document.getElementById(id);
            if (popup) {
                popup.style.opacity = '0';
                setTimeout(() => {
                    popup.style.display = 'none';
                }, 300);
            }
        }

        // Auto-dismiss popups after 4 seconds
        document.addEventListener('DOMContentLoaded', function () {
            const successPopup = document.getElementById('successPopup');
            const errorPopup = document.getElementById('errorPopup');

            if (successPopup) {
                setTimeout(() => closePopup('successPopup'), 4000);
            }
            if (errorPopup) {
                setTimeout(() => closePopup('errorPopup'), 4000);
            }
        });
    </script>
    @stack('scripts')
</body>

</html>