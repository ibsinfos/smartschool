<style>
.modal-dialog{ width:50%; }
.group_Listing_det{ width:100%; }
.group_Listing_det .title{ font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:30px; display:block; text-align:center; font-weight:600; color:#FFF; background:#000; width:100%;  } 
/*.group_Listing_det .table_data{height: 400px; overflow: auto; }*/
.group_Listing_det .table_data table{  }
.mar20top{margin-top: 20px;}

.group_Listing_det .table_data .group_list_name{width: 120px; word-wrap: break-word; box-sizing: border-box; text-align: left;}
.group_Listing_det .table_data .group_list_user_type{width: 405px; word-wrap: break-word; box-sizing: border-box; text-align: left;}


</style>

<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active group_Listing_det" id="list">

          
          		<div class="table_data">
          			<div class="table-responsive">
		                <table class="table datatable" border="0" cellpadding="0" cellspacing="0" style=" border:1px solid #EEE; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5; width:100%; box-sizing:border-box; " id="table_export">
		                	<thead>  
                        <tr bgcolor="#000000">
                            <td colspan="3" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Group Listing </td>
                        </tr>
                                               		                	        		
		                        <tr bgcolor="#2092D0">
		                    		<th align="center" style="color:#FFF; background:#2092D0; border-right:1px solid #EEE; text-align:center; width:5%;border-top:1px solid #eee;">No</th>
		                    		<th align="center" style="color:#FFF; background:#2092D0; border-right:1px solid #EEE; text-align:center; width:25%;border-top:1px solid #eee;">Group name</th>
		                    		<th align="center" style="color:#FFF; background:#2092D0; border-right:1px solid #EEE; text-align:center; width:70%;border-top:1px solid #eee;">Assigned Modules</th>  
								</tr>
							</thead>
		                    <tbody>
		                    	<?php 
								$group = $this->db->get('group')->result_array();
								$count = 1;
							
								foreach($group as $row):	
								
									if($row['user_type'] == 1){								
								
										$u_type  = 'Teacher';
										
										
									}elseif($row['user_type'] == 2){
										$u_type  = 'Student';
									}elseif($row['user_type'] == 3){
										$u_type  = 'Non-Teaching';
									}elseif($row['user_type'] == 4){
										$u_type  = 'Parent';
									}
									$modules = $this->db->get_where("assign_module",array("group_id"=>$row['user_type']))->result_array();
								
									$module_id = $modules[0]['module_id'];
									$mod = explode(",",$module_id);
									foreach($mod as $modu):
									
									$getmod = $this->db->get_where("modules",array("module_id"=>$modu))->result_array();
									
									$get[]  = $getmod[0]['module_name'];
									
									endforeach;
									$all_modules = implode(",",$get);
								
							
									
									
									if($row['group_id']!='1' && $row['group_id']!='2')
									{
								?>
		                        <tr>
		                            <td align="center" style="width:5%; border-right:1px solid #EEE;"><?php echo $count++;?></td>
									<td align="center" style="width:25%; border-right:1px solid #EEE;"> <div style="width: 120px; word-wrap: break-word; box-sizing: border-box; text-align: left;" class="group_list_name"> <?php echo $row['group_name'];?></td>
									<td align="center" style="width:70%; border-right:1px solid #EEE;"> <div style="width: 405px; word-wrap: break-word; box-sizing: border-box; text-align: left;" class="group_list_user_type"> <?php echo $all_modules;?> </div> </td>
		                        </tr>
		                        <?php 		
									}
									$get = '';
									$all_modules = '';
									
								endforeach; 
								?>
		                    </tbody>
		                </table>
          			</div>
          		</div>
                <?php 
				if(count($group) > 0){
				echo form_open(base_url() . 'index.php?admin/group_list_pdf' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
									
									<div class="form-group">
										<div class="col-md-12 text-center mar20top">
											<button type="submit" class="btn btn-info">Export To Pdf</button>
										</div>
									</div> 
								</form>
                                
                                <?php } ?>	
			</div>
            <!--TABLE LISTING ENDS--->
		</div>
	</div>
</div>



