<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Spj;
use App\Models\Arsip;
use App\Models\Pegawai;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'total_spj' => Spj::count(),
            'total_arsip' => Arsip::count(),
            'total_pegawai' => Pegawai::count(),
            'user' => auth()->user(),
        ];
        return view('profile.index', $data);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->update($request->only(['name']));
        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        auth()->user()->update(['password' => Hash::make($request->new_password)]);
        return redirect()->route('profile.index')->with('success', 'Password berhasil diubah.');
    }
}