<div class="row">
	<div class="col-md-12">
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					Holiday List
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table class="table table-bordered datatable" id="table_export">
                
				
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div>Holiday Name</div></th>
                    		<th><div>Date</div></th>
                            <th width="70%"><div>Detail</div></th>   
						</tr>
					</thead>
                    <tbody>
                    	<?php
						$holidays=$this->db->get('holiday')->result_array();
						 $count = 1;foreach($holidays as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>							
							<td><?php echo $row['holiday_name'];?></td>
							<td><?php echo date("F d, Y",strtotime($row['holiday_date']));?></td>
							<td><?php echo $row['holiday_detail'];?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
			
		</div>
	</div>
</div>
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({"oLanguage": { "sSearch": "Filter" } });
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		$('#example').dataTable( {
				paging: false,
				searching: false
		});
		$("#holiday_date").datepicker({
                minDate: 0
        });
    });
</script>