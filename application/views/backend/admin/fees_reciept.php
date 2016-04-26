<style>
.modal-dialog{   width:50%; }
</style>

<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="printableArea">
             <?php $invoice = $this->db->get_where("invoice",array("class"=>$class_id,"student_id"=>$student))->result_array(); 
			 if(!empty($invoice))
			 {
			 ?>

          <table class="table datatable table"  id="table_export">
                	<thead>
                     
                        <tr bgcolor="#000000"><td colspan="11" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Student Fees Reciept</td></tr>
                        
                   </thead>
                   <tbody>
                  
                   	<tr><th>Student Name : </th><th><?php echo $invoice[0]['student_name']; ?></th></tr>
                    <tr><th>Class : </th><th><?php echo $invoice[0]['class']; ?></th></tr>
                    <tr><th>Paid Amount : </th><th><?php echo $invoice[0]['amount_paid']; ?></th></tr>
                    <tr><th>Fees Type : </th><th><?php echo $invoice[0]['invoice_type']; ?></th></tr>
                    <tr><th>Outstanding : </th><th><?php echo $invoice[0]['outstanding']; ?></th></tr>
                    <tr><th>Status : </th><th><?php echo $invoice[0]['status']; ?></th></tr>
                    <tr><th>Date : </th><th><?php echo date("F d, Y",strtotime( $invoice[0]['paid_date']));
					?></th><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><th></th><th>Signature : </th></tr>
                    
                   </tbody>
             </table>
             
           <?php }
		   else{ ?>
			  <h4 style="text-align:center;">
            No Record Found
</h4>
			 <?php   } ?>  
                
			</div>
            
            <?php if(!empty($invoice))
			 { ?>
            <table>
            <tr><td><input type="button" onclick="printDiv('printableArea')" value="print a Reciept!" /></td></tr>
            </table>
            <?php } ?>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>


                                    
                                
<script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
	var newcontents = '<table width="100%"><tr><td width="33.33%"  valign="middle" align="left";><div><?php  $image = base_url().'/uploads/system_image/1.jpg'; ?><img src="<?php echo $image; ?>" width="80" height="70" /></div></td><td width="33.33%" valign="middle" align="center"><div style="font-size:1.8em; text-align:center; font-weight:600; color:#000;">Page Inc School</div></td><td width="33.33%" valign="bottom" align="right" style="font-size:12px;"><div>Date : <?php echo date('jS M Y'); ?> </div></td></tr></table>';
								
	var printablecontents = newcontents+printContents;					
     document.body.innerHTML = printablecontents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>


