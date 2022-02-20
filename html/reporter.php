<?php
$auramorto="-1";
if(isset($_POST["auramorto"]))$aura_morto=$_POST["auramorto"];
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
  <h1>Reporter<br><br></h1>
  <form action="guardia.php" method="post">
    <input type="hidden" id="auramorto" name="auramorto" value="<?php echo $auramorto; ?>">
   <input type="text" id="reportato" name="reportato" placeholder="Pio">
   <button type="submit" class="waves-effect waves-teal btn-large grey darken-4 white-text">Conferma</button>
 </form>
</div>
</body>
<script type="text/javascript" src="../js/materialize.min.js"></script>
</html>
