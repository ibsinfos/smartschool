<?php
if(isset($month))
{

		 ?>
         <table class="table table-bordered datatable" id="table_export">
           <thead>
                <tr>
                  <th>Select All<input type="checkbox" id="selecctall" name="class_ids"  />                      
                         </th>
                    <td>Absent Date</td>
                    <td>Staff</td>
                    <td>Description</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody id="teacher_attendance_listing">
			<?php $array = array("attendance.status"=>2,"attendance.teacher_id !="=>0,"attendance.month"=>$month);
	$this->db->select('*');
	$this->db->from('attendance');
	$this->db->join('teacher', 'teacher.teacher_id = attendance.teacher_id');
	$this->db->where($array);
	$query = $this->db->get();
	$attendance =$query->result();
      foreach($attendance as $row){ ?>
			<tr class="gradeA">
			<td>
		<input type="checkbox" name="delete_id[]" value="<?php echo $row->attendance_id; ?>" class="checkbox1" /></td>
			<td><?php echo date("F d, Y",strtotime($row->date)); ?></td>
				   <td><?php echo $row->name; ?></td>
				   <td><?php echo $row->description; ?></td>
				   <td><div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu"><li><a href="<?php echo base_url().'index.php?admin/teacher_attendance/delete/'.$row->attendance_id; ?>"><i class="entypo-trash"></i>Remove</a></li></ul></div></td></tr>
                   	<?php 	} 		?>
          </tbody>
        </table>
           <table>
                <tr><td><input type="submit" name="delete_all" id="deletesall"  class="btn btn-info" value="Remove All"  /></td></tr>
                </table>
                
                <?php }
				if(!empty($search_keyword) && isset($search_keyword)){ 
					
		 $array = array("attendance.status"=>2,"attendance.teacher_id !="=>0,"teacher.name LIKE"=>"%".$search_keyword."%");
			$this->db->select('*');
			$this->db->from('attendance');
			$this->db->join('teacher', 'teacher.teacher_id = attendance.teacher_id');
			$this->db->where($array);
			$query = $this->db->get();
			$attendance =$query->result(); 
			
			
			?>
              <table class="table table-bordered datatable" id="table_export">
           <thead>
                <tr>
                  <th>Select All<input type="checkbox" id="selecctall" name="class_ids"  />                      
                         </th>
                    <td>Absent Date</td>
                    <td>Staff</td>
                    <td>Description</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody id="teacher_attendance_listing">
			<?php foreach($attendance as $row){ ?>
				<tr class="gradeA">
				<td>
		<input type="checkbox" name="delete_id[]" value="'.$row->attendance_id.'" class="checkbox1" /></td>
				<td><?php echo date("F d, Y", strtotime($row->date)); ?></td>
					   <td><?php echo $row->name; ?></td>
					   <td><?php echo $row->description; ?></td>
					   <td><div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu"><li><a href="<?php echo base_url().'index.php?admin/teacher_attendance/delete/'.$row->attendance_id; ?>"><i class="entypo-trash"></i>Remove</a></li></ul></div></td></tr> 
	 			<?php } ?>
				</tbody>
        	</table>
           <table>
                <tr><td><input type="submit" name="delete_all" id="deletesall"  class="btn btn-info" value="Remove All"  /></td></tr>
                </table>
			<?php } ?>
		
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->    
       <script>
 jQuery(document).ready(function() {
	 jQuery("#deletesall").click(function(){
		 var student_length =  $(".checkbox1:checked").length;
		
		   if(student_length < 1)
			{
				 alert('Please select at least one!');
				return false;	 
			}
	 			var r = confirm("Do you want to remove selected data?");
								
								if (r == true) {
									
								} else {
								
								   return false;
								}		
								});
  jQuery('#selecctall').click(function(event) {  
  
								
 
   if(this.checked) { 
    jQuery('.checkbox1').each(function() { 
     this.checked = true;          
    });
    }else{
    jQuery('.checkbox1').each(function() { 
     this.checked = false;               
    });         
   }
  });
  
  jQuery(".checkbox1").click(function(){
   if($(".checkbox1").length == $(".checkbox1:checked").length) {
    jQuery("#selecctall").prop("checked",true);
    } else {
    jQuery("#selecctall").prop("checked",false);
   }
   
  }); 
  
 });
</script>           
<script type="text/javascript">

	jQuery(document).ready(function($)
	{	
		var datatable = $("#table_export").dataTable({"oLanguage": { "sSearch": "Filter" } });
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});	
	});
	jQuery(document).ready(function($)
	{	
		var datatable = $("#table_export_assessment").dataTable({bFilter: false, bInfo: false,"bPaginate": false});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});	
	});
		
</script>                