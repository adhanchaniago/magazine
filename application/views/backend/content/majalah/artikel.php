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
								<div class='btn-search'>Cari Artikel per Bulan :</div>
								<div class='col-md-3 col-sm-12'>
									<div class='button-search'>
										<select type="text" value="<?php echo $month ?>" class="form-control" id="month" name="month" placeholder="Bulan"
										required/>
										<option value="01">Januari</option>
						<option value="02">Februari</option>
						<option value="03">Maret</option>
						<option value="04">April</option>
						<option value="05">Mei</option>
						<option value="06">Juni</option>
						<option value="07">Juli</option>
						<option value="08">Agustus</option>
						<option value="09">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
						</select>
									</div>
								</div>
								<div class='col-md-3 col-sm-12 select-search'>
									<select type="text" value="<?php echo $year ?>" class="form-control" id="year" name="year" placeholder="Tahun"
									required/>
									<option value="2000">2000</option>
						<option value="2001">2001</option>
						<option value="2002">2002</option>
						<option value="2003">2003</option>
						<option value="2004">2004</option>
						<option value="2005">2005</option>
						<option value="2006">2006</option>
						<option value="2007">2007</option>
						<option value="2008">2008</option>
						<option value="2009">2009</option>
						<option value="2010">2010</option>
						<option value="2011">2011</option>
						<option value="2012">2012</option>
						<option value="2013">2013</option>
						<option value="2014">2014</option>
						<option value="2015">2015</option>
						<option value="2016">2016</option>
						<option value="2017">2017</option>
						<option value="2018">2018</option>
						<option value="2019">2019</option>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						</select>
								</div>
							</div>
							<div class='btn-navigation'>
								<div class='pull-right'>

									<button type="submit" name="kirim" class="btn btn-primary" type="button">
									<i class="fa fa-search"></i>
									</button>
									<a class="btn btn-primary" href="<?php echo site_url();?>majalah/artikel">
										<i class="fa fa-refresh"></i>
									</a>
									<?php 	
									if ($admin->user_role === 'admin'){ if ($jml_data > 0){if ($this->input->post('year')) {  ?>
									<a class="btn btn-primary" href="<?php echo site_url();?>majalah/artikelpdf/<?php echo $this->input->post('year'); ?>/<?php echo $this->input->post('month'); ?>">
										<i class="fa fa-print"></i>
									</a>
									<?php } else {?>
										<a class="btn btn-primary" href="<?php echo site_url();?>majalah/artikelpdf">
										<i class="fa fa-print"></i>
									</a>
									<?php } } }  ?>
								</div>
							</div>
						</form>
					</div>
					<?php if ($this->input->post('month')) {?>
					<div style="color: red; margin-bottom: 20px;" class="text-center">Pencarian Bulan : <?php echo $this->input->post('month'); ?> - Tahun : <?php echo $this->input->post('year'); ?></div>
					<?php } ?>
							<?php if ($this->input->post('artikel_bulan')) {?>
							<div style="color: red; margin-bottom: 20px;" class="text-center">Pencarian dari <?php echo dateIndo1($this->input->post('artikel_bulan').' 00:00:00'); ?> - <?php echo dateIndo1($this->input->post('artikel_tahun').' 00:00:00'); ?></div>
							<?php } ?>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<th width=100>#</th>
										<th>Tanggal</th>
										<th>Judul</th>
										<th>Pengirim</th>
										<th>Edisi</th>
										<th>Status</th>
										<th class="text-center">Aksi</th>
									</thead>
									<tbody>
										
									<?php 
									$i	= $page+1;
									
									if ($this->input->post('month')) {
										$month = $this->input->post('month');
										$year = $this->input->post('year');
										}

								if ($jml_data > 0){
									if ($admin->user_role === 'admin'){
									foreach ($this->ADM->grid_all_artikel2('', 'artikel_created', 'DESC', $batas, $page, $month, $year, '', '') as $row){
									?>
										<tr>
											<td>
												<?php echo $i; ?>
											</td>
											<td>
												<?php echo dateIndo1($row->artikel_created); ?>
											</td>
											<td>
												<?php echo $row->artikel_judul; ?>
											</td>
											<td>
												<a href="<?php echo site_url();?>master/pegawai/detail/<?php echo $row->pegawai_nip;?>"><?php echo $row->pegawai_nama; ?></a>
											</td>
											<td>
												<?php echo $row->edisi_nama; ?>
											</td>
											<td>
											<?php if ($row->artikel_approve == 0) { ?> Belum di Approve <?php } else { ?> Sudah di Approve <?php } ?>
											</td>
											<td class="text-center action">
												<?php if ($admin->username === $row->pegawai_nip) { ?>
												<a class="btn-update" href="<?php echo site_url();?>majalah/artikel/edit/<?php echo $row->artikel_id;?>">
													<i class="icon wb-pencil"></i>
												</a>
												<?php } ?>
												<a class="btn-detail" href="<?php echo site_url();?>majalah/artikel/detail/<?php echo $row->artikel_id;?>">
													<i class="icon wb-info"></i>
												</a>
												<?php if ($admin->user_role === 'admin') { ?>
												<?php if ($row->artikel_approve == 0) { ?>
												<a class="btn-delete" href="javascript:;" data-id="<?php echo $row->artikel_id;?>" data-toggle="modal" data-target="#modal-approve">
												<i class="icon wb-check"></i>
												</a>
												<?php } ?>
												<a class="btn-delete" href="javascript:;" data-id="<?php echo $row->artikel_id;?>" data-toggle="modal" data-target="#modal-konfirmasi"
												title="<?php echo $row->artikel_id;?>">
													<i class="icon wb-trash"></i>
												</a>
												<?php } ?>
												<a class="btn-detail" target="_blank" href="<?php echo site_url();?>/assets/files/artikel_dok/<?php echo $row->artikel_dok;?>">
													<i class="icon wb-print"></i>
												</a>
											</td>
										</tr>
										<?php
										$i++;
									} 
								} } else {
									?>
											<?php }   ?>

											<?php 
									$i	= $page+1;
									
									if ($this->input->post('month')) {
										$month = $this->input->post('month');
										$year = $this->input->post('year');
										}

								if ($jml_data > 0){
									if ($admin->user_role === 'user' || $admin->user_role === 'kepegum'){
										if ($admin->user_role === 'user'){
										$where['a.pegawai_nip']= $admin->username;
										} else {
										$where['a.artikel_approve']= 1;
										}
									foreach ($this->ADM->grid_all_artikel2('', 'artikel_created', 'DESC', $batas, $page, $month, $year, $where, '') as $row){
									?>
										<tr>
											<td>
												<?php echo $i; ?>
											</td>
											<td>
												<?php echo dateIndo1($row->artikel_created); ?>
											</td>
											<td>
												<?php echo $row->artikel_judul; ?>
											</td>
											<td>
												<a href="<?php echo site_url();?>master/pegawai/detail/<?php echo $row->pegawai_nip;?>"><?php echo $row->pegawai_nama; ?></a>
											</td>
											<td>
												<?php echo $row->edisi_nama; ?>
											</td>
											<td>
											<?php if ($row->artikel_approve == 0) { ?> Belum di Approve <?php } else { ?> Sudah di Approve <?php } ?>
											</td>
											<td class="text-center action">
												<?php if ($admin->username === $row->pegawai_nip) { if ($row->artikel_approve == 0) {
													?>
												<a class="btn-update" href="<?php echo site_url();?>majalah/artikel/edit/<?php echo $row->artikel_id;?>">
													<i class="icon wb-pencil"></i>
												</a>
												<?php }} ?>
												<a class="btn-detail" href="<?php echo site_url();?>majalah/artikel/detail/<?php echo $row->artikel_id;?>">
													<i class="icon wb-info"></i>
												</a>
												<?php if ($admin->username === $row->pegawai_nip) { ?>
												<!--<a class="btn-delete" href="javascript:;" data-id="<?php echo $row->artikel_id;?>" data-toggle="modal" data-target="#modal-konfirmasi"
												title="<?php echo $row->artikel_id;?>">
													<i class="icon wb-trash"></i>
												</a>-->
												<?php } ?>
											</td>
										</tr>
										<?php
										$i++;
									} 
								} } else {
									?>
											<tr>
												<td class="text-center" colspan="9">Belum ada data!.</td>
											</tr>
											<?php }   ?>
									</tbody>
								</table>
							</div>
							
							<div class="wrapper">
								<div class="paging">
									<div id='pagination'>
										<div class='pagination-right'>
											<ul class="pagination">
												<?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'majalah/artikel/view', $id=""); }?>
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
	<?php if ($admin->user_role === 'user') { ?>
	<a href="<?php echo site_url();?>majalah/artikel/tambah">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-plus" aria-hidden="true"></i>
		</button>
	</a>
	<?php } ?>
