
<div class="row">

  <div class="col-md-8">
    <form action="{{ asset('admin/proyek/cari') }}" method="get" accept-charset="utf-8">
    <br>
    <div class="input-group">       
      <select name="tipe" class="form-control" style="width:50%;">
        <option value="all" {{ (($tipe=="all") ? 'selected' : '') }}>-- Semua Tipe--</option>
        <option value="done" {{ (($tipe=="done") ? 'selected' : '') }}>Telah Dikerjakan</option>
        <option value="in_progress" {{ (($tipe=="in_progress") ? 'selected' : '') }}>Sedang Dikerjakan</option>
      </select>
      <input type="text" name="keywords" class="form-control" placeholder="Ketik kata kunci pencarian proyek...." value="<?php if(isset($_GET['keywords'])) { echo strip_tags($_GET['keywords']); } ?>">
      <span class="input-group-btn btn-flat">
        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
        <a href="{{ asset('admin/proyek/tambah') }}" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Baru</a>
      </span>
    </div>
    </form>
  </div>
  <div class="col-md-6 text-left">
  </div>
</div>

<div class="clearfix"><hr></div>
<form action="{{ asset('admin/proyek/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<div class="row">
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-btn" >
        <button class="btn btn-danger btn-sm" type="submit" name="hapus" onClick="check();" >
          <i class="fa fa-trash"></i>&nbsp;Hapus Semua Yang Dipilih
        </button> 
      </span>
      <span class="input-group-btn" style="display:none;">
        <button type="submit" class="btn btn-info btn-sm btn-flat" name="update">Update</button> 
      </span>
    </div>
  </div>

  <div class="col-md-8">
    <div class="btn-group">
      

         <?php if(isset($pagin)) { echo $pagin; } ?>

        </div>
      </div>
    </div>
    <div class="clearfix"><hr></div>
    <div class="table-responsive mailbox-messages">
      <table id="example1" class="display table table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
          <tr class="bg-info">
            <th width="5%" class="text-center">
              <div class="mailbox-controls">
                <!-- Check all button -->
               <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
            </div>
            </th>
            <th width="10%">TIPE</th>
            <th width="5%">GAMBAR</th>
            <th width="20%">NAMA</th>
            <th width="10%">PROVINSI</th>
            <th width="10%">KOTA/KAB</th>
            <th width="10%">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php 
            $i=1; 
            foreach($proyek as $proyek) { 
              $image = DB::table('proyek_img')->where('id_proyek',$proyek->id_proyek)->orderBy('id_proyek_img')->first();
          ?>

            <tr class="odd gradeX">
              <td class="text-center">
                <div class="icheck-primary">
                  <input type="checkbox" name="id_proyek[]" value="<?php echo $proyek->id_proyek ?>" id="check<?php echo $i ?>">
                  <label for="check<?php echo $i ?>"></label>
                </div>
              </td>
              <td><?php echo (($proyek->tipe == 'done') ? 'Telah Dikerjakan' : 'Sedang Dikerjakan')?></td>
              <td><img src="{{ asset('assets/upload/proyek/'.$image->gambar) }}" class="img img-thumbnail img-fluid" width="80"></td>
              <td><?php echo $proyek->kode ?>
                <small>
                  <br>Judul: <?php echo $proyek->nama_proyek ?>
                  <br>Luas Tanah: <?php echo $proyek->lt ?>  m2
                  <br>Luas Bangunan: <?php echo $proyek->lb ?> m2
                  <br>Alamat: <?php echo $proyek->alamat ?>
                </small>
              </td>
              <td><?php echo $proyek->nama_provinsi ?></td>
              <td><?php echo $proyek->nama_kabupaten ?></td>
              <td><div class="btn-group">
                  <a href="{{ asset('admin/proyek/detail/'.$proyek->id_proyek) }}" 
                    class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Detail</a>
                  <a href="{{ asset('admin/proyek/edit/'.$proyek->id_proyek) }}" 
                    class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="{{ asset('admin/proyek/delete/'.$proyek->id_proyek) }}" class="btn btn-danger btn-sm delete-link"><i class="fa fa-trash"></i></a>
                  </div>
                </td>
              </tr>
                    <?php $i++; } ?>
            </tbody>
          </table>
      </div>

      </form>

      <div class="clearfix"><hr></div>
      <div class="pull-right"><?php if(isset($pagin)) { echo $pagin; } ?></div>
