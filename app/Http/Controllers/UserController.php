<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);

        return view('users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_karyawan' => 'required',
            'status' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('users.index')
            ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, User $user)
    {
        $user->validate([
            'nomor_karyawan' => 'required',
            'status' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(User $user)
    {
        
        $user->delete();

        return redirect()->route('products.index')
            ->with('success','Product deleted successfully');
    }
}
