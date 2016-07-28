<?php
include_once 'connect.php';
if(isset($_POST['btn-update']))
{
 $id = $_GET['edit_id_asset'];
 $id_asset_type = $_GET['edit_id_asset_type'];
 $fname = $_POST['name'];
 $lname = $_POST['description'];
 
 if($crud->update($id,$id_asset_type,$name,$description))
 {
  $msg = "<div class='alert alert-info'>
    <strong>Complete</strong> Record was updated successfully <a href='index.php'>HOME</a>!
    </div>";
 }
 else
 {
  $msg = "<div class='alert alert-warning'>
    <strong>SORRY!</strong> ERROR while updating record !
    </div>";
 }
}

if(isset($_GET['edit_id_asset']))
{
 $id = $_GET['edit_id_asset'];
 extract($crud->getID($id)); 
}

if(isset($_GET['edit_id_asset_type']))
{
 $id = $_GET['edit_id_asset_type'];
 extract($crud->getID($id_asset_type)); 
}

?>
<?php include_once 'views/header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
 echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
  
     <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>Asset Name</td>
            <td><input type='text' name='name' class='form-control' value="<?php echo $name; ?>" required></td>
        </tr>
 
        <tr>
            <td>Asset Description</td>
            <td><input type='text' name='last_name' class='form-control' value="<?php echo $last_name; ?>" required></td>
        </tr>
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
       <span class="glyphicon glyphicon-edit"></span>  Update this Record
    </button>
                <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'views/footer.php'; ?>