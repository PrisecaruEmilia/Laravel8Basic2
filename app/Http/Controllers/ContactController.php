<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    // public function index()
    // {
    //     return view('contact');
    // }

    public function adminContact()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contact.index', compact('contacts'));
    }

    public function addContact()
    {
        return view('admin.contact.create');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate(
            [
                'address' => 'required|unique:contacts|max:255',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            ],
            [
                'address.required' => "Please input your address",
            ]
        );

        Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('admin.contact')->with('success', 'Contact inserted successfully');
    }

    public function contact()
    {
        $contact = DB::table('contacts')->first();
        return view('pages.contact', compact('contact'));
    }

    public function contactForm(Request $request)
    {
        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('contact')->with('success', 'Your message was successfully sent!');
    }

    public function adminContactMessage()
    {
        $messages = ContactForm::latest()->get();
        return view('admin.contact.message', compact('messages'));
    }

    public function deleteMessage($id)
    {
        ContactForm::find($id)->delete();
        return Redirect()->back()->with('success', 'The message was successfully deleted!');
    }
}
