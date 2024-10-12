@extends('layout.component')
@section('content')
    <section class="container-fluid vh-100 form-background">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-lg-8 col-md-8">
                <div class="card shadow-md glassmorphism">
                    <div class="card-body d-flex p-0">
                        <div class="text-light w-100 p-4">
                            <div class="d-flex align-items-center">
                                <img src="assets/logo.png" alt="LOGO" class="object-contain me-2"
                                    style="width:50px;height:50px;">
                                <h5>EXPENSE TRACKER</h5>
                            </div>
                            <div class="text-center">
                                <img src="assets/sign_up.png" alt="LOGO" class="object-contain"
                                    style="width:400px;height:400px;">
                            </div>
                        </div>
                        <div class=" text-light w-100 p-4 d-flex justify-content-center align-items-center">
                            <form action="{{ route('firebase.store') }}" method="post" class="w-100">
                                @csrf
                                @method('post')

                                <div class="mb-4 text-center">
                                    <h2>Get Started</h2>
                                    <p>Already have an account? <a href="{{ route('view.login') }}" class="text-info"
                                            style="text-decoration: none">Sign In</a></p>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                                    <input type="text" class="form-control" placeholder="Firstname" name="firstname"
                                        required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                                    <input type="text" class="form-control" placeholder="Lastname" name="lastname"
                                        required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                                </div>
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                                    <input type="password" id="password" class="form-control" placeholder="Password"
                                        name="password" required>
                                    <span class="input-group-text">
                                        <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                                    </span>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-dark rounded-pill fw-bold">
                                        SIGN UP
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (session()->has('duplicate'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'This email already exists.',
                });
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Registration failed.',
                });
            });
        </script>
    @endif

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('bi-eye');
        });
    </script>
@endsection
