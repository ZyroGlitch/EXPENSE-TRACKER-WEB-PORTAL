@extends('layout.component')

@section('content')
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="shadow-sm" style="background:white">
            <div class="sidebar-header d-flex justify-content-center p-3">
                <img src="{{ URL('assets/logo.png') }}" alt="LOGO" class="object-contain text-center"
                    style="width:150px;height:150px;">
            </div>



            <!-- Home Dropdown Menu -->
            <li class="d-flex justify-content-start align-items-center p-3 mb-1" style="height:50px;">
                <a href="{{ route('view.dashboard') }}" id="dashboardBtn"><i class="bi bi-house-fill me-2"></i>
                    <span>DASHBOARD</span></a>
            </li>
            <li class="d-flex justify-content-start align-items-center  p-3" style="height:50px;">
                <a href="{{ route('view.user') }}" id="userBtn"><i class="bi bi-person-fill me-2"></i>
                    <span>USERS</span></a>
            </li>
            <li class="d-flex justify-content-start align-items-center  p-3" style="height:50px;">
                <a href="{{ route('view.logout') }}" id="signoutBtn"><i class="bi bi-arrow-left-square-fill me-2"></i>
                    <span>SIGN OUT</span></a>
            </li>
        </nav>

        <!-- Main content -->
        <div id="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-b-2 shadow-sm">
                <div class="container-fluid">
                    <!-- Sidebar Toggle Button -->
                    <a type="button" id="sidebarCollapse">
                        <i class="bi bi-list fs-1 text-dark fw-bold" id="toggleIcon"></i>
                    </a>

                    <div class="d-flex align-items-center">
                        @if (session('user_id'))
                            <h4 class="fw-bold mb-0 me-3">{{ session('firstname') }}</h4>
                        @endif

                        <img src="assets/default.jpg" alt="img"
                            class="object-fit rounded-circle border border-3 border-info shadow-md"
                            style="width:50px;height:50px;">
                    </div>
                </div>
            </nav>
            <!-- Content Section -->
            <div class="container-fluid h-auto p-4">
                @yield('page-content')
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Attach click event listeners to AJAX links
            const ajaxLinks = document.querySelectorAll('.ajax-link');
            ajaxLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default link behavior

                    const url = this.getAttribute('href');
                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            // Update the content area with the new page content
                            document.getElementById('content').innerHTML = html;
                        })
                        .catch(error => console.error('Error loading content:', error));
                });
            });
        });
    </script>
@endsection
