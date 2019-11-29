<!-- ================================================== VIEW ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
<div class="page">
	<div class="page-title blue">
		<h3>
			<?php echo $breadcrumb; ?>
		</h3>
		<p>Informasi Mengenai
			<?php echo $breadcrumb; ?>
		</p>
	</div>
	<div class="page-content container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h5 class="panel-title">View Data
							<?php echo $breadcrumb; ?>
						</h5>
					</div>
					<!-- ========== Flashdata ========== -->
					<?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
					<?php if ($this->session->flashdata('success')) { ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check sign"></i>
						<?php echo $this->session->flashdata('success'); ?>
					</div>
					<?php } else if ($this->session->flashdata('warning')) { ?>
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check sign"></i>
						<?php echo $this->session->flashdata('warning'); ?>
					</div>
					<?php } else { ?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-warning sign"></i>
						<?php echo $this->session->flashdata('error'); ?>
					</div>
					<?php } ?>
					<?php } ?>
					<!-- ========== End Flashdata ========== -->
					<div class="panel-body container-fluid table-detail">
						<div class="table-full table-view">
					<?php if ($admin->user_role === 'admin'){ ?> 
							<div class="navigation-btn">
								<form action="" method="post" id="form">
									<div class='row margin-bottom'>
										<div class='btn-search'>Cari Berdasarkan :</div>
										<div class='col-md-3 col-sm-12'>
											<div class='button-search'>
												<?php array_pilihan('cari', $berdasarkan, $cari);?>
											</div>
										</div>
										<div class='col-md-3 col-sm-12 select-search'>
											<div class="input-group">
												<input type="text" name="q" class="form-control" value="<?php echo $q;?>" />
												<span class="input-group-btn">
													<button type="submit" name="kirim" class="btn btn-primary" type="button">
														<i class="fa fa-search"></i>
													</button>
												</span>
											</div>
										</div>
									</div>
									<div class='btn-navigation'>
										<div class='pull-right'>
											<a class="btn btn-primary" href="<?php echo site_url();?>master/pegawai">
												<i class="fa fa-refresh"></i>
											</a>
										</div>
									</div>
								</form>
							</div>
									<?php } ?>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<th>No</th>
										<th>Nama Pegawai</th>
										<th>NIP</th>
										<th>Alamat</th>
										<th>Sekolah</th>
										<th>Jabatan</th>
										<th>Golongan</th>
										<th class="text-center">Aksi</th>
									</thead>
									<tbody>
										<?php 
									$i	= $page+1;
									$like_pegawai[$cari]			= $q;
									if ($admin->user_role === 'admin'){
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_pegawai('', 'pegawai_created', 'DESC', $batas, $page, '', $like_pegawai) as $row){
									?>
										<tr>
											<td>
												<?php echo $i; ?>
											</td>
											<td>
												<?php echo $row->pegawai_nama;?>
											</td>
											<td>
												<?php echo $row->pegawai_nip;?>
											</td>
											<td>
												<?php echo $row->pegawai_alamat;?>
											</td>
											<td>
												<?php echo $row->sekolah_nama;?>
											</td>
											<td>
												<?php echo $row->jabatan;?>
											</td>
											<td>
												<?php echo $row->golongan;?>
											</td>
											<td class="text-center action">
												<a class="btn-update" href="<?php echo site_url();?>master/pegawai/edit/<?php echo $row->pegawai_nip;?>">
													<i class="icon wb-pencil"></i>
												</a>
												<a class="btn-detail" href="<?php echo site_url();?>master/pegawai/detail/<?php echo $row->pegawai_nip;?>">
													<i class="icon wb-info"></i>
												</a>
												<a class="btn-delete" href="javascript:;" data-id="<?php echo $row->pegawai_nip;?>" data-toggle="modal" data-target="#modal-konfirmasi"
												title="<?php echo $row->pegawai_nama;?>">
													<i class="icon wb-trash"></i>
												</a>
											</td>
										</tr>
										<?php
										$i++;
									} 
								} else {
									?>
											<tr>
												<td class="text-center" colspan="9">Belum ada data!.</td>
											</tr>
											<?php } }?>
											
										<?php 
									$i	= $page+1;
									$like_pegawai[$cari]			= $q;
									$where_pegawai['pegawai_nip']			= $admin->username;
									if ($admin->user_role === 'user'){
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_pegawai('', 'pegawai_created', 'DESC', $batas, $page, $where_pegawai, $like_pegawai) as $row){
									?>
										<tr>
											<td>
												<?php echo $i; ?>
											</td>
											<td>
												<?php echo $row->pegawai_nama;?>
											</td>
											<td>
												<?php echo $row->pegawai_nip;?>
											</td>
											<td>
												<?php echo $row->pegawai_alamat;?>
											</td>
											<td>
												<?php echo $row->sekolah_nama;?>
											</td>
											<td>
												<?php echo $row->jabatan;?>
											</td>
											<td>
												<?php echo $row->golongan;?>
											</td>
											<td class="text-center action">
												<a class="btn-update" href="<?php echo site_url();?>master/pegawai/edit/<?php echo $row->pegawai_nip;?>">
													<i class="icon wb-pencil"></i>
												</a>
												<a class="btn-detail" href="<?php echo site_url();?>master/pegawai/detail/<?php echo $row->pegawai_nip;?>">
													<i class="icon wb-info"></i>
												</a>
												<?php if ($admin->user_role === 'admin') { ?>
												<a class="btn-delete" href="javascript:;" data-id="<?php echo $row->pegawai_nip;?>" data-toggle="modal" data-target="#modal-konfirmasi"
												title="<?php echo $row->pegawai_nama;?>">
													<i class="icon wb-trash"></i>
												</a>
												<?php } ?>
											</td>
										</tr>
										<?php
										$i++;
									} 
								} else {
									?>
											<tr>
												<td class="text-center" colspan="9">Belum ada data!.</td>
											</tr>
											<?php } }?>
									</tbody>
								</table>
							</div>
							<div class="wrapper">
								<div class="paging">
									<div id='pagination'>
										<div class='pagination-right'>
											<ul class="pagination">
												<?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'master/pegawai/view', $id=""); }?>
											</ul>
										</div>
									</div>
								</div>
								<div class="total">Total :
									<?php echo $jml_data;?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
									if ($admin->user_role === 'admin'){ ?>
	<a href="<?php echo site_url();?>master/pegawai/tambah">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-plus" aria-hidden="true"></i>
		</button>
	</a>
									<?php } ?>
