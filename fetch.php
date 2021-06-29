<?php
include 'config.php';



if(isset($_POST["search_param"])){


 $search = mysqli_real_escape_string($con, $_POST["search_param"]);
 $query = "";
 $query = " SELECT * FROM applicant  WHERE name LIKE '%".$search."%'";


}


$result = mysqli_query($con, $query);
if(mysqli_num_rows($result) > 0 ){
  while($row = mysqli_fetch_array($result)){
    $arr['id'] = $row['id'];
    $arr['name'] = $row['name'];
    $arr['email'] = $row['email'];
    $arr['phone'] = $row['phonenumber'];
  
    $res[] = $arr;
  }
  echo json_encode(array("message"=>"fetch successfully","status"=>"success",  "data"=>$res,"code"=>200));
}else{
  echo json_encode(array("message"=>"data not found","status"=>"Unsuccess","data"=>array(),"code"=>404));
}

?>



