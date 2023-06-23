<?php include 'db_connect.php';?>
<?php
if(isset($_GET['rid'])){
	$qry = $conn->query("SELECT r.*,p.plan,p.amount as pamount,pp.package,pp.amount as ppamount,concat(m.lastname,', ',m.firstname,' ',m.middlename) as name,m.member_id as mid_no from registration_info r inner join members m on m.id = r.member_id inner join plans p on p.id = r.plan_id inner join packages pp on pp.id = r.package_id where r.id=".$_GET['rid'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
	$trainer = $conn->query("SELECT * FROM trainers where id= $trainer_id");
	$trainer_arr = $trainer->num_rows > 0 ? $trainer->fetch_array() :'';'';
	$tf = $trainer_id > 0 ? $trainer_arr['rate']:0;
}
?>
<style>
	#hidden_button{
		display:none;
	}
</style>
<div class="container-fluid">
	<div class="row">
		
		<div class="col-md-9">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th hidden>#</th>
						<th hidden>trainer</th>
						<th hidden>plan</th>
						<th>You</th>
						<th>Amount</th>
						<th>Remarks</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$userid= $_SESSION['login_id'];
						$pcount=0;
					$paid = $conn->query("SELECT * FROM registration_info inner join plans on registration_info.plan_id = plans.id inner join members on members.id=registration_info.member_id inner join trainers on registration_info.trainer_id=trainers.id and registration_info.member_id='$userid' " );
					while($row= $paid->fetch_assoc()):
						$pcount++;
					?>
					<tr>
						<td hidden><?php echo $row['member_id']; ?></td>
						<td hidden><?php echo $row['rate'];?></td>
						<td hidden><?php echo $row['amount'];?></td>
						<td><?php
							?><label style="font-size:17px;margin-bottom:10px;color:#444;"><span style="color:rgb(0,130,189);font-weight:bold;">First Name: </span><?php echo $row['firstname']?></label><br><?php
							?><label style="font-size:17px;margin-bottom:10px;color:#444;"><span style="color:rgb(0,130,189);font-weight:bold;">Last Name: </span><?php echo $row['lastname'];?><br><?php
							?><label style="font-size:17px;margin-bottom:10px;color:#444;"><span style="color:rgb(0,130,189);font-weight:bold;">Contact: </span> <?php echo $row['contact'];
						?></td>
						<td class="text-right"><?php echo number_format($row['amount']) ?></td>
						<td><?php echo $row['remarks'] ?></td>
						<td><?php if($row['status']==1){
							?><i class="fa fa-edit edit-pay"style="color:rgb(0,130,189);cursor:pointer;font-size:18px;"></i><?php
						}else if($row['status']==3){
							?><span style="font-size:14px;color:green;margin-right:5px;">AWAITING APPROVAL</span><?php
						}else{
							?><span style="font-size:14px;color:green;margin-right:5px;">APPROVED</span><?php
						}
						 ?></td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		<div class="col-md-3">
	
	
			<large><b>New Payment</b></large>
			<form id="manage_payment">
				<input type="hidden" name="registration_id" value="<?php echo $id ?>">
				
				<hr>
				
				<div class="form-group">
					<input type="hidden"id="member"name="member">
					<label for="" class="control-label"> Trainer Fee: <span id="trainer_fee_span"style="color:#333;font-weight:bold"></span></label>
					<input type="hidden" class="form-control" name="trainer_fee"readonly id="trainer_fee">
				</div>
				<div class="form-group">
				<input type="hidden" class="form-control" name="client_id"readonly id="client_id">
					<label for="" class="control-label">Plan Amount: <span id="plan_amount_span"style="color:#333;font-weight:bold"></span></label>
					<input type="hidden" class="form-control" name="amount"readonly id="plan_amount">
				</div>
				<div class="form-group">
					<label for="" class="control-label"> Total: <span id="total_span"style="color:#333;font-weight:bold"></span></label>
					<input type="hidden" class="form-control" name="total"readonly id="total">
				</div>
				<div class="form-group">
					<label for="" class="control-label">Amount</label>
					<input type="number" class="form-control" name="paid"id="paid"required>
				</div>
				
				<div class="form-group">
					<input type="submit"name="save_pay" class="btn btn-primary"value="Save Payment"id="hidden_button">
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-md-12">
			
		</div>
	</div>
</div>
<style>
	p{
		margin:unset;
	}
	td,th{
		padding: 5px
	}
	#uni_modal .modal-footer{
		display: none;
	}
	#uni_modal .modal-footer.display {
		display: block;
	}
</style>
<script>
	$(document).ready(function(){
		$('#manage_payment').submit(function(e){
		e.preventDefault()
		if(document.getElementById('paid').value < document.getElementById('total').value){
			alert('Please pay the full amount!')
		}else{
			start_load()
		$.ajax({
			url:'save_pay.php',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp == 1){
					alert_toast('Payment Successfully saved','success')
					end_load()
					setTimeout(function(){
						location.href='index.php?page=payment'
					},2500)
				}else{
					alert_toast('Failed','danger')
					end_load()
					setTimeout(function(){
						location.href='index.php?page=payment'
					},2500)
				}
			}
		})
		}
		
	})
	
	$('.edit-pay').on('click', function(){
		window.scrollTo(0,0)
		document.getElementById('client_id').value=$(this).closest('tr').find('td:eq(0)').text().trim()
		var train=$(this).closest('tr').find('td:eq(1)').text().trim()
		var amount=$(this).closest('tr').find('td:eq(2)').text().trim()
		document.getElementById('trainer_fee').value=train
		document.getElementById('plan_amount').value=amount
		$('#trainer_fee_span').html(train)
		$('#plan_amount_span').html(amount)
		document.getElementById('member').value=$(this).closest('tr').find('td:eq(0)').text().trim()
		let total=parseInt(train) + parseInt(amount)
		document.getElementById('total').value=total
		$('#total_span').html(total)
		document.getElementById('hidden_button').style.display='block'
	})
	})
	
</script>