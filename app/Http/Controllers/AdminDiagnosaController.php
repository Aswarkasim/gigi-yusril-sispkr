<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Gejala;
use App\Models\Pasien;
use App\Models\Diagnosa;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminDiagnosaController extends Controller
{
    public function index()
    {
        //destroy session pasen_id
        session()->forget('pasien_id');
        $data = [
            'title'   => 'Diagnosa',
            'content' => 'admin/diagnosa/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function result()
    {
        $pasien_id = Session::get('pasien_id');
        $data = [
            'title'   => 'Hasil Diagnosa',
            'pasien'  => Pasien::with(['penyakit'])->find($pasien_id),
            'diagnosa'  => Diagnosa::with('gejala')->where('pasien_id', session()->get('pasien_id'))->groupBy('gejala_id')->get(),
            'content' => 'admin/diagnosa/result'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function createPasien(Request $request)
    {
        $data = [
            'name'  => $request->name,
            'umur'  => $request->umur
        ];
        $pasien = Pasien::create($data);
        //set session pasien id
        session()->put('pasien_id', $pasien->id);
        return redirect('/admin/diagnosa/periksa');
    }

    function periksa()
    {
        //get data pasien last insert


        $data = [
            'title'   => 'Diagnosa',
            'gejala'    => Gejala::all(),
            'pasien'    => Pasien::find(session()->get('pasien_id')),
            'diagnosa'  => Diagnosa::with('gejala')->where('pasien_id', session()->get('pasien_id'))->groupBy('gejala_id')->get(),
            'content' => 'admin/diagnosa/periksa'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function pilih()
    {
        $gejala_id = request('gejala_id');
        $cf_user = request('nilai');
        $role = Role::whereGejalaId($gejala_id)->get();

        foreach ($role as $r) {
            $data = [
                'pasien_id' => Session::get('pasien_id'),
                'penyakit_id' => $r->penyakit_id,
                'gejala_id'  => $gejala_id,
                'nilai_cf'  => $cf_user,
                'cf_hasil'  => $cf_user * $r->bobot_cf,
            ];
            Diagnosa::create($data);
        }

        return redirect('/admin/diagnosa/periksa');
    }

    function delete()
    {
        $diagnosa_id = request('diagnosa_id');
        $diagnosa = Diagnosa::find($diagnosa_id);
        $gejala_id = $diagnosa->gejala_id;
        $pasien_id = $diagnosa->pasien_id;

        $diagnosaBygejala = Diagnosa::where('gejala_id', $gejala_id)->where('pasien_id', $pasien_id)->get();

        foreach ($diagnosaBygejala as $d) {
            $d->delete($d);
        }
        // DB::table('diagnosas')->delete($diagnosa_id);
        return redirect('/admin/diagnosa/periksa');
    }

    function proses()
    {
        $pasien_id = Session::get('pasien_id');
        $penyakit = Penyakit::all();
        $hasil = 0;
        $penyakit_id = '';

        $role = Role::all();
        foreach ($role as $r) {
            $diagnosa = Diagnosa::where('pasien_id', $pasien_id)->wherePenyakitId($r->penyakit_id)->whereGejalaId($r->id)->first();
            if ($diagnosa == null) {
                $data = [
                    'pasien_id' => $pasien_id,
                    'penyakit_id' => $r->penyakit_id,
                    'gejala_id'  => $r->gejala_id,
                    'nilai_cf'  => 0,
                    'cf_hasil'  => 0,
                ];
                Diagnosa::create($data);
            }
        }



        foreach ($penyakit as $p) {
            $diagnosa = Diagnosa::wherePenyakitId($p->id)->wherePasienId($pasien_id)->get();
            $diagnosa_hasil = $this->hitung_cf($diagnosa);
            if ($diagnosa_hasil > $hasil) {
                $hasil = $diagnosa_hasil;
                $penyakit_id = $p->id;
            }
            // echo $diagnosa_hasil . ' Penyakit = : ' . $p->id . '<br>';
        }
        // echo 'Hasil : ' . $hasil . ' Penyakit = : ' . $penyakit_id . '<br>';
        // die;
        $pasien = Pasien::find($pasien_id);
        $pasien->akumulasi_cf = $hasil;
        $pasien->persentase = round($hasil * 100);
        $pasien->penyakit_id = $penyakit_id;
        $pasien->save();
        return redirect('/admin/diagnosa/result');
    }

    function hitung_cf($data)
    {
        $cf_old = 0;

        // printr_pretty($cf_last['cf_hasil']);
        foreach ($data as $key => $value) {
            if ($key == 0) {
                $cf_old =  $value->cf_hasil;
            } else {
                $cf_old = $cf_old + $value->cf_hasil * (1 - $cf_old);
            }
        }
        // $persentase = $cf_old * 100;
        // return $persentase;
        return $cf_old;
    }
}
