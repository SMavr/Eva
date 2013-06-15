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

   }
   
   //maybe I have to delete those
    $_POST['newusername']=null; 
   $_POST['password']=null;
    $_POST['isattr']=null;
   }
   
   //deleting user
    if(isset($_POST['deleteuserid'])){
     $deleteuser=" DELETE FROM user WHERE user_id='$_POST[deleteuserid]'"; 
      mysqli_query($con,$deleteuser);
    }
    
    //insert new attribute in the database
    if(isset($_POST['attrname'])){
       $new_attr_query="INSERT INTO attribute (attr_title)
           VALUES ('".$_POST['attrname']."')";
       mysqli_query($con, $new_attr_query);
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
<script type='text/javascript' src='http://twitter.github.io/bootstrap/assets/js/bootstrap-tab.js'></script>
<script>$("#tabs").tabs({
  selected: 2 
});</script>
    </head>
    <body>
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li <li class="<?php echo isset($_POST['attrname']) ? '' : 'active'; ?>"><a href="#usertablediv" data-toggle="tab">Users</a></li>
        <li class="<?php echo isset($_POST['attrname']) ? 'active' : ''; ?>"><a href="#attrdiv" data-toggle="tab">Attributes</a></li>
        </ul>
          <div id="users_attributes" class="tab-content">
        <div class="tab-pane <?php echo isset($_POST['attrname']) ? '' : 'active'; ?>" id="usertablediv">
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
             <!--Creating the add button. rewriteUser is important for the edituser data not to be writed in the modal -->
            <a href="#userModal" role="button" class="btn btn-primary" data-toggle="modal" onclick="javascript:rewriteUser('','','',null,null);">Add New User</a>
        </div>
              
              
              <!-- The attributes table div (maybe we should make a seperate file with this)-->
              
           <div class="tab-pane <?php echo isset($_POST['attrname']) ? 'active' : ''; ?>" id="attrdiv">
               <table class="table table-hover" id="usertable">
                   <tr><th>Title</th><th>Users</th><th>Edit Users</th> <th>Delete</th></tr>
                   <?php
                  
                    while ($attrresult=mysqli_fetch_array($attrfetch))
                    {
                         //1 retrieving users who belong to a specific attribute
     $users_to_attr= 'SELECT username FROM user, usertoattr WHERE 
         usertoattr.attr_id='.$attrresult["attr_id"].' AND user.user_id = usertoattr.user_id';

     $users_to_attr_fetch=mysqli_query($con,$users_to_attr);
     $attribute1='';
     
     //needing for the javascript function
     $attr2=array();
    while ($users_to_attr_result=mysqli_fetch_array($users_to_attr_fetch))
     {
        $attr2[]=$users_to_attr_result["username"];
     }
             $attribute1=implode(",", $attr2);
             
            //1 end
                        
                        //counting how many users belong to each attribute
                          $users_to_attr_count='SELECT COUNT(*) FROM usertoattr 
                              WHERE usertoattr.attr_id ='.$attrresult["attr_id"];
                          $users_to_attr_count_fetch=mysqli_query($con,$users_to_attr_count);
                           $users_to_attr_count_result=mysqli_fetch_array( $users_to_attr_count_fetch);
                  echo '<tr><td>'.$attrresult["attr_title"].'</td>
                      <td>'.$users_to_attr_count_result["COUNT(*)"].'</td>
                        <td>  <a href="#attrModal" role="button"  class="btn" data-toggle="modal"
                        onclick="javascript:editAttribute(\''.$attrresult["attr_title"].'\',\''.$attrresult["attr_id"].'\',\''.
                         $attribute1.'\');">Edit</a></td>
                        <td><a href="#" role="button" class="btn" onclick=\"javascript:\">Delete</button> </td></tr>';      
                        
                        
                    }
                   
                   ?>
               </table>
                <a href="#attrModal" role="button" class="btn btn-primary" data-toggle="modal" onclick="javascript:editAttribute('','','');">Add Attribute</a>
        </div>   
          </div>
      
        <!-- end of attributes table-->
        
        
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
           $attrfetch=mysqli_query($con,$attrquery);  
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
          <!--end of user Modal-->  
          
          <!-- Modal for edit uses to each attribute -->
            <div id="attrModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div> 
                <h5 id="myModalLabel">Edit <p name="attrpd" id="attrpd"></p></h5> 
                 <form method='post' action='01users.php'>
                 Edit attribute title <input type="text" name="attrname" id='attrname'><br>
         Users<br> <select multiple="multiple" name="attr_users_select" id="attr_users_select" style="height:200px">
             <?php
             $fetch1=mysqli_query($con,$query);
 while($result1 = mysqli_fetch_array($fetch1)) {
echo  "<option >".$result1["username"]."</option>";
 }
             ?>
         </select><br>
          <!-- hidden div used to capture the id of the current attribute -->
         <div style="visibility: hidden"> <input type="text" name="attr_hidden_id" id="attr_hidden_id"></div>
         <button class='btn btn-primary'type='submit'>Save</button>
         <button class='btn' data-dismiss="modal" aria-hidden="true">Cancel</button>
                 </form>
                
            </div>
          <!--end of user Modal-->  
     
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
}

// insert values to the attributes modal
function editAttribute(title,attr_id,users_to_attr) {
 var myTarget = document.getElementById("attrname");
    myTarget.value =title;
    document.getElementById("attrpd").innerHTML = title;
     myTarget = document.getElementById("attr_hidden_id");
    myTarget.value =attr_id;
    
    //grey the users who belong to the specific attribute
 var optionsToSelect=users_to_attr.split(",");
myTarget = document.getElementById("attr_users_select");

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


}
//jQuery(document).ready(function ($) {
//        $('#tabs').tab();
//    });

 
</script>
 <?php
 mysqli_close($con);
 ?>

    </body>
    
</html>