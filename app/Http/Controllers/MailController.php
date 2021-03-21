<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mails = DB::table('mail')->orderBy('mail.id')
        ->join('users', 'mail.id_user', '=', 'users.id')
        ->select('mail.*', 'users.email')
        ->get();
        $total = Mail::paginate(10)->total();
        $actual = 1;

        return view('mail.index', compact('mails', 'total', 'actual'));
    }

    public function search(Request $request)
    {
        $offset = ($request->page-1)*10;
        $mails = DB::table('mails')
        ->join('users', 'mail.id_user', '=', 'users.id')
        ->select('mail.*', 'users.email')
        ->get();

        $total = Mail::paginate(5)->total();

        $actual = 2;

        return view('mail.index', compact('mails', 'total', 'actual',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new \stdClass();
        $data -> status=0;
        return view('mail.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'to_mail' => 'required',
            'subject' => 'required',
            'text' => 'required',
        ]);

            
        $email = User::where('id', '=', $request->id_user)->get();

        $create = Mail::insert([
            ['id_user' => $request->id_user, 
            'to_mail' => $request->to_mail,
            'subject' => $request->to_mail,
            'text' => $request->text],
        ]);
        $headers = "From:" . $email[0]->email;
        // mail($request->to_mail,$request->subject,$request->text, $headers);

        return redirect()->route('mail.index')
        ->with('success', 'User created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function show(Mail $mail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function edit(Mail $mail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mail $mail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mail $mail)
    {
        //
    }
}
