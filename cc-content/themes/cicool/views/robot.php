       


<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<!-- Content Header (Page header) -->
 <table id="example" class="table table-striped" border="1" style="width:100%;">
   <thead>
        <td style="width: 48pt; height: 15.0pt;" width="64" height="20">id_chart_opd</td>
        <td style="width: 48pt;" width="64">kode_opd</td>
<td style="width: 48pt;" width="64">tahun</td>
<td style="width: 48pt;" width="64">bulan</td>
<td style="width: 48pt;" width="64">sirup</td>
<td style="width: 48pt;" width="64">proses</td>
<td style="width: 48pt;" width="64">kontrak</td>
<td style="width: 48pt;" width="64">selesai</td>
<td style="width: 48pt;" width="64">metode_pengadaan</td>
<td style="width: 48pt;" width="64">tgl_input</td>
    </thead>
    <tbody>
        
        <?php $kode=$_GET['kode']; ?>
<?php $x=1;foreach($list_instansi as $r){ ?>

 <?php

$curl = curl_init();
$kdsatker=$r->kd_satker_str;
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://ekontrak.semarangkota.go.id/api/ekontrak/angkaekontrak?opd='.$kdsatker.'&year=2022',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'x-api-key: FD59804809A3DFD300C1E49F6E6FD23D',
    'Cookie: AuLCaFgU=50dc1c8a2c75d3d9e74e52e27cf1dc425c6a1e17'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;

 $data = json_decode($response,true);
 ?>
 
 <?php 
 if($kode=='1'){ 
 $array=($data['data']['tender']);
 
  } 
  if($kode=='2'){ 
 $array=($data['data']['nontender']);
 
  } 
  if($kode=='3'){ 
 $array=($data['data']['epurchasing']);
 
  } 
  
  
  ?>

            
 
 
 
<tr>
    <td><?php echo $x; ?></td>
    <td>
        <?php echo $r->kd_satker_str; ?>
    </td>
     <td>2022</td>
     <td>6</td>
     <?php
      foreach ($array as $key)
              {
                if($key['jenis']=='Sirup'){  
               $paketsirup= $key['paket'];  
               
                }
                if($key['jenis']=='Proses'){  
               $paketproses= $key['paket'];  
                }
                if($key['jenis']=='Kontrak'){  
               $paketkontrak= $key['paket'];  
                }
                 if($key['jenis']=='Selesai'){  
               $paketselesai= $key['paket'];  
                }
                
                
              }    
                
                
              
     ?>
     <td><?php echo $paketsirup; ?></td>
      <td><?php echo $paketproses; ?></td>
       <td><?php echo $paketkontrak; ?></td>
        <td><?php echo $paketselesai; ?></td>
    
     <td><?php echo $kode; ?></td>
     <td><?php echo date('Y-m-d H:i:s'); ?></td>
</tr>

<?php $x++;} ?>
</tbody>
</table>


  <script src='https://code.jquery.com/jquery-1.12.3.js'></script>
<script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js'></script>
<script src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js'></script>
<script src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js'></script>
<script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js'></script>
<script >
	$(document).ready(function() {
    $('#example').DataTable( {
        "pageLength": 100,
    "paging": true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excelFlash', 'excel', 'pdf', 'print',{
            text: 'Reload',
            
            action: function ( e, dt, node, config ) {
                dt.ajax.reload();
            }
        }
        ]
    } );
} );
</script>