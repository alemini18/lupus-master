<?php
include_once("funzioni.php");
if(isset($_POST["simp"]) and isset($_POST["morto"]))
  uccisione($_POST["morto"],$_POST["assassino"],$_POST["simp"]);
else die("Mancano dati");

?>
<html>
<head>
 <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lupus</title>
</head>
<body>
  <div class="container left-align">
  <center><h1>Giorno<br><br></h1></center>
  <h3>Morti<br></h3>
  <?php
    $db=database_connect() or die("Errore di connessione");
    $result=$db->query("SELECT * FROM morti");
    if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
        echo '<p>'.$row["morto"].'</p>';
      }
    }else echo "Nessuno è morto";
    $result=$db->query('SELECT * FROM lupus WHERE tipo="Reporter"');
    $fr=1;
    if($result->num_rows>0){
      $row=$result->fetch_assoc();
      if($row["visitato"]=="No")$fr=0;
    }else $fr=0;
    echo '<h3>Reportage:<br></h3>';
    $reportato=$_POST["reportato"];
    if($fr==1){
      $result=$db->query('SELECT * FROM lupus WHERE nome="'.$reportato.'"');
      if($result->num_rows>0){
        $row=$result->fetch_assoc();
        if($row["visitato"]=="")echo '<p>'.$reportato.' è rimasto a casa</p>';
        else echo '<p>'.$reportato.' è uscito</p>';
      }
      $result=$db->query('SELECT * FROM lupus');
      if($result->num_rows>0){
        echo "<p>E'/Sono andato/i da lei/lui ";
        while($row=$result->fetch_assoc()){
          if($row["visitato"]==$reportato)echo $row["nome"]." ";
        }
        echo '</p>';
      }
    }else echo '<p>Nessun reportage</p>';
   ?>
  <form action="verifica.php" method="post">
    <div class="row">
      <div class="col s3 offset-s3"><h5 style="text-align:right">Rogo:</h5></div>
      <div class="col s3"><input type="text" name="rogo" id="rogo"></div>
    </div>
   <center><button type="submit" class="waves-effect waves-teal btn-large grey darken-4 white-text">Conferma</button></center>
 </form>
</div>
</body>
<script type="text/javascript" src="../js/materialize.min.js"></script>
</html>
