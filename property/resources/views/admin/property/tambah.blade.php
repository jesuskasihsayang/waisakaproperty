<p class="text-right">
  <a href="{{ asset('admin/property') }}" 
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

<form action="{{ asset('admin/property/tambah_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-6">
      <div class="row form-group">
        <label class="col-md-3 text-right">Tipe</label>
        <div class="col-md-9">
          <select name="tipe" id="tipe" class="form-control select2">
            <option value="jual">Jual</option>
            <option value="sewa">Sewa</option>
          </select>
        </div>
      </div>

      <div class="row form-group jenis-sewa" style="display:none">
        <label class="col-md-3 text-right">Jenis Sewa</label>
        <div class="col-md-9">
          <select name="jenis_sewa" class="form-control select2">
            <option value="tahun">Tahunan</option>
            <option value="bulan">Bulanan</option>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kategori Property</label>
        <div class="col-md-9">
          <select name="id_kategori_property" class="form-control select2">
            <?php foreach($kategori_property as $kategori_property) { ?>
            <option value="<?php echo $kategori_property->id_kategori_property ?>"><?php echo $kategori_property->nama_kategori_property ?></option>
            <?php } ?>
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
          <input type="text" name="nama_property" class="form-control" placeholder="Nama property" value="{{ old('nama_property') }}" required>
        </div>
      </div>

      <div class="row form-group">
      <label class="col-md-3 text-right">Luas Tanah <span class="text-danger">*</span></label>
        <div class="col-md-9">
          <input type="number" name="lt" class="form-control" placeholder="Luas Tanah" value="{{ old('lt',0) }}">
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Luas Bangunan <span class="text-danger">*</span></label>
        <div class="col-md-9">
          <input type="number" name="lb" class="form-control" placeholder="Luas Bangungan" value="{{ old('lb',0) }}">
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kamar Tidur <span class="text-danger">*</span></label>
        <div class="col-md-9">
          <select name="kamar_tidur" class="form-control">
            <?php for($i=1;$i<=10;$i++) { ?>
              <option value="{{ $i }}">{{ $i }}</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Kamar Mandi <span class="text-danger">*</span></label>
        <div class="col-md-9">
          <select name="kamar_mandi" class="form-control">
            <?php for($i=1;$i<=10;$i++) { ?>
              <option value="{{ $i }}">{{ $i }}</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Lantai</label>
        <div class="col-md-9">
          <input type="number" name="lantai" class="form-control" placeholder="Lantai" value="{{ old('lantai',0) }}">
        </div>
      </div>

    </div>
    <div class="col-md-6">

      <div class="row form-group">
        <label class="col-md-3 text-right">Staff Agen</label>
        <div class="col-md-9">
          <select name="id_staff" class="form-control select2">
            <?php foreach($staff as $staff) { ?>
            <option value="<?php echo $staff->id_staff ?>"><?php echo $staff->nama_staff ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Sertifikasi</label>
        <div class="col-md-9">
          <select name="surat" class="form-control">
            <option value="SHM">SHM - Sertifikat Hak Milik</option>
            <option value="HGB">HGB - Hak Guna Bangunan</option>
            <option value="other">Lainnya (PPJB, Girik, Adat, dll)</option>
          </select>
        </div>
      </div>

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
        <label class="col-md-3 text-right">Harga</label>
        <div class="col-md-9">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
            <input class="form-control text-right" placeholder="Harga" name="harga" type="text" value="0">
          </div>
        </div>
      </div>

      <div class="row form-group">
        <label class="col-md-3 text-right">Status Terjual/Tersewa</label>
        <div class="col-md-9">
          <select name="status" class="form-control select2">
            <option value="0">Belum</option>
            <option value="1">Sudah</option>
          </select>
        </div>
      </div>

    </div>
  </div>

  

  <div class="row form-group">
    <label class="col-md-1 text-right">Deskripsi Lengkap</label>
    <div class="col-md-11">
      <textarea name="isi" class="form-control" id="kontenku" placeholder="Isi property">{{ old('isi') }}</textarea>
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
