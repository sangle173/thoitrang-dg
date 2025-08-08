<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Portfolio;
use App\Models\ContactMessage;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        
        $blogCountToday = Blog::whereDate('created_at', Carbon::today())->count();
        $newPortfolioCount = Portfolio::whereDate('created_at', Carbon::today())->count();
        $newContactMessageCount = ContactMessage::whereDate('created_at', Carbon::today())->count();
        $totalPortfolioCount = Portfolio::count();
        return view('dashboard', compact('blogCountToday', 'newPortfolioCount', 'newContactMessageCount', 'totalPortfolioCount'));
    }
}
