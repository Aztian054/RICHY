<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PengaturanController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::all(),
            'total_users' => User::count(),
            'app_settings' => [
                'app_name' => 'RICH ERP',
                'app_version' => 'v2.0',
                'instansi' => 'BPPMHKP',
            ],
        ];
        return view('pengaturan.index', $data);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|min:8|confirmed',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Update user profile
        if ($request->has('name') || $request->has('email')) {
            $user = auth()->user();
            if ($request->filled('name')) $user->name = $request->name;
            if ($request->filled('email')) $user->email = $request->email;
            $user->save();
        }

        // Update specific user password or level (admin feature)
        if ($request->filled('user_id') && $request->filled('password')) {
            $targetUser = User::findOrFail($request->user_id);
            $targetUser->password = Hash::make($request->password);
            $targetUser->save();
        }

        return redirect()->route('pengaturan.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}