<p class="text-right">
	<a href="{{ asset('admin/property/edit/'.$property->id_property) }}" class="btn btn-warning btn-sm">
		<i class="fa fa-edit"></i> Edit
	</a>
	<a href="{{ asset('admin/property') }}" class="btn btn-success btn-sm">
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
				<img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/upload/property/'.$gambar[0]->gambar) }}" alt="{{ $property->nama_property }}">
				</div>

				<h3 class="profile-username text-center">{{ $property->kode }}</h3>

				<p class="text-muted text-center">{{ ucwords($property->tipe) }}, {{ ucwords($property->nama_kategori_property) }}</p>

				<ul class="list-group list-group-unbordered mb-3">
				<li class="list-group-item">
					<b>{{ ucwords(strtolower($property->alamat)) }}</b>
				</li>
				<li class="list-group-item">
					<b>{{ ucwords(strtolower($property->nama_kecamatan)) }}, {{ ucwords(strtolower($property->nama_kabupaten)) }}, {{ ucwords(strtolower($property->nama_provinsi)) }}</b>
				</li>
				</ul>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->

		<!-- Profile Image -->
		<div class="card card-primary">
			<div class="card-header">
				<h4 class="card-title">Staff Agen</h4>
			</div>
			<div class="card-body box-profile">
				<div class="text-center">
				<img class="profile-user-img img-fluid img-circle" src="{{ ($staff->gambar!="") ? asset('assets/upload/staff/thumbs/'.$staff->gambar) : asset('assets/upload/image/thumbs/'.website('icon')) }}" alt="{{ $staff->nama_staff }}">
				</div>

				<h3 class="profile-username text-center">{{ $staff->nama_staff }}</h3>

				<p class="text-muted text-center">{{ $staff->jabatan }}</p>
			</div>
			<!-- /.card-body -->
    	</div>
    	<!-- /.card -->

    </div>
    <div class="col-md-9">
    	<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Detail Property : {{ $property->kode }}</h3>
			</div>
				<!-- /.card-header -->
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th width="25%">Judul</th>
							<th>{{ $property->nama_property }}</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Tipe</td>
							<td>{{ ucwords($property->tipe) }}</td>
						</tr>
						<tr>
							<td>Kategori Property</td>
							<td>{{ $property->nama_kategori_property }}</td>
						</tr>
						<tr>
							<td>Luas Tanah</td>
							<td>{{ $property->lt }} m2</td>
						</tr>
						<tr>
							<td>Luas Bangunan</td>
							<td>{{ $property->lb }} m2</td>
						</tr>
						<tr>
							<td>Kamar Tidur</td>
							<td>{{ $property->kamar_tidur }}</td>
						</tr>
						<tr>
							<td>Kamar Mandi</td>
							<td>{{ $property->kamar_mandi }}</td>
						</tr>
						<tr>
							<td>Lantai</td>
							<td>{{ $property->lantai }}</td>
						</tr>
						<tr>
							<td>Nama Agen</td>
							<td>{{ $property->nama_staff }}</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>{{ $property->alamat }}</td>
						</tr>
						<tr>
							<td>Provinsi</td>
							<td>{{ $property->nama_provinsi }}</td>
						</tr>
						<tr>
							<td>Kabupaten</td>
							<td>{{ $property->nama_kabupaten }}</td>
						</tr>
						<tr>
							<td>Kecamatan</td>
							<td>{{ $property->nama_kecamatan }}</td>
						</tr>
						<tr>
							<td>Harga</td>
							<td>Rp {{ number_format($property->harga) }}</td>
						</tr>
						<tr>
							<td>Keywords di Google</td>
							<td>{{ $property->keywords }}</td>
						</tr>
						<tr>
							<td>Deskripsi lengkap</td>
							<td>{!! $property->isi !!}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
		<?php foreach($gambar as $img) { ?>
			<img class="img img-thumbnail img-fluid" width="80" src="{{ asset('assets/upload/property/'.$img->gambar) }}" alt="{{ $property->nama_property }}">
		<?php } ?>
    </div>
</div>