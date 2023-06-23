<?php
include('db_connect.php');
if(isset($_POST['save-him'])){
      $id=$_POST['member_id'];
      $lastname=$_POST['lastname'];
      $firstname=$_POST['firstname'];
      $middlename=$_POST['middlename'];
      $email=$_POST['email'];
      $contact=$_POST['contact'];
      $gender=$_POST['gender'];
      $address=$_POST['address'];
      $plan_id=$_POST['plan_id'];
      $package_id=$_POST['package_id'];
      $trainer_id=$_POST['trainer_id'];
      $username=$_POST['username'];
      $password=$_POST['password'];

      $memberesult=$conn->query("select * from members where member_id='$id' ");
      $rowcount=mysqli_num_rows($memberesult);
      if($rowcount<1){
      $regmember="insert into members(member_id, firstname, middlename, lastname, gender, contact, address, email) values( '$id','$firstname' , '$middlename','$lastname' ,'$gender','$contact' ,'$address' , '$email')";
      if($conn->query($regmember)){
          $getuserid="select * from members ORDER by id DESC limit 1";
          $idresult=$conn->query($getuserid);
          $idrow=mysqli_fetch_assoc($idresult);
          $clientid=$idrow['id'];
          $pass="insert into user_client(member_id,name,username,password,type) values('$clientid', '$username', '$username', '$password', '1')";
          $conn->query($pass);
          $updatereg="insert into registration_info(member_id, plan_id, package_id, trainer_id) values('$clientid', '$plan_id', '$package_id', '$trainer_id')";
          $conn->query($updatereg);
        ?>
        <script>
          alert('Registration successful')
        </script>
      <?php
      }else{
        ?>
        <script>
          alert('Failed');
        </script>
      <?php
      }
      
    }else{
      ?><script>alert('Member exists!')</script><?php
    }
    header('Location:index.php?page=members');

}else if(isset($_POST['btn_update'])){
  $txtid=$_POST['txtid'];
  $txtfname=$_POST['txtfname'];
  $txtmname=$_POST['txtmname'];
  $txtlname=$_POST['txtlname'];
  $txtemail=$_POST['txtemail'];
  $txtcontact=$_POST['txtcontact'];
  $previd=$_POST['txthidden'];
  $updatemember="update members set member_id='$txtid',firstname='$txtfname',middlename='$txtmname',lastname='$txtlname',gender='$txtgender',contact='$txtcontact',address='$txtaddress',email='$txtemail' where member_id='$previd' ";
  if($conn->query($updatemember)){
        echo "Update successful";
        header('Location:index.php?page=members');
      }else{
        echo "Failed";
      }
}else{
?><script>alert('here')</script><?php
}

?>