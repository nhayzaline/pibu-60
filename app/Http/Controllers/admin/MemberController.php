<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function anggota()
    {
        $members = \App\Models\User::where('role' . 'siswa')->latest()->get();

        return view('admin.anggota' , compact('members'));
    }
}
