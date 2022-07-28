<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <table class="table">
          <tr>
            <td width="100px">No</td>
            <td>Nama Pasien</td>
            <td>Umur</td>
            <td>Penyakit</td>
            <td>Keakuratan</td>
          </tr>

          @foreach ($pasien as $item)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td><a href="/admin/pasien/detail/{{$item->id}}"><b>{{$item->name}}</b></a></td>
            <td>{{$item->umur}}</td>
            <td>{{$item->penyakit->name}}</td>
            <td>{{$item->persentase}}%</td>
          </tr>
          @endforeach
        </table>

        {{$pasien->links()}}
      </div>
    </div>
  </div>
</div>