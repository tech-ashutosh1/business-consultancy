<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teamMembers = TeamMember::latest()->get();
        return view('admin.team.index', compact('teamMembers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|string|max:255', // Assuming URL or path
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
        ]);

        TeamMember::create($validated);

        return redirect()->route('team-members.index')
            ->with('success', 'Team member added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamMember $teamMember)
    {
        return view('admin.team.edit', compact('teamMember'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
        ]);

        $teamMember->update($validated);

        return redirect()->route('team-members.index')
            ->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return redirect()->route('team-members.index')
            ->with('success', 'Team member removed successfully.');
    }
}
