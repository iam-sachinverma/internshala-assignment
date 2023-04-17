<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand text-black mx-4 fs-3 fw-bold" href="index.php">Car Rent</a>

    <?php 
         if(isset($_SESSION['agency_id'])){
      ?>

         <div class="d-flex gap-3">   
          <a href="add_vehicle.php" class="btn btn-primary">Add New Car</a>
          <a href="view_booking.php" class="btn btn-primary">View Booking</a>
          <a href="components/logout.php" onclick="return confirm('logout from this website?');" class="btn btn-danger">Logout</a>
         </div>
         
      <?php }  ?>

      <?php
         // $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         // $select_profile->execute([$customer_id]);
         if(isset($_SESSION['customer_id'])){
            // $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      
      <div class="d-flex gap-3"> 
         <a href="components/logout.php" onclick="return confirm('logout from this website?');" class="btn btn-danger">Logout</a>
      </div>

      <?php
         }
         else{
            if(!isset($_SESSION['agency_id'])){
      ?>
               <div class="d-flex gap-3">
                  <a href="login.php" class="btn btn-success">Login</a>
               </div>
      <?php
         }}
      ?>

  </div>
</nav>

<!-- <header class="header">

   <section class="d-flex align-items-center justify-content-between p-3">

      <a href="index.php" class="logo navbar-brand">Cart Rent</a>

      <?php 
         if(isset($_SESSION['agency_id'])){
      ?>

         <div class="d-flex gap-3">   
          <a href="add_vehicle.php" class="btn btn-primary">Add New Car</a>
          <a href="view_booking.php" class="btn btn-primary">View Booking</a>
          <a href="components/logout.php" onclick="return confirm('logout from this website?');" class="btn btn-danger">Logout</a>
         </div>
         
      <?php }  ?>

      <?php
         // $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         // $select_profile->execute([$customer_id]);
         if(isset($_SESSION['customer_id'])){
            // $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      
      <div class="d-flex gap-3"> 
         <a href="components/logout.php" onclick="return confirm('logout from this website?');" class="btn btn-danger">Logout</a>
      </div>

      <?php
         }
         else{
            if(!isset($_SESSION['agency_id'])){
      ?>
               <div class="d-flex gap-3">
                  <a href="login.php" class="btn btn-success">Login</a>
               </div>
      <?php
         }}
      ?>

   </section>

</header> -->