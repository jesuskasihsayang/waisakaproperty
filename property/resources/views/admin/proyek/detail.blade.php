<p class="text-right">
	<a href="{{ asset('admin/proyek/edit/'.$proyek->id_proyek) }}" class="btn btn-warning btn-sm">
		<i class="fa fa-edit"></i> Edit
	</a>
	<a href="{{ asset('admin/proyek') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Kembali
	</a>
</p>
<hr>

<div class="row">
	<div class="col-md-3">
		<!-- Profile Image -->
		<div class="card card-primary card-outline">
			<div class="card-body box-profile">
				<div class="text-center">
				<img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/upload/proyek/'.$gambar[0]->gambar) }}" alt="{{ $proyek->nama_proyek }}">
				</div>

				<h3 class="profile-username text-center">{{ $proyek->kode }}</h3>

				<p class="text-muted text-center">{{ ucwords($proyek->tipe) }}</p>

				<ul class="list-group list-group-unbordered mb-3">
				<li class="list-group-item">
					<b>{{ ucwords(strtolower($proyek->alamat)) }}</b>
				</li>
				<li class="list-group-item">
					<b>{{ ucwords(strtolower($proyek->nama_kecamatan)) }}, {{ ucwords(strtolower($proyek->nama_kabupaten)) }}, {{ ucwords(strtolower($proyek->nama_provinsi)) }}</b>
				</li>
				</ul>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->

	

    </div>
    <div class="col-md-9">
    	<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Detail proyek : {{ $proyek->kode }}</h3>
			</div>
				<!-- /.card-header -->
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th width="25%">Judul</th>
							<th>{{ $proyek->nama_proyek }}</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Tipe</td>
							<td>{{ ucwords($proyek->tipe) }}</td>
						</tr>
						<tr>
							<td>Luas Tanah</td>
							<td>{{ $proyek->lt }} m2</td>
						</tr>
						<tr>
							<td>Luas Bangunan</td>
							<td>{{ $proyek->lb }} m2</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>{{ $proyek->alamat }}</td>
						</tr>
						<tr>
							<td>Provinsi</td>
							<td>{{ $proyek->nama_provinsi }}</td>
						</tr>
						<tr>
							<td>Kabupaten</td>
							<td>{{ $proyek->nama_kabupaten }}</td>
						</tr>
						<tr>
							<td>Kecamatan</td>
							<td>{{ $proyek->nama_kecamatan }}</td>
						</tr>
						<tr>
							<td>Lama Pengerjaan</td>
							<td>{{ $proyek->lama_pengerjaan }} Hari</td>
						</tr>
						<tr>
							<td>Keywords di Google</td>
							<td>{{ $proyek->keywords }}</td>
						</tr>
						<tr>
							<td>Deskripsi lengkap</td>
							<td>{!! $proyek->isi !!}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
		<?php foreach($gambar as $img) { ?>
			<img class="img img-thumbnail img-fluid" width="80" src="{{ asset('assets/upload/proyek/'.$img->gambar) }}" alt="{{ $proyek->nama_proyek }}">
		<?php } ?>
    </div>
</div>