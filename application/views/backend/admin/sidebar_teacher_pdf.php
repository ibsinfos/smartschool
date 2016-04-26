

<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          
                 <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                    <tr>
                            <td colspan="6">
                                <table width="100%">
                                    <tr>
                                        <td width="33.33%"  valign="middle" align="left";><div><?php  $image = base_url().'/uploads/system_image/1.jpg'; ?>
                                        <img src="<?php echo $image; ?>" width="80" height="70" /></div></td>
                                        <td width="33.33%" valign="middle" align="center"><div style="font-size:1.8em; text-align:center; font-weight:600; color:#000;">Page Inc School</div></td>
                                        <td width="33.33%" valign="bottom" align="right" style="font-size:12px;"><div>Date : <?php echo date('jS M Y'); ?> </div></td>     
                                    </tr>
                                </table>
                            </td>
                    </tr>
                       <tr><td colspan="6" style="height:15px;"></td></tr>
                		<tr bgcolor="#000000"><td colspan="6" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Teachers</td></tr>
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF;padding:6px 2px; text-align:center;border-top:1px solid #eee;" width="6%">No</th>
                    		<th style="color:#FFF;padding:6px 2px; text-align:center;border-top:1px solid #eee;" width="20%">Teacher Name</th>
                    		<th style="color:#FFF;padding:6px 2px; text-align:center;border-top:1px solid #eee;" width="10%">Class</th>
                            <th style="color:#FFF;padding:6px 2px; text-align:center;border-top:1px solid #eee;" width="24%">Subject</th> 							
                            <th style="color:#FFF;padding:6px 2px; text-align:center;border-top:1px solid #eee;" width="20%">Phone</th> 							
                            <th style="color:#FFF;padding:6px 2px; text-align:center;border-top:1px solid #eee;" width="20%">Email</th> 
						</tr>
					</thead>
                    <tbody>
                    		<?php 
						
						
					
					$teacher = $this->db->get_where("teacher",array("teaching_type"=>1))->result_array();
					$count = 1;
					if(!empty($teacher))
					{
					foreach($teacher as $rowteacher):
					    $this->db->join('teacher', 'teacher.teacher_id=teacher_class_association.teacher_id');
						$this->db->where("teacher.teacher_id",$rowteacher['teacher_id']);
    					$class = $this->db->get("teacher_class_association")->result_array();
						//echo $this->db->last_query(); die;
						//print_r($class);
						
						foreach($class as $row_class):
						$class_id[] = $row_class['class_id'];
						
						endforeach;
						if(!empty($class_id))
						{
						
						$all_class = implode(',',$class_id);
						}
						else{
						$all_class = '';
							}
						$this->db->select('subject.name');
						 $this->db->join('teacher', 'teacher.teacher_id=subject.teacher_id');
						$this->db->where("teacher.teacher_id",$rowteacher['teacher_id']);
    					$subject = $this->db->get("subject")->result_array();
						
						foreach($subject as $row_sub):
							$subjects[] = $row_sub['name'];
							
						endforeach;
						if(!empty($subjects))
						{
						$all_sub = implode(',',$subjects);
						}
						else{
							$all_sub = '';
							}
						
						
						
							//$classe = implode(',',$classes);
							
							?>
                          <tr>
                        <td align="center" style="font-size:11px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="6%"><?php echo $count; 
						$count++;?></td>
                            <td align="center" style="font-size:11px;padding:6px 2px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="20%"><?php echo $rowteacher['name'];?></td>
                            <td align="center" style="font-size:11px;padding:6px 2px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="10%"><?php echo $all_class;?></td>
                              <td align="center" style="font-size:11px;padding:6px 2px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="24%"><?php echo  $all_sub; ?></td>
                               <td align="center" style="font-size:11px;padding:6px 2px;  border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="20%"><?php echo $rowteacher['phone'];?></td>
                              <td align="center" style="font-size:11px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;" width="20%"><?php echo  $rowteacher['email']; ?></td>
                           
							
                        </tr>
                        <?php 
						$all_class = '';
						
						$class_id = '';
						$all_sub = '';
						$subjects = '';
						endforeach; ?>
                        <?php 
					}else{
						?>	
						<tr><td align="left" style="font-size:13px; line-height:18px;" colspan="3">*No record found..</td></tr>
						<?php 
					}
						?>
                    </tbody>
					<tr>
                        <td valign="middle" align="right" colspan="6" style="padding:10px 2px; font-size:9px;border-top:2px solid #2092D0;"><span style="color:#2092D0;">Generated By : </span> <?php echo $this->session->userdata('name');?> </td> 
                        </tr>
                </table>
                
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>



