<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all the users
        //$users = User::all();
        // return view('admin.users.index')
        //     ->with([
        //         //'users' => $users
        //         'users'=> User::all()
        // ]);

        // Check if it is a logged in user who wants to access the user table

        if(Gate::denies('logged-in')){
            dd('no access');
        }
        if(Gate::allows('is-admin')){
            return view('admin.users.index', ['users'=> User::paginate(10)]);
        }

        dd('you need to be admin');



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // Validation of User data
        //Staement below replaced by Fortify CreateNewUser
        //$validatedData = $request->validated();

        // $user = User::create($request->except(['_token', 'roles']));
        //$user = User::create($validatedData);

        $newUser = new CreateNewUser();
        $user = $newUser->create($request->only([
            'name',
            'email',
            'password',
            'password_confirmation'
        ]));

        $user->roles()->sync($request->roles);

        $request->session()->flash('success', 'You have created the user successful');

        return redirect(route('admin.users.index'));
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
        return view('admin.users.edit', [
            'roles' => Role::all(),
            'user' => User::find($id)
        ]);
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
        // $user = User::findOrFail($id);
        $user = User::find($id);

        if(!$user) {
            $request->session()->flash('error', 'User not found. You can not edit this user.');
            return redirect(route('admin.users.index'));
        }

        $user->update($request->except(['_token', 'roles']));
        $user->roles()->sync($request->roles);

        $request->session()->flash('success', 'You have edited the user successful');

        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        User::destroy($id);

        $request->session()->flash('success', 'You have deleted the user successful');

        return redirect(route('admin.users.index'));
    }
}
