<script>
	$(document).ready(function() {
		$('#selecctall').click(function(event) {  
			if(this.checked) { 
				$('.checkbox1').each(function() { 
					this.checked = true;          
				});
				}else{
				$('.checkbox1').each(function() { 
					this.checked = false;               
				});         
			}
		});
		
		$(".checkbox1").click(function(){
			if($(".checkbox1").length == $(".checkbox1:checked").length) {
				$("#selecctall").prop("checked",true);
				} else {
				$("#selecctall").prop("checked",false);
			}
			
		}); 
		
	});
</script>
<script>
	$(document).ready(function(){
		$('#btnadd').click(function(){	
			var queryArr = [];
			$('.checkbox1').each(function() { 
				if ($(this).is(':checked')) {
					queryArr.push($(this).val());				
				}				       
			});
			if(queryArr.length==0)
			{
				alert('select any receiver');
			}
			else
			{
				$.ajax({			
					type: "post",			
					url: "<?php echo base_url('/index.php?student/get_receiver');?>",			
					data: {
						ids:queryArr,
						type:$("#txtentity").val(),				
					},
					cache: false,			
					async: false,	
					dataType:'json',
					success: function(result){
						$("#receiverlist").append(result["name"] +";");
						$('#receiveid').val($('#receiveid').val() + result['ids'] +";");
						$('#receivetype').val($('#receivetype').val() + result['type'] +";");
						
					}
				});
			}
		});
	});
</script>
<input type="hidden" name="txtentity" id="txtentity" value="<?=$_POST['entity'] ?>">

