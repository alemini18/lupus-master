<?php
include_once("funzioni.php");
$db=database_connect() or die("Errore di connessione");
$result=$db->query('SELECT aura FROM lupus WHERE nome="'.$_POST["rogo"].'"');
$auramorto="-1";
if($result->num_rows>0){
  $row=$result->fetch_assoc();
  $auramorto="".$row["aura"];
}
$db->query('DELETE FROM lupus WHERE nome="'.$_POST["rogo"]'"');
$result=$db->query('SELECT * FROM lupus');
$lupi=0;
$stop=False;
$n=$result->num_rows;
if($n>0){
  while($row=$result->fetch_assoc()){
    if($row["tipo"]=="Lupo")$lupi++;
  }
  if($lupi==0 or 2*$lupi>=$n)$stop=True;
}
if($stop==False){
  $db->query('DELETE FROM morti WHERE 1');
  $db->query('UPDATE lupus SET visitato="", protetto=0 WHERE 1');
  echo '<form id="sendpost" method="post" action="reporter.php">';
  echo  '<input type="hidden" name="auramorto" value="'.$_POST["auramorto"].' />';
  echo '</form>';
  echo '<script>document.getElementById("sendpost").submit();</script>';
  die();
}else{
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
  <h1>Partita Finita<br><br></h1>
  <?php
  $result=$db->query('SELECT nome FROM lupus WHERE tipo="Criceto"');
  if($result->num_rows>0)echo '<h5>Il Criceto vince!<br><br></h5>';
  else if($lupi>0)echo '<h5>I Cattivi vincono!<br><br></h5>';
  else echo '<h5>I Buoni vincono!<br><br><h5>';
  ?>
  <form action="index.php">
   <button type="submit" class="waves-effect waves-teal btn-large grey darken-4 white-text">Nuova Partita</button>
 </form>
</div>
</body>
<script type="text/javascript" src="../js/materialize.min.js"></script>
</html>
<?php }?>
