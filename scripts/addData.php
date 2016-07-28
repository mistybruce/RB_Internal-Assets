<?php
include_once 'connect.php';
if(isset($_POST['btn-save']))
{
 $id_asset = $_POST['id_asset'];
 $id_asset_type = $_POST['id_asset_type'];
 $name = $_POST['name'];
 $description= $_POST['description'];

 if($crud->create($name,$description))
 {
  header("Location: addData.php?inserted");
 }
 else
 {
  header("Location: addData.php?failure");
 }
}
?>
<?php include_once 'views/header.php'; ?>
<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
 ?>
    <div class="container">
 <div class="alert alert-info">
    <strong>Complete</strong> Record was inserted successfully <a href="index.php">HOME</a>!
 </div>
 </div>
    <?php
}
else if(isset($_GET['failure']))
{
 ?>
    <div class="container">
 <div class="alert alert-warning">
    <strong>SORRY!</strong> ERROR while inserting record !
 </div>
 </div>
    <?php
}
?>

<div class="clearfix"></div><br />

<div class="container">

  
  <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>Asset Name</td>
            <td><input type='text' name='name' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Asset Description</td>
            <td><input type='text' name='description' class='form-control' required></td>
        </tr>

        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
      <span class="glyphicon glyphicon-plus"></span> Create New Record
   </button>  
            <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'views/footer.php'; ?>