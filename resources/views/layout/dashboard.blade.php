@extends('../index')

@section('page-content')
    <section class="container-fluid h-auto">
        <h1>Dashboard</h1>
        <div class="row justify-content-evenly align-items-center mt-3">
            <!-- Income Card -->
            <div class="col-lg-4 col-md-4">
                <div class="card text-light shadow-sm" style="background: #003f91">
                    <div class="card-body">
                        <img src="{{ URL('assets/dollar.png') }}" alt="Income Icon" class="object-contain"
                            style="width:50px;height:50px;">
                        <h5 class="mt-4">TOTAL INCOME</h5>

                        <?php
                        $income = 0; // Initialize income variable
                        foreach ($fetchExpense as $data) {
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
            <!-- Expense Card -->
            <div class="col-lg-4 col-md-4">
                <div class="card text-light shadow-sm" style="background: #003f91">
                    <div class="card-body">
                        <img src="{{ URL('assets/expenses.png') }}" alt="Expense Icon" class="object-contain"
                            style="width:50px;height:50px;">
                        <h5 class="mt-4">TOTAL EXPENSE</h5>

                        <?php
                        $expense = 0;
                        foreach ($fetchExpense as $data) {
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
            <!-- Active Users Card -->
            <div class="col-lg-4 col-md-4">
                <div class="card text-light shadow-sm" style="background: #003f91">
                    <div class="card-body">
                        <img src="{{ URL('assets/person.png') }}" alt="Users Icon" class="object-contain"
                            style="width:50px;height:50px;">
                        <h5 class="mt-4">ACTIVE USERS</h5>

                        <?php
                        $user = 0;
                        ?>

                        @forelse ($users as $data)
                            <?php $user++; ?>
                        @empty
                            <h4>{{ $user }}</h4>
                        @endforelse

                        <h4>{{ $user }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="my-5 d-flex justify-content-evenly align-items-start">
            <div class="col-lg-7 col-md-7">
                <canvas id="barChart" style="width:100%;height:400px;" class="object-contain"></canvas>
            </div>
            <div class="col-lg-4 col-md-4">
                <canvas id="doughnut" style="width:100%;height:400px;" class="object-contain"></canvas>
            </div>

        </div>


        <!-- CHARTJS CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const barChart = document.getElementById('barChart');
            const doughnut = document.getElementById('doughnut');

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
            
            foreach ($fetchExpense as $data) {
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
            // $salary = ($salary / $totalAmount) * 100;
            // $rent = ($rent / $totalAmount) * 100;
            // $food = ($food / $totalAmount) * 100;
            // $electricity = ($electricity / $totalAmount) * 100;
            // $health = ($health / $totalAmount) * 100;
            // $cloth = ($cloth / $totalAmount) * 100;
            // $education = ($education / $totalAmount) * 100;
            // $transportation = ($transportation / $totalAmount) * 100;
            // $travel = ($travel / $totalAmount) * 100;
            // $repair = ($repair / $totalAmount) * 100;
            // $telephone = ($telephone / $totalAmount) * 100;
            
            ?>

            new Chart(barChart, {
                type: 'bar',
                data: {
                    labels: ['Salary', 'Rent', 'Food', 'Electricity', 'Health', 'Cloth', 'Education', 'Transportation',
                        'Travel', 'Repair', 'Telephone'
                    ],
                    datasets: [{
                        label: 'EXPENSE TRACKING',
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

            new Chart(doughnut, {
                type: 'doughnut',
                data: {
                    labels: [
                        'Salary', 'Rent', 'Food', 'Electricity',
                        'Health', 'Cloth', 'Education', 'Transportation',
                        'Travel', 'Repair', 'Telephone'
                    ],

                    datasets: [{
                        label: '# of Votes',
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

                }
            });
        </script>

    </section>
@endsection
