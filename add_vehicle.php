<?php 

include('template.php');

if(!isset($_SESSION['agency_id'])){
   header('location:login.php');
}
 
if(isset($_POST['publish'])){
 
    $vehicle_model = $_POST['vehicle_model'];
    $vehicle_model = filter_var($vehicle_model, FILTER_SANITIZE_STRING);
    $vehicle_number = $_POST['vehicle_number'];
    $vehicle_number = filter_var($vehicle_number, FILTER_SANITIZE_STRING);
    $seating_capacity = $_POST['seating_capacity'];
    $seating_capacity = filter_var($seating_capacity, FILTER_SANITIZE_STRING);
    $rent = $_POST['rent'];
    $rent = filter_var($rent, FILTER_SANITIZE_STRING);
    $agency_id = $_POST['agency_id'];
    $agency_id = filter_var($agency_id, FILTER_SANITIZE_STRING);
     
    $select_vehicle_number = $conn->prepare("SELECT * FROM `vehicles` WHERE vehicle_number = ?");
    $select_vehicle_number->execute([$vehicle_number]);
 
    if($select_vehicle_number->rowCount() > 0 AND $vehicle_number != ''){
       $message[] = 'Vehicle with same number already inserted';
    }else{
       $insert_vehicle = $conn->prepare("INSERT INTO `vehicles`(agency_id, vehicle_model, vehicle_number, seating_capacity, rent) VALUES(?,?,?,?,?)");
       $insert_vehicle->execute([$agency_id, $vehicle_model, $vehicle_number, $seating_capacity, $rent]);
       $message[] = 'vehicle published!';
    }
    
}

?>

<section class="form-container">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>" method="post" enctype="multipart/form-data">
      
      <h1 class="heading">Add new car</h1>

      <?php
         if(isset($message)){
            foreach($message as $message){
               echo '
               <div class="message">
                  <span>'.$message.'</span>
                  <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
               </div>
               ';
            }
         }
      ?>
      
      <!-- <p>Enter Vehicle Model <span>*</span></p> -->
      <input type="text" name="vehicle_model" maxlength="100" required placeholder="add vehicle model" class="box">
      <!-- <p>Enter Vehicle Number <span>*</span></p> -->
      <input type="text" name="vehicle_number" maxlength="100" required placeholder="add vehicle number" class="box">
      <!-- <p>Enter Seating Capacity<span>*</span></p> -->
      <input type="number" name="seating_capacity" maxlength="100" required placeholder="add vehicle sitting capacity" class="box">
      <!-- <p>Enter Rent for One Day</p> -->
      <input type="number" name="rent" required placeholder="add per day rent" class="box" />
      <!-- agency input -->
      <input type="hidden" name="agency_id" value="<?= $_SESSION['agency_id'] ?>">
     
      <div class="flex-btn">
         <input type="submit" value="Publish vehicle" name="publish" class="btn btn-success" required>
      </div>
    </form>

</section>