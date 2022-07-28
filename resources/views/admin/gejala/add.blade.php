<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (Request::is('admin/gejala/create'))
          <form action="/admin/gejala" method="POST">  
        @else
          <form action="/admin/gejala/{{$gejala->id}}" method="POST">  
            @method('PUT')
        @endif
          @csrf
          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($gejala) ? $gejala->name : old('name')}}" placeholder="Nama">
             @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Nilai CF</label>
            <input type="" class="form-control  @error('nilai_cf') is-invalid @enderror"  name="nilai_cf"  value="{{isset($gejala) ? $gejala->nilai_cf : old('nilai_cf')}}" placeholder="Nilai CF">
             @error('nilai_cf')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

     {{-- {!!form_input($errors, 'name', 'Nama', isset($gejala) ? $gejala : null)!!} --}}

          <a href="/admin/gejala" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

