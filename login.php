<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
if(!isset($_SESSION['system'])){
	// $system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	// foreach($system as $k => $v){
	// 	$_SESSION['system'][$k] = $v;
	// }
}
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>User Login</title>
 	

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
		background-image:url(background/header-background.png);
		background-size:cover;
		background-repeat:no-repeat;
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position: absolute;
		right:0;
		width:40%;
		height: calc(100%);
		background:transparent;
		
		/* display: flex; */
		align-items: center;
	}
	#login-left{
		position: absolute;
		left:0;
		width:60%;
		height: calc(100%);
		background:transparent;
		align-items: center;
		/* background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>); */
	    background-repeat: no-repeat;
	    background-size: cover;
	}
	.create-account{
		margin-left:5%;
		margin-top:60px;
		font-size:18px;
		color:#000;
		margin-top:70px;
		z-index:300;
	}
	#login-right .card{
		margin: auto;
		z-index: 1
	}
	.logo {
    margin: auto;
    font-size: 8rem;
    background: white;
    padding: .5em 0.7em;
    border-radius: 50% 50%;
    color: #000000b3;
    z-index: 10;
}
div#login-right::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: calc(100%);
    height: calc(100%);
    /* background: #000000e0; */
}
#btn_cancel	{
	margin-left:7%;
}
#login-left form{
	width:100%;
	margin-left:5%;
	display:flex;
	flex-wrap:wrap;
	margin-top:	50px;
}
#login-left form .form-group{
	width:30%;
	margin-left:1.5%;
}
#login-left form input, #login-left form select{
	/* margin-top:0; */
	margin-bottom:20px;
	width:100%;

}
#login-left form button{
	float:right;
}
#signupform{
	display:none;
}
#sign_result{
	margin-left:5%;
	color:red;
}
.running-man{
	position:absolute;
	height:100vh;
	/* background-color:#FFFFFF; */
	width:100%;
}
.form_panel{
	z-index:5;
	position:absolute;
	background:transparent;
	width:100%;
}
.running-man{
	margin-top:40px;
}
</style>

<body>


  <main id="main" class=" bg-dark">
  		<div id="login-left">
			<div class="running-man">
				<img src="background/running-man.png"alt="Oops! No image">
			</div>
			<div class="form_panel">
		  <a href="#"id="show_signup"><span class="create-account">Create Account</span></a>
		  <div id="signupform">
		  <form id="frmSign">
		  <div class="form-group">
			<input type="number"class="form-control"placeholder="Enter Your ID"name="txtid"id="txtid">
			</div>
			<div class="form-group">
			<input type="text"class="form-control"placeholder="First Name"name="txtfname"id="txtfname">
			</div>
			<div class="form-group">
			<input type="text"class="form-control"placeholder="Middle Name"name="txtmname"id="txtmname">
			</div>
			<div class="form-group">
			<input type="text"class="form-control"placeholder="Last Name"name="txtlname"id="txtlname">
			</div>
			<div class="form-group">
			<select name="gender" id="gender"class="form-control">
				<option value=""></option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select>
			</div>			
			<div class="form-group">
			<input type="text"class="form-control"placeholder="Contact"name="contact"id="contact">
			</div>
			<div class="form-group">
			<input type="text"class="form-control"placeholder="Address"name="address"id="address">
			</div>
			<div class="form-group">
			<input type="text"class="form-control"placeholder="Email"name="email"id="email">
			</div>
			<div class="form-group">
			<input type="text"class="form-control"placeholder="Usename"name="username"id="username">
			</div>
			<div class="form-group">
			<input type="password"class="form-control"placeholder="Password"name="password"id="password">
			</div>
			<div class="form-group">
			<input type="password"class="form-control"placeholder="Confirm Password"name="con_password"id="con_password">
			</div>
			<div class="form-group">
			<input type="button"value="Sign up"class="btn btn-primary"id="btn_create">
			</div>
		  </form>
		  <button class="btn btn-secondary"id="btn_cancel">Cancel</button>
		  <div id="sign_result"></div>
			</div>
</div>
  		</div>

  		<div id="login-right">
  			<div class="card col-md-8"style="margin-top:215px">
  				<div class="card-body">
  						
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="username" class="control-label">Username</label>
  							<input type="text" id="username" name="username" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label">Password</label>
  							<input type="password" id="password" name="password" class="form-control">
  						</div>
  						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
  					</form>
  				</div>
  			</div>
			
  		</div>
   

  </main>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
	
