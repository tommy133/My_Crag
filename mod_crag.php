<?php session_start(); ?>

<html>
<title>Modificar sector</title>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<?php include "display_cons_options.html";
    include "conection.php";
?>

<br>

<form name="captura" method="post" 
   action="" enctype="multipart/form-data">

   <div class="form-row">&nbsp;&nbsp;
    <div class="col-md-3 mb-3">
      <label for="validationDefault01">Nom del sector</label>
      <input type="text" class="form-control" id="validationDefault01" name="nom_sect" value="<?php echo $_SESSION["nom_sect"];?>">
    </div>
    <div class="col-md-1 mb-3">
      <label for="validationDefault02">Coordenades</label>
      <input type="text" class="form-control" id="validationDefault02" name="coord" value="<?php echo $_SESSION["coord"];?>">
    </div>
    
</div>

<div class="form-row">&nbsp;&nbsp;
   <div class="col-md-4 mb-3">
      <label for="validationDefault03">Descripció</label>
      <textarea rows="4" cols="50" class="form-control" id="validationDefault03" name="desc"><?php echo $_SESSION["descrip"];?></textarea>
      
   </div>
</div>

<div class="form-row">&nbsp;&nbsp;
    <div class="col-md-3 mb-3">
      <label for="validationDefault04">Foto</label>
      <input type="file" id="validationDefault04" name="foto">
    </div>
    
</div>

<div class="form-row">&nbsp;&nbsp;
   <div class="col-md-4 mb-3">
      <label for="validationDefault05">Accés</label>
      <textarea rows="4" cols="50" class="form-control" id="validationDefault05" name="acces"><?php echo $_SESSION["acces"];?></textarea>
      
   </div>
</div>

<div class="form-row">&nbsp;&nbsp;
   <div class="col-md-2 mb-3">
      <?php
         $query="SELECT * FROM estil";
         $res=mysqli_query($con,$query);
      ?>
      <label for="validationDefault06">Estil</label>
      <SELECT name="estil" class="form-control">
         
        <?php
         echo "<OPTION VALUE=".$_SESSION["nom_estil"].">".$_SESSION["nom_estil"]."</OPTION>";
          while ($reg=mysqli_fetch_array($res)) {
            echo "<OPTION VALUE='".$reg['nom_estil']."'>".$reg['nom_estil']."</OPTION>";
          }

        ?>
        
      </SELECT>
    </div>
    <div class="col-md-2 mb-3">
      <?php
        $query="SELECT * FROM sector ORDER BY nom_sect ASC";
        $res=mysqli_query($con,$query);
      ?>
   
      <label for="validationDefault07">Sector pertanyent</label>
      <SELECT name="sector" class="form-control" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
         
        <?php
         echo "<OPTION VALUE=".$_SESSION["id_super_sect"].">".$_SESSION["nom_super_sect"]."</OPTION>";
          while ($reg=mysqli_fetch_array($res)) {
            echo "<OPTION VALUE='".$reg['id_sect']."'>".$reg['nom_sect']."</OPTION>";
          }

        ?>
        
      </SELECT>
      
    </div>
  </div>


    &nbsp;&nbsp;
    <button class="btn btn-primary" name="submit" type="submit">Modificar</button>


</form>

<?php 
  
  include "conection.php";

  if (isset($_POST['submit'])){
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

	 $query = "UPDATE sector SET ";
	 $query.=(!empty($nom_sect))? ("nom_sect='$nom_sect_str',"):"";
	 $query.=(!empty($coord))? ("coord='$coord',"):"";
	 $query.=(!empty($desc))? ("descrip='$desc_str',"):"";
   $query.=(!empty($foto))? ("foto='$foto',"):"";
   $query.=(!empty($acces))? ("acces='$acces_str',"):"";
   $query.=($estil!='NULL')? ("nom_estil='$estil',"):"";
   $query.=($id_super_sector!='NULL')? ("id_super_sector=$id_super_sector,"):"";

	 $query=substr($query,0,-1);
	 $query.=" WHERE id_sect=".$_SESSION["id_sect"];;   
   
   if (!mysqli_query($con,$query))
    {
       echo("Error description: " . mysqli_error($con));
    } else {
       echo  "<script type='text/javascript'>alert('REGISTRE SATISFACTORI');</script>";
    }
  }

?>

</body>
</html>