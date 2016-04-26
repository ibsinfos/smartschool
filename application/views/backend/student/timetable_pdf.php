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
                        <tr><td colspan="11" style="height:15px;"></td></tr>
                        <tr bgcolor="#000000"><td colspan="11" style="font-size:1.2em; text-align:center; font-weight:600; padding:6px 0px; color:#FFF;">Timetable Month Listing</td></tr>
                        
                        <tr bgcolor="#2092D0">
                            <th style="color:#FFF; padding:6px 0px;">No</th>
                            <th style="color:#FFF; padding:6px 0px;">Class Name</th>
                            <th style="color:#FFF; padding:6px 0px;">Subject Name</th>
                            <th style="color:#FFF; padding:6px 0px;">Teacher Name</th>
                            <th style="color:#FFF; padding:6px 0px;">Start Time</th>
                            <th style="color:#FFF; padding:6px 0px;">End Time</th>
                            <th style="color:#FFF; padding:6px 0px;">Day</th>
                            <th style="color:#FFF; padding:6px 0px;">Date</th>
                        </tr>
                       
                    </thead>
                    <tbody>
                        <?php 
                        $std_id = $this->session->userdata('student_id');

                        $this->db->select('time_table.*');
                       // $this->db->join('subject', 'subject.subject_id = time_table.subject_id');
                       // $this->db->join('teacher', 'teacher.teacher_id = time_table.teacher_id');
                        $this->db->join('student','student.class_id = time_table.class_id');
                        $this->db->where('student.student_id', $std_id);
                        $this->db->group_by('time_table.month');
                        $this->db->order_by('time_table.month', 'ASC');
                     
                        $timetables = $this->db->get('time_table')->result_array();

                       // print_r($this->db->last_query());
                        $count = 1;
                        if(count($timetables) > 0){
                        foreach($timetables as $rows):?>
                        <tr>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $count++;?></td>                         
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $rows['class_id']?></td>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php $subjectName=$this->db->get_where('subject',array('subject_id'=>$rows['subject_id']))->row();  echo $subjectName->name;?> </td>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php $teacherName=$this->db->get_where('teacher',array('teacher_id'=>$rows['teacher_id']))->row();  echo $teacherName->name;?> </td>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $rows['time_start']?></td>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $rows['time_end']; ?></td>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $rows['day']; ?></td>
                            <td align="center" style="font-size:11px; padding:6px 0px; border-bottom:1px solid #EEE; border-left:1px solid #EEE; border-right:1px solid #EEE;"><?php echo $rows['date']; ?></td>
                        </tr>
                        <?php                       
                        endforeach;
                        }
                        else
                        {
                        ?>  
                        <tr><td align="left" style="font-size:12px; padding:6px 0px;" colspan="5">*No record found..</td></tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                    
                     <tr>
                        <td valign="middle" align="right" colspan="5" style="padding:12px 0px; border-top:2px solid #2092D0; font-size:10px;"><span style="color:#2092D0;">Generated By : </span> <?php echo $this->session->userdata('name');?> </td>
                        </tr>

                </table>
                
            </div>
            <!--TABLE LISTING ENDS -->
        </div>
    </div>
</div>