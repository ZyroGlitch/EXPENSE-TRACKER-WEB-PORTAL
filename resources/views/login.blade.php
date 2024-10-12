@extends('layout.component')

@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center form-background">
        <div class="col-lg-4 col-md-4">
            <div class="card p-1 glassmorphism">
                <div class="card-body text-light">
                    <form action="{{ route('firebase.checkLogin') }}" method="post">
                        @csrf
                        @method('post')

                        <div class="text-center mb-4">
                            <img src="assets/logo.png" alt="LOGO" class="object-contain" style="width:150px;height:150px;">
                            <h3>EXPENSE TRACKER</h3>
                        </div>

                        <label for="email" class="form-label fw-bold">Email</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <label for="password" class="form-label fw-bold">Password</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                            <input type="password" class="form-control" id="password" name="password" required>

                            <span class="input-group-text">
                                <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                            </span>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-dark rounded-pill fw-bold" style="height:40px;">
                                SIGN IN
                            </button>
                        </div>

                        <div class="text-center">
                            <p>Don't have an account? <a href="{{ route('view.register') }}" class="text-info"
                                    style="text-decoration: none">Sign
                                    Up</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if (session()->has('no_data'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'User not found.',
                });
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Incorrect email or password.',
                });
            });
        </script>
    @endif
@endsection
