<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM members where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
}
?>
<style>
	.flexed{
		width:100%;
		display:flex;
	}
	.flexed .col-md-4 input{
		margin-left:0;
		margin-right:2%;
	}
</style>

<div class="container-fluid">
	<form action="save_member.php"method="POST" id="manage-member"autocomplete="off">
		<div id="msg"display='block'>
			<!--show response-->
		</div>
				<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id']:'' ?>" class="form-control"required>
		<div class="row form-group">
			<div class="col-md-4">
						<label class="control-label">ID No.</label>
						<input type="text" name="member_id" class="form-control" value="<?php echo isset($member_id) ? $member_id:'' ?>"required>
						<!--small><i>Leave this blank if you want to a auto generate ID no.</i></small-->
					</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">Last Name</label>
				<input type="text" name="lastname" class="form-control" value="<?php echo isset($lastname) ? $lastname:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">First Name</label>
				<input type="text" name="firstname" class="form-control" value="<?php echo isset($firstname) ? $firstname:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Middle Name</label>
				<input type="text" name="middlename" class="form-control" value="<?php echo isset($middlename) ? $middlename:'' ?>">
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">Email</label>
				<input type="email" name="email" class="form-control" value="<?php echo isset($email) ? $email:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Contact #</label>
				<input type="text" name="contact" class="form-control" value="<?php echo isset($contact) ? $contact:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Gender</label>
				<select name="gender" required="" class="custom-select" id="">
					<option <?php echo isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Male</option>
					<option <?php echo isset($gender) && $gender == 'Female' ? 'selected' : '' ?>>Female</option>
				</select>
			</div>
			<div class="col-md-4">
				<label class="control-label">Usename #</label>
				<input type="text" name="username" class="form-control" value="<?php echo isset($contact) ? $contact:'' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Password #</label>
				<input type="text" name="password" class="form-control" value="<?php echo isset($contact) ? $contact:'' ?>" required>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Address</label>
				<textarea name="address" class="form-control"><?php echo isset($address) ? $address : '' ?></textarea>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
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
			<div class="col-md-4">
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
			<div class="col-md-4">
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
		</div>
		<div class="submit-buttons">
		<input type="submit"value="Save"name="save-him" id="save-him" class="btn btn-primary">
		<input type="submit"value="Update"name="save-him" id="update-him" class="btn btn-primary">
		</div>
	</form>
</div>
<script src="assets/js/jquery-te-1.4.0.min.js"></script>
<script src="assets/js/new.js"></script>
<script>

// $('#save-him').on('click', function(e){
// 	e.preventDefault()
// 	var data=$('#manage-member').serialize()
// 	$.ajax({
// 		url:'save_member.php',
// 		data:data,
// 		success:function(data){
// 			$('#msg')	.html(data)
// 		}
// 	})
// })

	// $('#manage-member').submit(function(e){
	// 	e.preventDefault()
	// 	//start_load()
	// 	$.ajax({
	// 		url:'save_member.php',
	// 		method:'POST',
	// 		data:$(this).serialize(),
	// 		success:function(resp){
	// 			if(resp == 1){
	// 				alert_toast(resp)
	// 				setTimeout(function(){
	// 					//location.reload()
	// 				},1000)
	// 			}else if(resp == 2){
	// 				$('#msg').html(resp)
	// 				//end_load();
	// 			}
	// 		}
	// 	})
	// })
</script>

<style>
	.submit-buttons{
		text-align:right;
		width:100%;
	}
	#save-him{
		display:block;
		float:right;
	}
	#update-him{
		display:none;
	}
	#submit{
		display:none;
	}
	#upper-cancel{
		margin-top:-20px;
		margin-right:3%;
	}
</style>