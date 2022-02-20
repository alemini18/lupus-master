<?php
include_once("funzioni.php");
$db=database_connect() or die("Errore");
if($_POST["state"]=="0"){ #identify
  foreach($_POST as $key => $value){
    $type=preg_replace("/[^a-zA-Z]+/", "", $key);
    if(trova($type)){
      $human=id_to_type($type);
      $aur=id_to_aura($type);
      $db->query('INSERT INTO lupus VALUES ("'.$value.'","'.$human.'", "'.$aur.'", "", 0)') or die("Errore nell'aggiunta del nome");
    }
  }
  $data=array(
    "auramorto" => "-1"
  );
  header("Location: reporter.php");
  #posta("reporter.php",$data);
  #die();

}
else if($_POST["state"]=="1"){ #guardia
  $nome=$_POST["guardato"];
  $result=$db->query('SELECT nome FROM lupus WHERE tipo="Guardia"') or die("Errore sulla guardia 1");
  $guardia="";
  if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $guardia=$row["nome"];
  }
  $db->query('UPDATE lupus SET visitato="'.$nome.'" WHERE nome="'.$guardia.'"');
  $db->query('UPDATE lupus SET protetto=1 WHERE nome="'.$nome.'"') or die("Errore sulla guardia 2");
  $data=array(
    "auramorto" => $_POST["auramorto"],
    "reportato" => $_POST["reportato"]
  );

echo '<form id="sendpost" method="post" action="veggente.php">';
echo  '<input type="hidden" name="auramorto" value="'.$_POST["auramorto"].' />';
echo  '<input type="hidden" name="reportato" value="'.$_POST["reportato"].'" />';
echo '</form>';
echo '<script>document.getElementById("sendpost").submit();</script>';

}
else if($_POST["state"]=="2"){ #uccisione


}

?>
