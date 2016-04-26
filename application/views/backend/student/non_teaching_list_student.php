
<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          
                <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:12px; letter-spacing:0.5;" id="table_export">
                	<thead>
                   
                        <tr>
                        <td colspan="4" style="height:15px;"></td>
                        </tr>
                        <tr bgcolor="#000000"><td colspan="4" style="font-size:1.2em; text-align:center; font-weight:600;  color:#FFF;">Non-Teaching Staff Listing</td></tr>
                		
                        <tr bgcolor="#2092D0">
                        <th style="color:#FFF; border-right:1px solid #EEE;  font-size:10px; text-align:center;">Full Name</th>	
                        	<th style="color:#FFF; border-right:1px solid #EEE;  font-size:10px; text-align:center;">Designation</th>  	
                    		<th style="color:#FFF; border-right:1px solid #EEE;  font-size:10px; text-align:center;">Phone</th> 
                    		<th style="color:#FFF; border-right:1px solid #EEE;  font-size:10px; text-align:center;">Email</th> 
                    		
						</tr>
                       
					</thead>
                    <tbody>
                    	<?php 
						$non_tech = $this->db->get_where('teacher', array('teaching_type' => 2))->result_array();
						$count = 1;
					
						foreach($non_tech as $rowtech):	
					
						?>
                        <tr>
                          
							<td align="center" style="font-size:10px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;"><?php echo $rowtech['name'];?></td>
							<td align="center" style="font-size:10px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $rowtech['designation'];?></td>
							<td align="center" style="font-size:10px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $rowtech['phone'];?></td>
                            <td align="center" style="font-size:10px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $rowtech['email'];?></td>
                            
                        </tr>
                        
                         <?php endforeach;?>
                      
						
                    </tbody>
                    	
                </table>
               <?php  if(count($non_tech) > 0){ ?>
                 <tr><td >  <?php echo form_open(base_url() . 'index.php?student/sidebar_non_teaching_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
									<div class="form-group">
										
									</div>	
									<div class="form-group">
										<div class="col-md-12 text-center">
											<button type="submit" class="btn btn-info">Export To Pdf</button>
										</div>
									</div> 
								</form></td></tr>	
                <?php } ?>
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>



