<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::paginate(5)->onEachSide(2);
        return view('admin.dashboard.contacts', compact('contacts'));
    }
    

    public function show($id){
        $contact = Contact::find($id);
        return view('admin.dashboard.respond_contact',compact('contact'));
    }
    public function destroy(Contact $contact){
        Contact::destroy($contact->id);
        return redirect()->route('contacts.index');
    }
}