</div>
<!-- ========== Modal Konfirmasi ========== -->
<div id="modal-approve" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>

			<div class="modal-body" style="background:green;color:#fff">
				Apakah Anda yakin ingin dismiss data ini?
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-success" id="approve-artikel">Ya</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
			</div>
		</div>
	</div>
</div>
<!-- ========== End Modal Konfirmasi ========== -->
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
				<a href="javascript:;" class="btn btn-danger" id="hapus-artikel">Ya</a>
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
						<h5 class="panel-title">Tambah Artikel</h5>
					</div>
					<div class="panel-body container-fluid">
						<form action="<?php echo site_url();?>majalah/artikel/tambah" method="post" enctype="multipart/form-data" id="exampleStandardForm" autocomplete="off">
							<div class="form-group form-material">
								<label class="control-label" for="inputText">ID Artikel</label>
								<input type="number" class="form-control input-sm" id="artikel_id" name="artikel_id" placeholder="ID Artikel" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Judul Artikel</label>
								<input type="text" class="form-control input-sm" placeholder="Judul Artikel" id="artikel_judul" name="artikel_judul" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Edisi</label>
								<select type="text" class="form-control input-sm" id="edisi_id" name="edisi_id" placeholder="Edisi" required/>
								<option value=""></option>

								<?php 
								$where_edisi['edisi_status'] = "Open";
									foreach ($this->ADM->grid_all_edisi('', 'edisi_created', 'DESC', 10000, '', $where_edisi, '') as $row){
									?>
								<option value="<?php echo $row->edisi_id;?>">
									<?php echo $row->edisi_nama;?>
								</option>
								<?php } ?>
								</select>
							</div>
							<div style="margin-bottom: 20px !important;margin-top: 20px !important;font-weight:500">
								<label class="control-label" for="inputText" style="font-weight:500">Artikel</label>
								<input type="file" class="form-control btn-sm input-sm" size="100" name="artikel_dok" id="artikel_dok">
							</div>
							<div class='button center'>
								<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
								<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>majalah/artikel'"
								/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>majalah/artikel">
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
						<h5 class="panel-title">Edit Artikel</h5>
					</div>
					<div class="panel-body container-fluid">
						<form enctype="multipart/form-data" action="<?php echo site_url();?>majalah/artikel/edit/<?php echo $artikel_id;?>" method="post"
						id="exampleStandardForm" autocomplete="off">
						<div class="form-group form-material">
						<label class="control-label" for="inputText">Judul Artikel</label>
						<input type="text" class="form-control input-sm" placeholder="Judul Artikel" id="artikel_judul" name="artikel_judul" value="<?php echo $artikel_judul;?>" required/>
					</div>
					<div class="form-group form-material">
						<label class="control-label" for="inputText">Edisi</label>
						<select type="text" class="form-control input-sm" id="edisi_id" name="edisi_id" placeholder="Edisi" required/>
						<option value="<?php echo $edisi_id;?>"><?php echo $edisi_nama;?></option>

						<?php 
								$where_edisi['edisi_status'] = "Open";
							foreach ($this->ADM->grid_all_edisi('', 'edisi_created', 'DESC', 10000, '', $where_edisi, '') as $row){
							?>
						<option value="<?php echo $row->edisi_id;?>">
							<?php echo $row->edisi_nama;?>
						</option>
						<?php } ?>
						</select>
					</div>
							<?php if ($artikel_dok){?>
							<div for="artikel_dok" class="control-label" style="font-weight:500">Artikel</div>
							<?php echo $artikel_dok;?>
							<div style="margin-bottom: 20px !important;margin-top: 20px !important;font-weight:500">
								<label class="control-label" for="inputText" style="font-weight:500">Ganti Artikel</label>
								<input type="file" class="form-control btn-sm input-sm" size="100" name="artikel_dok" id="artikel_dok">
							</div>
							<?php } else {?>
							<div style="margin-bottom: 20px !important;margin-top: 20px !important">
								<label class="control-label" for="inputText" style="font-weight:500">Artikel</label>
								<input type="file" class="form-control btn-sm input-sm" size="100" name="artikel_dok" id="artikel_dok">
							</div>
							<?php } ?>
							<div class='button center'>
								<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
								<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>majalah/artikel'"
								/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>majalah/artikel">
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
												<a target="_blank" href="<?php echo site_url();?>assets/files/artikel_dok/<?php echo $artikel->artikel_dok;?>"><?php echo $artikel->artikel_dok;?></a>
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
	<a href="<?php echo site_url();?>majalah/artikel">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-eye" aria-hidden="true"></i>
		</button>
	</a>
</div>
<?php }  ?>
<!-- ================================================== END DETAIL ================================================== -->
<script src="<?php echo base_url();?>templates/backend/js/highchart.js"></script>
					<script src="<?php echo base_url();?>templates/backend/js/exporting.js"></script>