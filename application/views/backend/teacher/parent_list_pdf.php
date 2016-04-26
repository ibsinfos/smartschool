

<div class="row">
	<div class="col-md-12"> 
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="width:100%;">
            
          
                 <table class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export">
                	<thead>
                   <tr>
                            <td colspan="7">
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
                        <tr><td colspan="7" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="7" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Parent Listing</td></tr>
                        
                         <tr bgcolor="#000000"><td colspan="7" style="font-size:1.0em;border-top:1px solid #FFF; text-align:center; font-weight:600;  color:#FFF;  padding:6px 0px;"> <?php echo ucwords('Class Name : <span style="text-align:right;color:#2092D0;font-size:1.0em;font-weight:600;">'.$class_id.'</span>'); ?></td></tr>
                		
                          <tr bgcolor="#2092D0">
                    		<th  style="color:#FFF; border-right:1px solid #EEE; text-align:center;padding:6px 3px; ">No</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE;  text-align:center;padding:6px 3px;" >Student Name</th>
                            <th style="color:#FFF; border-right:1px solid #EEE;  text-align:center;padding:6px 3px;" >Class Name</th>
                            <th style="color:#FFF; border-right:1px solid #EEE; text-align:center; padding:6px 3px;" >Father Name</th>
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center;padding:6px 3px; ">Mother Name</th>                    		 
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center;padding:6px 3px; " >Parent Email</th>  
                    		<th style="color:#FFF; border-right:1px solid #EEE; text-align:center; padding:6px 3px;" >Phone</th>  
                    	</tr>
					</thead>
                    <tbody>
                    	<?php 
						
						
						//$exam = $this->db->get_where('parent',array('parent.class_id'=>$class_id))->result_array();
						$parents =   $this->db->get_where('parent',array('parent.class_id'=>$class_id))->result_array();
						
						
						$count = 1;
						
						foreach($parents as $row):						
						?>
                        <tr>
                            <td align="center" style="font-size:11px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $count++;?></td>                            
							<td align="center" style="font-size:11px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo @$this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
                            <td align="center" style="font-size:11px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php
							echo $row['class_id']; ?></td>
                            <td align="center" style="font-size:11px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php
							echo $row['name']; ?></td>
							<td align="center" style="font-size:11px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['mother_name'];?></td>
							<td align="center" style="font-size:11px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['parent_email'];?></td>
							<td align="center" style="font-size:11px; padding:6px 2px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $row['phone'];?></td>
                        </tr>
                         <?php endforeach;?>
						
                    </tbody>
					<tr>
                        <td valign="middle" align="right" colspan="7" style="padding:12px 2px; border-top:2px solid #2092D0; font-size:10px;"><span style="color:#2092D0;">Generated By : </span> <?php echo $this->session->userdata('name');?> </td>
                        </tr>
                </table>
                
			</div>
            <!----TABLE LISTING ENDS--->
		</div>
	</div>
</div>



