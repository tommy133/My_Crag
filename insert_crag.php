<html>
<body>
<?php
  include "conection.php";
  include "crag_form_reg.php";


  $nom_sect = $_POST['nom_sect'];
  $coord = $_POST['coord'];
  $desc = $_POST['desc']; 

  if (!file_exists($_FILES['foto']['tmp_name']) || !is_uploaded_file($_FILES['foto']['tmp_name'])){
      $foto = NULL;
      
   }else {
      $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
   }

   $acces = $_POST['acces'];
   $estil = $_POST['estil'];
   $id_super_sector = $_POST['sector'];

   $nom_sect_str = addslashes($nom_sect);
   $desc_str = addslashes($desc);
   $acces_str = addslashes($acces);

    $crag_exists = "SELECT count(*) FROM sector WHERE nom_sect='".$nom_sect_str.
    "' AND id_super_sector=".$id_super_sector;

   $res = mysqli_query($con, $crag_exists);
   $count = mysqli_fetch_array($res);

   $res->close();
    $con->next_result();

   if ($count[0] == 0){
    $query="INSERT INTO sector(nom_sect";
    $query.=(!empty($coord))? ", coord":"";
    $query.=(!empty($desc))? ", descrip":"";
    $query.=(!empty($foto))? ", foto":"";
    $query.=(!empty($acces))? ", acces":"";
    $query.=($estil!='NULL')? ", nom_estil":"";
    $query.=($id_super_sector!='NULL')? ", id_super_sector":"";
    $query.=") VALUES ('$nom_sect_str'";
    $query.=(!empty($coord))? ", '$coord'":"";
    $query.=(!empty($desc))? ", '$desc_str'":"";
    $query.=(!empty($foto))? ", '$foto'":"";
    $query.=(!empty($acces))? ", '$acces_str'":"";
    $query.=($estil!='NULL')? ", '$estil'":"";
    $query.=($id_super_sector!='NULL')? ", $id_super_sector":"";
    $query.= ")";

    if (!mysqli_query($con,$query))
      {
         echo("Error description: " . mysqli_error($con));
      } else {
        echo  "<script type='text/javascript'>alert('REGISTRE SATISFACTORI');</script>";      }

      mysqli_close($con);

  } else echo  "<script type='text/javascript'>alert('AQUEST SECTOR JA EXISTEIX!');</script>";
   

?>

</body>
</html>

