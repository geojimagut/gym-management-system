<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-trainer">
				<div class="card">
					<div class="card-header">
						    Trainers
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Name</label>
								<input type="text" class="form-control" name="name">
							</div>
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="email" class="form-control" name="email">
							</div>
							<div class="form-group">
								<label class="control-label">Contact</label>
								<input type="text" class="form-control" name="contact">
							</div>
							<div class="form-group">
								<label class="control-label">Rate</label>
								<input type="number" class="form-control text-right" name="rate">
							</div>
							<div class="form-group">
								<label class="control-label">Speciality</label>
								<input type="text" class="form-control text-right" name="speciality"id="speciality">
							</div>
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
									<th class="text-center">Action</th>
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
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_trainer" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-email="<?php echo $row['email'] ?>" data-contact="<?php echo $row['contact'] ?>" data-rate="<?php echo $row['rate'] ?>" ><i class="fa fa-edit"></i></button>
										<button class="btn btn-sm btn-danger delete_trainer" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
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
		// start_load()
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
		// endLoad()
	})
	$('.edit_trainer').click(function(){
		// start_load()
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
		// start_load()
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