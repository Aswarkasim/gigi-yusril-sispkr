  <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">

<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (Request::is('admin/penyakit/create'))
          <form action="/admin/penyakit" method="POST">  
        @else
          <form action="/admin/penyakit/{{$penyakit->id}}" method="POST">  
            @method('PUT')
        @endif
          @csrf
          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($penyakit) ? $penyakit->name : old('name')}}" placeholder="Nama">
             @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Deskripsi</label>
             <textarea class="form-control  @error('desc') is-invalid @enderror" id="summernote-desc"  name="desc" placeholder="Penanganan">{{isset($penyakit) ? $penyakit->desc : old('desc')}}</textarea>
             @error('desc')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Penanganan</label>
            <textarea class="form-control  @error('penanganan') is-invalid @enderror" id="summernote-pen"  name="penanganan" placeholder="Penanganan">{{isset($penyakit) ? $penyakit->penanganan : old('penanganan')}}</textarea>
             @error('penanganan')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>
     {{-- {!!form_input($errors, 'name', 'Nama', isset($penyakit) ? $penyakit : null)!!} --}}

          <a href="/admin/penyakit" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>


