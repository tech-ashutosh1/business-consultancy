<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all contacts
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        
        // Statistics
        $stats = [
            'total_contacts' => Contact::count(),
            'total_services' => Service::count(),
            'this_week' => Contact::where('created_at', '>=', now()->subWeek())->count(),
            'this_month' => Contact::where('created_at', '>=', now()->subMonth())->count(),
        ];

        // Chart Data: Contacts per month (last 6 months)
        $monthlyContacts = Contact::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', now()->subMonths(6))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Prepare data for Chart.js
        $chartLabels = $monthlyContacts->pluck('month')->map(function($month) {
            return date('M Y', strtotime($month . '-01'));
        });
        $chartData = $monthlyContacts->pluck('count');

        // Service inquiries (which services are mentioned most in subjects)
        $services = Service::all();
        $serviceData = [];
        foreach($services as $service) {
            $count = Contact::where('subject', 'like', '%' . $service->title . '%')
                ->orWhere('message', 'like', '%' . $service->title . '%')
                ->count();
            $serviceData[] = [
                'service' => $service->title,
                'count' => $count
            ];
        }

        return view('dashboard', compact('contacts', 'stats', 'chartLabels', 'chartData', 'serviceData'));
    }
}