<head>
    <title>Nota</title>
   <!--  <script src="<?php echo base_url();?>js/jquery-1.8.0.js"></script>
    <script src="<?php echo base_url();?>js/jquery-1.8.0.js"></script>
    <link type="text/css" href="<?php echo base_url();?>css/blitzer/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.23.custom.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/jquery-easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/jquery-easyui/themes/icon.css">
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.easyui.min.js"></script> -->
    
</head>

<?php
ini_set("memory_limit","20000M");
//$mpdf=new mPDF('c','A4','','',15,15,10,5,5,5); 
$mpdf=new mPDF('c','A7-L','','',7,7,2,2,5,5); 

$mpdf->mirrorMargins = 10;  // Use different Odd/Even headers and footers and mirror margins

$html='
<style>
table.gridtable {
    font-family: Times New Roman;
    font-size:25px;
    color:#000000;
    border-width: 0px;
    border-collapse: collapse;
    
}
table.gridtableheader {
    font-family: Times New Roman;
    font-size:25px;
    color:#000000;
    border-width: 0px;
    border-collapse: collapse;
    
}
table.gridtable th {
    border-width: 1px;
    padding: 2px;
    border-style: solid;
    border-color: #666666;
    background-color: #dedede;
    font-weight:bold;
}
table.gridtable td {
    border-width: 1px;
    padding: 1px;
    border-style: solid;
    border-color: #666666;
    background-color: #ffffff;
}

table.gridtable2 {
    margin-top:20px;
    font-family: Times New Roman;
    font-size:10px;
    color:#333333;
    border-width: 1px;
    border-color: #666666;
    border-collapse: collapse;
    
}
table.gridtable2 th {
    border-width: 1px;
    padding: 2px;
    border-style: solid;
    border-color: #666666;
    background-color: #dedede;
    font-weight:bold;
}
table.gridtable2 td {
    border-width: 0px;
    padding: 0px;
    font-size:8px;
    border-style: solid;
    border-color: #666666;
    background-color: #ffffff;
}

</style>
        
 <table width="1100px" class="gridtableheader" style="text-align: center;">
   <tr >
      <td width="19%"><img width="55px" style="padding-right:20px;"  src="'.base_url().'assets/img/klinik/'.$klinik->foto.'" class="user-image" alt="User Image"></td>l
      <td width="82%" style="text-align: center;">
         <p style="text-align: center;"><strong>'.strtoupper($klinik->nama).'</strong></p>
         <p style="text-align: center;"><strong>'.$klinik->alamat.'</strong></p>
        
        
      </td>
        
   </tr>
</table>
<hr />

          
       
          <table width="1100px" class="gridtableheader" border="0">
            
              <tr><td>Tanggal Periksa :</td><td>'.$pemeriksaan->waktu_pemeriksaan.'</td></tr>
              <tr><td>No.RM :</td><td>'.$pemeriksaan->no_rm.'</td></tr>
              <tr><td>Nama :</td><td>'.$pemeriksaan->nama_pasien.'</td></tr>
           
             
            
          </table>     
         <table width="1100px" class="gridtableheader" border="0">
            
              <tr>
               <td><strong> TARIF</strong></td>
               <td></td>
               <td></td>
              </tr>
            <tr>
              
              <th></th>
            
             
            </tr>
            </thead>
            <tbody>';
           
              
               foreach ($tindakan->result() as $key => $value) { 
                 $html .='<tr>
                    <td></td>
                    <td>'.$value->item.'</td>
                    <td></td>
                    <td></td>
                    <td align="right">'.number_format($value->harga).'</td>
                    
                    
          </tr>';
        }
          $html.='<tr>             
             
               <td><strong>OBAT</strong></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
          </tr>';
            
              
            foreach ($obat->result() as $key => $value) {
                 $html .= '<tr>
            <td></td>
            <td>'.$value->item.'</td>
            <td>'.$value->jumlah.'</td>
            <td align="right">'.number_format($value->harga).'</td>
            <td align="right">'.number_format($value->subtotal).'</td>
            
          </tr>';}
          $html.='<tr>             
             
               <td><strong>OBAT RACIK</strong></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
          </tr>';
            
              
            foreach ($racikan->result() as $key => $value) {
                 $html .= '<tr>
            <td></td>
            <td>'.$value->item.'</td>
            <td></td>
            <td></td>
            <td align="right">'.number_format($value->subtotal).'</td>
            
          </tr>';}
          $html.='<tr>
             <td colspan="4" align="right"><strong>Total</strong></td>
         
             <td align="right"><strong>'.number_format($pemeriksaan->total).'</strong></td>
           </tr>   
           <tr>
             <td colspan="4" align="right"><strong>Bayar</strong></td>
            
             <td align="right"><strong>'.number_format($pemeriksaan->bayar).'</strong></td>
           </tr> 
            <tr>
             <td colspan="4" align="right"><strong>Kembalian</strong></td>
             
             <td align="right"><strong>'.number_format($pemeriksaan->kembalian).'</strong></td>
           </tr>
           
            </tbody>
          </table>
       ';
       $mpdf->WriteHTML($html);
//$mpdf->SetHTMLFooter($footer);
$mpdf->SetHTMLFooter($footer,'E');

//$mpdf->Output();
$mpdf->Output('filename.pdf','D');
exit;


?>