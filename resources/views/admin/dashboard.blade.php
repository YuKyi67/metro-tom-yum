<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">📊 Daily Sales Report</h2>
                @if($sales->isEmpty())
                    <p class="text-gray-500 dark:text-gray-300">No completed sales yet.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Sales (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $day)
                                <tr>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($day->date)->format('d M Y') }}</td>
                                    <td class="px-6 py-4">RM {{ number_format($day->total_sales, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
        </div>
            @if(!$sales->isEmpty())
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h2 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">📈 Sales Chart Overview</h2>
                <canvas id="salesChart" height="120"></canvas>
            </div>
            @endif

            @if($topItems->isNotEmpty())
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h2 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">🥧 Top 5 Most Sold Menu Items (Pie Chart)</h2>
                <div style="width: 300px; height: 300px;">
                    <canvas id="topItemsChart" width="300" height="300"></canvas>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Bar Chart Script -->
    <script>
        const ctx = document.getElementById('salesChart')?.getContext('2d');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($sales->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M Y'))) !!},
                    datasets: [{
                        label: 'Total Sales (RM)',
                        data: {!! json_encode($sales->pluck('total_sales')) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'Total Sales (RM)' }
                        },
                        x: {
                            title: { display: true, text: 'Date' }
                        }
                    }
                }
            });
        }
    </script>

    <!-- Pie Chart Script -->
    <script>
        const pieCtx = document.getElementById('topItemsChart')?.getContext('2d');
        if (pieCtx) {
            new Chart(pieCtx, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($topItems->keys()) !!},
                    datasets: [{
                        label: 'Quantity Sold',
                        data: {!! json_encode($topItems->values()) !!},
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
        // Automatically close after 3 seconds
        setTimeout(() => {
            document.getElementById('popupAlert').style.display = 'none';
        }, 3000);

    </script>
    @if (session('show_popup'))
    <div id="popupAlert"
        class="fixed top-4 left-4 max-w-sm bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-3 py-2 shadow-md"
        role="alert">
    <div class="flex items-center">
            <div class="py-1">
                <img src="{{ asset('images/Icon/cynical.gif') }}" alt="Gif" class="w-12 h-12">
                <p class="font-bold">Welcome back, Admin!</p>
            </div>
    </div>
</div>
        @php session()->forget('show_popup') @endphp
        @endif        
</x-app-layout>
