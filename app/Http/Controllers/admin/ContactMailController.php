<?php

namespace App\Http\Controllers\Admin;




use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactMailController extends Controller
{
    public function index(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string'
        ]);

        $response = $request->response;

        $contact = Contact::find($id);

        $mailData = [
            'title' => 'Mail from Fueni Morroco',
            'body' => 'This is for testing email using SMTP',
            'response' => $response,
            'user_name' => $contact->firstName ." ".$contact->lastName,
            'question' => $contact->message
        ];

        try {
            Mail::to($contact->email)->send(new ContactMail($mailData));
            Contact::destroy($id);
            return redirect()->route('contacts.index')->with('success', "Your email was sent successfully to : $contact->email");
        } catch (\Exception $e) {
            return redirect()->route('contacts.index')->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }
}
