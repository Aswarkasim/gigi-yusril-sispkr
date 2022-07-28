<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class AdminPasienController extends Controller
{
    //
    function index()
    {
        $cari = request('cari');

        if ($cari) {
            $pasien = Pasien::with(['penyakit'])->where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $pasien = Pasien::with(['penyakit'])->latest()->paginate(10);
        }
        $data = [
            'title'   => 'Manajemen Pasien',
            'pasien' => $pasien,
            'content' => 'admin/pasien/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function detail($pasien_id)
    {
        session()->put('pasien_id', $pasien_id);
        return redirect('/admin/diagnosa/result');
    }

    function print($pasien_id)
    {
        $data['pasien'] = Pasien::with(['penyakit'])->find($pasien_id);
        return view('admin/pasien/print', $data);
    }
}
