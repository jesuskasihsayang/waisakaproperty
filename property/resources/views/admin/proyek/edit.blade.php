<p class="text-right">
	<a href="{{ asset('admin/proyek') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Kembali
	</a>
</p>
<hr>
<?php
// Validasi error

// Error upload
if(isset($error)) {
	echo '<div class="alert alert-warning">';
	echo $error;
	echo '</div>';
}

// Form open
?>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/proyek/edit_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="id_proyek" value="{{ $proyek->id_proyek }}">
<div class="row">
    <div class="col-md-6">
      <div class="row form-group">
        <label class="col-md-3 text-right">Tipe</label>
        <div class="col-md-9">
          <select name="tipe" class="form-control select2">
            <option value="done" <?php echo (($proyek->tipe=='done') ? 'selected' : '') ?>>Telah Dikerjakan</option>
            <option value="in_progress" <?php echo (($proyek->tipe=='in_progress') ? 'selected' : '') ?>>Sedang Dikerjakan</option>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kode <span class="text-danger">*</span></label>
        <div class="col-md-9">
          <input type="text" name="kode" class="form-control" placeholder="Kode" value="{{ $proyek->kode }}" required>
        </div>
      </div>
      
      <div class="row form-group">
        <label class="col-md-3 text-right">Judul <span class="text-danger">*</span></label>
        <div class="col-md-9">
          <input type="text" name="nama_proyek" class="form-control" placeholder="Nama proyek" value="{{ $proyek->nama_proyek }}" required>
        </div>
      </div>

      <div class="row form-group">
      <label class="col-md-3 text-right">Luas Tanah</label>
        <div class="col-md-9">
          <input type="number" name="lt" class="form-control" placeholder="Luas Tanah" value="{{ $proyek->lt }}">
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Luas Bangunan</label>
        <div class="col-md-9">
          <input type="number" name="lb" class="form-control" placeholder="Luas Bangungan" value="{{ $proyek->lb }}">
        </div>
      </div>

    </div>
    <div class="col-md-6">

      <div class="row form-group">
        <label class="col-md-3 text-right">Alamat</label>
        <div class="col-md-9">
          <textarea name="alamat" class="form-control" placeholder="Alamat">{{ $proyek->alamat }}</textarea>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Provinsi</label>
        <div class="col-md-9">
          <select name="id_provinsi" id="provinsi" class="form-control select2">
            <?php foreach($provinsi as $provinsi) { ?>
            <option value="{{ $provinsi->id }}" {{ (($proyek->id_provinsi==$provinsi->id) ? 'selected' : '') }}>{{ $provinsi->nama }}</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kabupaten</label>
        <div class="col-md-9">
          <select name="id_kabupaten" id="kabupaten" class="form-control select2">
            <?php foreach($kabupaten as $kabupaten) { ?>
              <option value="{{ $kabupaten->id }}" {{ (($proyek->id_kabupaten==$kabupaten->id) ? 'selected' : '') }}>{{ $kabupaten->nama }}</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kecamatan</label>
        <div class="col-md-9">
          <select name="id_kecamatan" id="kecamatan" class="form-control select2">
            <?php foreach($kecamatan as $kecamatan) { ?>
              <option value="{{ $kecamatan->id }}" {{ (($proyek->id_kecamatan==$kecamatan->id) ? 'selected' : '') }}>{{ $kecamatan->nama }}</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Lama Pengerjaan</label>
        <div class="col-md-9">
          <div class="input-group mb-3">
            <input class="form-control text-right" placeholder="Lama Pengerjaan" name="lama_pengerjaan" type="text" value="{{ $proyek->lama_pengerjaan }}">
            <div class="input-group-append">
              <span class="input-group-text">Hari</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  

  <div class="row form-group">
    <label class="col-md-1 text-right">Deskripsi Lengkap</label>
    <div class="col-md-11">
      <textarea name="isi" class="form-control" id="kontenku" placeholder="Isi proyek">{{ $proyek->isi }}</textarea>
    </div>
  </div>

  <div class="row form-group">
    <label class="col-md-1 text-right">Keywords pencarian di Google</label>
    <div class="col-md-11">
      <textarea name="keywords" id="keywords" class="form-control" placeholder="Keywords pencarian di Google">{{ $proyek->keywords }}</textarea>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">

      <div class="row form-group">
        <label class="col-md-3 text-right">(Utama) Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/proyek/'.$gambar[0]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/proyek/'.$gambar[1]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/proyek/'.$gambar[2]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/proyek/'.$gambar[3]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/proyek/'.$gambar[4]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>

    </div>
    <div class="col-md-6">

      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/proyek/'.$gambar[5]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/proyek/'.$gambar[6]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/proyek/'.$gambar[7]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/proyek/'.$gambar[8]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/proyek/'.$gambar[9]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>

    </div>
  </div>

  <div class="row form-group">
    <label class="col-md-4 text-right"></label>
    <div class="col-md-8">
      <div class="form-group">
        <input type="submit" name="submit" class="btn btn-success " value="Simpan Data">
        <input type="reset" name="reset" class="btn btn-info " value="Reset">
      </div>
    </div>
  </div>
</form>