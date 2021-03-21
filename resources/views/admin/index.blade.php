@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Admin Panel</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="" title="Create a product"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif
    <select name="option" id="option">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
    </select>
    <button>></button>
    <button><</button>
    <table class="table table-bordered table-responsive-lg">
    
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Email</th>
            <th>Number</th>
            <th>CI</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->type}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->number}}</td>
                <td>{{$user->ci}}</td>
                <td>{{$user->date}}</td>
                <td>
                    <form action="{{ url('admin/'. $user->id) }}" method="POST">

                        <a href="{{url('admin/'.$user->id.'/edit')}}">
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
