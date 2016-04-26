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
                        <tr bgcolor="#000000"><td colspan="4" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Holiday Listing</td></tr>
                        
                		
                        <tr bgcolor="#2092D0">
                    		<th align="center" style="width:25%;color:#FFF; border-right:1px solid #EEE;padding:6px 0px; text-align:center">No</th>
                    		<th align="center" style="width:25%;color:#FFF; border-right:1px solid #EEE; padding:6px 0px;  text-align:center">Holiday Name</th>
                            <th align="center" style="width:25%;color:#FFF; border-right:1px solid #EEE; padding:6px 0px;  text-align:center">Detail</th>
                    		<th align="center" style="width:25%;color:#FFF; border-right:1px solid #EEE; padding:6px 0px;  text-align:center">Date</th>  
						</tr>
                       
					</thead>
                    <tbody>
                    	<?php 
						$this->db->order_by('holiday_date','asc');
						$holiday = $this->db->get('holiday')->result_array();
						
						$count = 1;
						
						foreach($holiday as $row):?>
                        <tr>
                            <td align="center" style="width:25%;font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $count++;?></td>							
							<td align="center" style="width:25%;font-size:12px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"><?php echo $row['holiday_name'];?></td>
                            <td align="center" style="width:25%;font-size:12px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"><?php echo $row['holiday_detail'];?></td>
							<td align="center" style="width:25%;font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo date("F d, Y",strtotime( $row['holiday_date']));?></td>							
                        </tr>
                         <?php endforeach;
						?>
                    </tbody>
                    
                   
                    	
                </table>
                	<?php 
					if(count($holiday) > 0){
				 echo form_open(base_url() . 'index.php?admin/holiday_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
							
							<div class="form-group">
								<div class="col-md-12 text-center">
									<button type="submit" class="btn btn-info">Export To Pdf</button>
								</div>
							</div> 
						</form>		
                                <?php } ?>
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>



