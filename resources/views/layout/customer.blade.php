@extends('../index')

@section('page-content')
    <h1>Users</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php $i = 1; ?>
                    @forelse ($fetchData as $key => $data)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                @if (isset($data['image']))
                                    <img src="{{ asset($data['image']) }}" alt="image{{ $i }}"
                                        class="object-contain rounded shadow-sm me-1" style="width: 60px;height:60px;">
                                @else
                                    <img src="{{ asset('assets/default.png') }}" alt="default-image{{ $i }}"
                                        class="object-contain" style="width: 60px;height:60px;">
                                @endif
                            </td>
                            <td>
                                {{ $data['firstname'] . ' ' . $data['lastname'] }}</td>
                            <td>{{ $data['email'] }}</td>
                            <td>
                                <div class="d-grid">
                                    <a href="{{ URL('customerInfo' . $key) }}"
                                        class="btn btn-sm btn-primary fw-bold text-light">
                                        <i class="bi bi-eye-fill"></i> VIEW
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @empty
                        <tr>
                            <td colspan="4">No User Records Exist!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
