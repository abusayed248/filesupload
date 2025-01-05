<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function show()
    {
        $policy = Policy::where('title', 'Privacy Policy')->first();
 
        return view('policy.show', compact('policy'));
    }

    public function edit()
    {
        $policy = Policy::where('title', 'Privacy Policy')->firstOrFail();
        return view('policy.edit', compact('policy'));
    }

    public function update(Request $request)
    {
        $policy = Policy::where('title', 'Privacy Policy')->firstOrFail();
        $policy->update(['content' => $request->input('content')]);

        return redirect()->route('policy.show')->with('success', 'Privacy Policy updated successfully.');
    }
}
