<html>
<title>Modificar via</title>
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
    session_start();
?>

<br>

<form name="captura" method="post" 
   action="" enctype="multipart/form-data">

   <div class="form-row">&nbsp;&nbsp;
    <div class="col-md-3 mb-3">
      <label for="validationDefault01">Nom de la via</label>
      <input type="text" class="form-control" id="validationDefault01" name="nom_via" value="<?php echo $_SESSION["nom_via"];?>">
    </div>
    <div class="col-md-1 mb-3">
      <label for="validationDefault02">Grau</label>
      <input type="text" class="form-control" id="validationDefault02" name="grau" value="<?php echo $_SESSION["grau"];?>">
    </div>
    
  </div>

  <div class="form-row">&nbsp;&nbsp;
   <div class="col-md-4 mb-3">
      <label for="validationDefault03">Descripció</label>
      <textarea rows="4" cols="50" class="form-control" id="validationDefault03" name="desc"><?php echo $_SESSION["descrip"];?></textarea>
      
   </div>
  </div>

  <div class="form-row">&nbsp;&nbsp;
    <div class="col-md-2 mb-3">
      <label for="validationDefault04">Altura</label>
      <input type="text" class="form-control" id="validationDefault04" name="altura" value="<?php echo $_SESSION["altura"];?>">
    </div>
    <div class="col-md-2 mb-3">
      <label for="validationDefault05">Foto</label>
      <input type="file" id="validationDefault05" name="foto" >
    </div>
  </div>

  <div class="form-row">&nbsp;&nbsp;
    <div class="col-md-2 mb-3">
      <label for="validationDefault06">Nombre de chapes</label>
      <input type="number" class="form-control" id="validationDefault06" name="n_bolts" value="<?php echo $_SESSION["n_bolts"];?>">
    </div>
    <div class="col-md-2 mb-3">
      <?php
        $query="SELECT * FROM estil";
        $res=mysqli_query($con,$query);
      ?>
   
      <label for="validationDefault07">Estil</label>
      <SELECT name="estil" class="form-control">
         
        <?php
         echo "<OPTION VALUE=".$_SESSION["nom_estil"].">".$_SESSION["nom_estil"]."</OPTION>";
          while ($reg=mysqli_fetch_array($res)) {
            echo "<OPTION VALUE='".$reg['nom_estil']."'>".$reg['nom_estil']."</OPTION>";
          }

        ?>
        
      </SELECT>
    </div>
  </div>

  <div class="form-row">&nbsp;&nbsp;
    <div class="col-md-2 mb-3">
      <?php
        $query="SELECT sect.id_sect, sect.nom_sect as sect0, sect.coord, sect.nom_estil, super_sect.nom_sect as sect1
         FROM sector as super_sect RIGHT JOIN sector as sect ON super_sect.id_sect=sect.id_super_sector ORDER BY sect0 ASC";
        $res=mysqli_query($con,$query);
      ?>
   
      <label for="validationDefault08">Sector pertanyent</label>
      <SELECT name="sector" class="form-control" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
         
        <?php
         echo "<OPTION VALUE=".$_SESSION["id_sect"].">".$_SESSION["nom_sect"]."</OPTION>";
          while ($reg=mysqli_fetch_array($res)) {
            if ($reg['sect1']==NULL) echo "<OPTION VALUE='".$reg['id_sect']."'>".$reg['sect0']."</OPTION>";
            else echo "<OPTION VALUE='".$reg['id_sect']."'>".$reg['sect0']." - ".$reg['sect1']."</OPTION>";
          }

        ?>
        
      </SELECT>
      
    </div>
    <div class="col-md-2 mb-3">
      <?php
        $query="SELECT * FROM estat";
        $res=mysqli_query($con,$query);
      ?>

      <label for="validationDefault09">Estat</label>
      <SELECT name="estat" class="form-control">
         
        <?php
         echo "<OPTION VALUE=".$_SESSION["nom_estat"].">".$_SESSION["nom_estat"]."</OPTION>";
          while ($reg=mysqli_fetch_array($res)) {
            echo "<OPTION VALUE='".$reg['nom_estat']."'>".$reg['nom_estat']."</OPTION>";
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
    $nom_via = $_POST['nom_via'];
    $grau = $_POST['grau'];
    $desc = $_POST['desc']; 
      $altura = $_POST['altura'];
    
    if (!file_exists($_FILES['foto']['tmp_name']) || !is_uploaded_file($_FILES['foto']['tmp_name'])){
        $foto = NULL;
        
	 }else { //put an image in folder php
	    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/db_img/";
      $file = $_FILES['foto']['tmp_name'];
      $target = $upload_dir.basename($file);
      
    if (is_dir($upload_dir) && is_writable($upload_dir)) {
        move_uploaded_file($file,$target);echo $file;echo " ".$target;
    }
	 }

	 $n_bolts = $_POST['n_bolts'];
	 $estil = $_POST['estil'];
	 $id_sector = $_POST['sector'];
	 $estat = $_POST['estat'];

	 $nom_via_str = addslashes($nom_via);
	 $desc_str = addslashes($desc);

	 $query = "UPDATE via SET ";
	 $query.=(!empty($nom_via))? ("nom_via='$nom_via_str',"):"";
	 $query.=(!empty($grau))? ("grau='$grau',"):"";
	 $query.=(!empty($desc))? ("descrip='$desc_str',"):"";
   $query.=(!empty($altura))? ("altura='$altura',"):"";
   $query.=(!empty($foto))? ("foto='$foto',"):"";
   $query.=(!empty($n_bolts))? ("n_bolts=$n_bolts,"):"";
   $query.=($estil!='NULL')? ("nom_estil='$estil',"):"";
   $query.=($estat!='NULL')? ("nom_estat='$estat',"):"";
   $query.=($id_sector!='NULL')? ("id_sector=$id_sector,"):"";
   
	 $query=substr($query,0,-1);
	 $query.=" WHERE id_via=".$_SESSION["id_via"];   
 
   if (!mysqli_query($con,$query))
    {
       echo("Error description: " . mysqli_error($con));
    } else {
       echo ("<script LANGUAGE='JavaScript'>
    window.alert('Succesfully Updated');
    window.location.href='mod_line.php';
    </script>");exit;
    }
  }

?>

</body>
</html>