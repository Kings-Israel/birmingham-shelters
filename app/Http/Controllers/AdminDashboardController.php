<?php

namespace App\Http\Controllers;

class AdminDashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin-dashboard', ['greeting' => "Good {$this->time_of_day()}"]);
    }

    protected function time_of_day(): string
    {
        $hour = now()->hour;

        if ($hour >= 0 && $hour < 12) {
            return 'Morning';
        } elseif ($hour >= 12 && $hour < 16) {
            return 'Afternoon';
        } else {
            return 'Evening';
        }
    }
}
