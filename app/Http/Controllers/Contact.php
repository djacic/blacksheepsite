<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Contact extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        if(!$request->has('send'))
            return redirect(route("home"));

        $messages = [
            'firstName.required' => "Polje za ime je obavezno.",
            'firstName.alpha' => "Polje za ime sme da sadrzi samo slova.",
            'firstName.min' => "Polje za prezime mora da sadrzi bar 2 slova.",
            'lastName.required' => "Polje za prezime je obavezno.",
            'lastName.alpha' => "Polje za prezime sme da sadrzi samo slova.",
            'lastName.min' => "Polje za prezime mora da sadrzi bar 2 slova.",
            'email.required' => "Polje za email adresu je obavezno.",
            'email.email' => "Email adresa nije u dobrom formatu.",
            'message.required' => "Polje za poruku je obavezno.",
            'message.min' => "Polje za poruku mora da sadrzi bar 15 karaktera."
        ];

        $rules = [
            'firstName' => 'required|alpha|min:2',
            'lastName' => 'required|alpha|min:2',
            'email' => 'required|email',
            'message' => 'required|min:15'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->validate();


        Mail::send('emails.contact', [ 'request' => $request->all()], function($message) {
            $message->from("lukeelukic@gmail.com", 'Blacksheep kontakt forma');
            $message->to('luka.lukic@ict.edu.rs');
        });

        return redirect()->back()->with('status', 'Poruka uspešno poslata!');
    }

}
