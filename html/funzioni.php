<?php
$ruoli=array("Reporter", "Guardia", "Veggente", "Veggente Oscuro", "Criceto", "Medium", "Villico", "Villico Brutto", "Lupo", "Simp");
$id=array("rep", "gua", "veg", "vego", "cri", "med", "vil", "vilb", "lup", "sim");
$aura=array(1,1,1,0,1,1,1,0,0,1);

function database_connect(){
  $db=new mysqli("localhost", "alemini", "", "my_alemini");
  if($db->connect_error)return 0;
  else return $db;
}
function trova($s){
  global $id;
  for($i=0;$i<10;$i++){
    if($s==$id[$i])return 1;
  }
  return 0;
}
function id_to_type($s){
  global $id,$ruoli;
  for($i=0;$i<10;$i++)if($s==$id[$i])return $ruoli[$i];
  die("Id non trovato");
}
function id_to_aura($s){
  global $id,$aura;
  for($i=0;$i<10;$i++)if($s==$id[$i])return $aura[$i];
  die("Id non trovato");
}
function uccisione($morto, $lupo, $simp){
  $db=database_connect() or die("Errore di connessione");
  $db->query('UPDATE lupus SET visitato="'.$morto.'" WHERE nome="'.$lupo.'"');
  $result=$db->query('SELECT * FROM lupus WHERE nome="'.$morto.'"') or die("Errore sul lupo");
  if($result->num_rows>0){
    $row=$result->fetch_assoc();
    if($row["tipo"]=="Criceto" or $row["protetto"]==1)return;
  }else die("Nome non trovato");
  if($simp=="1"){
    $result=$db->query('SELECT * FROM lupus WHERE tipo="Simp"') or die("Errore sul simp");
    if($result->num_rows>0){
      $row=$result->fetch_assoc();
      $db->query('INSERT INTO morti VALUES ("'.$row["nome"].'")') or die("Errore sul simp");
      $db->query('DELETE FROM lupus WHERE tipo="Simp"');
      return;
    }
  }
  $db->query('INSERT INTO morti VALUES ("'.$morto.'")') or die("Errore sul simp");
  $db->query('DELETE FROM lupus WHERE nome="'.$morto.'"') or die("Errore sul simp");
}
function veggente($nome, $buono){
  $veg="Veggente";
  if($buono==0)$veg=$veg." Oscuro";
  $db=database_connect() or die("Errore di connessione");
  $db->query('UPDATE lupus SET visitato="'.$nome.'" WHERE tipo="'.$veg.'"');
  $result=$db->query('SELECT * FROM lupus WHERE nome="'.$nome.'"') or die("Errore sul veg");
  if($result->num_rows>0){
    $row=$result->fetch_assoc();
    if($row["tipo"]=="Criceto" and $buono==1){
      $result1=$db->query('SELECT * FROM lupus WHERE tipo="Veggente"') or die("Errore sul veg");
      if($result1->num_rows>0){
        $row1=$result1->fetch_assoc();
        $db->query('INSERT INTO morti VALUES ("'.$row1["nome"].'")') or die("Errore sul veg");
        $db->query('DELETE FROM lupus WHERE tipo="Veggente"') or die("Errore sul veg");
      }
    }
    if($row["tipo"]=="Reporter" and $buono==0){
      $db->query('UPDATE lupus SET visitato="No" WHERE tipo="Reporter"') or die("Errore sul stop rep");
    }
    return $row["aura"]?"Buono":"Cattivo";
  }
  die("Nome non trovato");
}


?>
