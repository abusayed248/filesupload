<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\ContactInfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
   public function index()
   {
        $contact_info = ContactInfo::first();
       return view('backend.pages.contact', compact('contact_info'));
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
   // update contact info
   public function updateContactInfo()
   {
    $info = ContactInfo::first();
    return view('backend.pages.edit-contact-info', compact('info'));
   }
   // update contact info status
   public function updateContactInfoStatus(Request $request)
   {
        $contact_info = ContactInfo::find($request->id);

        if ($contact_info) {
            // Update the fields
            $contact_info->update([
                'company_name' => $request->company_name,
                'text_no' => $request->text_no,
                'address' => $request->address,
                'tel' => $request->tel,
                'email' => $request->email,
                'twitter' => $request->twitter,
                'description' => $request->description,
            ]);
        
            // Handle the photo upload
            $photo = $request->file('photo');
            $slug = Str::slug($request->company_name, '-');
        
            if ($photo) {

                if ($request->old_photo && File::exists(public_path($request->old_photo))) {
                    File::delete(public_path($request->old_photo));
                }
                
                $extension = $photo->getClientOriginalExtension();
                $fileNameToStore = $slug . '_' . time() . '.' . $extension; // Filename to store
                $destinationPath = 'files/contact_info';
                $photo->move(public_path($destinationPath), $fileNameToStore);
        
                // Update the photo field
                $contact_info->photo = $destinationPath . '/' . $fileNameToStore;
                $contact_info->save();
            }
        }
        return redirect()->back()->with('infostatus', 'Contact infos updated successfully.');
   }
}
