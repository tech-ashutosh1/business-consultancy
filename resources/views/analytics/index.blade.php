<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                📊 Contact Analytics Dashboard
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('analytics.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" 
                   class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export CSV
                </a>
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                    ← Back to Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Breadcrumbs --}}
            <x-breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Analytics', 'url' => route('analytics.index')]
            ]" />

            {{-- Date Filter --}}
            <div class="bg-white rounded-xl shadow-lg p-6">
                <form method="GET" action="{{ route('analytics.index') }}" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Start Date</label>
                        <input type="date" 
                               name="start_date" 
                               value="{{ $startDate }}"
                               class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">End Date</label>
                        <input type="date" 
                               name="end_date" 
                               value="{{ $endDate }}"
                               class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none">
                    </div>
                    <button type="submit" 
                            class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-2 px-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                        Apply Filter
                    </button>
                </form>
            </div>

            {{-- Key Metrics --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Total Contacts in Period --}}
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm opacity-80 uppercase tracking-wide">Period Total</p>
                        <div class="text-3xl">📧</div>
                    </div>
                    <p class="text-4xl font-bold">{{ $stats['total_contacts'] }}</p>
                    <p class="text-xs opacity-80 mt-2">Selected date range</p>
                </div>

                {{-- Today --}}
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm opacity-80 uppercase tracking-wide">Today</p>
                        <div class="text-3xl">📅</div>
                    </div>
                    <p class="text-4xl font-bold">{{ $stats['today'] }}</p>
                    <p class="text-xs opacity-80 mt-2">
                        Yesterday: {{ $stats['yesterday'] }}
                        @if($stats['yesterday'] > 0)
                            ({{ $stats['today'] > $stats['yesterday'] ? '+' : '' }}{{ $stats['today'] - $stats['yesterday'] }})
                        @endif
                    </p>
                </div>

                {{-- This Month --}}
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm opacity-80 uppercase tracking-wide">This Month</p>
                        <div class="text-3xl">📈</div>
                    </div>
                    <p class="text-4xl font-bold">{{ $stats['this_month'] }}</p>
                    <p class="text-xs opacity-80 mt-2">
                        @if($stats['growth_from_last_month'] > 0)
                            ↗ +{{ $stats['growth_from_last_month'] }}% from last month
                        @elseif($stats['growth_from_last_month'] < 0)
                            ↘ {{ $stats['growth_from_last_month'] }}% from last month
                        @else
                            → Same as last month
                        @endif
                    </p>
                </div>

                {{-- Average Per Day --}}
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm opacity-80 uppercase tracking-wide">Avg Per Day</p>
                        <div class="text-3xl">⚡</div>
                    </div>
                    <p class="text-4xl font-bold">{{ $stats['average_per_day'] }}</p>
                    <p class="text-xs opacity-80 mt-2">In selected period</p>
                </div>
            </div>

            {{-- Charts Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Daily Contacts Trend --}}
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">📊 Daily Contact Trend</h3>
                    <canvas id="dailyTrendChart"></canvas>
                </div>

                {{-- Service Popularity --}}
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">🏆 Service Popularity</h3>
                    <div class="space-y-3">
                        @forelse($serviceStats as $index => $stat)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex items-center space-x-3">
                                    <span class="text-2xl">{{ $stat['icon'] ?: '📋' }}</span>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $stat['service'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $stat['count'] }} inquiries</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 h-2 rounded-full" 
                                             style="width: {{ $stats['total_contacts'] > 0 ? ($stat['count'] / $stats['total_contacts'] * 100) : 0 }}%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-indigo-600">{{ $stat['count'] }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-8">No service data available</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Peak Days & Recent Contacts --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Peak Days --}}
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">📅 Peak Days</h3>
                    <div class="space-y-2">
                        @foreach($peakDays as $peak)
                            <div class="flex items-center justify-between p-3 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg">
                                <span class="font-semibold text-gray-700">{{ $peak->day }}</span>
                                <span class="bg-indigo-600 text-white px-4 py-1 rounded-full text-sm font-bold">
                                    {{ $peak->count }} contacts
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Recent Contacts --}}
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">🕐 Recent Contacts</h3>
                    <div class="space-y-3">
                        @forelse($recentContacts as $contact)
                            <div class="border-l-4 border-indigo-600 pl-4 py-2 hover:bg-gray-50 transition">
                                <p class="font-semibold text-gray-800">{{ $contact->name }}</p>
                                <p class="text-sm text-gray-600">{{ $contact->subject }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $contact->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-8">No recent contacts</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- All Time Stats --}}
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl shadow-lg p-8 text-white text-center">
                <h3 class="text-2xl font-bold mb-4">🎯 All-Time Statistics</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-5xl font-bold">{{ $stats['total_all_time'] }}</p>
                        <p class="text-sm opacity-80 mt-2">Total Contacts Ever</p>
                    </div>
                    <div>
                        <p class="text-5xl font-bold">{{ $stats['this_week'] }}</p>
                        <p class="text-sm opacity-80 mt-2">This Week</p>
                    </div>
                    <div>
                        <p class="text-5xl font-bold">{{ \App\Models\Service::count() }}</p>
                        <p class="text-sm opacity-80 mt-2">Active Services</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Chart.js Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Daily Trend Chart
        const dailyCtx = document.getElementById('dailyTrendChart').getContext('2d');
        new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Daily Contacts',
                    data: {!! json_encode($chartData) !!},
                    borderColor: 'rgb(99, 102, 241)',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointBackgroundColor: 'rgb(99, 102, 241)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: {
                            size: 14
                        },
                        bodyFont: {
                            size: 13
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>