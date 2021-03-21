@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Emails</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('logout') }}" title="logour" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</i>
                </a>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('home') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>
    <br>
    <br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif
    <div>
        <form action="/searchMail" method="POST">
            @csrf
            <div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{route('mail.create') }}" title="Create a product"> <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
            </div>
            <br>
            @if($total>1)
                Current: {{$actual}}
                Select the Page
                <select name="page" id="page" type="sumit">
                    @for ($i = 1; $i <= ceil($total/10); $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                <button class="btn btn-primary" type="submit" onclick="{{$actual-1}}">Change</button>
            @endif
        </form>
    </div>
    <table class="table table-bordered table-responsive-lg">
    
        <tr>
            <th>ID</th>
            <th>From</th>
            <th>To</th>
            <th>Subject</th>
            <th>Text</th>
            <th>Status</th>
        </tr>
        @foreach ($mails as $mail)
            <tr>
                <td>{{$mail->id}}</td>
                <td>{{$mail->email}}</td>
                <td>{{$mail->to_mail}}</td>
                <td>{{$mail->subject}}</td>
                <td>{{$mail->text}}</td>
                @if ($mail->status==0)
                    <td>Draft</td>
                @else
                    <td>Send</td>
                @endif
            </tr>
        @endforeach
    </table>

@endsection
