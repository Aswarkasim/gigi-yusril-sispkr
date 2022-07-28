<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">

        <form action="/admin/diagnosa/pasien/create" method="POST">
          @csrf
        <div class="form-group">
          <label for=""><b>Nama Pasien</b></label>
          <input type="text" class="form-control" name="name" required placeholder="Nama Pasien">
        </div>

        <div class="form-group">
          <label for=""><b>Umur</b></label>
          <input type="number" class="form-control" name="umur" required placeholder="Umur">
        </div>

        <div class="float-right">
          <button type="submit" class="btn btn-primary">Masuk ke diagnosa <i class="fas fa-arrow-right"></i></button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>