<?php
  
  include "conection.php";
  include "display_cons_options.html";
  
  $nom_via = $_POST['nom_via'];
  $grau = $_POST['grau'];
  $altura = $_POST['altura'];
  $n_bolts = $_POST['n_bolts'];
  $estil = $_POST['estil'];
  $nom_estat = $_POST['estat'];
  $id_sector = $_POST['sector'];

  $nom_via_str = addslashes($nom_via);

  function sector($id_sect, $con){
    $query1 = "CALL get_subsect($id_sect)";
    $res1=mysqli_query($con,$query1);

    while ($reg1=mysqli_fetch_array($res1)) {
      $out.= "id_sector=".$reg1['id']." OR ";
    }
    $out = substr($out, 0, -3);
    $res1->close();
    $con->next_result();
    return $out;
  }
  
  function higherThan($grau, $con){

    for ($i=1; $i<strlen($grau); $i++){
      $raw_grade.=$grau[$i];
    }

    $query2 = "SELECT ordre FROM grau_ordre WHERE grau='$raw_grade'";
    $res2 = mysqli_query($con,$query2);
    $reg2 = mysqli_fetch_array($res2);

    return $reg2['ordre'];
  }
  
  if ($nom_estat=='Send') $table="vies_encadenades"; 
  else $table="via"; 

  if ($grau[0]=='>'){
    $query="SELECT id_via, nom_via, grau_ordre.grau, grau_ordre.ordre, altura, n_bolts, $table.nom_estil, nom_estat, id_sector, nom_sect FROM $table LEFT JOIN sector ON $table.id_sector = sector.id_sect JOIN grau_ordre ON $table.grau=grau_ordre.grau";
  } else {
    $query="SELECT id_via, nom_via, grau, altura, n_bolts, $table.nom_estil, nom_estat, id_sector, nom_sect FROM $table LEFT JOIN sector ON $table.id_sector = sector.id_sect";
  }

  $query.=" WHERE ";
  $query.=(!empty($nom_via))? "nom_via='$nom_via_str'   AND" : "";
  $query.=(!empty($grau) && !($grau[0]=='>'))? " grau='$grau'   AND" : "";
  $query.=(!empty($grau) && ($grau[0]=='>'))? " grau_ordre.ordre>=".higherThan($grau,$con)."   AND" : "";
  $query.=(!empty($altura))? " altura='$altura'   AND" : "";
  $query.=(!empty($n_bolts))? " n_bolts='$n_bolts'   AND" : "";
  $query.=($estil!='NULL')? " $table.nom_estil='$estil'   AND" : "";
  $query.=($id_sector!='NULL')? "(".sector($id_sector, $con).")   AND" : "";
  $query.=($nom_estat!='NULL'&&$nom_estat!='Send')? " nom_estat='$nom_estat'   AND" : "";

  $query = substr($query, 0, -6);

  $res=mysqli_query($con,$query);
  if(!$res) echo mysqli_error($con);

  $nres=mysqli_num_rows($res);

  mysqli_close($con);
   
  

?>

<html><head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <title>Llista de Vies</title>
</head>
<style>
p{
  font-size: 25px;
  color: black;
}
</style>
<body>
<p><?php echo "Resultat: ".$nres." vies"; ?></p>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr bgcolor="#d18207">
                <th>Id</th>
                <th>Nom</th>
                <th>Grau</th>
                <th>Altura</th>
                <th>Nº de chapes</th>
                <th>Estil</th>
                <th>Estat</th>
                <th>Sector</th>
            </tr>
        </thead>
        <?php
          while ($reg=mysqli_fetch_array($res)) { ?>
        <tbody>
            <tr>
                <td><a href="view_line.php?id=<?php echo $reg['id_via'];?>&sect=<?php echo $reg['nom_sect'];?>"><?php echo $reg['id_via'];?></td>
                <td><?php echo $reg['nom_via'];?></td>
                <td><?php echo $reg['grau'];?></td>
                <td><?php echo $reg['altura'];?></td>
                <td><?php echo $reg['n_bolts'];?></td>
                <td><?php echo $reg['nom_estil'];?></td>
                <td><?php echo $reg['nom_estat'];?></td>
                <td><a href="crag_list.php?id=<?php echo $reg['id_sector'];?>"><?php echo $reg['nom_sect'];?></td>
                
            </tr>
            
        </tbody>
       <?php } ?> 
    </table>


</body>
</html>
