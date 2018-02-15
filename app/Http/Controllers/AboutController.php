<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class AboutController extends Controller
{
    //
    public function contact()
    {
        return view('pages.contact');
    }

    public function send(Request $request)
    {
        $req = $request->all();
        /*echo $req['name'];
        dd($req);*/
        /*Mail::send('emails.reminder', array('data' => $data), function ($m) use ($user)  {
            $m->from('hello@app.com', 'Your Application');

            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });*/
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        Mail::send('email.send', array('data' => $req), function ($message) use ($req)  {
            $message->from('info@spapal.ca', $req['name']);

            $message->to('info@spapal.ca')->subject('Contact from StorePal');
        });
        flash()->success('success', 'Thank You For Contacting Us');
        return redirect()->back();
    }
}
