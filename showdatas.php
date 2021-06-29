<?php
include('config.php');
$viewlimit = 4;
$page = '';
if(isset($_POST['pageno']) && $_POST['pageno'] != '')
{
$page = $_POST['pageno'];
}
else{
$page = 1;
}
$offset = ($page -1)*$viewlimit;
$sql_total = mysqli_query($con,"SELECT * from applicant");
$total_records = mysqli_num_rows($sql_total);
$total_pages = ceil($total_records/$viewlimit);
$output = array();

$select = mysqli_query($con,"SELECT * from `applicant` LIMIT {$offset},{$viewlimit}");
if($select)
{
while($row = mysqli_fetch_assoc($select))
{
$array['id'] = $row['id'];
$array['name'] = $row['name'];
$array['phno'] = $row['phonenumber'];
$array['email'] = $row['email'];
$output[] = $array;
}
}
echo json_encode(array("message"=>"Sucessfull","status"=>"Success","data"=>$output,'page'=>$page,'pagecount'=>$total_pages));
?>