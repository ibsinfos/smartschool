<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          
                 <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                    <tr>
                       <td valign="middle" align="left";><div><?php  $image = base_url().'/uploads/system_image/1.jpg'; ?>
						
						
                        <img src="<?php echo $image; ?>" width="80" height="70" /></div></td>
                    	<td valign="middle" align="center"><div style="font-size:1.8em; text-align:center; font-weight:600; color:#000;">Page Inc School</div></td>
                        <td valign="bottom" align="right" style="font-size:12px;"><div>Date : <?php echo date('jS M Y'); ?> </div></td>	 
						</tr>
                        <tr><td colspan="7" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="7" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Exam Listing</td></tr>
                		
                        <tr bgcolor="#2092D0">
                    		<th style="color:#FFF; padding:6px 6px;" >No</th>
                    		<th style="color:#FFF; padding:6px 6px;">Exam</th>
                    		<th style="color:#FFF; padding:6px 6px;" >Standard</th> 
                    		<th style="color:#FFF; padding:6px 6px;">Subject</th>  
                    		<th style="color:#FFF; padding:6px 6px;">Date</th> 
                    		<th style="color:#FFF; padding:6px 6px;">Day</th>  
                    		<th style="color:#FFF; padding:6px 6px;">Time</th>  
						</tr>
					</thead>
                    <tbody>
                    	<?php 
						$array = array("exam.exam_id"=>$exam_name);
						$this->db->select('exam.name as exam_name,class.name_numeric,subject.name as sub_name,exam.date,exam.time_start,exam.time_end');
						$this->db->from('exam');
						$this->db->join('class', 'class.name_numeric = exam.class_id');
						//$this->db->join('subject', 'subject.subject_id = exam.subject_id');
						$this->db->join('subject', 'subject.class_id = exam.class_id');
						$this->db->where($array);
						//$this->db->group_by('exam.class_id');
						
						$query = $this->db->get();
						
						//echo $this->db->last_query();
						//die;						
						
						$examlists =$query->result();
						$count = 1;
						if(count($examlists) > 0){
						foreach($examlists as $row):						
						?>
                        <tr>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $count++;?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row->exam_name; ?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo (int)$row->name_numeric;?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row->sub_name;?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row->date;?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo date('l', strtotime($row->date));?></td>
							<td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row->time_start.'-'.$row->time_end;?></td>
                        </tr>
                        <?php endforeach;
						}
						else
						{
						?>
						<tr> 
						<td align="left" style="font-size:11px;padding:6px 0px;" colspan="5">*No record found..</td>
						</tr>	
						<?php 
						}
						?>
                    </tbody>
					<tr>
                        <td valign="middle" align="right" colspan="7" style="padding:12px 0px; border-top:2px solid #2092D0; font-size:10px;"><span style="color:#2092D0;">Generated By : </span> <?php echo $this->session->userdata('name');?> </td>
                        </tr>
                </table>
                
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>


