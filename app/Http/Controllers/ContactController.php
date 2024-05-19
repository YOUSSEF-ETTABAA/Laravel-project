<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('user.contact');
    }
    public function store(Request $request){
        $request->validate([
            'fname' => 'required|string|max:255',  
            'lname' => 'required|string|max:255',  
            'email' => 'required|email|max:255', 
            'message' => 'required|string' 
        ]);  
        
        $contact = new Contact();
        $contact->firstName = $request->fname;
        $contact->lastName = $request->lname;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->route('contact.store')->with(['success' => 'Your message was send successfully']);
    }
}