</body>

<style>
	.bottom_part{
		margin-top:100vh;
		position:absolute;
		color:#000;
		width:100%;
		height:fit-content;
	}
	.why_us{
		text-align:center;
		height:fit-content;
		padding-bottom:30px;
	}
	.why-us h3{
		font-size:52px;
		font-weight:bold;
		color:rgb(0,130,189);
		font-family:Tahoma;
		text-decoration:underline;
	}
	.small_logo{
		text-align:center;
		margin-top:50px;
	}
	.small_logo .fa{
		font-size:100px;
		color:red;
	}
	.service_wrapper{
		display:flex;
		width:90%;
		margin-left:5%;
	}
	.service_body{
		width:30%;
		margin-left:1.5%;
		height:fit-content;
		padding-bottom:20px;
		/* border:1px solid rgb(200,200,200); */
		border-radius:4px;
	}
	.service{
		text-align:center;	
	}
	.service p{
		font-size:25px;
		font-weight:bold;
		margin-top:30px;
		color:blue;
	}
</style>
<div class="bottom_part">
	<div class="why_us"style="margin-top:50px">
		<h3 style="color:purple;font-size:52px;font-weight:bold;">Why Choose Us?</h3>
	</div>
	<div class="service_wrapper">
	<div class="service_body">
		<div class="small_logo">
			<i class="fa fa-forward" aria-hidden="true"style="font-size:72px;color:red"></i>
		</div>
		<div class="service">
			<p>Register</p>
		</div>
	</div>
	<div class="service_body">
		<div class="small_logo">
			<i class="fa fa-forward" aria-hidden="true"style="font-size:72px;color:red"></i>
		</div>
		<div class="service">
			<p>Select a trainer</p>
		</div>
</div>
<div class="service_body">
		<div class="small_logo">
			<i class="fa fa-forward" aria-hidden="true"style="font-size:72px;color:red"></i>
		</div>
		<div class="service">
			<p>Show up for training</p>
		</div>
</div>
</div>
<!-- contact -->

<div class="contact"style="margin-top:150px;text-align:center;margin-bottom:100px;">
<div class="why_us"style="margin-top:50px">
		<h3 style="color:purple;font-size:37px;font-weight:bold;">Why Choose Us?</h3>
	</div>
	<input type="text"placeholder="Enter Email Address"style="width:60%;height:40px;border:0;border-bottom:2px solid purple;"><br>
	<input type="text"placeholder="Message . . ."style="width:60%;height:40px;border:0;border-bottom:2px solid purple;margin-top:50px;"><br>
	<div class="ka_button"style="text-align:left;width:60%;margin-left:20%;">
	<button class="btn btn-secondary"style="width:15%;margin-top:20px;">SEND</button>
	</div>
	
</div>
<!-- footer -->
<div id="home_footer"style="width:100%;background:#000;height:200px;color:#FFFFFF">
<div class="why_us"style="margin-top:50px">
		<h3 style="color:white;font-size:52px;font-weight:bold;padding-top:30px">Go Hard or Go Home!</h3>
	</div>
</div>
</div>
<script>
	//signing up

	$('#btn_create').on('click', function(){
		var data=$('#frmSign').serialize() +'&btn_create = btn_create'
		$.ajax({
			url:'save_member.php',
			method:'POST',
			data:data,
			success:function(data){
				$('#sign_result').html(data)
				setTimeout(function(){
					$('#sign_result').html('')
					document.getElementById('txtid').value=''
					document.getElementById('txtfname').value=''
					document.getElementById('txtmname').value=''
					document.getElementById('txtlname').value=''
					document.getElementById('gender').value=''
					document.getElementById('contact').value=''
					document.getElementById('address').value=''
					document.getElementById('email').value=''
					document.getElementById('username').value=''
					document.getElementById('password').value=''
					document.getElementById('con_password').value=''
				},150000)
			}
		})
	})
	//end of sign up
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
	document.getElementById('show_signup').onclick=function(){
		setTimeout(function(){
			document.getElementById('signupform').style.display='block'
		// document.getElementById('login-left').style.backgroundColor='#000'
		},200)
		
	}
	document.getElementById('btn_cancel').onclick=function(){
		setTimeout(function(){
			document.getElementById('signupform').style.display='none'
		// document.getElementById('login-left').style.backgroundColor='#FFFFFF'
		},200)
	}
</script>	
</html>