</div>
<!-- ========== Modal Konfirmasi ========== -->
<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>

			<div class="modal-body" style="background:#d9534f;color:#fff">
				Apakah Anda yakin ingin menghapus data ini?
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-danger" id="hapus-pegawai">Ya</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
			</div>
		</div>
	</div>
</div>
<!-- ========== End Modal Konfirmasi ========== -->
<!-- ================================================== END VIEW ================================================== -->

<!-- ================================================== TAMBAH ================================================== -->
<?php } elseif ($action == 'tambah') { ?>
<div class="page">
	<div class="page-title blue">
		<h3>
			<?php echo $breadcrumb; ?>
		</h3>
		<p>Informasi Mengenai
			<?php echo $breadcrumb; ?>
		</p>
	</div>
	<div class="page-content container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah user</h5>
					</div>
					<div class="panel-body container-fluid">
						<form action="<?php echo site_url();?>master/pegawai/tambah" method="post" id="exampleStandardForm" autocomplete="off">
							<div class="form-group form-material">
								<label class="control-label" for="inputText">NIP Pegawai</label>
								<input type="text" class="form-control input-sm" id="pegawai_nip" name="pegawai_nip" placeholder="NIP Pegawai" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Pegawai Password</label>
								<input type="pegawai_password" class="form-control input-sm" id="pegawai_password" name="pegawai_password" placeholder="Pegawai Password" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Nama Pegawai</label>
								<input type="text" class="form-control input-sm" id="pegawai_nama" name="pegawai_nama" placeholder="Nama Pegawai" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Alamat Pegawai</label>
								<textarea type="text" class="form-control input-sm" id="pegawai_alamat" name="pegawai_alamat" placeholder="Alamat Sekolah" required/></textarea>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Sekolah</label>
								<select type="text" class="form-control input-sm" id="sekolah_id" name="sekolah_id" placeholder="Sekolah" required/>
								<option value=""></option>
								<?php 
									foreach ($this->ADM->grid_all_sekolah('', 'sekolah_created', 'DESC', 10000, '', '', '') as $row){
									?>
								<option value="<?php echo $row->sekolah_id;?>"><?php echo $row->sekolah_nama;?></option>
								<?php } ?>
								</select>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Jabatan</label>
								<select type="text" class="form-control input-sm" id="jabatan" name="jabatan" placeholder="Jabatan" required/>
								<option value="">Pilih Jabatan</option>
								<option value="Guru">Guru</option>
								<option value="Pegawai Sekolah">Pegawai Sekolah</option>
								</select>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Golongan</label>
								<select type="text" class="form-control input-sm" id="golongan" name="golongan" placeholder="Golongan" required/>
								<option value="">Pilih Golongan</option>
								<option value="I a-d">I a</option>
								<option value="I a-d">I b</option>
								<option value="I a-d">I c</option>
								<option value="I a-d">I d</option>
								<option value="II a-d">II a</option>
								<option value="II a-d">II b</option>
								<option value="II a-d">II c</option>
								<option value="II a-d">II d</option>
								<option value="III a-d">III a</option>
								<option value="III a-d">III b</option>
								<option value="III a-d">III c</option>
								<option value="III a-d">III d</option>
								<option value="IV a-d">IV a</option>
								<option value="IV a-d">IV b</option>
								<option value="IV a-d">IV c</option>
								<option value="IV a-d">IV d</option>
								<option value="IV a-d">IV e</option>
								</select>
							</div>
							<div class='button center'>
								<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
								<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>master/pegawai'"
								/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>master/pegawai">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-eye" aria-hidden="true"></i>
		</button>
	</a>
</div>
<!-- ================================================== END TAMBAH ================================================== -->

<!-- ================================================== EDIT ================================================== -->
<?php } elseif ($action == 'edit') { ?>
<div class="page">
	<div class="page-title blue">
		<h3>
			<?php echo $breadcrumb; ?>
		</h3>
		<p>Informasi Mengenai
			<?php echo $breadcrumb; ?>
		</p>
	</div>
	<div class="page-content container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h5 class="panel-title">Edit Pegawai</h5>
					</div>
					<div class="panel-body container-fluid">
						<form action="<?php echo site_url();?>master/pegawai/edit/<?php echo $pegawai_nip;?>" method="post" id="exampleStandardForm"
						autocomplete="off">
							<input type="hidden" name="pegawai_nip" value="<?php echo $pegawai_nip;?>" />
							<div class="form-group form-material">
								<label class="control-label" for="inputText">NIP Pegawai</label>
								<input type="text" value="<?php echo $pegawai_nip; ?>" class="form-control input-sm" id="pegawai_nip" name="user_role"
								placeholder="Masukan NIP Pegawai" value="<?php echo $pegawai_nip;?>" disabled required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Pegawai Password</label>
								<input type="pegawai_password" class="form-control input-sm" id="pegawai_password" name="pegawai_password" placeholder="Masukan Pegawai Password Bila diubah"
								/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Nama Pegawai</label>
								<input type="text" value="<?php echo $pegawai_nama; ?>" class="form-control input-sm" id="pegawai_nama" name="pegawai_nama" placeholder="Nama Pegawai"
								required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Alamat Pegawai</label>
								<textarea type="text" class="form-control input-sm" id="pegawai_alamat" name="pegawai_alamat" placeholder="Alamat Sekolah" required/><?php echo $pegawai_alamat; ?></textarea>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Sekolah</label>
								<select type="text" class="form-control input-sm" id="sekolah_id" name="sekolah_id" placeholder="Sekolah" required/>
								<option value="<?php echo $sekolah_id; ?>"><?php echo $sekolah_nama; ?></option>
								<?php 
									foreach ($this->ADM->grid_all_sekolah('', 'sekolah_created', 'DESC', 10000, '', '', '') as $row){
									?>
								<option value="<?php echo $row->sekolah_id;?>"><?php echo $row->sekolah_nama;?></option>
								<?php } ?>
								</select>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Jabatan</label>
								<select type="text" class="form-control input-sm" id="jabatan" name="jabatan" placeholder="Jabatan" required/>
								<option value="<?php echo $jabatan; ?>"><?php echo $jabatan; ?></option>
								<option value="Guru">Guru</option>
								<option value="Pegawai Sekolah">Pegawai Sekolah</option>
								</select>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Golongan</label>
								<select type="text" class="form-control input-sm" id="golongan" name="golongan" placeholder="Golongan" required/>
								<option value="<?php echo $golongan; ?>"><?php echo $golongan; ?></option>		<option value="I a-d">I a-d</option>
								<option value="II a-d">II a-d</option>
								<option value="III a-d">III a-d</option>
								<option value="IV a-d">IV a-d</option>
								</select>
							</div>
							<div class='button center'>
								<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
								<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>master/pegawai'"
								/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>master/pegawai">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-eye" aria-hidden="true"></i>
		</button>
	</a>
</div>
<!-- ================================================== END EDIT ================================================== -->

<!-- ================================================== DETAIL ================================================== -->
<?php } elseif ($action == 'detail') { ?>
<div class="page">
	<div class="page-title blue">
		<h3>
			<?php echo $breadcrumb; ?>
		</h3>
		<p>Informasi Mengenai
			<?php echo $breadcrumb; ?>
		</p>
	</div>
	<div class="page-content container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h5 class="panel-title">Detail
							<?php echo $breadcrumb; ?>
						</h5>
					</div>
					<div class="panel-body container-fluid table-detail">
						<div class="table-full table-detail">
							<div class="table-responsive">
								<table class="table table-hover">
									<tbody>
										<tr>
											<td class="title">
												<strong>NIP Pegawai</strong>
											</td>
											<td>:
												<strong>
													<?php echo $pegawai->pegawai_nip;?>
												</strong>
											</td>
										</tr>
										<tr>
											<td class="title" width="150">Nama Pegawai</td>
											<td>:
												<?php echo $pegawai->pegawai_nama;?>
											</td>
										</tr>
										<tr>
											<td class="title">Alamat Pegawai</td>
											<td>:
												<?php echo $pegawai->pegawai_alamat;?>
											</td>
										</tr>
										<tr>
											<td class="title">Nama Sekolah</td>
											<td>:
												<?php echo $pegawai->sekolah_nama;?>
											</td>
										</tr>
										<tr>
											<td class="title">Alamat Sekolah</td>
											<td>:
												<?php echo $pegawai->sekolah_alamat;?>
											</td>
										</tr>
										<tr>
											<td class="title">Jabatan</td>
											<td>:
												<?php echo $pegawai->jabatan;?>
											</td>
										</tr>
										<tr>
											<td class="title">Golongan</td>
											<td>:
												<?php echo $pegawai->golongan;?>
											</td>
										</tr>
										<tr>
											<td class="title">Dibuat</td>
											<td>:
												<?php echo dateIndo($pegawai->pegawai_created);?>
											</td>
										</tr>
										<tr>
											<td class="title">Terakhir di Ubah </td>
											<td>:
												<?php echo dateIndo($pegawai->pegawai_updated);?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>master/pegawai/">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-eye" aria-hidden="true"></i>
		</button>
	</a>
</div>
<?php }  ?>
<!-- ================================================== END DETAIL ================================================== -->
