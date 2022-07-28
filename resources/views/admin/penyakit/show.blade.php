<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">

            <h5><strong>Penyakit : {{$penyakit->name}}</strong></h5>
            <hr>
            <b>Deskripsi</b>
            <p>
              {{$penyakit->desc}}
            </p>
            <hr>
            <b>Penanganan</b>
            <p>{{$penyakit->penanganan}}</p>
          </div>
          <div class="col-md-8">
            @include('/admin/penyakit/add_gejala')
            <table class="table mt-2">
              <tr>
                <th width="50px">No</th>
                <th>Gejala</th>
                <th>Bobot</th>
                <th width="50px">#</th>
              </tr>
              
              @foreach ($penyakit->role as $item)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->gejala->name}}</td>
                <td>{{$item->bobot_cf}}</td>
                <td>
                  <a href="/admin/role/delete?role_id={{$item->id}}"><i class="fas fa-times"></i></a>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>