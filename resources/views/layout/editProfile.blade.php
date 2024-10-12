@extends('../index')

@section('page-content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('view.user') }}">User Table</a></li>
            <li class="breadcrumb-item"><a href="{{ route('view.customerInfo', ['key' => $key]) }}">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Profile</li>
        </ol>
    </nav>

    <section class="h-auto d-flex">
        <div class="col-lg-8 col-md-8">
            <h1>UPDATE PROFILE</h1>
            <div class="card">
                <div class="card-body d-flex align-items-start">

                    <img src="{{ asset($userData['image']) }}" alt="image" class="object-cover shadow-md rounded me-4"
                        style="width:200px;height:200px;">

                    <div class="w-100">
                        <h2>Information</h2>
                        <form action="{{ URL('edit/' . $key) }}" method="post">
                            @csrf
                            @method('put')

                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                                <input type="text" class="form-control" placeholder="Firstname"
                                    value="{{ $userData['firstname'] }}" name="firstname">
                            </div>

                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                                <input type="text" class="form-control" placeholder="Lastname"
                                    value="{{ $userData['lastname'] }}" name="lastname">
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col-lg-5 col-md-5">
                                    <div class="d-grid">
                                        <button type="reset" class="btn btn-secondary fw-bold"><i class="bi bi-x-lg"></i>
                                            RESET</button>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary fw-bold"><i
                                                class="bi bi-pencil-fill"></i>
                                            UPDATE</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
