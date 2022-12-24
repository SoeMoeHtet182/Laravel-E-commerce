<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileApiController extends Controller
{
    public function profile()
    {
        $user_id = request()->user_id;
        $user = User::where('id', $user_id)->with('level')->first();
        if (!$user) {
            return response([
                'message' => false,
                'data' => 'User not found'
            ]);
        } else {
            return response([
                'message' => true,
                'data' => $user
            ]);
        }
    }

    public function updateInfo(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        if ($request->has('file')) {
            $image = $request->file('file');
            $image_name = uniqid() . $image->getClientOriginalName();
            $image->move(public_path('/images'), $image_name);

            $user->update([
                'image' => $image_name
            ]);
            return asset('/images/' . $image_name);
        }

        if ($request->has('dataToApi')) {
            $user_name = $request->dataToApi;
            $user->update([
                'name' => $user_name
            ]);
            return response([
                'message' => true,
                'data' => $user->name
            ]);
        }
    }
}
