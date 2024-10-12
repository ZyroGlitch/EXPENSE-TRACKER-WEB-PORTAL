@extends('../index')

@section('page-content')
    <section class="h-auto">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('view.user') }}" style="text-decoration: none">User Table</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>

        <div class="card px-3">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div class="col-lg-3 col-md-3 text-center">
                    <img src="{{ $fetchData['image'] }}" alt="profile image" class="object-contain rounded shadow-md"
                        style="width:200px;height:200px;">
                </div>


                <div class="col-lg-9 col-md-9 flex-col">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h2>{{ $fetchData['firstname'] . ' ' . $fetchData['lastname'] }}</h2>
                            <h4>{{ $fetchData['email'] }}</h4>
                        </div>

                        <a href="{{ route('view.editProfile', ['key' => $key]) }}"><i
                                class="bi bi-pencil-square fs-1 text-danger"></i></a>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-lg-6 col-md-6 me-3">
                            <!-- Income Card -->
                            <div class="card text-light shadow-sm" style="background: #003f91">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ URL('assets/dollar.png') }}" alt="Income Icon" class="object-contain me-3"
                                        style="width:50px;height:50px;">
                                    <div>
                                        <h5 class="mt-4">TOTAL INCOME</h5>

                                        <?php
                                        $income = 0;
                                        
                                        foreach ($fetchAmount as $data) {
                                            if ($data['type'] == 'Income') {
                                                $income += $data['amount'];
                                            } else {
                                                $income += 0;
                                            }
                                        }
                                        ?>
                                        <h4>${{ $income }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <!-- Expense Card -->
                            <div class="card text-light shadow-sm" style="background: #003f91">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ URL('assets/expenses.png') }}" alt="Expense Icon"
                                        class="object-contain me-3" style="width:50px;height:50px;">

                                    <div>
                                        <h5 class="mt-4">TOTAL EXPENSE</h5>

                                        <?php
                                        $expense = 0; // Initialize income variable
                                        foreach ($fetchAmount as $data) {
                                            if ($data['type'] == 'Expense') {
                                                $expense += $data['amount'];
                                            } else {
                                                $expense += 0;
                                            }
                                        }
                                        ?>
                                        <h4>${{ $expense }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="h-auto mt-3">
        <div class="card p-3">
            <h2>EXPENSE TRACKER CHART</h2>
            <div class="card-body row justify-content-evenly align-items-center">
                <canvas id="barChart" style="width:100%;height:400px;" class="object-contain mt-3"></canvas>
            </div>
        </div>
    </section>

    @if (session()->has('update-success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Profile Info Update Successfully.',
                });
            });
        </script>
    @endif

    @if (session()->has('update-error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to Update!',
                });
            });
        </script>
    @endif

    <!-- CHARTJS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const barChart = document.getElementById('barChart');

        <?php
        $totalAmount = 0;
        $salary = 0;
        $rent = 0;
        $food = 0;
        $electricity = 0;
        $health = 0;
        $cloth = 0;
        $education = 0;
        $transportation = 0;
        $travel = 0;
        $repair = 0;
        $telephone = 0;
        
        foreach ($fetchAmount as $data) {
            $totalAmount += $data['amount'];
        
            switch ($data['category']) {
                case 'Salary':
                    $salary += $data['amount'];
                    break;
                case 'Rent':
                    $rent += $data['amount'];
                    break;
                case 'Food':
                    $food += $data['amount'];
                    break;
                case 'Electricity':
                    $electricity += $data['amount'];
                    break;
                case 'Health':
                    $health += $data['amount'];
                    break;
                case 'Cloth':
                    $cloth += $data['amount'];
                    break;
                case 'Education':
                    $education += $data['amount'];
                    break;
                case 'Transportation':
                    $transportation += $data['amount'];
                    break;
                case 'Travel':
                    $travel += $data['amount'];
                    break;
                case 'Repair':
                    $repair += $data['amount'];
                    break;
                case 'Telephone':
                    $telephone += $data['amount'];
                    break;
                default:
                    $salary += 0;
                    $rent += 0;
                    $food += 0;
                    $electricity += 0;
                    $health += 0;
                    $cloth += 0;
                    $education += 0;
                    $transportation += 0;
                    $travel += 0;
                    $repair += 0;
                    $telephone += 0;
            }
        }
        
        // Calculate the percentage
        // but check if the amount is divide to zero
        // $salary != 0 ? ($salary = ($salary / $income) * 100) : ($salary = 0);
        // $rent != 0 ? ($rent = ($rent / $income) * 100) : ($rent = 0);
        // $food != 0 ? ($food = ($food / $income) * 100) : ($food = 0);
        // $electricity != 0 ? ($electricity = ($electricity / $income) * 100) : ($electricity = 0);
        // $health != 0 ? ($health = ($health / $income) * 100) : ($health = 0);
        // $cloth != 0 ? ($cloth = ($cloth / $income) * 100) : ($cloth = 0);
        // $education != 0 ? ($education = ($education / $income) * 100) : ($education = 0);
        // $transportation != 0 ? ($transportation = ($transportation / $income) * 100) : ($transportation = 0);
        // $travel != 0 ? ($travel = ($travel / $income) * 100) : ($travel = 0);
        // $repair != 0 ? ($repair = ($repair / $income) * 100) : ($repair = 0);
        // $telephone != 0 ? ($telephone = ($telephone / $income) * 100) : ($telephone = 0);
        
        ?>

        new Chart(barChart, {
            type: 'bar',
            data: {
                labels: ['Salary', 'Rent', 'Food', 'Electricity', 'Health', 'Cloth', 'Education', 'Transportation',
                    'Travel', 'Repair', 'Telephone'
                ],
                datasets: [{
                    data: [
                        {{ $salary }}, {{ $rent }}, {{ $food }},
                        {{ $electricity }}, {{ $health }}, {{ $cloth }},
                        {{ $education }}, {{ $transportation }}, {{ $travel }},
                        {{ $repair }}, {{ $telephone }}
                    ],
                    backgroundColor: [
                        '#00dd8e',
                        '#16f2e9',
                        '#ff00b7',
                        '#ffe900',
                        '#ff1600',
                        '#6e4b9a',
                        '#2a272a',
                        '#00df75',
                        '#ff9b00',
                        '#768d94',
                        '#00d2ff'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
