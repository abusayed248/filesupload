<?php

namespace App\Http\Controllers\Backend;

use App\Models\Faq;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Support\Facades\File;

class FaqController extends Controller
{
    public function faq() {
        $faqs = Faq::get();
        return view('admin.pages.faq', compact('faqs'));
    }

    // all testimonials
    public function index() {
        $testimonials = Testimonial::get();
        return view('admin.pages.testimonial.index', compact('testimonials'));
    }
    // store testimonials
    public function updateTestimonial(Request $request, $id) {
        // Update the fields
        $testimonial = Testimonial::find($id); // Retrieve the model instance first
        if ($testimonial) {
            $testimonial->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        
            // Handle the photo upload
            $photo = $request->file('photo');
            $slug = Str::slug($request->name, '-');
        
            if ($photo) {
                // Delete the old photo if it exists
                if ($request->old_photo && File::exists(public_path($request->old_photo))) {
                    File::delete(public_path($request->old_photo));
                }
        
                // Generate a new filename and store the photo
                $extension = $photo->getClientOriginalExtension();
                $fileNameToStore = $slug . '_' . time() . '.' . $extension;
                $destinationPath = 'files/testimonials';
                $photo->move(public_path($destinationPath), $fileNameToStore);
        
                // Update the photo field
                $testimonial->photo = $destinationPath . '/' . $fileNameToStore;
                $testimonial->save();
            }
        }
        
        return redirect()->back()->with('status', 'Testimonial updated successfully');
    }
    // store testimonials
    public function storeTestimonial(Request $request) {
        // Update the fields
        $testimonial = Testimonial::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Handle the photo upload
        $photo = $request->file('photo');
        $slug = Str::slug($request->name, '-');

        if ($photo) {

            // if ($request->old_photo && File::exists(public_path($request->old_photo))) {
            //     \File::delete(public_path($request->old_photo));
            // }

            $extension = $photo->getClientOriginalExtension();
            $fileNameToStore = $slug . '_' . time() . '.' . $extension; // Filename to store
            $destinationPath = 'files/testimonials';
            $photo->move(public_path($destinationPath), $fileNameToStore);

            // Update the photo field
            $testimonial->photo = $destinationPath . '/' . $fileNameToStore;
            $testimonial->save();
        }
        return redirect()->back()->with('status', 'Testimonial added successfully');
    }

    //add testimonial
    public function addTestimonial() {
        return view('admin.pages.testimonial.add');
    }

    //edit testimonial
    public function editTestimonial($id) {
        $testimonial = Testimonial::find($id);
        return view('admin.pages.testimonial.edit', compact('testimonial'));
    }

    public function addFaq() {
        return view('admin.pages.add-faq');
    }

    public function storeFaq(Request $request) {
        Faq::create($request->all());
        return redirect()->back()->with('status', 'Data added successfully.');
    }
    public function editFaq($id) {
        $faq = Faq::find($id);
        return view('admin.pages.edit-faq', compact('faq'));
    }
    public function deleteFaq( $id) {
        $faq = Faq::find($id);
        $faq->delete();
        return redirect()->back()->with('status', 'Data deleted successfully.');
    }

    // delete testimonial
    public function deleteTestimonial( $id) {
        $testimonial = Testimonial::find($id);
        if ($testimonial->photo) {
                File::delete(public_path($testimonial->photo));
        }
        $testimonial->delete();
        return redirect()->back()->with('status', 'Data deleted successfully.');
    }
    public function updateFaq(Request $request, $id) {
        $faq = Faq::find($id);
        $faq->update($request->all());
        return redirect()->back()->with('status', 'Data deleted successfully.');
    }


    //=================== news start =================//
    public function addNews() {
        return view('admin.pages.news.add');
    }

    public function storeNews(Request $request) {
        News::create($request->all());
        return redirect()->back()->with('status', 'News added successfully');
    }

    public function updateNews(Request $request, $id) {
        $news = News::find($id);
        $news->update($request->all());
        return redirect()->back()->with('status', 'News updated successfully');
    }
    public function editNews($id) {
        $news = News::find($id);
        return view('admin.pages.news.edit', compact('news'));
    }
    public function deleteNews($id) {
        $news = News::find($id);
        $news->delete();
        return redirect()->back()->with('status', 'News deleted successfully');
    }
}
