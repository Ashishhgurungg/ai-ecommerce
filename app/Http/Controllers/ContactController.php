<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
     public function submitContactForm(Request $request){

        $validateData= $request->validate([
            // company name, country, job title, and job details
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'message'=>'required|string|max:1000',
            'phone'=>'required|string|max:20',
            'subject'=>'required|string|max:255',
            'company'=>'required|string|max:255',
            'country'=>'required|string|max:255',
            'job_title'=>'required|string|max:255',
            'job_details'=>'required|string|max:1000',
        ]);

        Contact::create($validateData);
        return redirect('/contact')->with('success', 'Your message has been sent successfully!');
    }

     public function listInquiries()
     {
            $inquiries = Contact::paginate(3);
            return view('inquiries', ['inquiries' => $inquiries]);
     }

        public function deleteInquiry($id)
        {
                $inquiry = Contact::findOrFail($id);
                $inquiry->delete();
                return redirect('/inquiries')->with('success', 'Inquiry deleted successfully!');
        }
}
