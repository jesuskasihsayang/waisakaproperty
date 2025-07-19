<p>
@include('admin/kategori_property/tambah')
</p>

<table class="table table-bordered" id="example1">
<thead>
<tr>
    <th width="5%">NO</th>
    <th width="25%">NAMA KATEGORI</th>
    <th width="25%">KETERANGAN</th>
    <th width="15%">SLUG</th>
    <th width="10%">NO URUT</th>
    <th></th>
</tr>
</thead>
<tbody>

<?php $i=1; foreach($kategori_property as $kategori_property) { ?>

<tr>
    <td class="text-center"><?php echo $i ?></td>
    <td><?php echo $kategori_property->nama_kategori_property ?></td>
    <td><?php echo $kategori_property->keterangan ?></td>
    <td><?php echo $kategori_property->slug_kategori_property ?></td>
    <td><?php echo $kategori_property->urutan ?></td>
    <td>
      <div class="btn-group">
      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Edit<?php echo $kategori_property->id_kategori_property ?>">
    <i class="fa fa-edit"></i> Edit
</button>
      <a href="{{ asset('admin/kategori_property/delete/'.$kategori_property->id_kategori_property) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i> Hapus</a>
      </div>
      @include('admin/kategori_property/edit')
    </td>
</tr>

<?php $i++; } ?>

</tbody>
</table>