<!-- Dev :==> Nikita Patel
Disc :==> Report For Time Table List --->


<div id="main_timetable"> 
	
	<div id="timetable_sub_1" > 
		<?php //echo form_open(base_url() . 'index.php?admin/timetable/class_wise_timetable' , array('class' => 'form-horizontal validate'));?>	
		<form action="<?php echo base_url() . 'index.php?student/timetable/class_wise_timetable_list'; ?>" method="post" id="class_wise_timetable" class="form-horizontal validate">
		
			<div class="form-group">
				<label class="col-sm-1 control-label">Month</label>
				<div class="col-sm-2">
					<select name="month" id="month" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  onchange="return weekCount(this.value);">
						<option value="">Select Month</option>
						<option value="1">January </option>
						<option value="2">February </option>
						<option value="3">March</option>
						<option value="4">April</option>
						<option value="5">May </option>
						<option value="6">June</option>
						<option value="7">July </option>
						<option value="8">August </option>
						<option value="9">Septmber </option>
						<option value="10">October </option>	
						<option value="11">November</option>	
						<option value="12">December </option>	
						
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">Week</label>
				<div class="col-sm-2">
					<select name="week" id="week" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  >
						<option value="">Select Week</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-2">
					<button type="submit" class="btn btn-info">Submit</button>
				</div>
			</div>
		</form>
	</div>
	

</div>       
<!-- End Time Table report -->
<!--   
	$("#class_wise_timetable").submit(function(){
	var data = $("#class_wise_timetable").serialize();			
	showAjaxModal('<?php echo base_url();?>index.php?modal/timetable/timetable_class_wise_list/',data);
	});
	
	
	
	$("#teacher_wise_timetable").submit(function(){
	var data = $("#teacher_wise_timetable").serialize();				
	showAjaxModal('<?php echo base_url();?>index.php?modal/timetable/timetable_teacher_wise_list/',data);
});   -->

