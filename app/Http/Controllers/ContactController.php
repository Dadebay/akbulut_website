<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function index(){
        $feedbacks = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.feedback.index', compact('feedbacks'));

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'body' => 'required'
        ],[
            'name.required'=>'name required',
            'phone.required'=>'phone required',
            'phone.digits'=>'phone must be 8 digits',
            'phone.regex'=>'phone must start with 6'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        $feedback = Contact::create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'body' => $request->get('body')
        ]);

        $name    = $request->get('name');
        $phone   = $request->get('phone');
        $body    = $request->get('body');
        $subject = 'New Contact Message from Akbulut Website';
        $mailBody = "Name: {$name}\nPhone: {$phone}\n\nMessage:\n{$body}";

        $recipients = [
            env('CONTACT_MAIL_1', 'info.akbulut.es@gmail.com'),
            env('CONTACT_MAIL_2', 'dadebaygurbanow333@gmail.com'),
        ];

        foreach ($recipients as $recipient) {
            Mail::raw($mailBody, function ($message) use ($recipient, $subject, $name) {
                $message->to($recipient)
                        ->subject($subject);
            });
        }

        return response()->json(['msg' => 'feedback created', 'feedback' => $feedback], 201);
    }

    public function destroy($id)
    {
        Contact::find($id)->delete();
        return redirect()->route('feedbacks.index')->with('success', 'feedback deleted successfully');
    }
}
