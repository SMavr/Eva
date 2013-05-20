<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
include_once ('evform.php');
$result=mysql_query("SELECT * FROM idea");
echo "<select name='idea'>";
while ($temp = mysql_fetch_assoc($result)) 
                {
    echo "<option value='".$temp['id']."'>".$temp['title']."</option>";
}
echo "</select>";
?>
