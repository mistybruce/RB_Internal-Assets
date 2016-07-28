<?php

class crud
{
 private $db;
 
 function __construct($DB_con)
 {
  $this->db = $DB_con;
 }
 
 public function create($name,$description,)
 {
  try
  {
   $stmt = $this->db->prepare("INSERT INTO assets(name,description) VALUES(:name, :description)");
   $stmt->bindparam(":name",$name);
   $stmt->bindparam(":description",$description);
   $stmt->execute();
   return true;
  }
  catch(PDOException $e)
  {
   echo $e->getMessage(); 
   return false;
  }
  
 }
 //get asset id
 public function getID($id)
 {
  $stmt = $this->db->prepare("SELECT * FROM assets WHERE id=:id_asset");
  $stmt->execute(array(":id_asset"=>$id));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }
  //get asset_id_type
  public function getID($id_asset_type)
 {
  $stmt = $this->db->prepare("SELECT * FROM asset_types WHERE id_asset_type=:id_asset_type");
  $stmt->execute(array(":id_asset_type"=>$id_asset_type));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }
 
 public function update($id, $id_asset_type,$name,$description)
 {
  try
  {
   $stmt=$this->db->prepare("UPDATE assets SET first_name=:name, 
                                                
               description= :description, 
                contact_no= :contact
             WHERE id_asset_type= :id_asset_type
             WHERE id=:id_asset ");
   $stmt->bindparam(":name",$name);
   $stmt->bindparam(":description",$description);
   $stmt->bindparam(":id_asset",$id_asset);
   $stmt->bindparam(":id_asset_type",$id_asset_type);
   $stmt->execute();
   
   return true; 
  }
  catch(PDOException $e)
  {
   echo $e->getMessage(); 
   return false;
  }
 }
 
 public function delete($id)
 {
  $stmt = $this->db->prepare("DELETE FROM assets WHERE id=:id_asset");
  $stmt->bindparam(":id_asset",$id_asset);
  $stmt->execute();
  return true;
 }
 
 /* paging */
 
 public function dataview($query)
 {
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
    ?>
                <tr>
                <td><?php print($row['id_asset']); ?></td>
                <td><?php print($row['name']); ?></td>
                <td><?php print($row['description']); ?></td>
                <td><?php print($row['id_asset_type']); ?></td>
                <td align="center">
                <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </tr>
                <?php
   }
  }
  else
  {
   ?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
  }
  
 }
 
 public function paging($query,$records_per_page)
 {
  $starting_position=0;
  if(isset($_GET["page_no"]))
  {
   $starting_position=($_GET["page_no"]-1)*$records_per_page;
  }
  $query2=$query." limit $starting_position,$records_per_page";
  return $query2;
 }
 
 public function paginglink($query,$records_per_page)
 {
  
  $self = $_SERVER['PHP_SELF'];
  
  $stmt = $this->db->prepare($query);
  $stmt->execute();
  
  $total_no_of_records = $stmt->rowCount();
  
  if($total_no_of_records > 0)
  {
   ?><ul class="pagination"><?php
   $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
   $current_page=1;
   if(isset($_GET["page_no"]))
   {
    $current_page=$_GET["page_no"];
   }
   if($current_page!=1)
   {
    $previous =$current_page-1;
    echo "<li><a href='".$self."?page_no=1'>First</a></li>";
    echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
   }
   for($i=1;$i<=$total_no_of_pages;$i++)
   {
    if($i==$current_page)
    {
     echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
    }
    else
    {
     echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
    }
   }
   if($current_page!=$total_no_of_pages)
   {
    $next=$current_page+1;
    echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
    echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
   }
   ?></ul><?php
  }
 }
 

 
}