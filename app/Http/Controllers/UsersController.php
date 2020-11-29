<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

class UsersController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }


    public function index(Request $req)
    {
      $users = DB::table('users')->where([['status', '!=', 'Pašalintas']])->get();

      return view('users.index', ['users' => $users]);
    }


    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        $user->created_at = Date::now();
        $user->updated_at = Date::now();

        $user->save();

        return redirect('/vartotojai');
    }

    public function show(User $user) {
      return view('users.show', ['user' => $user]);
    }


    public function showDelete(User $user) {

      $route = User::findOrFail($user->id);

      return view('users.delete', ['user' => $user]);
    }


    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }


    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        if ($request->password) {
          $user->password = bcrypt($request->password);
        }
        if($request->role_id) {
          $user->role_id = $request->role_id;
        }
        $user->reservations_number = $request->reservations_number;
        $user->reservations_cost = $request->reservations_cost;
        $user->updated_at = Date::now();

        $user->save();

        return redirect($request->role_id == 1 ? '/vartotojai' : '/vartotojas/'.$user->id);
    }

    
    public function destroy(User $user)
    {
      $user->status = 'Pašalintas';

      $user->save();

      return redirect()->back();
    }
}
