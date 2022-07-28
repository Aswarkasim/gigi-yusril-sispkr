<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalGejala">
  <i class="fas fa-plus"></i> Tambah Gejala
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalGejala" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gejala</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      

      <form action="/admin/role/create" method="POST">
        @csrf
        <input type="hidden" name="penyakit_id" value="{{$penyakit->id}}">
        <div class="modal-body">
          <div class="form-group">
              <label for="">Gejala</label>
              <select name="gejala_id" required class="form-control" id="">
                <option value="">--Pilih Gejala--</option>
                <?php 
                  foreach ($gejala as $item) {
                    $cek = App\Models\Role::wherePenyakitId($penyakit->id)->whereGejalaId($item->id)->count();

                    if($cek <= 0){
                 ?>
                      <option value="{{$item->id}}">{{$item->name}}</option>
                    <?php } } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="">Bobot</label>
              <input type="text" class="form-control" name="bobot_cf" placeholder="0.0">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>