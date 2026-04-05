<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Event;
use App\Models\EventReport;
use App\Models\Project;
use App\Models\Faculty;
use App\Models\User;
use App\Models\Moot;
use App\Models\MootParticipation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_articles' => Article::count(),
            'published_articles' => Article::published()->count(),
            'total_events' => Event::count(),
            'upcoming_events' => Event::upcoming()->count(),
            'total_projects' => Project::count(),
            'active_projects' => Project::active()->count(),
            'total_faculty' => Faculty::active()->count(),
            'total_users' => User::count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'faculty_users' => User::where('role', 'faculty')->count(),
            'staff_users' => User::where('role', 'staff')->count(),
            'total_moots' => Moot::count(),
            'total_participations' => MootParticipation::count(),
            'open_registrations' => MootParticipation::where('status', 'registration_open')->count(),
        ];

        $recent_articles = Article::latest()->take(5)->get();
        $upcoming_events = Event::upcoming()->orderBy('start_datetime')->take(5)->get();
        $recent_projects = Project::latest()->take(5)->get();
        
        $recent_participations = MootParticipation::with('moot')
            ->orderBy('year', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_articles', 'upcoming_events', 'recent_projects', 'recent_participations'));
    }
}
