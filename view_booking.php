<?php 

include('template.php');

if(!isset($_SESSION['agency_id'])){
    header('location:login.php');
}

?>

<section class="container">

   <h1 class="heading text-center mt-4 mb-4">Booked Vehicle</h1>

   <div class="row">

        <?php
         $select_booking = $conn->prepare("SELECT * FROM `booked_vehicles` ORDER BY `booking_id` DESC");
         $select_booking->execute();
         
         if($select_booking->rowCount() > 0){

            

            while($fetch_booking = $select_booking->fetch(PDO::FETCH_ASSOC)){
               $vehicle_id = $fetch_booking['vehicle_id'];
               $vehicle_details = $conn->prepare("SELECT * FROM `vehicles` WHERE vehicle_id = ? AND agency_id = ?");
               $vehicle_details->execute([$vehicle_id, $_SESSION['agency_id']]);

                $user_id = $fetch_booking['user_id'];
                $get_user = $conn->prepare("SELECT * FROM `users` WHERE `id` = $user_id");
                $get_user->execute(); 

                if($get_user->rowCount() > 0){
                   while($fetch_user =  $get_user->fetch(PDO::FETCH_ASSOC)){
                
        ?>

            <?php 
                if($fetch_vehicle = $vehicle_details->fetch(PDO::FETCH_ASSOC)){
            ?>

                <div class="col-3">
                    <div class="card">
                        
                    <div class="card-body">
                    <div class="user">
                                <p class="fw-bold fs-5">User Details :</p>
                                <p><code>Name:-</code>  <?=  $fetch_user['name'] ?> <br>  <code>Email:-</code>  <?=  $fetch_user['email'] ?></p>
                            </div>
                        <div class="">
                            <span class="fw-bold">Car Name : </span><?= $fetch_vehicle['vehicle_model']; ?>
                            <br>
                            <span class="fw-bold">Car Number : </span><?= $fetch_vehicle['vehicle_number']; ?>
                            <div class="days"><b>No. of Days:</b> &nbsp;<span>₹ <?= $fetch_booking['days']; ?> </span> </div>   
                            <div class="days">Starting date:   <?= $fetch_booking['start_date'] ?></div>
                        </div>
                    </div>
                    </div>

                </div>
                <?php }
                }} ?>   
           <?php
                }
            }else{
                echo '<p class="empty">Zero Booking Yet! ></p>';
            }
        ?>

   </div>

</section>