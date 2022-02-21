<?php
include_once("funzioni.php");
$db=database_connect() or die("Errore di connessione");
if(isset($_POST["state"])){
$nome=$_POST["guardato"];
$result=$db->query('SELECT nome FROM lupus WHERE tipo="Guardia"') or die("Errore sulla guardia 1");
$guardia="";
if($result->num_rows>0){
  $row=$result->fetch_assoc();
  $guardia=$row["nome"];
}

$db->query('UPDATE lupus SET visitato="'.$nome.'" WHERE nome="'.$guardia.'"');
$db->query('UPDATE lupus SET protetto=1 WHERE nome="'.$nome.'"') or die("Errore sulla guardia 2");
}
$auramorto="-1";
if(isset($_POST["auramorto"]))$aura_morto=$_POST["auramorto"];
$reportato="-1";
if(isset($_POST["reportato"]))$reportato=$_POST["reportato"];
$veggato="";
$url="veggente.php";
if(isset($_POST["veggato"])){
$veggato=$_POST["veggato"];
$responso=veggente($veggato,1);
$url="veggenteo.php";
}
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
  <div class="container center-align">
  <h1>Veggente<br><br></h1>
  <form action="<?php echo $url;?>" method="post">
    <input type="hidden" id="auramorto" name="auramorto" value="<?php echo $auramorto; ?>">
    <input type="hidden" id="reportato" name="reportato" value="<?php echo $reportato; ?>">
    <?php
      if($veggato!=""){
        echo '<h5>'.$responso.'<br><br></h5>';
      }else echo '<input type="text" id="veggato" name="veggato">';
     ?>
   <button type="submit" class="waves-effect waves-teal btn-large grey darken-4 white-text"><?php if($veggato=="")echo 'Conferma'; else echo 'Prosegui';?></button>
 </form>
</div>
</body>
<script type="text/javascript" src="../js/materialize.min.js"></script>
</html>
