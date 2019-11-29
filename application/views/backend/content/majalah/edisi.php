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
										<a class="btn btn-primary" href="<?php echo site_url();?>majalah/artikelpdf">
										<i class="fa fa-print"></i>
									</a>
											<a class="btn btn-primary" href="<?php echo site_url();?>majalah/edisi">
												<i class="fa fa-refresh"></i>
											</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<?php 
									$i	= $page+1;
									$like_edisi[$cari]			= $q;
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_edisi('', 'edisi_created', 'DESC', $batas, $page, '', $like_edisi) as $row){
									?>


			<div class="col-md-3">
				<div class="panel">
					<div class="" style="padding: 30px 10px 10px 10px; text-align: center">
						Edisi : <?php echo $row->edisi_nama;?><br>
						<?php echo $row->edisi_status;?>
					</div>
					<div class="text-center action" style="border-top: 1px solid #ddd;padding: 10px 0px;">
						
					<?php if ($admin->user_role === 'admin') { ?>
						<a class="btn-update" href="<?php echo site_url();?>majalah/edisi/edit/<?php echo $row->edisi_id;?>">
							Edit
						</a> |
					<?php } ?>
						<a class="btn-detail" href="<?php echo site_url();?>majalah/edisi/detail/<?php echo $row->edisi_id;?>">
							Detail Artikel
						</a>
					</div>
				</div>
			</div>

			<?php
				$i++;
				} 
				?>


				<div class="col-md-12">
					<div class="wrapper">
						<div class="paging">
							<div id='pagination'>
								<div class='pagination-right'>
									<ul class="pagination">
										<?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'majalah/edisi/view', $id=""); }?>
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
		<?php } else {
		?>
			<div class="col-md-12">
				<div class="panel">
					<div class="table-responsive">
						<table class="table table-hover">
							<tbody>
								<tr>
									<td class="text-center">Belum ada data!.</td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>

			<?php } ?>
		</div>
	</div>
