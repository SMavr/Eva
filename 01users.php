<!DOCTYPE html>
<?php 
include_once ('evform.php');
// caution! All insert commands have to remain first towards select commands
// inserting new user into the database

   if(isset($_POST['newusername'])){
      
       
       //if you select the id from the hidden div update the current user
       if($_POST['hiddenid']!=null){
       $sql1="UPDATE user SET username='$_POST[newusername]',password='$_POST[newpasswordname]' 
           WHERE user_id='$_POST[hiddenid]'";   
         mysqli_query($con,$sql1);
        $_POST['hiddenid']=null;   
       }
       else{
  $insertuser="INSERT INTO user (username, password)
VALUES ('$_POST[newusername]','$_POST[newpasswordname]')";
  mysqli_query($con,$insertuser);
       
  //inserting attribute inside the database
  if(isset($_POST['isattr'])){
  foreach ($_POST['isattr'] as $newuserattr)
            {
      
      //maybe we should imporve this SQL commands
      $sql1="SELECT user_id FROM user WHERE username='".$_POST['newusername']."'";
      $sql2="SELECT attr_id FROM attribute WHERE attr_title='".$newuserattr."'";
      $sql1fetch=mysqli_query($con,$sql1);
      $sql2fetch=mysqli_query($con,$sql2);
      $sql1result=mysqli_fetch_array($sql1fetch);
      $sql2result=mysqli_fetch_array($sql2fetch);
  $insertuser = "INSERT INTO usertoattr (user_id, attr_id) VALUES 
(".$sql1result['user_id'].",".$sql2result['attr_id'].")";
   mysqli_query($con,$insertuser);
            }
  }
            //important deleting the post of the new user
  
   }
    $_POST['newusername']=null; 
   $_POST['password']=null;
    $_POST['isattr']=null;
   }
   
   //deleting user
    if(isset($_POST['deleteuserid'])){
     $deleteuser=" DELETE FROM user WHERE user_id='$_POST[deleteuserid]'"; 
      mysqli_query($con,$deleteuser);
    }
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
            <tr><th>Username</th><th>Password</th><th>Role</th><th>Attribute</th></th><th>Ideas/Score Ratio</th><th>Edit</th><th>Delete</th></tr>
        <?php
   
 while($result = mysqli_fetch_array($fetch)) {
     
    // retrieving the attributes of a specific Evaluator
     $usertoattrquery= "SELECT attr_title FROM attribute, usertoattr, user WHERE 
         user.user_id = ".$result['user_id']." AND usertoattr.user_id=user.user_id 
     AND attribute.attr_id = usertoattr.attr_id";

     $usertoattrfetch=mysqli_query($con,$usertoattrquery);
     $attribute='';
     //needing for the javascript function
     $attr=array();
    while ($usertoattrresult=mysqli_fetch_array($usertoattrfetch))
     {
        $attr[]=$usertoattrresult["attr_title"];
     }
             $attribute=implode(",", $attr);
       
     // writing the table staff username password role attribute ... we have to add an email column
echo "<tr ><td>".$result["username"]."</td><td>" .$result["password"]."</td>
    <td>" .$result["role"]."</td><td>".$attribute."</td><td>coming soon</td><td>
         <a href='#userModal' role='button'  class='btn' data-toggle='modal' onclick=\"javascript:rewriteUser('".$result["username"]."','".
        $result["password"]."','".$result["role"]."','".$result["user_id"]."','".$attribute."');\">Edit</a> </td>
         <td><a href='#' role='button' class='btn' onclick=\"javascript:deleteConfirm('".$result['user_id'].
        "');\">Delete</button> </td></tr>";


}
   ?>
        </table>
      
        
            <!-- Modal for the creation of a New User -->
            <div id="userModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div> 
                 <h3 id="myModalLabel">Add New User</h3>
                 <form method='post' action='01users.php'>
                 User Name <input type="text" name="newusername" id='editName'><br>
         User Password <input type="text" name="newpasswordname" id='editPass'><br>
         User Email <input type="text" id='editEmail' name="newMail"><br>
         User Role <select multiple="multiple">
  <option >Evaluator</option>
  <option >Observer</option>
         </select><br>
         User Attribute <select multiple="multiple" name="isattr[]" id="editAttr">
             <?php
             
 while($attrresult = mysqli_fetch_array($attrfetch)) {
     // $selected = in_array( $attrresult[attr_title], $attr ) ? ' selected' : '';
echo  "<option >".$attrresult[attr_title]."</option>";
 }
             ?>
         </select><br>
          <!-- hidden div used to capture the edit user id -->
         <div style="visibility: hidden"> <input type="text" name="hiddenid" id="hiddenid"></div>
         <button class='btn btn-primary'type='submit'>OK</button>
         <button class='btn' data-dismiss="modal" aria-hidden="true">Cancel</button>
                 </form>
                
            </div>
            
             <!--Creating the add button. rewriteUser is important for the edituser data not to be writed in the modal -->
            <a href="#userModal" role="button" class="btn btn-primary" data-toggle="modal" onclick="javascript:rewriteUser('','','',null,null);">Add New User</a>

               
<script>
function deleteConfirm(userid)
{
var r=confirm("Are you sure you want to delete this user?");
if (r==true){
    deleteAnswers(userid);
}
}

function deleteAnswers(userid)
{
    //document.getElementById("exp").innerHTML=userid;

//run again the php file
// this time the delete post values are valid!
$.post("01users.php",{ deleteuserid : userid });
window.location.href = "01users.php";
confirm("Would you like to delete all of his answers too?");
}

//insert values from table to modal
function rewriteUser(name,password,role,userid,attr) {
 var myTarget = document.getElementById("editName");
    myTarget.value =name;
    myTarget = document.getElementById("editPass");
    myTarget.value =password;
     myTarget = document.getElementById("hiddenid");
    myTarget.value =userid;
    
    //make the preselected attributes of users selected 
 var optionsToSelect=attr.split(",");
myTarget = document.getElementById("editAttr");

  for ( var i = 0, l = myTarget.options.length, o; i < l; i++ )
{
    
  o = myTarget.options[i];
  o.selected=false;
  //is the attribute of the user common with the attributes in the modal?
  if ( optionsToSelect.indexOf( o.text ) != -1 )
  {
    o.selected = true;
  }
}

//finding the sellecting attributes
//var allattr= new Array(<?php //echo json_encode(',', $attr); ?>);
//attr=attr.split(",");
//var common;
//for (var i=0; i<attr.length; i++) {
//    common = allattr.indexOf(attr[i]);
//    if (common > -1) {
//        allattr.splice(common, 1);
//    }
//}
//  myTarget = document.getElementById("editAttr");

//     myTarget = document.getElementById("editRole");
//    myTarget.value =role;
//    myTarget = document.getElementById("editAttr");
    
    //declaring that that there is user_id (not working)
//$.post("01users.php",{ edit_user_id : userid });

 
}

 
</script>
 <?php
 mysqli_close($con);
 ?>
    </body>
    
</html>