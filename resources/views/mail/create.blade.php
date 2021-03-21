@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Send Email</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('mail.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any() )
        <div class="alert alert-danger">
            <strong>Error!</strong> 
            <ul>
                @foreach ($errors->all() as $error)
                    <li></li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($data->status==1 )
        <div class="alert alert-danger">
            <strong>{{$data->message}}</strong> 
        </div>
    @endif
    <form action="/mail" method="POST" >
        @csrf

        <div class="row">
            <input type="hidden" name="id_user" class="form-control" placeholder="Id" value={{Auth::user()->id}} required autocomplete="To">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>To:</strong>
                    <input type="email" name="to_mail" class="form-control" placeholder="To" required autocomplete="To">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Subject:</strong>
                    <input id="subject" type="text" placeholder="Subject" class="form-control" name="subject" " required autocomplete="subject">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Message:</strong>
                    <textarea class="form-control" style="height:50px" id="text" name="text"
                    placeholder="Message"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </form>
@endsection
