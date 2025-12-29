<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of services (for admin)
     */
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'icon' => 'nullable|max:50',
            'price' => 'nullable|max:100',
            'show_price' => 'nullable|boolean'
        ]);

        // Handle checkbox (if not checked, it won't be in request)
        $validated['show_price'] = $request->has('show_price');

        Service::create($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service created successfully!');
    }

    /**
     * Show the form for editing a service
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'icon' => 'nullable|max:50',
            'price' => 'nullable|max:100',
            'show_price' => 'nullable|boolean'
        ]);

        // Handle checkbox
        $validated['show_price'] = $request->has('show_price');

        $service->update($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified service
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully!');
    }
}