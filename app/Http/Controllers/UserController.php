<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->all();
        $query = $request->get('query');

        if ($params) {
            $users = User::where('name', 'like', '%' . $params['query'] . '%')
                ->orWhere('email', 'like', '%' . $params['query'] . '%')
                ->paginate(10);

            return view('users.index', compact('users', 'query'));
        }

        $users = User::paginate(10);

        return view('users.index', compact('users', 'query'));
    }

    public function create()
    {
        $user = new User();

        return view('users.form')->with('user', $user);
    }

    public function store(Request $request)
    {
        $params = $request->all();

        if ($params) {
            $user = new User();
            $user->name = $params['name'];
            $user->email = $params['email'];
            $user->password = Hash::make($params['password']);
            $user->save();

            return redirect()->route('users.index');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('users.form', compact('user'));
    }

    public function update($id, Request $request)
    {
        $params = $request->all();

        if ($params) {
            $user = User::find($id);
            $user->fill($params);
            $user->save();

            return redirect()->route('users.index');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index');
    }
}
