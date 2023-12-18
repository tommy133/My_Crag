
<?php
  include "conection.php";
  include "display_cons_options.html";

    $id_sect = $_GET['id'];
   $nom_sect = $_POST['nom_sect'];
  
   $estil = $_POST['estil'];
   $id_super_sector = $_POST['sector'];

   $nom_sect_str = addslashes($nom_sect);

   $query="SELECT sect.id_sect, sect.nom_sect as sect0, sect.coord, sect.nom_estil, super_sect.id_sect as id_sect1, super_sect.nom_sect as sect1 FROM sector as super_sect RIGHT JOIN sector as sect ON super_sect.id_sect=sect.id_super_sector";
   
   if (!empty($id_sect)){
      $query.=" WHERE sect.id_sect='$id_sect'";
   } else if (!empty($nom_sect)){
      $query.=" WHERE sect.nom_sect='$nom_sect_str'";
   } else if (($estil!='NULL')&&($id_super_sector!='NULL')){
      $query.=" JOIN estil ON sect.nom_estil = estil.nom_estil WHERE estil.nom_estil='$estil' AND id_super_sector='$id_super_sector'";
    }
   else {
    $query.=($estil!='NULL')? " JOIN estil ON sect.nom_estil = estil.nom_estil WHERE estil.nom_estil='$estil'" :"";
    $query.=($id_super_sector!='NULL')? " WHERE sect.id_super_sector='$id_super_sector'" : "";
  }
  $res=mysqli_query($con,$query);

  mysqli_close($con);
   

?>

<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <title>Llista de Sectors</title>
</head>
<body>
<br><br>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr bgcolor="#d18207">
                <th>Id</th>
                <th>Nom</th>
                <th>Coordenades</th>
                <th>Estil</th>
                <th>Sector Pertanyent</th>
            </tr>
        </thead>
        <?php
          while ($reg=mysqli_fetch_array($res)) { ?>
        <tbody>
            <tr>
                <td><a href="view_crag.php?id_sect=<?php echo $reg['id_sect'];?>&super_sect=<?php echo $reg['sect1'];?>"><?php echo $reg['id_sect'];?></td>
                <td><?php echo $reg['sect0'];?></td>
                <td><?php echo $reg['coord'];?></td>
                <td><?php echo $reg['nom_estil'];?></td>
                <td><a href="crag_list.php?id=<?php echo $reg['id_sect1'];?>"><?php echo $reg['sect1'];?></td>
                
            </tr>
            
        </tbody>
       <?php } ?> 
    </table>


</body>
</html>
