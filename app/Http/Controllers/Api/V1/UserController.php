<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new User;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->model;
        if (isset($request->nomor_karyawan) && trim($request->nomor_karyawan) !== '') {
            $data = $data->where('nomor_karyawan', 'LIKE', '%'.$request->nomor_karyawan.'%');
        }
        if (isset($request->name) && trim($request->name) !== '') {
            $data = $data->where('name', 'LIKE', '%'.$request->name.'%');
        }
        if (isset($request->role) && trim($request->role) !== '') {
            $data = $data->where('role', $request->role);
        }
        if ($request->has('order')) {
            $data = $data->orderBy($request->input('order'), $request->input('ascending')? 'ASC' : 'DESC');
        } else {
            $data = $data->orderBy('nomor_karyawan', 'ASC');
        }
        return $data->paginate($request->limit? $request->limit : 10)->appends($request->all());
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
            'nomor_karyawan' => 'required',
            'status' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        return $this->model->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
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
        $user = $this->model->findOrFail($id);
        $user->update($request->all());
        return $user->refresh();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }
}
