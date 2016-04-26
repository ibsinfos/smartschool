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
                   
                        <tr><td colspan="11" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="3" style="font-size:1.2em; text-align:center; font-weight:600;  color:#FFF;">Notification Listing</td></tr>
                		
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; " width="5%">No</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; " width="25%">Notification Name</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; " width="70%">Notice</th>  
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						$noticeboard = $this->db->get('noticeboard')->result_array();
						$count = 1;
						
						foreach($noticeboard as $row):?>
                        <tr>
                            <td valign="middle" align="center"  style="font-size:13px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="5%"><?php echo $count++;?></td>							
							<td valign="middle" align="center" style="font-size:13px;  border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" width="25%"><?php echo $row['notice_name'];?></td>
							<td valign="middle" align="left" style="font-size:13px; line-height:18px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="70%"><?php echo $row['notice'];?></td>							
                        </tr>
                        <?php endforeach;
						
						?>
                    </tbody>
				
                </table>
                <?php 
				if(count($noticeboard) > 0){
				echo form_open(base_url() . 'index.php?admin/notification_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
									
									<div class="form-group">
										<div class="col-md-12 text-center">
											<button type="submit" class="btn btn-info">Export To Pdf</button>
										</div>
									</div> 
								</form>
                                <?php  }?>	
                
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>



