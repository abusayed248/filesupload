<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{

    public function edit()
    {
        $policy = Policy::where('title', 'Privacy Policy')->firstOrFail();
        return view('admin.pages.policy.edit', compact('policy'));
    }

    public function update(Request $request)
    {
        $policy = Policy::where('title', 'Privacy Policy')->firstOrFail();
        $policy->update(['content' => $request->input('content')]);

        return redirect()->back()->with('success', 'Privacy Policy updated successfully.');
    }
}
