<?php
include('db_connect.php');
/*signing up for an account*/
  $id=$_POST['txtid'];
  $fname=$_POST['txtfname'];
  $mname=$_POST['txtmname'];
  $lname=$_POST['txtlname'];
  $gender=$_POST['gender'];
  $contact=$_POST['contact'];
  $address=$_POST['address'];
  $email=$_POST['email'];
  $username=$_POST['username'];
  $password=$_POST['password'];
  $con_password=$_POST['con_password'];

  if(empty($id)||empty($fname)||empty($lname)||empty($gender)||empty($contact)||empty($address)||empty($email)||empty($username)||empty($password)||empty($con_password)){
    echo "Please fill all the fields";
  }else if($password!=$con_password){
    echo "Passwords do not match!";
  }else{
    $result=$conn->query("select * from members where member_id='$id'");
    $reg=mysqli_num_rows($result);
    if($reg<1){
      $regmember="insert into members(member_id, firstname, middlename, lastname, gender, contact, address, email) values( '$id','$fname' , '$mname','$lname' ,'$gender','$contact' ,'$address' , '$email')";
      if($conn->query($regmember)){
          $getuserid="select * from members ORDER by id DESC limit 1";
          $idresult=$conn->query($getuserid);
          $idrow=mysqli_fetch_assoc($idresult);
          $clientid=$idrow['id'];
          $updatereg="insert into user_client(member_id,name,username,password,type) values('$clientid', '$username', '$username', '$password', '1')";
          if($conn->query($updatereg)){
            echo "Registration successful";
          }else{
            echo "Failed";
          }
          
      }else{
        echo "Registration failed!";
      }
    }else{
      echo "User already exists!";
    }
   
  }

?>