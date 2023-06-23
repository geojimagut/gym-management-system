<?php include('db_connect.php');?>

<div class="full_table">
			<!-- Table Panel -->
					<div class="card-header">
						<b>Package List</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							
							<thead>
								<tr>
									<th class="text-center"hidden>#</th>
									<th class="text-center">package</th>
									<th class="text-center">Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$package = $conn->query("SELECT * FROM packages order by id asc");
								while($row=$package->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"hidden><?php echo $i++ ?></td>
									<td class="">
										<p>package: <b><?php echo $row['package'] ?></b></p>
										<p>Description: <small><b><?php echo $row['description'] ?></b></small></p>
										
									</td>
									<td class="text-right">
										<b><?php echo number_format($row['amount'],2) ?></b>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
			<!-- Table Panel -->
		</div>

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
</style>
<script>
	function _reset(){
		$('#manage-package').get(0).reset()
		$('#manage-package input,#manage-package textarea').val('')
	}
	$('#manage-package').submit(function(e){
		e.preventDefault()
		//  
		$.ajax({
			url:'ajax.php?action=save_package',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.edit_package').click(function(){
		//  
		var cat = $('#manage-package')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='package']").val($(this).attr('data-package'))
		cat.find("[name='description']").val($(this).attr('data-description'))
		cat.find("[name='amount']").val($(this).attr('data-amount'))
		end_load()
	})
	$('.delete_package').click(function(){
		_conf("Are you sure to delete this package?","delete_package",[$(this).attr('data-id')])
	})
	function delete_package($id){
		 
		$.ajax({
			url:'ajax.php?action=delete_package',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	$('table').dataTable()
</script>