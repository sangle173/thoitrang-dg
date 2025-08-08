<?php

namespace App\Http\Controllers;

use App\Models\AboutSetting;
use App\Models\TeamMember;

class AboutPublicController extends Controller
{
    public function show()
    {
        $about = AboutSetting::first();
        $teamMembers = TeamMember::orderBy('order')->get();
        return view('about.show', compact('about','teamMembers'));
    }
}

