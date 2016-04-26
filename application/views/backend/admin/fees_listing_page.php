
<style>
.modal-dialog{   width:50%; }
</style>
<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
        <div id="attendance_sub_2" >
        
                           <form action="" method="post" id="standard_wise" class="form-horizontal validate" >
                         
                          <div class="form-group"> 
                          <select name="standard" style="width:30%;" class="form-control" 
                           data-validate="required" id="standard" data-message-required="<?php echo get_phrase('value_required');?>" style="display: none">
                          <option value="">Select Standard</option>
                          <?php for($h=1; $h<=12; $h++){ ?>
                           <option value="<?php echo $h;?>"><?php echo $h;?></option>
                          <?php }  ?> 			
					</select>
                          </div>
                           
                          <div class="form-group">
                          	<div class="row">
										<div class="col-md-12">
											<button type="submit" class="btn btn-info">Submit</button>
										</div>
                          	</div>
						  </div> 
                          </form>
                          </div>
            <!----TABLE LISTING STARTS-->
           <?php if(isset($standard)){ ?>
          
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          
                 <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                    
                        <tr><td colspan="8" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="8" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Fees Listing</td></tr>                        
                		
                        <tr bgcolor="#2092D0">
                    		<th  style="color:#FFF; border-right:1px solid #EEE; text-align:center; ">No</th>
                            <th style="color:#FFF; border-right:1px solid #EEE; text-align:center; ">Student</th> 
                    		<th style="color:#FFF; border-right:1px solid #EEE;  text-align:center;" >Class</th>
                    	 	<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; ">Amount</th>  
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; " >Outstanding</th> 
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; " >Fees Type</th>  
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; " >Status</th> 
                            <th style="color:#FFF; border-right:1px solid #EEE; text-align:center; " >Date</th> 
                             
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						//echo $standard;
						
						$invoices =   $this->db->get_where('invoice',array("class"=>intval($standard)))->result_array();
						//echo $this->db->last_query();
						$count = 1;
						
						foreach($invoices as $row):						
						?>
                        <tr>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $count++;?></td>
							
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo @$this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['class'];?></td>
						
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['amount_paid'];?></td>
                            	<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['outstanding'];?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['invoice_type'];?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['status'];?></td>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo date("F d, Y",strtotime($row['paid_date']));?></td>
                        </tr>
                         <?php endforeach;?>
						
                              
                                
                    </tbody>
					
                </table>
                 <?php // echo form_open(base_url() . 'index.php?admin/fees_list_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
                 <form action="<?php echo base_url() . 'index.php?admin/fees_list_pdf'; ?>" method="post">
									<div class="form-group">
										<input type="hidden" name="standard" value="<?php echo $standard; ?>" />
									</div>	
									<div class="form-group">
										<div class="col-md-12 text-center">
											<button type="submit" class="btn btn-info">Export To Pdf</button>
										</div>
									</div> 
								</form>
			</div>
            <?php } ?>
          
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>



<script type="text/javascript">
$(document).ready(function() {
	
	$("#standard_wise").submit(function(){
		var standard = $("#standard").val();
		var data = "standard="+standard;
		showAjaxModal('<?php echo base_url();?>index.php?modal/fees_listing/fees_listing_page/',data);
				return false;
	});
    
});
</script>


