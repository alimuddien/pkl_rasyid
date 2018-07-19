<!DOCTYPE html>
<html>
<head>
	<title>Medique - Login</title>
	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css">
	<style type="text/css">
		body {
			background-image: url("img/back_login.jpg");
			background-size: cover;
			background-position: center;
			background-attachment: fixed;
			font-family: sans-serif;
			background-repeat: no-repeat;
			color: black;
		}
	</style>
</head>
<body>

	<header>

	</header>

	<nav>
		<ul class="nav">
		  	<li class="nav-item"><a href="<?php echo base_url('home')?>">Home</a></li>
				<li class="nav-item"><a href="<?php echo base_url('logout')?>">Logout</a></li>
				<li class="nav-item"><a href="<?php echo base_url('getlistlayanan')?>">Layanan</a></li>
				<li class="nav-item"><a href="<?php echo base_url('getlistjamkes')?>">Jamkes</a></li>
		</ul>
	</nav>
	
	<!-- PENCARIAN - FILTER FASKES -->
		<div class="col-md-3">
			<div class="tab">
				<button class="tablinks" onclick="openType(event, 'FFaskes')">Filter (Untuk Faskes)</button>
				<div id="FFaskes" class="tabcontent">
					<form method="POST" action="<?php echo base_url('home')?>">
						<input type="text" placeholder="Pencarian Fasilitas Kesehatan..." name="search">
						<button type="submit" name="submitsearch">Cari</button>
					<h3>Kota</h3>
						<select class="form-control" id="faskk" name="faskota">
							<option value="0" disabled selected>Pilih Kota</option>
							<?php
								for ($i = 0; $i < count($faskes_kota); $i++){
									echo "<option value=\"".$faskes_kota[$i]['intIDKota']."\">".$faskes_kota[$i]['txtKota']."</option>";
								}
							?>
						</select>
					<h3>Klinik</h3>
						<select class="form-control" id="faskk" name="fasklinik">
							<option value="0" disabled selected>Pilih Klinik</option>
							<?php
								for ($i = 0; $i < count($faskes_klinik); $i++){
									echo "<option value=\"".$faskes_klinik[$i]['indtIDJenisPelayanan']."\">".$faskes_klinik[$i]['txtJenisPelayanan']."</option>";
								}
							?>
						</select>
					<h3>Jaminan Kesehatan</h3>
						<input type="checkbox" name="jk" value="0">BPJS Kesehatan<br>
						<input type="checkbox" name="jk" value="1">Askes<br>
						<input type="checkbox" name="jk" value="2">Axa<br>
						<input type="checkbox" name="jk" value="3">Prudential<br>
						<br>
						<button type="submit" name="submitfilter">Filter</button>
				</form>
				</div>
			</div>
		</div>

		<div class="col-md-9">
			<table id="tabelfaskes">
			<?php
				for ($i = 0; $i < count($data_faskes); $i++){
					echo "<table border=\"0\">";
					// if ()
					// {
						echo "<tr>";
							echo "<td>";
								echo "<img src=\" ".$data_faskes[$i]['imgAvatar']."\">";
							echo "</td>";
							echo "<td>";
								echo "<h3>".$data_faskes[$i]['txtPartnerName']."</h3>";
								echo "<b>".$data_faskes[$i]['txtAlamat'].", ".$data_faskes[$i]['txtKota'].", ".$data_faskes[$i]['txtProvinsi'].", Indonesia</b><br>";
								for ($j = 0; $j < count($list_layanan[$i]); $j++){
									echo $list_layanan[$i][$j]['txtJenisPelayanan'];
									if ($j+1 < count($list_layanan[$i])){
											echo ", ";
									}
								}
								echo "<br>";
								for ($j = 0; $j < count($list_jamkes[$i]); $j++){
									echo $list_jamkes[$i][$j]['txtJenisJamKes'];
									if ($j+1 < count($list_jamkes[$i])){
											echo ", ";
									}
								}
							echo "</td>";
						echo "</tr>";
					echo "</table>";
				}
					?>
				</div>
			<!-- END -->

</body>
</html>
