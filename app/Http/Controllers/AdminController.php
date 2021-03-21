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
        // $users = DB::table('users')->get();
        
        // $datatable = DataTables::of($users)
		// 	->addColumn('id', function ($users) {
		// 		return $users['id'];
		// 	})
		// 	->addColumn('name', function ($users) {
		// 		return $users['name'];
		// 	})
		// 	->addColumn('type', function ($users) {
		// 		return $users['type'];
		// 	})
		// 	->addColumn('email', function ($users) {
		// 		return $users['email'];
		// 	})
		// 	->addColumn('number', function ($users) {
		// 		return $users['number'];
		// 	})
		// 	->addColumn('ci', function ($users) {
		// 		return $users['ci'];
		// 	})
		// 	->addColumn('date', function ($users) {
		// 		return $users['date'];
		// 	});
		// 	$columns = ['id', 'name', 'type', 'email',  'number', 'ci', 'date'];
		// 	$base = new DataTableBase($users, $datatable, $columns,'UsersRequestDetail');
		// 	return $base->render(null);

        //     return view('admin.index', compact($base));


        // $usersData = $users->map(
		// 	function ($item) use ($users) {
		// 		$return_data = [
		// 			'id' => $item['driver_id'],
		// 			'name' => $item ['name'],
		// 			'type' => $item['type']=0?'User':'Admin',
		// 			'email' => $item['email'],
		// 			'number' => $item['number'],
		// 			'ci' => $item['ci']	,
		// 			'date' => $item['date']	,
                    
		// 		];
		// 		return $return_data;
		// 	}
		// );
        $users = User::latest()->paginate(5);

        return view('admin.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function search(Request $request)
    {
        $user = DB::table('users')
            ->where('email', '=', $request->email)
            ->where('password', '=', Hash::make($request->password))
            ->where('type', '=', 1)
            ->get();
    }
    public function adminLogin(Request $request)
    {
        $user = DB::table('users')
            ->where('email', '=', $request->email)
            ->where('password', '=', Hash::make($request->password))
            ->where('type', '=', '1' )
            ->get();

        if($user){
            // return view('admin.index');
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
