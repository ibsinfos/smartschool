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
					url: "<?php echo base_url('/index.php?admin/get_receiver1');?>",			
					data: {
						ids:queryArr,
						type:$("#txtentity").val(),				
					},
					cache: false,			
					async: false,	
					dataType:'json',
					success: function(result){
						$("#receiverlist").append(result["name"] +",");
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
		$this->db->group_by('parent.parent_email');
		$this->db->select('parent.*');
		$this->db->from('student');
		$this->db->join('parent', 'student.parent_email = parent.parent_email');
		$this->db->where('student.class_id',$_POST['class_name']);
		$dataparent=$this->db->get()->result();
		if(empty($dataparent))
		{
			echo "There is no any record";
		}
		else
		{
			
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
					/* foreach($dataparent as $row1)
					{	 */				
					foreach($dataparent as $row)
					{
						$studentname=array();
						$stuname="";
						$count++;					
						$ids = $row->parent_id;			
						
						$studentname=	$this->db->get_where('student', array('parent_email' => $row->parent_email))->result();
								
						if($count%5==0)
						{
						?>
						<tr id="<?=$count?>"></tr>
						<?php
						}
						else
						{
						?>
						<td ><input type="checkbox" class="checkbox1" name="chk_group[]"  value="<?php echo $ids; ?>" />
						<?php
							foreach($studentname as $s)
								{
									$stuname.=$s->name ."&nbsp;&nbsp;";
								}
							?>
						<label ><?php echo $row->name; ?></label><br>
						<label >Student name:<?php echo $stuname;?></label>
						</td>
						<?php
						}
					?>						
					<?php 
					}
					
					//}
				?>			
			</tbody>
			<footer><tr><td><input type="button" class="btn btn-info" name="btnadd" id="btnadd" value="Add"/></td></tr>
			</footer>
		</table>	
		<?php
		}
	?>
</div>
