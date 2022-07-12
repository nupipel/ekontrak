<style>
    @media print {
  .hidden-print {
    display: none !important;
  }
}
</style>

<?php

    $this->db = $this->load->database('bappeda', true);
    $tahun=$_GET['tahun'];
$skpd=$_GET['skpd'];
$tahap=$_GET['tahap'];
    
  if (empty($skpd)) { $skpd = 0;}
  if (empty($tahun)) { $tahun = 0;}
  if (empty($tahap)) { $tahap = 0;}
  
  
?>





				<form id="saru2" method="get" action="/web/strukturapbdskpd/"  class="hidden-print">
					<div class="form-group">
						<label for="tahun">TAMPIL</label>
						<select name="tahun" id="tahun" class="custom-select " style="width:100px;"> 
						<option value="0">..Pilih..</option>
						<option value="2021" <?=($tahun == '2021') ? " selected " :"";?>>2021 </option>
						<option value="2022" <?=($tahun == '2022') ? " selected " :"";?>>2022</option>
						<option value="2023" <?=($tahun == '2023') ? " selected " :"";?>>2023</option>
						<option value="2024" <?=($tahun == '2024') ? " selected " :"";?>>2024</option>
						<option value="2025" <?=($tahun == '2025') ? " selected " :"";?>>2025</option>
						<option value="2026" <?=($tahun == '2026') ? " selected " :"";?>>2026</option>
						</select> 
						<label for="tahap">TAHAPAN</label>
						<select name="tahap" id="tahap" class="custom-select " style="width:100px;"> 
						<option value="0">..Pilih..</option>
						<option value="0" <?=($tahap == '0') ? " selected " :"";?>>Induk </option>
						<option value="1" <?=($tahap == '1') ? " selected " :"";?>>Perubahan</option>
						</select> 						
						<label for="skpd">SKPD</label>
						<select name="skpd" id="skpd" class="custom-select " style="width:200px;"> 
						<option value="0">..Pilih..</option>
						<?php
						  $nskpd = $this->db->query("select * from data_unit where id_unit=id_skpd and status='br' order by kode_skpd asc")->result();
						  foreach ($nskpd as $s) {
							  $slej = ($s->id_skpd == $skpd) ? " selected " : "";
							  echo '<option value="'.$s->id_skpd.'" '.$slej.'>'.$s->nama_skpd.'</option>';
						  }
						?>
						</select> 						
					    <input type="submit"  value="Ok Pilih" class="btn btn-success">
					</div>	
					
					
					<a href="#" onclick="window.print();return false;" class="btn btn-primary" /><i class="fa fa-print"></i> Cetak</a>
				</form>
				
				
<div align="center" id="loadingbar"></div>
<br>
<div class="table-responsive">
<?php



   echo '<table class="table table-striped">
		<thead>
		  <tr><th>Kode </th>
		  <th>Uraian</th>
		  <th>Anggaran</th></tr>
		</thead>
		<tbody>';
		$akund = $this->db->query("select * from akun_baru where length(kode_akun) <= 9 ")->result();
		$arkun = array();
		foreach ($akund as $ak)  {$arkun[$ak->kode_akun] = $ak->nama_akun;}
		$tbl = ($tahap == 0) ? "data_rka" : "data_rka_perubahan";
		$belanja = $this->db->query("SELECT SUBSTRING(kode_akun, 1,6) as kode_akun, SUM(rincian) as angp FROM $tbl  WHERE tahun='$tahun' and id_skpd='$skpd' and rincian > 0 GROUP BY SUBSTRING(kode_akun, 1,6) ")->result();
		$arb = $arb1 = array();
		foreach ($belanja as $p) { 
				if (empty($arb[substr($p->kode_akun,0,1)])) { $arb[substr($p->kode_akun,0,1)]= 0;}
				if (empty($arb1[substr($p->kode_akun,0,3)])) { $arb1[substr($p->kode_akun,0,3)]= 0;}
				$arb[substr($p->kode_akun,0,1)] += $p->angp;
				$arb1[substr($p->kode_akun,0,3)] += $p->angp;
		}
		$nbe = ''; $nbe0 = '';
		foreach ($belanja as $p) {
			if ($nbe0 != substr($p->kode_akun,0,1)) {
			echo '<tr style="font-weight:bold">';
			echo '<td>'.substr($p->kode_akun,0,1).'</td>';
			echo '<td>'.$arkun[substr($p->kode_akun,0,1)].'</td>';
			echo '<td class="text-right">'.@number_format($arb[substr($p->kode_akun,0,1)],0,',','.').'</td>';
			echo '</tr>';	
			}				
			if ($nbe != substr($p->kode_akun,0,3)) {
			echo '<tr style="font-weight:bold">';
			echo '<td>'.substr($p->kode_akun,0,3).'</td>';
			echo '<td>'.$arkun[substr($p->kode_akun,0,3)].'</td>';
			echo '<td class="text-right">'.@number_format($arb1[substr($p->kode_akun,0,3)],0,',','.').'</td>';
			echo '</tr>';	
			}			
			echo '<tr>';
			echo '<td>'.$p->kode_akun.'</td>';
			echo '<td>'.$arkun[$p->kode_akun].'</td>';
			echo '<td class="text-right">'.@number_format($p->angp,0,',','.').'</td>';
			echo '</tr>';
			$nbe = substr($p->kode_akun,0,3);
			$nbe0 = substr($p->kode_akun,0,1);
		}
echo '</tbody></table>';		
?>	
</div>
</div>
<script>
// $(document).ready(function(){	

//     $("#saru2").on("submit",function(e){
// 		   e.preventDefault();
// 		   var skpd = $("#skpd").val();
// 		   var tahun = $("#tahun").val();
// 		   var tahap = $("#tahap").val();
// 			$("#loadingbar").html('<div align="center" class="loader">Loading...</div>');		   
// 		   $.get('<?=site_url('/web/strukturapbdskpd/');?>',{
// 				content : "<?=$page;?>",
// 				modul : '<?=$modul;?>',
// 				skpd : skpd,
// 				tahun : tahun,
// 				tahap : tahap,
// 			}, 
// 			function(html){
// 				$("#main_content").html(html);
// 			});
// 	  });	
// });	  
</script>		
		

