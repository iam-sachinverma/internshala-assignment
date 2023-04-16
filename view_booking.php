<?php 

include('template.php');

if(!isset($_SESSION['agency_id'])){
    header('location:login.php');
}

?>

<section class="show-posts">

   <h1 class="heading">Booked Vehicle</h1>

   <div class="box-container">

        <?php
         $select_booking = $conn->prepare("SELECT * FROM `booked_vehicles` ORDER BY `booking_id` DESC");
         $select_booking->execute();
         if($select_booking->rowCount() > 0){
            while($fetch_booking = $select_booking->fetch(PDO::FETCH_ASSOC)){
               $vehicle_id = $fetch_booking['vehicle_id'];
             
               $vehicle_details = $conn->prepare("SELECT * FROM `vehicles` WHERE vehicle_id = ? AND agency_id = ?");
               $vehicle_details->execute([$vehicle_id, $_SESSION['agency_id']]);
               
        ?>

                <?php 
                    if($fetch_vehicle = $vehicle_details->fetch(PDO::FETCH_ASSOC)){
                ?>

            <div class="box">
                <div class="status" style="background-color:limegreen; padding: 1rem">Booked</div>

                <div class="title">
                    <?= $fetch_vehicle['vehicle_model']; ?>
                </div>
                
                <div class="posts-content">
                    <?= $fetch_vehicle['vehicle_number']; ?>
                </div>

                <div class="options">
                    <div class="days"><b>No. of Days:</b> &nbsp;<span>₹ <?= $fetch_booking['days']; ?> </span> </div>   
                    <br>
                    <div class="prices"><b>Rent:</b> &nbsp;<span>₹ <?= $fetch_vehicle['rent']; ?> </span></div>
                </div>

                <br>

                <div class="icons"> 
                    <div class="days">Starting date: <?= $fetch_booking['start_date'] ?></div>
                </div>

            </div>

                <?php } ?>   


        <?php
                }
            }else{
                echo '<p class="empty">Zero Booking Yet! ></p>';
            }
        ?>

   </div>

</section>