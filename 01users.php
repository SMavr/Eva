<!DOCTYPE html>
<?php 
include_once ('evform.php');

// retrieving all users from user table 
$query= "SELECT * FROM user";
    $fetch=mysqli_query($con,$query) or die ('could no connect with instructions');
    
 // retrieving  attributes
   $attrquery= "SELECT * FROM attribute";
    $attrfetch=mysqli_query($con,$attrquery) or die ('could no connect with instructions'); 
    
?>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
            <link href="css/bootstrap-responsive.css" rel="stylesheet">
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type='text/javascript' src='http://twitter.github.io/bootstrap/assets/js/bootstrap-modal.js'></script>
<script type='text/javascript' src='http://twitter.github.io/bootstrap/assets/js/jquery.js'></script>
    </head>
    <body>
        <table class="table table-hover" id="usertable">
            <tr><th>Username</th><th>Password</th><th>Role</th>><th>Attribute</th></th><th>Ideas/Score Ratio</th><th>Edit</th><th>Delete</th></tr>
        <?php
   
 while($result = mysqli_fetch_array($fetch)) {
     
    // retrieving the attributes of a specific Evaluator
     $usertoattrquery= "SELECT attr_title FROM attribute, usertoattr, user WHERE 
         user.user_id = ".$result['user_id']." AND usertoattr.user_id=user.user_id 
     AND attribute.attr_id = usertoattr.attr_id";
//     $usertoattrquery= "SELECT * FROM attribute";
     $usertoattrfetch=mysqli_query($con,$usertoattrquery);
     $attribute='';
     //needing for the javascript function
     $attr=array();
    while ($usertoattrresult=mysqli_fetch_array($usertoattrfetch))
     {
       
        $attribute=$attribute.$usertoattrresult["attr_title"].",";
        $attr[]=$usertoattrresult["attr_title"];
     }

     // writing the table staff
echo "<tr id='kota'><td id='kati'>".$result["username"]."</td><td>" .$result["password"]."</td>
    <td>" .$result["role"]."</td><td>".$attribute."</td><td>coming soon</td><td>
         <a href='#editUser' role='button'  class='btn' data-toggle='modal' onclick=\"javascript:rewriteUser('".$result["username"]."','".
        $result["password"]."','".$result["role"]."');\">Edit</a> </td>
         <td><button class='btn'onclick='deleteConfirm()'>Delete</button> </td></tr>";
}
    
 
?>
        </table>
      
        
            <!-- Modal for the creation of a New User -->
            <div id="userModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div> 
                 <h3 id="myModalLabel">Add New User</h3>
                 User Name <input type="text"><br>
         User Password <input type="text"><br>
         User Email <input type="text"><br>
         User Role <select>
  <option >Evaluator</option>
  <option >Observer</option>
         </select><br>
         User Attribute <select multiple>
             <?php
 while($attrresult = mysqli_fetch_array($attrfetch)) {
echo  "<option >".$attrresult[attr_title]."</option>";
 }
             ?>
         </select><br>
         <button class='btn btn-primary'>OK</button>
         <button class='btn' data-dismiss="modal" aria-hidden="true">Cancel</button>
                
            </div>
            <a href="#userModal" role="button" class="btn btn-primary" data-toggle="modal">Add New User</a>
  
            
        
     <div id="editUser" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div> 
                 <h3 id="myModalLabel">Edit User</h3>
                 User Name <input id='editName' type="text"><br>
         User Password <input id='editPass' type="text"><br>
         User Email <input id='editEmail' type="text"><br>
         User Role <select id='editRole'>
  <option >Evaluator</option>
  <option >Observer</option>
         </select><br>
         User Attribute <select multiple id="editAttr">
  <option >Economics</option>
  <option >Software</option>
  <option >Management</option>
         </select><br>
         <button class='btn btn-primary'>OK</button>
         <button class='btn' data-dismiss="modal" aria-hidden="true">Cancel</button>
                
            </div>   
               
<script>
function deleteConfirm()
{
var r=confirm("Are you sure you want to delete this user?");

if (r==true){
    deleteAnswers();
}
}

function deleteAnswers()
{
confirm("Would you like to delete all of his answers too?");
}

function rewriteUser(name,password,role) {
 var myTarget = document.getElementById("editName");
    myTarget.value =name;
    myTarget = document.getElementById("editPass");
    myTarget.value =password;
    myTarget = document.getElementById("editRole");
    myTarget.value =role;
    myTarget = document.getElementById("editAttr");
 // for (i=0;i<this.length;i++){
    //myTarget.value =attr[i];
    
 // }
}
//document.getElementById("1").innerHTML="Welcome to my Homepage";

//function addtext() {
//    
//	var newtext = document.myform.kati.value;
//	if (document.myform.placement[1].checked) {
//		document.myform.outputtext.value = "";
//		}
//	document.myform.outputtext.value += newtext;
//}
//function myFunction()
//{
//$("#editName").html("Heiko")
//}
//$(document).ready(myFunction);

 
</script>
 
    </body>
    
</html>