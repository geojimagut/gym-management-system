<?php
include('db_connect.php');

$id=$_POST['member_id'];
$plan_id=$_POST['plan_id'];
      $package_id=$_POST['package_id'];
      $trainer_id=$_POST['trainer_id'];
      ?>
            <script>
                  alert('Here')
            </script>
      <?php
$updatereg="insert into registration_info(member_id, plan_id, package_id, trainer_id) values('$id', '$plan_id', '$package_id', '$trainer_id')";
$conn->query($updatereg);
?>