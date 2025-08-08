<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServicePublicController extends Controller
{
    public function index(Request $request)
{
    // Fetch all services with pagination, ordered by the 'order' field
    $services = Service::orderBy('order')->paginate(9);

    // Return the view without the category
    return view('services.index', compact('services'));
}

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        return view('services.show', compact('service'));
    }
}
