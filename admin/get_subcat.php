<?php
include('include/config.php');
if(!empty($_POST["matl"])) 
{
 $matl=$_POST['matl'];

$query=mysqli_query($con,"SELECT * FROM contheloai where matl='$matl'");
?>
<option value="">Chọn con thể loại</option>
<?php
 while($row=mysqli_fetch_array($query))
 {
  ?>
  <option value="<?php echo htmlentities($row['mactl']); ?>"><?php echo htmlentities($row['tenctl']); ?></option>
  <?php
 }
}
?>