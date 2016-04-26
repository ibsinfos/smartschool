<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS END------>
		<div class="tab-content">            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list" style="padding: 5px">
				<table class="table table-bordered datatable" id="table_export_assessment" >
                	<?php $row_count=$this->db->get_where('assessment',array('student_id'=>$this->session->userdata('student_id')))->row(); if(count($row_count)>0){?>
                    <thead>
                  <?php 
				  		$this->db->order_by("assessment_id", "desc");
						$this->db->limit(2);
						$assessment_list1=$this->db->get_where('assessment',array('student_id'=>$this->session->userdata('student_id')))->row();?>
                        <tr>
                            <th width="80"><div>Class</div></th>
                            <td style="background-color:#FFF;"><?php echo $assessment_list1->class_id;?></td>
                         </tr>
                    </thead>
                    <thead>
                    <tr>    <th style="background-color: rgb(255, 255, 255); border-right: medium none;"><div></div></th>
                    	    <th width="" style="background-color: rgb(255, 255, 255); border: medium none ! important;"><div></div></th>
                        </tr>
                    </thead>
                    <thead>
                    <tr>    <th><div>Behaviour</div></th>
                    	    <th width="150"><div>Date</div></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php   $this->db->order_by("assessment_id", "desc");
							$this->db->limit(2);
							$assessment_list=$this->db->get_where('assessment',array('student_id'=>$this->session->userdata('student_id')))->result_array();
					$count=1;	
					foreach($assessment_list as $row): ?>
                    <tr>
                    	<td><?php echo $row['behaviour'];?></td>
                        <td><?php echo date("F d, Y h:i a", strtotime($row['created_date']));?></td>
                    </tr>
                    <?php $count++;  endforeach; ?>
                    </tbody>
                    <?php } else{?>
                    <thead>
                      <tr>
                      	<td>No data available</td>
                      </tr>
                    </thead>
                    <?php }?>
				</table>
		   </div>
	</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->  
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({bFilter: false, bInfo: false,"bPaginate": false});
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
	});

</script>