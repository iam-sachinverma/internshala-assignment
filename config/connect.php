<?php 

  //  OOO0webHost Config
  // $db_name = 'mysql:host=localhost;dbname=id20367418_car';
  // $user_name = 'id20367418_soul';
  // $user_password = '[l3De&#8t*$LX9uv';'

  // Localhost config
  $db_name = 'mysql:host=localhost;dbname=car';
  $user_name = 'root';
  $user_password = '';

  try{

    $conn = new PDO($db_name, $user_name, $user_password);
    
  }catch(Exception $e){
    
    echo "Connection Failed".$e->getMessage();

  }

?>