<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUsers()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function manageUser($id)
    {
        $type = request()->type;
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        if ($type == 'ban') {
            $user->update(['suspended' => 1]);
            return redirect()->back()->with('success', 'Ban user successfully.');
        } else {
            $user->update(['suspended' => 0]);
            return redirect()->back()->with('success', 'Release user successfully.');
        }
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        $user->delete();
        return redirect()->back()->with('success', 'User account deleted');
    }
}
