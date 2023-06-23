<?php
include('db_connect.php');

$result=$conn->query("select id from members where member_id=".$_POST['member']);
$row=mysqli_fetch_assoc($result);
$id=$row['id'];
$paid=$_POST['paid'];
if($conn->query("update registration_info set status='3', amount= '$paid', date_of_payment=CURRENT_TIMESTAMP where member_id='$id'")){
    echo "1";
}else{
    echo "2";
}


?>