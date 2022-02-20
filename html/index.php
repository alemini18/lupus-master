<?php
include_once("funzioni.php");
$db=database_connect() or die("Errore di connessione al database");
$db->query("DELETE FROM lupus WHERE 1");
$db->query("DELETE FROM morti WHERE 1");
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
  <h1>Lupus<br><br></h1>
  <form action="identify.php" method="post">
  <?php
  for($i=0;$i<10;$i++){
    $n=1;
    if($i==8)$n=3;
    echo '<div class="row">';
    echo '<div class="col s3"></div>';
    echo '<div class="col s3">';
    echo  '<h5 style="text-align: right;">'.$ruoli[$i].'</h5>';
    echo '</div>';
    echo  '<div class="col s2">';
    echo  '<input id="'.$id[$i].'" name= "'.$id[$i].'" type="number" align="bottom" value='.$n.'>';
    echo  '</div></div>';
  }
   ?>
   <button type="submit" class="waves-effect waves-teal btn-large grey darken-4 white-text">Gioca!</button>
 </form>
</div>
</body>
<script type="text/javascript" src="../js/materialize.min.js"></script>
</html>
