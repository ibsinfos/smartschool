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
					url: "<?php echo base_url('/index.php?admin/get_receiver');?>",			
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
		$year_start_date=$this->session->userdata('start_date');
        $year_end_date=$this->session->userdata('end_date');
		$groupid=$this->db->get_where('group',array('group_id'=>$_POST['entity']))->row()->user_role;
		$datagroup=explode(',',$groupid);
		
		$all=$this->db->get_where('student', array('class_id' => $_POST['class_name'],'curr_date >='=>$year_start_date,'curr_date <='=>$year_end_date))->result_array();
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
					$parentname=array();
					$parname='';
					$ids = $row['student_id'];
					
					if(in_array($ids,$datagroup))
					{	
						$count++;	
						$parentname=	$this->db->get_where('parent', array('parent_email' => $row['parent_email']))->result();
						
						if($count%5==0)
						{
						?>
						<tr id="<?=$count?>"></tr>
						<td ><input type="checkbox" class="checkbox1" name="chk_group[]"  value="<?php echo $ids; ?>" />
							
							<?php
								echo $parname;
								foreach($parentname as $p)
								{
									$parname.=$p->name ."&nbsp;&nbsp;";
								}
							?>
							<label ><?php echo $row['name']; ?></label><br>
							<label >Parent name:<?php echo $parname;?></label>
						</td>
						<?php
						}
						else
						{
						?>
						<td ><input type="checkbox" class="checkbox1" name="chk_group[]"  value="<?php echo $ids; ?>" />
							
							<?php
								echo $parname;
								foreach($parentname as $p)
								{
									$parname.=$p->name ."&nbsp;&nbsp;";
								}
							?>
							<label ><?php echo $row['name']; ?></label><br>
							<label >Parent name:<?php echo $parname;?></label>
						</td>
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
	?>
</div>
