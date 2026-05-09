<?php

namespace App\Http\Controllers;

use App\Models\Spark;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Stats
        $totalSparks = $user->sparks()->count();
        $avgMood = $user->sparks()->avg('mood_score') ?? 0;
        $totalIgnites = $user->sparks()->withCount('reactions')->get()->sum('reactions_count');
        
        // Streak calculation
        $streakDays = $this->calculateStreak($user);
        
        // Chart Data: Mood over time (last 7 days)
        $moodTrend = $user->sparks()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('AVG(mood_score) as avg_mood'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->take(7)
            ->get();

        // Chart Data: Sparks by Category
        $categoryDistribution = $user->sparks()
            ->select('category_id', DB::raw('count(*) as count'))
            ->groupBy('category_id')
            ->with('category')
            ->get();

        // All sparks for management table
        $allSparks = $user->sparks()->with('category')->latest()->get();

        return view('dashboard', compact(
            'totalSparks', 
            'avgMood', 
            'totalIgnites',
            'streakDays',
            'moodTrend', 
            'categoryDistribution',
            'allSparks'
        ));
    }

    private function calculateStreak($user)
    {
        $dates = $user->sparks()
            ->select(DB::raw('DATE(created_at) as date'))
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->pluck('date')
            ->toArray();

        if (empty($dates)) return 0;

        $streak = 0;
        $today = now()->toDateString();
        $yesterday = now()->subDay()->toDateString();
        
        // Check if user posted today or yesterday
        if ($dates[0] !== $today && $dates[0] !== $yesterday) return 0;
        
        for ($i = 0; $i < count($dates); $i++) {
            $expected = now()->subDays($i)->toDateString();
            if (isset($dates[$i]) && $dates[$i] === $expected) {
                $streak++;
            } else {
                break;
            }
        }

        return $streak;
    }
}
