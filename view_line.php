<?php
  include "display_cons_options.html";
  include "conection.php";

  session_start();
  $_SESSION["id_via"] = $_GET['id'];

  $consulta="select * from via LEFT JOIN images ON (via.foto = images.id_img) WHERE id_via='".$_SESSION["id_via"]."'";
  $res=mysqli_query($con,$consulta);
  $reg=mysqli_fetch_array($res);
  
  $_SESSION["nom_via"] = $reg['nom_via'];
  $_SESSION["grau"] = $reg['grau'];
  $_SESSION["descrip"] = $reg['descrip'];
  $_SESSION["altura"] = $reg['altura'];
  $_SESSION["n_bolts"] = $reg['n_bolts'];
  $_SESSION["nom_estil"] = $reg['nom_estil'];
  $_SESSION["nom_estat"] = $reg['nom_estat'];
  $_SESSION["nom_sect"] = $_GET['sect'];
  $_SESSION["id_sect"] = $reg['id_sector'];

?>

<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Detall via</title>
</head>


<body>
<br><br>
<table id="viewline" class="table table-striped table-bordered" style="width:50%" >

<tr>
	<td><b>NOM</b></td><td><?php echo $reg['nom_via']; ?></td>
</tr>
<tr>
	<td><b>GRAU</b></td><td><?php echo $reg['grau']; ?></td>
</tr>
<tr>
	<td><b>DESCRIPCIÓ</b></td><td><?php echo $reg['descrip']; ?></td>
</tr>
<tr>
  <td><b>ALTURA</b></td><td><?php echo $reg['altura']; ?></td>
</tr>
<?php 
if (!empty($reg['foto'])){ ?>
<tr>
	<td><b>FOTO</b></td><td><?php echo '<img src="'.'db_img/'. $reg['nom_img'].'" height="500" width="600"/>'; ?></td>
</tr>
<?php  } ?>
<tr>
	<td><b>NOMBRE CHAPES</b></td><td><?php echo $reg['n_bolts']; ?></td>
</tr>
<tr>
	<td><b>ESTIL</b></td><td><?php echo $reg['nom_estil']; ?></td>
</tr>
<tr>
  <td><b>ESTAT</b></td><td><?php echo $reg['nom_estat']; ?></td>
</tr>
<tr>
  <td><b>SECTOR</b></td><td><?php echo $_GET['sect']; ?></td>
</tr>

</table>
&nbsp;&nbsp;
<button class="btn btn-primary" name="submit" type="submit" onclick="redirect_mod_line()">Modificar</button>
<script type="text/javascript">
      function redirect_mod_line()
      {
      window.location="mod_line.php";
      }
    </script>

</body>
</html>