		        <table  class="table datatable table" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:14px; letter-spacing:0.5;" id="table_export" >
                         <tbody>
                         <?php
						$get_staff_detail= $this->db->get_where('history_staff',array('staff_id'=>$_POST['staff_name'],'staff_year'=>$_POST['year']))->result_array();
						$attendance = $this->db->get_where("history_staff_attendance",array('staff_id'=>$_POST['staff_name'],'statt_attendance_year'=>$_POST['year']))->num_rows();
						 foreach($get_staff_detail as $staff_row){
							 $date1=date_create("2015-09-01");
							 $getdate = date("Y-m-d");
							 $date2=date_create($getdate);
							 $diff=date_diff($date1,$date2);
							 $total_count=$diff->format("%a");
					         $present_count=($total_count)-($attendance);
							 $t=$present_count/$total_count*(100);
							 $num_of_percent =  number_format($t, 1, '.', '');
			  			 ?>
                         <tr><td><b style="font-weight:900;">Teaching Type</b></td><td>
						 <?php if($staff_row['staff_teaching_type']==1){echo 'Technical';}else{echo 'Non-Technical';} ?></td></tr>
                        <tr><td><b style="font-weight:900;">Designation</b></td><td><?php echo $staff_row['staff_designation']; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Name</b></td><td><?php echo $staff_row['staff_fullname']; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Father Name</b></td><td><?php echo $staff_row['staff_fathername']; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Mother Name</b></td><td><?php echo $staff_row['staff_mothername']; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Birthday</b></td><td><?php echo $staff_row['staff_birthday']; ?></td></tr>
                         <tr><td><b style="font-weight:900;">Sex</b></td><td><?php echo $staff_row['staff_sex']; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Blood Group</b></td><td><?php echo $staff_row['staff_blood_group']; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Phone</b></td><td><?php echo $staff_row['staff_phone']; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Email</b></td><td><?php echo $staff_row['staff_email']; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Address</b></td><td><?php echo wordwrap($staff_row['staff_address'],40,"<br>\n"); ?></td></tr>
                        <tr><td><b style="font-weight:900;">Total Absent Days</b></td><td><?php echo $attendance; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Total Days</b></td><td><?php echo $total_count; ?></td></tr>
                        <tr><td><b style="font-weight:900;">Total Attendance % :</b></td><td><?php echo $num_of_percent.'%'; ?></td></tr>
                        <?php }?>
                        </tbody>
                        <tr bgcolor="#000000">
                            <td style="font-size:1.2em; text-align:left; font-weight:600; padding:6px 3px; color:#FFF;"><b style="font-weight:900;">Absent Date</b></td>
                            <td style="font-size:1.2em; text-align:left; font-weight:600; padding:6px 0px; color:#FFF;"><b style="font-weight:900;"><b style="font-weight:900;">Absent Reason</b></td>
                            <td style="font-size:1.2em; text-align:left; font-weight:600; padding:6px 0px; color:#FFF;"><b style="font-weight:900;"><b style="font-weight:900;">Leave Type</b></td>
                        </tr>
                        <?php
						$attendance_detail = $this->db->get_where("history_staff_attendance",array('staff_id'=>$_POST['staff_name'],'statt_attendance_year'=>$_POST['year']))->result_array();
						foreach($attendance_detail as $attendance_row){?>
                        <tr>
                       	 <td><?php echo date("d-M-Y",strtotime($attendance_row['staff_attendance_date']));?></td>
                         <td><?php echo $attendance_row['staff_description'];?></td>
                         <td><?php echo $attendance_row['leave_type'];?></td>
                        </tr>
                        <?php }?>
</table>
