<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cari = request('cari');

        if ($cari) {
            $penyakit = Penyakit::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $penyakit = Penyakit::latest()->paginate(10);
        }
        $data = [
            'title'   => 'Manajemen Penyakit',
            'penyakit' => $penyakit,
            'content' => 'admin/penyakit/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'title'   => 'Manajemen Penyakit Artikel',
            'content' => 'admin/penyakit/add'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // print_r($request);
        // die;
        // dd($request);
        $data = $request->validate([
            'name'              => 'required|min:3',
            'desc'              => 'required',
            'penanganan'              => 'required',
        ]);
        Penyakit::create($data);
        Alert::success('Sukses', 'Penyakit telah ditambahkan');
        return redirect('/admin/penyakit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $penyakit = Penyakit::with('role')->find($id);
        $data = [
            'title'   => 'Edit Penyakit',
            'penyakit' => $penyakit,
            'gejala'     => Gejala::all(),
            'content' => 'admin/penyakit/show'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $penyakit = Penyakit::find($id);
        $data = [
            'title'   => 'Edit Penyakit',
            'penyakit' => $penyakit,
            'content' => 'admin/penyakit/add'
        ];
        return view('admin/layouts/wrapper', $data);
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
        //
        $penyakit = Penyakit::find($id);
        $data = $request->validate([
            'name'              => 'required|min:3',
            'desc'              => 'required',
            'penanganan'              => 'required',
        ]);
        $penyakit->update($data);
        Alert::success('Sukses', 'Penyakit telah diubah');
        return redirect('/admin/penyakit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('penyakits')->delete($id);
        Alert::success('success', 'Kateogri telah dihapus');
        return redirect('/admin/penyakit');
    }
}
