<?php 
include('db_connect.php');
$userid=$_SESSION['login_id'];
// register package
?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="save_plan.php"method="POST">
				<div class="card">
					<div class="card-header">
						    Plan, Trainer and Schedule
				  	</div>
					<div class="card-body">
							<!-- plan and id -->
							<?php
								echo "<input type='hidden'name='member_id'value=".$userid.">";
							?>
					<div class="row form-group">
				<label class="control-label">Plan</label>
				<select name="plan_id" required="required" class="custom-select select2" id="">
					<option value=""></option>
					<?php
						$qry = $conn->query("SELECT * FROM plans order by plan asc");
						while($row= $qry->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($plan_id) && $plan_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['plan']) ?></option>
					<?php endwhile; ?>
				</select>
						</div>
					<div class="row form-group">
				<label class="control-label">Package</label>
				<select name="package_id" required="required" class="custom-select select2" id="">
					<option value=""></option>
					<?php
						$qry = $conn->query("SELECT * FROM packages order by package asc");
						while($row= $qry->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($package_id) && $package_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['package']) ?></option>
					<?php endwhile; ?>
				</select>
						</div>
						<div class="row form-group">
				<label class="control-label">Trainer</label>
				<select name="trainer_id" class="custom-select select2" id="">
					<option value=""></option>
					<?php
						$qry = $conn->query("SELECT * FROM trainers order by name asc");
						while($row= $qry->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($trainer_id) && $trainer_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['name']) ?></option>
					<?php endwhile; ?>
				</select>
						</div>
					<!-- end -->
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<b>Trainers</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center"hidden>#</th>
									<th class="text-center">Information</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$trainer = $conn->query("SELECT * FROM trainers order by id asc");
								while($row=$trainer->fetch_assoc()):
								?>
								<tr class="new_class">
									<td class="text-center"hidden><?php echo $i++ ?></td>
									<td class="">
										<p><i class="fa fa-user"></i> <b><?php echo $row['name'] ?></b></p>
										<p><small><i class="fa fa-at"></i> <b><?php echo $row['email'] ?></b></small></p>
										<p><small><i class="fa fa-phone-square-alt"></i> <b><?php echo $row['contact'] ?></b></small></p>
										<p><small><i class="fa fa-money-bill"></i> <b><?php echo number_format($row['rate'],2) ?></b></small></p>
										<p><small><i class="fa fa-user"></i> <b class="speciality"><?php echo $row['speciality'] ?></b></small></p>
										
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin:unset;
	}
</style>
<script>
	function _reset(){
		$('#manage-trainer').get(0).reset()
		$('#manage-trainer input,#manage-trainer textarea').val('')
	}
	$('#manage-trainer').submit(function(e){
		e.preventDefault()
		//  
		$.ajax({
			url:'ajax.php?action=save_trainer',
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
	$('.edit_trainer').click(function(){
		//  
		var cat = $('#manage-trainer')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='email']").val($(this).attr('data-email'))
		cat.find("[name='contact']").val($(this).attr('data-contact'))
		cat.find("[name='rate']").val($(this).attr('data-rate'))
		cat.find("#speciality").val($(this).closest('.new_class').find('.speciality')[0].innerText)
		
		// end_load()
	})
	$('.delete_trainer').click(function(){
		_conf("Are you sure to delete this trainer?","delete_trainer",[$(this).attr('data-id')])
	})
	function delete_trainer($id){
		//  
		$.ajax({
			url:'ajax.php?action=delete_trainer',
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