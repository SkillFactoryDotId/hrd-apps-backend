<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:admin|hrd');
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
        // https://laravel.com/docs/8.x/validation
        $request->validate([
            'nomor_karyawan' => 'required|unique:users',
            'status' => 'required|in:aktif,nonaktif',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|unique:users|min:11',
            'password' => 'required|min:6',
            'id_manager' => 'required_if:role,'. User::STAFF_ROLE ,
            'role' => 'required',
        ]);

        return $this->model->create([
            'nomor_karyawan' => $request->nomor_karyawan,
            'status' => $request->status,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'id_manager' => $request->id_manager,
            'role' => $request->role
        ]);
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
        $request->validate([
            'nomor_karyawan' => [
                'required',
                Rule::unique('users')->ignore($id), // abaikan data user yang memiliki id == $id
            ],
            'status' => 'required|in:aktif,nonaktif',
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id), // abaikan data user yang memiliki id == $id
            ],
            'phone_number' => 'required',
            'password' => 'nullable|min:6', // boleh kosong, tapi jika ada isi minimal 6 karakter
            'id_manager' => 'required_if:role,'. User::STAFF_ROLE ,
            'role' => 'required',
        ]);

        $user = $this->model->findOrFail($id);
        $user->update([
            'nomor_karyawan' => $request->nomor_karyawan,
            'status' => $request->status,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => !is_null($request->password) && $request->password !== '' ? Hash::make($request->password) : $user->password,
            'id_manager' => $request->id_manager,
            'role' => $request->role
        ]);
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
