<?php
include('db_connect.php');


$clientid=$_POST['member_id'];
	$plan_id=$_POST['plan_id'];
    $package_id=$_POST['package_id'];
    $trainer_id=$_POST['trainer_id'];

    $result=$conn->query("select * from registration_info where member_id='$clientid'");
    $count=mysqli_num_rows($result);
    if($count<1){
        $updatereg="insert into registration_info(member_id, plan_id, package_id, trainer_id) values('$clientid', '$plan_id', '$package_id', '$trainer_id')";
        if($conn->query($updatereg)){
            ?>
            <script>
                alert('Data added successfuly')
            setTimeout(function(){
                location.href='index.php?page=trainer'
            },200)
            </script>
            <?php
        }else{
            ?>
            <script>
                alert('An error occurred!')
            setTimeout(function(){
                location.href='index.php?page=trainer'
            },200)
            </script>
            <?php
        }
    }else if($count>0){
        ?>
        <script>
            alert('You already have a plan, schedule and trainer');
            setTimeout(function(){
                location.href='index.php?page=trainer'
            },200)
        </script>
        <?php
    }

?>