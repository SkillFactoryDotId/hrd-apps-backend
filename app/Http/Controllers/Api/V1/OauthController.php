<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use Auth;

class OauthController extends Controller
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

    public function me(Request $request)
    {
        return $request->user();
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($request->user()->id), // abaikan data user yang memiliki id == $id
            ],
            'phone_number' => 'required',
            'password' => 'nullable|min:6', // boleh kosong, tapi jika ada isi minimal 6 karakter
            
        ]);

         $request->user()->update([
            
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => !is_null($request->password) && $request->password !== '' ? Hash::make($request->password) : $user->password,
            
        ]);
        return $request->user()->refresh();

    }
}
