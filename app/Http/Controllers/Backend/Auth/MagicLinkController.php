<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MagicLinkController extends Controller
{
    public function login() {
        return view('auth.magic-link');
    }
    public function store(Request $request) {
        dd($request->all());
    }
}
