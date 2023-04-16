<header class="header">

   <section class="flex">

      <a href="index.php" class="logo">Cart Rent</a>

      <?php 
         if(isset($_SESSION['agency_id'])){
      ?>

         <div class="flex-btn"> 
          <a href="add_vehicle.php" class="btn">Add New Car</a>
          <a href="view_booking.php" class="btn">View Booking</a>
          <a href="components/logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">Logout</a>
         </div>
         
      <?php }  ?>

      <?php
         // $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         // $select_profile->execute([$customer_id]);
         if(isset($_SESSION['customer_id'])){
            // $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      
      <div class="class="flex-btn"> 
         <a href="components/logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">Logout</a>
      </div>

      <?php
         }
         else{
            if(!isset($_SESSION['agency_id'])){
      ?>
               <div class="flex-btn">
                  <a href="login.php" class="option-btn">Login</a>
               </div>
      <?php
         }}
      ?>

   </section>

</header>