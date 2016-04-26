<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
                <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                    <tr>
                        <td valign="middle" align="left";><div><img src="<?php echo base_url().'/uploads/system_image/1.jpg'; ?>" width="80" height="70" /></div></td>
                    	<td valign="middle" align="center"><div style="font-size:1.8em; text-align:center; font-weight:600; color:#000;">Page Inc School</div></td>
                        <td valign="bottom" align="right" style="font-size:12px;"><div>Date : <?php echo date('jS M Y'); ?> </div></td>	 
						</tr>
                        <tr><td colspan="4" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="4" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Parent Listing</td></tr>
                		
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; padding:6px 0px;" width="20%">No</th>
							<th style="color:#FFF; padding:6px 0px;" width="20%">Student Name</th>
                    		<th style="color:#FFF; padding:6px 0px;" width="20%">Father Name</th>
                    		<th style="color:#FFF; padding:6px 0px;" width="20%">Parent Phone</th> 
							<th style="color:#FFF; padding:6px 0px;" width="20%">Parent Email</th> 	
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						if(isset($parent_class) && !empty($parent_class)){
						//die($parent_class);	
						$array = array("student.class_id"=>$parent_class);
						$this->db->select('student.name as Name,parent.name as Father_Name,parent.phone as Parent_Phone,parent.email as Parent_Email');
						$this->db->from('class');
						$this->db->join('parent', 'parent.class_id = class.name_numeric');
						$this->db->join('student', 'student.class_id = class.name_numeric');
						$this->db->where($array);
						$this->db->group_by('parent.student_id');
						
						$query = $this->db->get();
						$parents =$query->result();
						
						}
						if(isset($parent_stand) && !empty($parent_stand)){
					
						$this->db->select('student.name as Name,parent.name as Father_Name,parent.phone as Parent_Phone,parent.email as Parent_Email');
						$this->db->from('class');
						$this->db->join('parent', 'parent.class_id = class.name_numeric');
						$this->db->join('student', 'student.class_id = class.name_numeric');
						$this->db->where("student.class_id LIKE '%$parent_stand%'");
						$this->db->group_by('parent.student_id'); 
						
						$query = $this->db->get();
						//echo $this->db->last_query();
						//die;
						$parents =$query->result();
						
						}
						if(isset($option) && $option == 3){
							
						$this->db->select('student.name as Name,parent.name as Father_Name,parent.phone as Parent_Phone,parent.email as Parent_Email');
						$this->db->from('class');
						$this->db->join('parent', 'parent.class_id = class.name_numeric');
						$this->db->join('student', 'student.class_id = class.name_numeric');
						$this->db->group_by('parent.student_id'); 	
						
						$query = $this->db->get();
						$parents =$query->result();
						}
						
						$count = 1;
						if(count($parents) > 0){
						foreach($parents as $att_row):						
						?>
                        <tr>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="10%"><?php echo $count++;?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" width="25%" ><?php echo $att_row->Name;?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" width="25%" ><?php echo $att_row->Father_Name;?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" width="25%" ><?php echo $att_row->Parent_Phone;?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:0px solid #EEE; border-right:0px solid #EEE;" width="25%"><?php echo $att_row->Parent_Email;?></td>
                        </tr>
                        <?php 						
						endforeach;  
						}
						else
						{
						?>
						<tr> 
							<td align="left" style="font-size:11px;padding:6px 0px;" colspan="4">*No record found..</td>
						</tr>	
						<?php 
						}
						?>
                    </tbody>
                    
                     <tr>
                        <td valign="middle" align="right" colspan="5" style="padding:12px 0px; border-top:2px solid #2092D0; font-size:10px;"><span style="color:#2092D0;">Generated By : </span> <?php echo $this->session->userdata('name');?> </td>
                        </tr>
                    	
                </table>
                
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>



