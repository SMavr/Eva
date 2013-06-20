<?php
include_once ('evform.php');


$inst_id=$_GET['inst_id'];
$new_instruction_text=$_GET['insturction_text'];


//update an instruction with the new text
$update_instruction="UPDATE instructions SET 
    instructions='".$new_instruction_text."' WHERE instructions_id=".$inst_id;
mysqli_query($con,$update_instruction);
echo  ' Intsruction '.$inst_id.' was saved';
// select instruction with a specific id
//$select_instruction="SELECT instructions FROM 
//    instructions WHERE instructions_id=".$inst_id;
//$select_instruction_fetch=mysqli_query($con,$select_instruction);

mysqli_close($con);
?>