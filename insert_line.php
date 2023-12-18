<html>
<body>
<?php
  include "conection.php";
  include "line_form_reg.php";


	$nom_via = $_POST['nom_via'];
	$grau = $_POST['grau'];
	$desc = $_POST['desc']; 
  	$altura = $_POST['altura'];
  
	if (!file_exists($_FILES['foto']['tmp_name']) || !is_uploaded_file($_FILES['foto']['tmp_name'])){
      $foto = NULL;
      
   }else {
      $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/db_img/";
      $filename = $_FILES['foto']['tmp_name'];echo $filename;
   }

   $n_bolts = $_POST['n_bolts'];
   $estil = $_POST['estil'];
   $id_sector = $_POST['sector'];
   $estat = $_POST['estat'];

    $nom_via_str = addslashes($nom_via);
   $desc_str = addslashes($desc);

   $line_exists = "SELECT count(*) FROM via WHERE nom_via='".$nom_via_str.
    "' AND grau='".$grau."' AND id_sector=".$id_sector;
 
   $res = mysqli_query($con, $line_exists);
   $count = mysqli_fetch_array($res);

   $res->close();
    $con->next_result();
    
   if ($count[0] == 0){
   	$query="INSERT INTO via(nom_via";
   	$query.=(!empty($grau))? ", grau":"";
   	$query.=(!empty($desc))? ", descrip":"";
    $query.=(!empty($altura))? ", altura":"";
   	$query.=(!empty($foto))? ", foto":"";
    $query.=(!empty($n_bolts))? ", n_bolts":"";
   	$query.=($estil!='NULL')? ", nom_estil":"";
   	$query.=($id_sector!='NULL')? ", id_sector":"";
    $query.=($estat!='NULL')? ", nom_estat":"";
   	$query.=") VALUES ('$nom_via_str'";
   	$query.=(!empty($grau))? ", '$grau'":"";
   	$query.=(!empty($desc))? ", '$desc_str'":"";
    $query.=(!empty($altura))? ", '$altura'":"";
   	$query.=(!empty($foto))? ", '$foto'":"";
   	$query.=(!empty($n_bolts))? ", '$n_bolts'":"";
   	$query.=($estil!='NULL')? ", '$estil'":"";
   	$query.=($id_sector!='NULL')? ", $id_sector":"";
    $query.=($estat!='NULL')? ", '$estat'":"";
   	$query.= ")";

   	if (!mysqli_query($con,$query))
      {
         echo("Error description: " . mysqli_error($con));
      } else {
         echo  "<script type='text/javascript'>alert('REGISTRE SATISFACTORI');</script>";
      }

	} else echo  "<script type='text/javascript'>alert('AQUESTA VIA JA EXISTEIX!');</script>";
   

?>
</body>
</html>

