<p class="text-right">
  <a href="{{ asset('admin/proyek') }}" 
  class="btn btn-success btn-sm"><i class="fa fa-backward"></i> Kembali</a>
</p>
<hr>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/proyek/tambah_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-6">
      <div class="row form-group">
        <label class="col-md-3 text-right">Tipe</label>
        <div class="col-md-9">
          <select name="tipe" class="form-control select2">
            <option value="done">Telah Dikerjakan</option>
            <option value="in_progress">Sedang Dikerjakan</option>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kode <span class="text-danger">*</span></label>
        <div class="col-md-9">
          <input type="text" name="kode" class="form-control" placeholder="Kode" value="{{ old('kode') }}" required>
        </div>
      </div>
      
      <div class="row form-group">
        <label class="col-md-3 text-right">Judul <span class="text-danger">*</span></label>
        <div class="col-md-9">
          <input type="text" name="nama_proyek" class="form-control" placeholder="Nama proyek" value="{{ old('nama_proyek') }}" required>
        </div>
      </div>

      <div class="row form-group">
      <label class="col-md-3 text-right">Luas Tanah</label>
        <div class="col-md-9">
          <input type="number" name="lt" class="form-control" placeholder="Luas Tanah" value="{{ old('lt') }}">
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Luas Bangunan</label>
        <div class="col-md-9">
          <input type="number" name="lb" class="form-control" placeholder="Luas Bangungan" value="{{ old('lb') }}">
        </div>
      </div>

    </div>
    <div class="col-md-6">

      <div class="row form-group">
        <label class="col-md-3 text-right">Alamat</label>
        <div class="col-md-9">
          <textarea name="alamat" class="form-control" placeholder="Alamat">{{ old('alamat') }}</textarea>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Provinsi</label>
        <div class="col-md-9">
          <select name="id_provinsi" id="provinsi" class="form-control select2">
            <option>-- Pilih Provinsi --</option>
            <?php foreach($provinsi as $provinsi) { ?>
            <option value="<?php echo $provinsi->id ?>"><?php echo $provinsi->nama ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kabupaten</label>
        <div class="col-md-9">
          <select name="id_kabupaten" id="kabupaten" class="form-control select2">
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kecamatan</label>
        <div class="col-md-9">
          <select name="id_kecamatan" id="kecamatan" class="form-control select2">
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Lama Pengerjaan</label>
        <div class="col-md-9">
          <div class="input-group mb-3">
            <input class="form-control text-right" placeholder="Lama Pengerjaan" name="lama_pengerjaan" type="text" value="0">
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
      <textarea name="isi" class="form-control" id="kontenku" placeholder="Isi proyek">{{ old('isi') }}</textarea>
    </div>
  </div>

  <div class="row form-group">
    <label class="col-md-1 text-right">Keywords pencarian di Google</label>
    <div class="col-md-11">
      <textarea name="keywords" id="keywords" class="form-control" placeholder="Keywords pencarian di Google">{{ old('keywords') }}</textarea>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">

      <div class="row form-group">
        <label class="col-md-3 text-right">(Utama) Upload gambar/Foto</label>
        <div class="col-md-9">
          <input type="file" name="gambar[]" class="form-control" required="required" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-9">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-9">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-9">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-9">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>

    </div>
    <div class="col-md-6">

      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-9">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-9">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-9">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-9">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-9">
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
