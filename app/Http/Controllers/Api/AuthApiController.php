<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    public function changePassword(Request $request)
    {
        $user_id = $request->user_id;
        $currentPassword = $request->currentPassword;
        $newPassword = $request->newPassword;

        $user = User::where('id', $user_id)->first();

        if (Hash::check($currentPassword, $user->password)) {
            $user->update([
                'password' => Hash::make($newPassword)
            ]);
            return response([
                'message' => true,
                'data' => null
            ]);
        } else {
            return response([
                'message' => false,
                'data' => 'password wrong'
            ]);
        }
    }
}
