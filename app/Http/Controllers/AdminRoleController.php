<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoleController extends Controller
{

    public function create(Request $request)
    {
        //
        // dd($request->all());
        $data = [
            'penyakit_id'   => $request->penyakit_id,
            'gejala_id'     => $request->gejala_id,
            'bobot_cf'      => $request->bobot_cf
        ];
        Role::create($data);
        return redirect('/admin/penyakit/' . $request->penyakit_id);
    }

    function delete()
    {
        $role_id = request('role_id');
        $role = Role::find($role_id);
        $penyakit_id = $role->penyakit_id;
        DB::table('roles')->delete($role_id);
        return redirect('/admin/penyakit/' . $penyakit_id);
    }
}
