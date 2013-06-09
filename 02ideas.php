<?php
    include_once ('evform.php');
     
    if (isset($_POST['ideatitle'])){
        
         if($_POST['hiddenid']!=null){
             echo $_POST['hiddenid'];
       $sql1="UPDATE idea SET title='$_POST[ideatitle]',idea_disc='$_POST[ideadescription]' 
           WHERE idea_id='$_POST[hiddenid]'";
       echo $sql1;
         mysqli_query($con,$sql1);
        $_POST['hiddenid']=null;   
       }
       else{
         //inserting a new idea
    $query2= "INSERT INTO idea (title,idea_disc)      
        VALUES ('$_POST[ideatitle]','$_POST[ideadescription]')"; //post request have no restriction on data length
    mysqli_query($con,$query2) or die ('could no connect with instructions');
    }
    }
    //deleting idea
    if(isset($_POST['delete_idea_id'])){
        echo $_POST['delete_idea_id'];
     $delete_idea=" DELETE FROM idea WHERE idea_id='$_POST[delete_idea_id]'"; 
      mysqli_query($con,$delete_idea);
    }
    
    //retrieving ideas
    $query1= "SELECT * FROM idea";
    $fetch1=mysqli_query($con,$query1) or die ('could no connect with instructions');
   
    
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
<script type='text/javascript' src='http://twitter.github.io/bootstrap/assets/js/bootstrap-transition.js'></script>
<script type='text/javascript' src='http://twitter.github.io/bootstrap/assets/js/bootstrap-collapse.js'></script>
    </head>
    <body> 
        
       <!-- managing ideas table-->
        <table class="table table-hover">
            <tr><th>Title</th><th>Edit</th><th>Delete</th></tr>
        <?php
   
 while($result = mysqli_fetch_array($fetch1)) {
     echo "<tr><td><div class='accordion-group'>";
    echo "<div class='accordion-heading'>";
       echo "<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapse".$result['idea_id']."'>";
echo $result["title"]."</a></div></td><td>
         <a href='#ideaModal' role='button' class='btn' data-toggle='modal' onclick=\"javascript:editIdea('".$result['title']."','".$result['idea_disc']."','".$result['idea_id']."');\">Edit</a> </td>
         <td><button class='btn' onclick='deleteConfirm(".$result['idea_id'].")'>Delete</button> </td></tr>";
     echo "<tr><td colspan='3'><div id='collapse".$result['idea_id']."' class='accordion-body collapse'>".$result['idea_disc'];
                echo    "<div class='accordion-inner'>";
echo '</div></div></td></tr></div>';
}
    
 
?>
        </table>
         <a href="#ideaModal" role="button" class="btn btn-primary" data-toggle="modal" onclick="javascript:ediIdea('','',null);">Add Idea</a>
         
      <!-- Modal -->
   
            <div id="ideaModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div> 
                <h3 id="myModalLabel">Add a new Idea</h3>
                <form method='post' action='02ideas.php'>
                Title <input type="text" name='ideatitle' id='ideatitle'><br>
              Description<br><textarea rows="4" cols="50" name='ideadescription' id='ideadesc'>

</textarea><br>
         </select><br>
            <div style="visibility: hidden"> <input type="text" name="hiddenid" id="hiddenid"></div>
         <button class='btn btn-primary'>OK</button>
         <button class='btn' data-dismiss="modal" aria-hidden="true">Cancel</button>
                </form>
            </div>
           
    
        
     <div id="editIdea" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div> 
                 <h3 id="myModalLabel">Edit Idea</h3>
                Title <input type="text"><br>
              Description<input type="text"><br>
        
         <button class='btn btn-primary'>OK</button>
         <button class='btn' data-dismiss="modal" aria-hidden="true">Cancel</button>
                
            </div>   
         
<script>
function deleteConfirm(idea_id)
{
var r=confirm("Are you sure you want to delete this idea?");

if (r==true){
    $.post("02ideas.php",{ delete_idea_id : idea_id });
     window.location.href = "02ideas.php";
}
}
//insert values from table to modal
function editIdea(name,description,hiddenid) {
 var myTarget = document.getElementById("ideatitle");
    myTarget.value =name;
    myTarget = document.getElementById("ideadesc");
    myTarget.value =description;
    myTarget = document.getElementById("hiddenid");
    myTarget.value =hiddenid;
   
}
</script>
<?php
 mysqli_close($con);
 ?>
 </body>  
</html>