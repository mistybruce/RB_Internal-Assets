<?php
include_once 'connect.php';
?>
<?php include_once 'views/header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="add-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
     <table class='table table-bordered table-responsive'>
     <tr>
     <th>#</th>
     <th>id_asset</th>
     <th>Name</th>
     <th>Description</th>
     <th>id_asset_type</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
     <?php
  $query = "SELECT * FROM assets";       
  $records_per_page=3;
  $newquery = $crud->paging($query,$records_per_page);
  $crud->dataview($newquery);
  ?>
    <tr>
        <td colspan="7" align="center">
    <div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
         </div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once 'views/footer.php'; ?>