<script type="text/javascript">
	$(function () {
		
		
		$("#class_wise_timetable").submit(function(){
			
			var data = $("#class_wise_timetable").serialize();			
			var class_id = $("#class_id").val();
			var month  = $("#month").val();
			var week = $("#week").val();
			
			if(class_id=="" || month=="" || week=="")
			{
				return false;	
			}
			
			
			
		});
		
		
		
		$("#teacher_wise_timetable").submit(function(){
			
			var data = $("#teacher_wise_timetable").serialize();				
			var teacher_id = $("#teacher_id").val();
			var weekt = $("#weekt").val();
			var montht = $("#montht").val();
			if(teacher_id=="" || weekt=="" || montht=="")
			{
				return false;
			}
			
		});  
		
		
		
		$("#report_list").change(function () {
			var repost_list = $(this).val();
			
			if ($(this).val() == "non_teaching") {
				$("#holiday").hide();
				$("#notification").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#study_materials").hide();
				$("#staff_attendence").hide();
				$("#ind_student").hide();
				$("#non_teaching").show();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				$("#attendance").hide();
				$("#exam_mark").hide();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();					
                } else if ($(this).val() == "holiday_list") {
				$("#holiday").show();
				$("#ind_student").hide();
				$("#notification").hide();
				$("#non_teaching").hide();
				$("#fees_listing").hide();
				$("#study_materials").hide();
				$("#staff_attendence").hide();
				$("#group_list").hide();
				$("#attendance").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				$("#exam_mark").hide();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "notification_list") {
				$("#notification").show();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#fees_listing").hide();
				$("#non_teaching").hide();
				$("#study_materials").hide();
				$("#staff_attendence").hide();
				$("#group_list").hide();
				$("#attendance").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				$("#exam_mark").hide();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "group_list") {
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#fees_listing").hide();
				$("#study_materials").hide();
				$("#staff_attendence").hide();
				$("#group_list").show();
				$("#attendance").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				$("#exam_mark").hide();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "fees_listing") {
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#fees_listing").hide();
				$("#group_list").hide();
				$("#staff_attendence").hide();
				$("#study_materials").hide();
				$("#fees_listing").show();
				$("#attendance").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				$("#exam_mark").hide();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "study_materials") {
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#fees_listing").hide();
				$("#group_list").hide();	
				$("#staff_attendence").hide();
				$("#attendance").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();					 
				$("#study_materials").show();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				$("#exam_mark").hide();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "staff_attendence") {
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#fees_listing").hide();
				$("#group_list").hide();	
				$("#staff_attendence").show();					 
				$("#study_materials").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				$("#exam_mark").hide();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "ind_student") {
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").show();
				$("#non_teaching").hide();
				$("#fees_listing").hide();
				$("#group_list").hide();	
				$("#staff_attendence").hide();					 
				$("#study_materials").hide();
				$("#attendance").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				$("#exam_mark").hide();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
                }else if ($(this).val() == "attendance") {
				$("#attendance").show();
				$("#holiday").hide();
				$("#notification").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#study_materials").hide();
				$("#staff_attendence").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				$("#exam_mark").hide();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
				}else if ($(this).val() == "timetable") {
				$("#timetable").show();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				$("#attendance").hide();
				$("#holiday").hide();
				$("#notification").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#study_materials").hide();
				$("#staff_attendence").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#exam_mark").hide();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
			    }else if ($(this).val() == "exam_mark") {
				$("#exam_mark").show();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				$("#attendance").hide();
				$("#holiday").hide();
				$("#notification").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#study_materials").hide();
				$("#staff_attendence").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
			}		
			else{
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#staff_attendence").hide();
				$("#study_materials").hide();
				$("#attendance").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				$("#exam_mark").hide();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
				
			}
		});
	});
	
	
	$(function () {
		$("#attendance_list").change(function () {
			if($("#attendance_list").val()=="class_wise_attendance"){
				$("#attendance_sub_1").show();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#attendance").show();
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#staff_attendence").hide();
				$("#study_materials").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
			}
			else if($("#attendance_list").val()=="standard_attendance"){
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").show();
				$("#attendance_sub_3").hide();
				$("#attendance").show();
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#staff_attendence").hide();
				$("#study_materials").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
			}
			else if($("#attendance_list").val()=="all_attendance"){
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").show();
				$("#attendance").show();
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#staff_attendence").hide();
				$("#study_materials").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
			}
		});
	});
	
	$(function () {
		$("#timetable_list").change(function () {
			//alert('dsd');
			if($("#timetable_list").val()=="class_wise_timetable"){
				$("#timetable").show();
				$("#timetable_sub_1").show();
				$("#timetable_sub_2").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#attendance").hide();
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#staff_attendence").hide();
				$("#study_materials").hide();
				}else if($("#timetable_list").val()=="teacher_wise_timetable"){
				$("#timetable").show();
				$("#timetable_sub_2").show();	
				$("#timetable_sub_1").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#attendance").hide();
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#staff_attendence").hide();
				$("#study_materials").hide();
			}
			
		});
	});
	
	$(function () {
		$("#exam_mark_list").change(function () {
			if($("#exam_mark_list").val()=="class_wise_exam"){
				$("#exam_mark").show();
				$("#exam_mark_sub_1").show();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#attendance").hide();
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#staff_attendence").hide();
				$("#study_materials").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
			}
			else if($("#exam_mark_list").val()=="student_mark"){
				$("#exam_mark").show();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").show();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();	
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#attendance").hide();
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#staff_attendence").hide();
				$("#study_materials").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
			}
			else if($("#exam_mark_list").val()=="class_wise_top3_student"){
				$("#exam_mark").show();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").show();
				$("#exam_mark_sub_4").hide();
				$("#exam_mark_sub_5").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#attendance").hide();
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#staff_attendence").hide();
				$("#study_materials").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
				}else if($("#exam_mark_list").val()=="subject_wise_top3_student"){
				$("#exam_mark").show();
				$("#exam_mark_sub_1").hide();
				$("#exam_mark_sub_2").hide();
				$("#exam_mark_sub_3").hide();
				$("#exam_mark_sub_4").show();
				$("#exam_mark_sub_5").hide();
				$("#attendance_sub_1").hide();
				$("#attendance_sub_2").hide();
				$("#attendance_sub_3").hide();
				$("#attendance").hide();
				$("#notification").hide();
				$("#holiday").hide();
				$("#ind_student").hide();
				$("#non_teaching").hide();
				$("#group_list").hide();
				$("#fees_listing").hide();
				$("#staff_attendence").hide();
				$("#study_materials").hide();
				$("#timetable").hide();
				$("#timetable_sub_1").hide();
				$("#timetable_sub_2").hide();
			}
		});
	});
	
	
	function get_exam(class_id) {
		
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_exam/' + class_id,
            success: function(response)
            {
				jQuery('#exam_listing').html(response);
			}
		});
	}
	function get_student_name_exam(class_id) {
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_exam_list_markid/' + class_id,
            success: function(response)
            {
				jQuery('.exam_listing_mark').html(response);
			}
		});
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_student_list_markid/' + class_id,
            success: function(response)
            {
				jQuery('#student_listing').html(response);
			}
		});
	}
function weekCount(month_number) {
 
 $('#week').find('option:not(:first)').remove();
		   $.ajax({
			type:"POST",
					url: '<?php echo base_url();?>index.php?admin/getweeks/',
		   data:'month='+month_number,
		   success: function(response)
					{
		  //  alert(response);
			//var week =  response;
			for(var i=1; i<=response;i++)
			 {
			 
			 $("#week").append('<option value='+i+'>'+i+'</option>');
			  
			 }
				 }
			   });
}
</script>