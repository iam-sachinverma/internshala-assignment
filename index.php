<?php 

include('template.php');


if(isset($_POST['booking'])){

   $vehicle_id = $_POST['vehicle_id'];
   $vehicle_id = filter_var($vehicle_id, FILTER_SANITIZE_STRING);
   $days = $_POST['days'];
   $days = filter_var($days, FILTER_SANITIZE_STRING);
   $start_date = $_POST['start_date'];
   $start_date = filter_var($start_date, FILTER_SANITIZE_STRING);
   $agency_id = $_POST['agency_id'];
   $agency_id = filter_var($agency_id, FILTER_SANITIZE_STRING);
    
   $insert_vehicle = $conn->prepare("INSERT INTO `booked_vehicles`(vehicle_id, agency_id, days, start_date) VALUES(?,?,?,?)");
   $insert_vehicle->execute([$vehicle_id, $agency_id, $days, $start_date]);
   $message[] = 'vehicle booked!';

}

?>
   
<!-- Main Content -->
<section class="show-posts">

   <h1 class="heading">Cars available for rent</h1>
   <br/>
   
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

   <br/>
   
   <div class="box-container">

      <?php
         $select_vehicles = $conn->prepare("SELECT * FROM `vehicles` ORDER BY `vehicle_id` DESC");
         $select_vehicles->execute();
         if($select_vehicles->rowCount() > 0){
            while($fetch_vehicles = $select_vehicles->fetch(PDO::FETCH_ASSOC)){
               $vehicle_id = $fetch_vehicles['vehicle_id'];
               $agency_id = $fetch_vehicles['agency_id'];
      ?>
      <form method="post" class="box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>">
         <input type="hidden" name="vehicle_id" value="<?= $vehicle_id; ?>">
         <input type="hidden" name="agency_id" value="<?= $agency_id; ?>" >

         <div class="title"><?= $fetch_vehicles['vehicle_model']; ?></div>
         <div class="posts-content"><?= $fetch_vehicles['vehicle_number']; ?></div>
         <div class="icons">
            <div class="seating">Seating: <?= $fetch_vehicles['seating_capacity']; ?></div>
            <br>
            <div class="prices">Rent per day: &nbsp; <span>₹ <?= $fetch_vehicles['rent']; ?> </span></div>
         </div>

         <br>

         <?php
            // $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            // $select_profile->execute([$customer_id]);

            if(isset($_SESSION['customer_id'])){
               // $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>

            <div class="options">
            <select name="days" class="box" required>
               <option value="" selected disabled>Select no. of days* </option>
               <option value="1">One</option>
               <option value="2">Two</option>
               <option value="3">Three</option>
               <option value="4">Four</option>
               <option value="5">More than 5 days</option>
            </select>

            <p>Start Date:</p>
            <input type="date" id="calendar" class="box" name="start_date" placeholder="Select Date" required>
            </div>

            <div class="flex-btn">
            
               <?php
               if(isset($_SESSION['agency_id'])) {         
            ?>
               <input value="Booking Vehicle" name="booking" class="btn" onclick="return confirm('Car agency cannot booked car');">
            <?php } else { ?>
               <input type="submit" value="Booking Vehicle" name="booking" class="btn">
            <?php } ?>
            
            </div>
         
         <?php 
         }else{ 
         ?>
            <div class="flex-btn">
               <a href="login.php" class="btn">Book Vehicle</a>  
            </div>
         <?php
         }
         ?>
         <br>
   
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no cars added yet!</p>';
         }
      ?>

   </div>

</section>
<!-- Main Content -->

  
  