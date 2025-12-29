<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    /**
     * Display analytics dashboard
     */
    public function index(Request $request)
    {
        // Date range filter (default: last 30 days)
        $startDate = $request->input('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        // Convert to Carbon instances
        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        // Total Statistics
        $stats = [
            'total_contacts' => Contact::whereBetween('created_at', [$start, $end])->count(),
            'total_all_time' => Contact::count(),
            'today' => Contact::whereDate('created_at', today())->count(),
            'yesterday' => Contact::whereDate('created_at', today()->subDay())->count(),
            'this_week' => Contact::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Contact::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'last_month' => Contact::whereMonth('created_at', now()->subMonth()->month)->whereYear('created_at', now()->subMonth()->year)->count(),
            'average_per_day' => round(Contact::whereBetween('created_at', [$start, $end])->count() / max(1, $start->diffInDays($end)), 2),
        ];

        // Calculate growth percentage
        $stats['growth_from_last_month'] = $stats['last_month'] > 0 
            ? round((($stats['this_month'] - $stats['last_month']) / $stats['last_month']) * 100, 1)
            : 0;

        // Daily contacts chart (last 30 days)
        $dailyContacts = Contact::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->whereBetween('created_at', [$start, $end])
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        // Prepare chart data
        $chartLabels = $dailyContacts->pluck('date')->map(function($date) {
            return Carbon::parse($date)->format('M d');
        });
        $chartData = $dailyContacts->pluck('count');

        // Hourly distribution (when do people contact you?)
        $hourlyDistribution = Contact::select(
            DB::raw('HOUR(created_at) as hour'),
            DB::raw('COUNT(*) as count')
        )
        ->whereBetween('created_at', [$start, $end])
        ->groupBy('hour')
        ->orderBy('hour')
        ->get();

        // Service popularity (mentions in subject/message)
        $services = Service::all();
        $serviceStats = [];
        foreach($services as $service) {
            $count = Contact::whereBetween('created_at', [$start, $end])
                ->where(function($query) use ($service) {
                    $query->where('subject', 'like', '%' . $service->title . '%')
                          ->orWhere('message', 'like', '%' . $service->title . '%');
                })
                ->count();
            
            $serviceStats[] = [
                'service' => $service->title,
                'icon' => $service->icon,
                'count' => $count
            ];
        }

        // Sort by popularity
        usort($serviceStats, function($a, $b) {
            return $b['count'] - $a['count'];
        });

        // Peak days (which days get most contacts)
        $peakDays = Contact::select(
            DB::raw('DAYNAME(created_at) as day'),
            DB::raw('COUNT(*) as count')
        )
        ->whereBetween('created_at', [$start, $end])
        ->groupBy('day')
        ->orderBy('count', 'desc')
        ->get();

        // Recent contacts
        $recentContacts = Contact::whereBetween('created_at', [$start, $end])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('analytics.index', compact(
            'stats',
            'chartLabels',
            'chartData',
            'hourlyDistribution',
            'serviceStats',
            'peakDays',
            'recentContacts',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Export analytics as CSV
     */
    public function exportCsv(Request $request)
    {
        $startDate = $request->input('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $contacts = Contact::whereBetween('created_at', [
            Carbon::parse($startDate)->startOfDay(),
            Carbon::parse($endDate)->endOfDay()
        ])->orderBy('created_at', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="analytics-' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($contacts) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, ['ID', 'Name', 'Email', 'Subject', 'Message', 'Date', 'Time']);

            // Data
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->name,
                    $contact->email,
                    $contact->subject,
                    $contact->message,
                    $contact->created_at->format('Y-m-d'),
                    $contact->created_at->format('H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}