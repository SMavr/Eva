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
        
        <table class="table table-hover">
            <tr><th>Username</th><<th>Edit</th><th>Delete</th></tr>
        <?php
    include_once ('evform.php');
    $query= "SELECT * FROM idea";
    $fetch=mysqli_query($con,$query) or die ('could no connect with instructions');
   
 while($result = mysqli_fetch_array($fetch)) {
echo "<tr><td>".$result["title"]."</td><td>
         <a href='#editIdea' role='button' class='btn' data-toggle='modal'>Edit</a> </td>
         <td><button class='btn'onclick='deleteConfirm()'>Delete</button> </td></tr>";
}
    
 
?>
        </table>
      
        <div>
            <div id="newIdea" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div> 
                <h3 id="myModalLabel">Add a new Idea</h3>
                Title <input type="text"><br>
              Description<input type="text"><br>
         </select><br>
         <button class='btn btn-primary'>OK</button>
         <button class='btn' data-dismiss="modal" aria-hidden="true">Cancel</button>
                
            </div>
            <a href="#newIdea" role="button" class="btn btn-primary" data-toggle="modal">Add Idea</a>
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

          
            
            <h2>Example accordion</h2>
           
            <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#demo">
                hi
            </button>
            <div id="demo" class="collapse in">fjasdfsafskadfa;sdfas </div>
              <div class="accordion" id="accordion2">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                      Collapsible Group Item #1
                    </a>
                  </div>
                  <div id="collapseOne" class="accordion-body collapse in">
                    <div class="accordion-inner">
                      <h3 id="myModalLabel">Edit Question</h3>
                 Question Text<input type="text"><br>
                 Question Weight<input type="text"><br>
                  Set Category  
                 
  <select>
  <option >Category 1</option>
  <option >Category 2</option>
  <option >Category 3</option>
  </select><br>
  
  
  
  
     
  <h4>Edit Answers</h4><br>
  <p>Text         Value        Delete</p>
  <div>
  <?php
  $query1= "SELECT * FROM qvalues WHERE question_id=1";
  $fetch1=mysqli_query($con,$query1);
  while($result1 = mysqli_fetch_array($fetch1)) {
      echo " <input type='text' value='".$result1["qv_text"]."'> <input type='text'
    value='" .$result1["qv_value"]."'>
    <button class='btn'>Delete</button>";}
  ?>
      <br>
     <button class='btn'>add</button> 
     <br>
         <button class='btn btn-primary'>OK</button>
         <button class='btn' data-dismiss="modal" aria-hidden="true">Cancel</button>
          </div>
  </div>      
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                      Collapsible Group Item #2
                    </a>
                  </div>
                  <div id="collapseTwo" class="accordion-body collapse">
                    <div class="accordion-inner">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                      Collapsible Group Item #3
                    </a>
                  </div>
                  <div id="collapseThree" class="accordion-body collapse">
                    <div class="accordion-inner">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div>
              </div>
            
    </body>
    
</html>