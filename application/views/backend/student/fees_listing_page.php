
<style>
.modal-dialog{   width:50%; }
</style>
<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          
                 <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                    
                        <tr><td colspan="7" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="7" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Fees Listing</td></tr>
                		
                        <tr bgcolor="#2092D0">
                    		<th  style="color:#FFF; border-right:1px solid #EEE; text-align:center; ">No</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE;  text-align:center;" >Date</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; ">Student</th> 
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; ">Total</th>  
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; " >Paid</th> 
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; " >MOP</th>  
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; " >Description</th>  
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						$student_id = $this->session->userdata('student_id');
						$invoices =   $this->db->get_where('invoice',array("student_id"=>$student_id))->result_array();
						$count = 1;
						
						foreach($invoices as $row):						
						?>
                        <tr>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $count++;?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo @$this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['amount'];?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['amount_paid'];?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['payment_method'];?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['description'];?></td>
                        </tr>
                         <?php endforeach;?>
						
                              
                                
                    </tbody>
					
                </table>
                 <?php echo form_open(base_url() . 'index.php?student/fees_list_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
									<div class="form-group">
										
									</div>	
									<div class="form-group">
										<div class="col-md-12 text-center">
											<button type="submit" class="btn btn-info">Export To Pdf</button>
										</div>
									</div> 
								</form>
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>



