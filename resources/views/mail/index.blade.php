@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Admin Panel</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('logout') }}" title="logour" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</i>
                </a>
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
        <form action="/searchAdmin" method="POST">
            @csrf
            <div>
                <input id="search" value="" name="search" type="text" placeholder="Search"></input>
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
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
            <th>Actions</th>
        </tr>
        @foreach ($mails as $mail)
            <tr>
                <td>{{$mail->id}}</td>
                <td>{{$mail->id_user}}</td>
                <td>{{$mail->to}}</td>
                <td>{{$mail->subject}}</td>
                <td>{{$mail->text}}</td>
                @if ($mail->status=0)
                    <td>Borrador</td>
                @else
                    <td>Send</td>
                @endif
                <td>
                    <form action="{{ url('admin/'. $mail->id) }}" method="POST">

                        <a href="{{url('admin/'.$mail->id.'/edit')}}">
                            <i class="fas fa-edit  fa-lg"></i>
                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
