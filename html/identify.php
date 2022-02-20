<?php
include_once("funzioni.php");

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
   <form action="store.php" method="post">
     <input type="hidden" id="state" name="state" value="0">
   <?php
   for($i=0;$i<10;$i++){
     for($j=0;$j<$_POST[$id[$i]];$j++){
     echo '<div class="row">';
     echo '<div class="col s3"></div>';
     echo '<div class="col s3">';
     echo  '<h5 style="text-align: right;">'.$ruoli[$i].'</h5>';
     echo '</div>';
     echo  '<div class="col s2">';
     echo  '<input id="'.$id[$i].$j.'" name= "'.$id[$i].$j.'" type="text" align="bottom" required>';
     echo  '</div></div>';
   }
   }
    ?>
    <button type="submit" class="waves-effect waves-teal btn-large grey darken-4 white-text">Conferma</button>
  </form>
 </div>
 </body>
 <script type="text/javascript" src="../js/materialize.min.js"></script>
 </html>