</div>
					<?php if ($admin->user_role === 'admin') { ?>
<a href="<?php echo site_url();?>majalah/edisi/tambah">
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
				<a href="javascript:;" class="btn btn-danger" id="hapus-edisi">Ya</a>
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
						<h5 class="panel-title">Tambah Edisi</h5>
					</div>
					<div class="panel-body container-fluid">
						<form action="<?php echo site_url();?>majalah/edisi/tambah" method="post" id="exampleStandardForm" autocomplete="off">
							<div class="form-group form-material">
								<label class="control-label" for="inputText">ID Edisi</label>
								<input type="number" class="form-control input-sm" id="edisi_id" name="edisi_id" placeholder="ID Edisi" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Nama Edisi</label>
								<input type="text" class="form-control input-sm" id="edisi_nama" name="edisi_nama" placeholder="Nama Edisi" required/>
							</div>
							<div class="form-group form-material">
								<div class='button center'>
									<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
									<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>majalah/edisi'"
									/>
								</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<a href="<?php echo site_url();?>majalah/edisi">
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
							<h5 class="panel-title">Edit Edisi</h5>
						</div>
						<div class="panel-body container-fluid">
							<form action="<?php echo site_url();?>majalah/edisi/edit/<?php echo $edisi_id;?>" method="post" id="exampleStandardForm" autocomplete="off">
								<div class="form-group form-material">
									<label class="control-label" for="inputText">ID Edisi</label>
									<input type="text" value="<?php echo $edisi_id; ?>" class="form-control input-sm" id="edisi_id" name="edisi_id" placeholder="Masukan ID Edisi"
									value="<?php echo $edisi_id;?>" disabled required/>
								</div>
								<div class="form-group form-material">
									<label class="control-label" for="inputText">Nama Edisi</label>
									<input type="text" value="<?php echo $edisi_nama; ?>" class="form-control input-sm" id="edisi_nama" name="edisi_nama" placeholder="Masukan Nama Edisi"
									value="<?php echo $edisi_nama;?>" required/>
								</div>
								<div class="form-group form-material">
									<label class="control-label" for="inputText">Status</label>
									<select type="text" class="form-control input-sm" id="edisi_status" name="edisi_status" placeholder="Masukan Status Edisi" required/>
									<option value="<?php echo $edisi_status; ?>"><?php echo $edisi_status; ?></option>
									<option value="Open">Open</option>
									<option value="Close">Close</option>
									<select>
								</div>
								<div class='button center'>
									<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
									<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>majalah/edisi'"
									/>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a href="<?php echo site_url();?>majalah/edisi">
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
								<?php echo $breadcrumb; ?> <?php echo $edisi->edisi_nama;?>
							</h5>
						</div>

						<div class="panel-body container-fluid table-detail">
							<div class="table-full table-view">
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
											<a class="btn btn-primary" href="<?php echo site_url();?>majalah/edisi/detail/<?php echo $edisi->edisi_id;?>">
												<i class="fa fa-refresh"></i>
											</a>
										</div>
									</div>
								</form>
							</div>
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<th width=100>No</th>
											<th>Judul</th>
											<th>Tanggal</th>
											<th class="text-center action">Aksi</th>
										</thead>
										<tbody>
										<?php 
									$i	= 1;
									$like_artikel[$cari]			= $q;
									$where_artikel['a.artikel_approve'] = 1;
									$where_artikel['a.edisi_id'] = $edisi->edisi_id;
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_artikel('', 'artikel_created', 'DESC', $batas, '', $where_artikel, $like_artikel) as $row){
									?>
											<tr>
												<td>
													<?php echo $i; ?>
												</td>
												<td>
													<?php echo$row->artikel_judul;?>
												</td>
												<td>
													<?php echo dateIndo1($row->artikel_created);?>
												</td>
												<td class="text-center action">
													<a class="btn-update" href="<?php echo site_url();?>majalah/edisi/artikel/<?php echo $row->artikel_id;?>">
														<i class="icon wb-info"></i>
													</a>
													<a class="btn-detail" target="_blank" href="<?php echo site_url();?>/assets/files/artikel_dok/<?php echo $row->artikel_dok;?>">
														<i class="icon wb-print"></i>
													</a>
												</td>
											</tr>
											<?php
										$i++;
									} 
								} else {
									?>
												<tr>
													<td class="text-center" colspan="5">Artikel Edisi <?php echo $edisi->edisi_nama;?> kosong!.</td>
												</tr>
												<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<a href="<?php echo site_url();?>majalah/edisi/view">
	<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
		<i class="icon wb-eye" aria-hidden="true"></i>
	</button>
</a>
<!-- ================================================== END DETAIL ================================================== -->

<!-- ================================================== ARTIKEL ================================================== -->
<?php } elseif ($action == 'artikel') { ?>
<div class="page">
	<div class="page-title blue">
		<h3>
			Artikel
		</h3>
		<p>Informasi Mengenai
		Artikel
		</p>
	</div>
	<div class="page-content container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h5 class="panel-title">Detail
						Artikel
						</h5>
					</div>
					<div class="panel-body container-fluid table-detail">
						<div class="table-full table-detail">
							<div class="table-responsive">
								<table class="table table-hover">
									<tbody>
										<tr>
											<td width="200" class="title">
												<strong>Judul Artikel</strong>
											</td>
											<td>:
												<?php echo $artikel->artikel_judul;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Tanggal Artikel</strong>
											</td>
											<td>:
												<?php echo dateIndo1($artikel->artikel_created);?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Pengirim</strong>
											</td>
											<td>:
												<?php echo $artikel->pegawai_nama;?><br>
												: Jabatan - <?php echo $artikel->jabatan;?><br>
												: Golongan - <?php echo $artikel->golongan;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Edisi</strong>
											</td>
											<td>:
												<?php echo $artikel->edisi_nama;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Artikel</strong>
											</td>
											<td>:
												<a target="_blank" href="<?php echo site_url();?>/assets/files/artikel_dok/<?php echo $artikel->artikel_dok;?>"><?php echo $artikel->artikel_dok;?></a>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Terakhir Diubah</strong>
											</td>
											<td>:
												<?php echo dateIndo($artikel->artikel_updated);?>
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
	<a href="<?php echo site_url();?>majalah/edisi">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-eye" aria-hidden="true"></i>
		</button>
	</a>
</div>
<?php }  ?>
<!-- ================================================== END ARTIKEL ================================================== -->