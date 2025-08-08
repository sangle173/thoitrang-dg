<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $query = Portfolio::whereHas('category', function ($q) {
            $q->where('status', true); // Only active categories
        });

        $category = null;

        // Filter by active category
        if ($request->has('category')) {
            $category = PortfolioCategory::where('slug', $request->category)
                ->where('status', true)
                ->first();

            if ($category) {
                $query->where('portfolio_category_id', $category->id);
            }
        }

        $portfolios = $query->latest()->paginate(9);
        $currentCategory = $request->category;

        return view('portfolio.index', compact('portfolios', 'currentCategory', 'category'));
    }

    public function show($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('portfolio.show', compact('portfolio'));
    }
}