<div class="panel-body">	
	<?php
		$groupid=$this->db->get_where('group',array('group_id'=>$_POST['entity']))->row()->user_role;
		$datagroup=explode(',',$groupid);
		
		if($_POST['entity']==1 || $_POST['entity']==3  )
		{
			if($_POST['entity'] == 1){					
				$all	=	$this->db->get('teacher')->result_array();					
				}elseif($_POST['entity'] == 2){					
				$all	=	$this->db->get('student')->result_array();					
				}elseif($_POST['entity'] == 3){					
				$all	=	$this->db->get('student')->result_array();					
				}elseif($_POST['entity'] == 4){					
				$all	=	$this->db->get('parent')->result_array();					
			}
			if(empty($all))
			{
				echo "There is no any record";
			}
			else{
			?>
			<table class="table table-bordered " id="table_export">		
				<thead>			
					<tr>	
						<th><div><input type="checkbox" name="selecctall" id="selecctall" value="" /> Select all</div></th>	
					</tr>			
				</thead>		
				<tbody>			
					<?php 									
						
						
						$count=0;
						foreach($all as $row):	
						
						if($_POST['entity'] == 1){					
							$ids = $row['teacher_id'];					
							}elseif($_POST['entity'] == 2){					
							$ids = $row['student_id'];
							}elseif($_POST['entity'] == 3){					
							$ids = $row['student_id'];					
							}elseif($_POST['entity'] == 4){					
							$ids = $row['parent_id'];				
						}	
						if(in_array($ids,$datagroup))
						{	
							$count++;
							if($count%5==0)
							{
							?>
							<tr id="<?=$count?>"></tr>
							<td ><input type="checkbox" class="checkbox1" name="chk_group[]"  value="<?php echo $ids; ?>" />
							<?php echo $row['name'];?></td>
							<?php
							}
							else
							{
							?>
							<td ><input type="checkbox" class="checkbox1" name="chk_group[]"  value="<?php echo $ids; ?>" />
							<?php echo $row['name'];?></td>
							<?php
							}
						}
					?>	
					
					<?php endforeach;?>			
				</tbody>
				<footer><tr><td><input type="button" name="btnadd" id="btnadd" value="Add"/></td></tr>
				</footer>
			</table>	
			<?php
			}
		}
		elseif($_POST['entity']==4)
		{
			$class=$this->db->get('class')->result_array();		
			if(empty ($class))
			{
				echo "There is no any record";
			}
			else
			{
			?>
			<select class="form-control" name="drpclassparent"  id="drpclassparent" required>
				
				<option value="">Select Class</option>
				<?php
					foreach($class as $c)
					{
					?>
					<option value="<?php echo $c['name_numeric']?>"><?php echo $c['name_numeric']?></option>
					<?php
					}
				?>
			</select>
			<?php
			}
		}
		else
		{
			$groupid=$this->db->get_where('group',array('group_id'=>$_POST['entity']))->row();
			
			$datagroup=explode(',',$groupid->user_role);
			
			if($groupid->user_type==1)
			{
				$all	=	$this->db->get('teacher')->result_array();
				//$ids = $row['teacher_id'];
			}
			elseif($groupid->user_type==2)
			{
				$all	=	$this->db->get('student')->result_array();	
				//$ids = $row['student_id'];
			}
			elseif($groupid->user_type==3)
			{
				$all	=	$this->db->get_where('teacher',array('teaching_type'=>2))->result_array();		
				//$ids = $row['teacher_id'];
			}
			elseif($groupid->user_type==4)
			{
				$all	=	$this->db->get('parent')->result_array();		
				//$ids = $row['parent_id'];
			}
			elseif($groupid->user_type==5)
			{
				$all	=	$this->db->get('admin')->result_array();
				//$ids = $row['admin_id'];
			}
			if(empty($all))
			{
				echo "There is no any record";
			}
			else{
			?>
			<table class="table table-bordered " id="table_export">		
				<thead>			
					<tr>	
						<td><input type="checkbox" name="selecctall" id="selecctall"  /> Select all</td>	
					</tr>			
				</thead>		
				<tbody>			
					<?php 	
						$count=0;
						foreach($all as $row){
							
							if($groupid->user_type==1)
							{
								$ids = $row['teacher_id'];
							}
							elseif($groupid->user_type==2)
							{	
								$ids = $row['student_id'];
							}
							elseif($groupid->user_type==3)
							{	
								$ids = $row['teacher_id'];
							}
							elseif($groupid->user_type==4)
							{	
								$ids = $row['parent_id'];
							}
							elseif($groupid->user_type==5)
							{
								$ids = $row['admin_id'];
							}
							
							
							if(in_array($ids,$datagroup))
							{		
								$count++;
								if($count%5==0)
								{
								?>
								<tr id="<?=$count?>"></tr>
								<td ><input type="checkbox" class="checkbox1" name="chk_group[]"  value="<?php echo $ids; ?>" />
								<?php echo $row['name'];?></td>
								<?php
								}
								else
								{
								?>
								<td ><input type="checkbox" class="checkbox1" name="chk_group[]"  value="<?php echo $ids; ?>" />
								<?php echo $row['name'];?></td>
								<?php
								}
							}
						}
					?>
				</tbody>
				<footer><tr><td><input type="button" name="btnadd" id="btnadd" value="Add"/></td></tr>
				</footer>
			</table>
			<?php
			}
		}
	?>
	<div id="listbox1"></div>
</div>
<script>
	$("#drpclass").change(function () {		
		var Entity = $("#txtentity").val();
		var class_name=$("#drpclass").val();
		$.ajax({   			
			url: "index.php?getinfo/getinfostudent", 			
			async: false,			
			type: "POST", 
			data: {
				entity:Entity,
				class_name:class_name,				
			},
			dataType: "html", 
			success: function(data) {
				$('#listbox1').html(data);				
			}			
		})		
	});
</script>
<script>
	$("#drpclassparent").change(function () {		
		var Entity = $("#txtentity").val();
		var class_name=$("#drpclassparent").val();
		$.ajax({   			
			url: "index.php?getinfo/getinfoparent",			
			async: false,			
			type: "POST", 
			data: {
				entity:Entity,
				class_name:class_name,				
			},
			dataType: "html", 			
			success: function(data) {
				$('#listbox1').html(data);				
			}			
		})		
	});
</script>	