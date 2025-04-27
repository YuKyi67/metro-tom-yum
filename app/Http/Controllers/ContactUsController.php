<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContactUsController extends Controller
{
    //
    public function index() {
        return view('contact');
    }

    public function feedback() {
        Gate::authorize('viewAny', User::class);

        $feedbacks = ContactUs::paginate(6);
        return view('admin.guest-feedback', ['feedbacks' => $feedbacks]);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        ContactUs::create($fields);
  
        // Store success message in session
        session()->flash('success', 'Thank you for contacting us. We will contact you shortly.');

        // Redirect back to the contact page
        return redirect()->route('contact.index');
    }
}
