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
   $user_id = $_POST['user_id'];
   $user_id = filter_var($user_id, FILTER_SANITIZE_STRING); 

   $insert_vehicle = $conn->prepare("INSERT INTO `booked_vehicles`(vehicle_id, user_id, agency_id, days, start_date) VALUES(?,?,?,?,?)");
   $insert_vehicle->execute([$vehicle_id, $user_id, $agency_id, $days, $start_date]);
   $message[] = 'vehicle booked!';

}

?>
   
<!-- Main Content -->
<section class="container">

   <h1 class="heading my-4 text-center">Cars available for rent</h1>
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

   <div class="row">
      
      <?php
            $select_vehicles = $conn->prepare("SELECT * FROM `vehicles` ORDER BY `vehicle_id` DESC");
            $select_vehicles->execute();
            if($select_vehicles->rowCount() > 0){
               while($fetch_vehicles = $select_vehicles->fetch(PDO::FETCH_ASSOC)){
                  $vehicle_id = $fetch_vehicles['vehicle_id'];
                  $agency_id = $fetch_vehicles['agency_id'];
                  if(isset($_SESSION['customer_id'])){
                     $user_id = $_SESSION['customer_id'];
                  }else{
                     $user_id = '';
                  }
                  ?>
                  <div class="col col-md-4 my-2">
                     <div class="card">
                        <form method="post" class="card-body" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>">
                           <!-- Hidden Filed -->
                           <input type="hidden" name="vehicle_id" value="<?= $vehicle_id; ?>">
                           <input type="hidden" name="agency_id" value="<?= $agency_id; ?>" >
                           <input type="hidden" name="user_id" value="<?= $user_id; ?>" >

                           <div class="details">
                              <div class="card-title fw-semibold fs-4"><?= $fetch_vehicles['vehicle_model']; ?></div>
                              <div class="fs-5 text-info mb-2">
                                 <?= $fetch_vehicles['vehicle_number']; ?>
                              </div>
                              <div class="prices">
                               <span class="fw-bold">Rent per day:</span> <span>₹ <?= $fetch_vehicles['rent']; ?> </span>
                              </div>
                              <div class="seating mb-3">
                                 <span class="fw-bold">Seating:</span> <?= $fetch_vehicles['seating_capacity']; ?>
                              </div>
                           </div>
                         
                           <?php
                              if(isset($_SESSION['customer_id'])){
                           ?>

                              <div class="options my-2">
                                 <select name="days" required class="form-select mb-3" aria-label="Default select example">
                                    <option value="" selected disabled>Select no. of days* </option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="4">Four</option>
                                    <option value="5">More than 5 days</option>
                                 </select>

                                 <label for="calendar" class="form-label">Start Date</label>
                                 <input type="date" id="calendar" class="form-control" name="start_date" placeholder="Select Date" required>
                              </div>

                              <div class="my-3 text-center">
                                 <?php
                                    if(isset($_SESSION['agency_id'])) {         
                                 ?>
                                    <input value="Booking Vehicle" name="booking" class="btn btn-primary" onclick="return confirm('Car agency cannot booked car');">
                                 <?php } else { ?>
                                    <input type="submit" value="Booking Vehicle" name="booking" class="btn btn-primary">
                                 <?php } ?>
                              
                              </div>
               
                              <?php 
                              }else{ 
                              ?>
                                 <div class="d-flex">
                                    <a href="login.php" class="btn btn-primary">Book Vehicle</a>  
                                 </div>
                              <?php
                              }
                              ?>
                        </form>
                     </div>
                  </div>
      <?php
            }
         }else{
            echo '<p class="empty">no cars added yet!</p>';
         }
      ?>

   </div>

</section>
<!-- Main Content -->

  
  