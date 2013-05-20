<!DOCTYPE html>
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
        
        <table class="table table-hover">
            <tr><th>Username</th><th>Password</th><th>Role</th>><th>Attribute</th></th><th>Ideas/Score</th><th>Edit</th><th>Delete</th></tr>
        <?php
    include_once ('evform.php');
    $query= "SELECT * FROM user";
    $fetch=mysqli_query($con,$query) or die ('could no connect with instructions');
   
 while($result = mysqli_fetch_array($fetch)) {
echo "<tr><td>".$result["username"]."</td><td>" .$result["password"]."</td>
    <td>" .$result["role"]."</td><td>only for Eval</td><td>coming soon</td><td>
         <a href='#editUser' role='button' class='btn' data-toggle='modal'>Edit</a> </td>
         <td><button class='btn'onclick='deleteConfirm()'>Delete</button> </td></tr>";
}
    
 
?>
        </table>
      
        <div>
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
         User Attribute <select>
  <option >Economics</option>
  <option >Software</option>
  <option >Management</option>
         </select><br>
         <button class='btn btn-primary'>OK</button>
         <button class='btn' data-dismiss="modal" aria-hidden="true">Cancel</button>
                
            </div>
            <a href="#userModal" role="button" class="btn btn-primary" data-toggle="modal">Add New User</a>
        </div>
            
        
     <div id="editUser" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div> 
                 <h3 id="myModalLabel">Edit User</h3>
                 User Name <input type="text"><br>
         User Password <input type="text"><br>
         User Email <input type="text"><br>
         User Role <select>
  <option >Evaluator</option>
  <option >Observer</option>
         </select><br>
         User Attribute <select>
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
</script>

            
    </body>
    
</html>