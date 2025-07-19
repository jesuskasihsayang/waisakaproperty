<p class="text-right">
	<a href="{{ asset('admin/property') }}" class="btn btn-success btn-sm">
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

<form action="{{ asset('admin/property/edit_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="id_property" value="{{ $property->id_property }}">
<div class="row">
    <div class="col-md-6">
      <div class="row form-group">
        <label class="col-md-3 text-right">Tipe</label>
        <div class="col-md-9">
          <select name="tipe" id="tipe" class="form-control select2">
            <option value="jual" <?php echo (($property->tipe=='jual') ? 'selected' : '') ?>>Jual</option>
            <option value="sewa" <?php echo (($property->tipe=='sewa') ? 'selected' : '') ?>>Sewa</option>
          </select>
        </div>
      </div>

      <div class="row form-group jenis-sewa" style="<?php echo (($property->tipe=='jual') ? 'display:none;' : '') ?>">
        <label class="col-md-3 text-right">Jenis Sewa</label>
        <div class="col-md-9">
          <select name="jenis_sewa" class="form-control select2">
            <option value="tahun" <?php echo (($property->jenis_sewa=='tahunan') ? 'selected' : '') ?>>Tahunan</option>
            <option value="bulan" <?php echo (($property->jenis_sewa=='bulanan') ? 'selected' : '') ?>>Bulanan</option>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kategori Property</label>
        <div class="col-md-9">
          <select name="id_kategori_property" class="form-control select2">
            <?php foreach($kategori_property as $kategori_property) { ?>
            <option value="{{ $kategori_property->id_kategori_property }}" {{ (($property->id_kategori_property==$kategori_property->id_kategori_property) ? 'selected' : '') }}><?php echo $kategori_property->nama_kategori_property ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kode <span class="text-danger">*</span></label>
        <div class="col-md-9">
          <input type="text" name="kode" class="form-control" placeholder="Kode" value="{{ $property->kode }}" required>
        </div>
      </div>
      
      <div class="row form-group">
        <label class="col-md-3 text-right">Judul <span class="text-danger">*</span></label>
        <div class="col-md-9">
          <input type="text" name="nama_property" class="form-control" placeholder="Nama property" value="{{ $property->nama_property }}" required>
        </div>
      </div>

      <div class="row form-group">
      <label class="col-md-3 text-right">Luas Tanah</label>
        <div class="col-md-9">
          <input type="number" name="lt" class="form-control" placeholder="Luas Tanah" value="{{ $property->lt }}">
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Luas Bangunan</label>
        <div class="col-md-9">
          <input type="number" name="lb" class="form-control" placeholder="Luas Bangungan" value="{{ $property->lb }}">
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kamar Tidur</label>
        <div class="col-md-9">
          <select name="kamar_tidur" class="form-control">
            <?php for($i=1;$i<=10;$i++) { ?>
              <option value="{{ $i }}" {{ (($property->kamar_tidur==$i) ? 'selected' : '') }}>{{ $i }}</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kamar Mandi</label>
        <div class="col-md-9">
          <select name="kamar_mandi" class="form-control">
            <?php for($i=1;$i<=10;$i++) { ?>
              <option value="{{ $i }}" {{ (($property->kamar_mandi==$i) ? 'selected' : '') }}>{{ $i }}</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Lantai</label>
        <div class="col-md-9">
          <input type="number" name="lantai" class="form-control" placeholder="Lantai" value="{{ $property->lantai }}">
        </div>
      </div>

    </div>
    <div class="col-md-6">

      <div class="row form-group">
        <label class="col-md-3 text-right">Staff Agen</label>
        <div class="col-md-9">
          <select name="id_staff" class="form-control select2">
            <?php foreach($staff as $staff) { ?>
            <option value="{{ $staff->id_staff }}" {{ (($property->id_staff==$staff->id_staff) ? 'selected' : '') }}>{{ $staff->nama_staff }}</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Sertifikasi</label>
        <div class="col-md-9">
          <select name="surat" class="form-control">
            <option value="SHM" {{ (($property->surat=='SHM') ? 'selected' : '') }}>SHM - Sertifikat Hak Milik</option>
            <option value="HGB" {{ (($property->surat=='HGB') ? 'selected' : '') }}>HGB - Hak Guna Bangunan</option>
            <option value="other" {{ (($property->surat=='other') ? 'selected' : '') }}>Lainnya (PPJB, Girik, Adat, dll)</option>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Alamat</label>
        <div class="col-md-9">
          <textarea name="alamat" class="form-control" placeholder="Alamat">{{ $property->alamat }}</textarea>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Provinsi</label>
        <div class="col-md-9">
          <select name="id_provinsi" id="provinsi" class="form-control select2">
            <?php foreach($provinsi as $provinsi) { ?>
            <option value="{{ $provinsi->id }}" {{ (($property->id_provinsi==$provinsi->id) ? 'selected' : '') }}>{{ $provinsi->nama }}</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kabupaten</label>
        <div class="col-md-9">
          <select name="id_kabupaten" id="kabupaten" class="form-control select2">
            <?php foreach($kabupaten as $kabupaten) { ?>
              <option value="{{ $kabupaten->id }}" {{ (($property->id_kabupaten==$kabupaten->id) ? 'selected' : '') }}>{{ $kabupaten->nama }}</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kecamatan</label>
        <div class="col-md-9">
          <select name="id_kecamatan" id="kecamatan" class="form-control select2">
            <?php foreach($kecamatan as $kecamatan) { ?>
              <option value="{{ $kecamatan->id }}" {{ (($property->id_kecamatan==$kecamatan->id) ? 'selected' : '') }}>{{ $kecamatan->nama }}</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Harga</label>
        <div class="col-md-9">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
            <input class="form-control text-right" placeholder="Harga" name="harga" type="text" value="{{ $property->harga }}">
          </div>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Status Terjual/Tersewa</label>
        <div class="col-md-9">
          <select name="status" class="form-control select2">
            <option value="0" <?php echo (($property->status=='0') ? 'selected' : '') ?>>Belum</option>
            <option value="1" <?php echo (($property->status=='1') ? 'selected' : '') ?>>Sudah</option>
          </select>
        </div>
      </div>

    </div>
  </div>

  

  <div class="row form-group">
    <label class="col-md-1 text-right">Deskripsi Lengkap</label>
    <div class="col-md-11">
      <textarea name="isi" class="form-control" id="kontenku" placeholder="Isi property">{{ $property->isi }}</textarea>
    </div>
  </div>

  <div class="row form-group">
    <label class="col-md-1 text-right">Keywords pencarian di Google</label>
    <div class="col-md-11">
      <textarea name="keywords" id="keywords" class="form-control" placeholder="Keywords pencarian di Google">{{ $property->keywords }}</textarea>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">

      <div class="row form-group">
        <label class="col-md-3 text-right">(Utama) Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/property/'.$gambar[0]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/property/'.$gambar[1]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/property/'.$gambar[2]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/property/'.$gambar[3]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/property/'.$gambar[4]) }}" class="img img-thumbnail img-fluid" width="80">
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
          <img src="{{ asset('assets/upload/property/'.$gambar[5]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/property/'.$gambar[6]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/property/'.$gambar[7]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/property/'.$gambar[8]) }}" class="img img-thumbnail img-fluid" width="80">
        </div>
        <div class="col-md-7">
          <input type="file" name="gambar[]" class="form-control" placeholder="Upload gambar">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-md-3 text-right">Upload gambar/Foto</label>
        <div class="col-md-2">
          <img src="{{ asset('assets/upload/property/'.$gambar[9]) }}" class="img img-thumbnail img-fluid" width="80">
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