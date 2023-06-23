<?php
include('db_connect.php');
$result=$conn->query("select id from members where member_id=".$_POST['id']);
    $row=mysqli_fetch_assoc($result);
    $id=$row['id'];
    if($conn->query("update registration_info set status='0' where member_id='$id'")){
        echo "1";
    }else{
        echo "2";
    }
?>