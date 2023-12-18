<?php session_start(); ?>

<?php
  include "crag_form_cons.php";
  include "conection.php";

  $_SESSION["id_sect"] = $_GET["id_sect"];

  $consulta="select * from sector LEFT JOIN images ON (sector.foto = images.id_img) WHERE id_sect='".$_SESSION["id_sect"]."'";
  $res=mysqli_query($con,$consulta);
  $reg=mysqli_fetch_array($res);

  $_SESSION["nom_sect"] = $reg['nom_sect'];
  $_SESSION["coord"] = $reg['coord'];
  $_SESSION["descrip"] = $reg['descrip'];
  $_SESSION["acces"] = $reg['acces'];
  $_SESSION["nom_estil"] = $reg['nom_estil'];
  $_SESSION["id_super_sect"] = $reg['id_super_sector'];
  $_SESSION["nom_super_sect"] = $_GET['super_sect'];
?>

<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Detall sector</title>
</head>

<body>
<table id="example" class="table table-striped table-bordered" style="width:50%">

<tr>
	<td><b>NOM</b></td><td><?php echo $reg['nom_sect']; ?></td>
</tr>
<tr>
	<td><b>COORDENADES</b></td><td><?php echo $reg['coord']; ?></td>
</tr>
<tr>
	<td><b>DESCRIPCIÓ</b></td><td><?php echo $reg['descrip']; ?></td>
</tr>

<tr>
	<td><b>ACCES</b></td><td><?php echo $reg['acces']; ?></td>
</tr>
<tr>
	<td><b>ESTIL</b></td><td><?php echo $reg['nom_estil']; ?></td>
</tr>
<tr>
  <td><b>SECTOR PERTANYENT</b></td><td><?php echo $_GET['super_sect']; ?></td>
</tr>
</table>
&nbsp;&nbsp;
<button class="btn btn-primary" name="submit" type="submit" onclick="redirect_mod_crag()">Modificar</button>  
<script type="text/javascript">
      function redirect_mod_crag()
      {
      window.location="mod_crag.php";
      }
    </script>

</body>
</html>