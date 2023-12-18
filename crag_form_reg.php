<html>
<title>Nou sector</title>
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<style>
#button-panel *{
  display:inline-block;
  

}
</style>

<body>

<?php include "display_reg_options.html";
		include "conection.php";?>

<br><br><br><br>

<form name="captura" method="post" 
   action="insert_crag.php" enctype="multipart/form-data">

<div class="form-row">&nbsp;&nbsp;
    <div class="col-md-3 mb-3">
      <label for="validationDefault01">Nom del sector</label>
      <input type="text" class="form-control" id="validationDefault01" name="nom_sect"  required>
    </div>
    <div class="col-md-1 mb-3">
      <label for="validationDefault02">Coordenades</label>
      <input type="text" class="form-control" id="validationDefault02" name="coord" >
    </div>
    
</div>

<div class="form-row">&nbsp;&nbsp;
   <div class="col-md-4 mb-3">
      <label for="validationDefault03">Descripció</label>
      <textarea rows="4" cols="50" class="form-control" id="validationDefault03" name="desc"></textarea>
      
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
      <textarea rows="4" cols="50" class="form-control" id="validationDefault05" name="acces"></textarea>
      
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
         echo "<OPTION VALUE=NULL></OPTION>";
          while ($reg=mysqli_fetch_array($res)) {
            echo "<OPTION VALUE='".$reg['nom_estil']."'>".$reg['nom_estil']."</OPTION>";
          }

        ?>
        
      </SELECT>
    </div>
    <div class="col-md-2 mb-3">
      <?php
        $query="SELECT sect.id_sect, sect.nom_sect as sect0, sect.coord, sect.nom_estil, super_sect.nom_sect as sect1
         FROM sector as super_sect RIGHT JOIN sector as sect ON super_sect.id_sect=sect.id_super_sector ORDER BY sect0 ASC";
        $res=mysqli_query($con,$query);
      ?>
   
      <label for="validationDefault07">Sector pertanyent</label>
      <SELECT name="sector" class="form-control" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
         
        <?php
         echo "<OPTION VALUE=NULL></OPTION>";
          while ($reg=mysqli_fetch_array($res)) {
            if ($reg['sect1']==NULL) echo "<OPTION VALUE='".$reg['id_sect']."'>".$reg['sect0']."</OPTION>";
            else echo "<OPTION VALUE='".$reg['id_sect']."'>".$reg['sect0']." - ".$reg['sect1']."</OPTION>";
          }

        ?>
        
      </SELECT>
      
    </div>
  </div>

  &nbsp;&nbsp;
  <button class="btn btn-primary" name="submit" type="submit">Enviar</button>

</form>


</body>
</html>