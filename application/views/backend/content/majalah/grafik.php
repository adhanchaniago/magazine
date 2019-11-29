
<script src="<?php echo base_url();?>templates/backend/js/highchart.js"></script>
					<script src="<?php echo base_url();?>templates/backend/js/exporting.js"></script>
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
								<div class='btn-search'>Grafik Artikel Tahun :</div>
								<div class='col-md-6 col-sm-12'>
									<select type="text" value="<?php echo $year ?>" class="form-control" id="year" name="year" placeholder="Tahun"
									required>
									<option value="<?php echo $year ?>"><?php echo $year ?></option>
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
									<a class="btn btn-primary" href="<?php echo site_url();?>majalah/grafik">
										<i class="fa fa-refresh"></i>
									</a>
								</div>
							</div>
						</form>
					</div>
					<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<script>
	Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
		<?php 
		$dates =  date('Y-m-d H:i:s');
		if ($this->input->post('year')) {
		$tahuns = $this->input->post('year');
	} else {
		$tahuns = substr($dates,0,4);
	}
		?>
        text: 'Laporan Total Artikel Per Bulan Tahun <?php echo $tahuns; ?>'
    },
    subtitle: {
        text: 'Statistik Total Artikel'
    },
    xAxis: {
        categories: [
			'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Artikel'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} pcs</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Bulan',
        data: [
			<?php 
									$where_artikel['a.artikel_approve'] = 1;
			$januari = 0;
			$februari = 0;
			$maret = 0;
			$april = 0;
			$mei = 0;
			$juni = 0;
			$juli = 0;
			$agustus = 0;
			$september = 0;
			$oktober = 0;
			$november = 0;
			$desember = 0;
			foreach ($this->ADM->grid_all_artikel('*', 'artikel_id', 'DESC', 1000, '', $where_artikel, '') as $row){ 
				
		$bulan = substr($row->artikel_created,5,2);
		$tahun = substr($row->artikel_created,0,4);
		
		if ($this->input->post('year')) {
			$tahuns = $this->input->post('year');
		} else {
			$tahuns = substr($dates,0,4);
		}

		if ($tahuns === $tahun && $bulan === '01') {
			$januari += 1;
		}
		if ($tahuns === $tahun && $bulan === '02') {
			$februari += 1;
		}
		if ($tahuns === $tahun && $bulan === '03') {
			$maret += 1;
		}
		if ($tahuns === $tahun && $bulan === '04') {
			$april += 1;
		}
		if ($tahuns === $tahun && $bulan === '05') {
			$mei += 1;
		}
		if ($tahuns === $tahun && $bulan === '06') {
			$juni += 1;
		}
		if ($tahuns === $tahun && $bulan === '07') {
			$juli += 1;
		}
		if ($tahuns === $tahun && $bulan === '08') {
			$agustus += 1;
		}
		if ($tahuns === $tahun && $bulan === '09') {
			$september += 1;
		}
		if ($tahuns === $tahun && $bulan === '10') {
			$oktober += 1;
		}
		if ($tahuns === $tahun && $bulan === '11') {
			$november += 1;
		}
		if ($tahuns === $tahun && $bulan === '12') {
			$desember += 1;
		}
		?>
		<?php } ?>
			<?php echo $januari ?>,
			<?php echo $februari ?>,
			<?php echo $maret ?>,
			<?php echo $april ?>,
			<?php echo $mei ?>,
			<?php echo $juni ?>,
			<?php echo $juli ?>,
			<?php echo $agustus ?>,
			<?php echo $september ?>,
			<?php echo $oktober ?>,
			<?php echo $november ?>,
			<?php echo $desember ?>
		]

    }]
});
</script>

					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
</div>
<!-- ================================================== END VIEW ================================================== -->
<?php }  ?>
<!-- ================================================== END DETAIL ================================================== -->