<?php

namespace App\Http\Controllers;

use App\Models\Terms;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function show()
    {
        $terms = Terms::query()->first();
        return view('terms.show', compact('terms'));
    }

    public function edit()
    {
        $terms = Terms::query()->first();
        return view('terms.edit', compact('terms'));
    }

    public function update(Request $request)
    {
        $terms = Terms::query()->first();
        $terms->update(['content' => $request->input('content'),
    'title' => $request->input('title'),
    ]);

        return redirect()->route('terms.show')->with('success', 'Privacy Terms updated successfully.');
    }
}
