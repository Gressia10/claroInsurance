<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DataTableBase;
use DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::orderBy('id')->offset(0)->limit(10)->get();
        $total = User::paginate(10)->total();
        $actual = 1;

        return view('admin.index', compact('users', 'total', 'actual'));
    }

    public function search(Request $request)
    {
        $offset = ($request->page-1)*10;
        $users = User::where('name', 'LIKE', "%{$request->search}%")
        ->orWhere('email', 'LIKE', "%{$request->search}%")
        ->orWhere('ci', 'LIKE', "%{$request->search}%")
        ->orWhere('number', 'LIKE', "%{$request->search}%")
        ->offset($offset)->limit(10)->get();

        $total = User::paginate(5)->total();

        $actual = 2;
        //return $userSearch;
        return view('admin.index', compact('users', 'total', 'actual', 'users'));
    }
    public function adminLogin(Request $request)
    {
        $user = DB::table('users')
            ->where('email', '=', $request->email)
            ->where('password', '=', Hash::make($request->password))
            ->where('type', '=', '1' )
            ->get();

        if($user){
            return redirect()->route('admin.index');
        }else{
            return response()->json([
                'status' => '0',
                'menssage'=>'User or password invalid'
            ]);
        }

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
        return view('admin.create', compact('data'));
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
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'date' => 'required',
            'number' => 'required',
            'ci' => 'required',
        ]);

        $email = User::where('email', '=', $request->email)->get();

        if(count($email)>0){
            $data = new \stdClass();
            $data -> status=1;
            $data -> message="Email already exists";
            return view('admin.create', compact('data'));
        }

        if($request->password === $request->password2){
            if (!(preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/", $request->password))) {
                $data = new \stdClass();
                $data -> status=1;
                $data -> message="The password must have at least one number, one shift letter and one minuscule letter with minimum 6";
                return view('admin.create', compact('data'));
            }else{
                User::create($request->all());
                return redirect()->route('admin.index')
                ->with('success', 'User created successfully.');
            }   
        }else{
            $data = new \stdClass();
            $data -> status=1;
            $data -> message="Passwords don't match";
            return view('admin.create', compact('data'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userRequest = DB::table('users')
        ->where('id', '=', $id)
        ->get();
        $user = $userRequest[0];

        return view('admin.edit', compact('user', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'date' => 'required',
            'type' => 'required'
        ]);

        $updated = DB::table('users')
            ->where('id', $id)
            ->update(['name' => $request->name, 'number' => $request->number,
            'date'=> $request->date, 'type'=>$request->type]);
            // ->update($request->all());

        return redirect()->route('admin.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();

        return redirect()->route('admin.index')
            ->with('success', 'User deleted successfully');
    }
}
