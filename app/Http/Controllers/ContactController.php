<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
   public function index()
   {
       return view('backend.pages.contact');
   }

   // terms page
   public function terms()
   {
       return view('backend.pages.terms');
   }
   // privacy page
   public function privacy()
   {
       return view('backend.pages.privacy');
   }
}
