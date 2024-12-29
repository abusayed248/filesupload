<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
   // message send
   public function sendMsg(Request $request)
   {
    $mailData = [

        'name' => $request->name,

        'message' => $request->message,

    ];

    Mail::to($request->email)->send(new ContactMail($mailData));
    return redirect()->back()->with('status', 'Send your mail successfully.');
   }
}
