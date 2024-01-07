<?php

namespace App\Http\Controllers;

use App\Mail\Mailing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailingController extends Controller
{
    public function viewEmail()
    {

    }

    public function store()
    {
        $users = User::all();
        foreach ($users as $recipient) {
            Mail::mailer('mailgun')->to($recipient->email)->send(new Mailing($recipient));
        }

        return redirect('home');
    }
}
