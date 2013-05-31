<?php
//what to do with passwords
include_once ('evform.php');
$username = mysql_real_escape_string($_POST['username']);
$password =mysql_real_escape_string($_POST['password']);

//$sql ="SELECT count(*) FROM user WHERE( username = '$username' AND password ='$password')";
$result=mysqli_query($con,"SELECT * FROM user WHERE( username = '$username' AND password ='$password')");
$row=mysqli_fetch_array($result);

$log_check=mysqli_num_rows($result);

if($log_check==1){
 if($row["role"]=="Evaluator")   
 {
     session_start();
 $_SESSION['user']= $_POST["username"];
header("location:00ideaselection.php");
 }
 else if ($row["role"]=="Admin"){
     session_start();
     $_SESSION['user']= $_POST["username"];
header("location:0mainadmin.php");
 }
 else {
     echo 'Password or Name are not correct!';
 }
    
    
}
////if you fetch somebody
////if ($row[0] > 0){
//  if($row["role"]=="Evaluator"){  
//    //$url = '0evaluatormain.html';
//echo "you are an Evaluator!";}
////echo "<script language=\"javascript\">
////location.href=\"$url\";
////</script>";}
//else{
//    
//echo  " <script>
//function myFunction()
//{
//alert(\"You are not an Evaluator\");
//}
//</script>";
//    
//}
//}
//    else {
//        echo 'Login failed';
//    }

?>