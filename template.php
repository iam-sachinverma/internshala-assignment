<?php 

@include 'config/connect.php';

session_start();

if(isset($_SESSION['customer_id'])){
  $customer_id = $_SESSION['customer_id'];
}else{
  $customer_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Car Rental</title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/agency_style.css"> -->

    <style>
      #snackbar {
         visibility: hidden; /* Hidden by default. Visible on click */
         min-width: 250px; /* Set a default minimum width */
         margin-left: -125px; /* Divide value of min-width by 2 */
         background-color: #333; /* Black background color */
         color: #fff; /* White text color */
         text-align: center; /* Centered text */
         border-radius: 2px; /* Rounded borders */
         padding: 16px; /* Padding */
         position: fixed; /* Sit on top of the screen */
         z-index: 1; /* Add a z-index if needed */
         left: 50%; /* Center the snackbar */
         bottom: 30px; /* 30px from the bottom */
      }

/* Show the snackbar when clicking on a button (class added with JavaScript) */
#snackbar.show {
  visibility: visible; /* Show the snackbar */
  /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
  However, delay the fade out process for 2.5 seconds */
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

/* Animations to fade the snackbar in and out */
@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
    </style>

</head>
<body>
    
   <!-- Header -->
   <?php include 'components/header.php'; ?>
   
   <!-- content -->
   <main></main>


   <!-- The actual snackbar -->
   <div id="snackbar">Some text some message..</div>
  
   <!-- Footer -->
   <?php include 'components/footer.php'; ?>

   <!-- JS Script -->
   <script type="text/javascript" src="js/script.js"></script>

   <!-- Avoid Form Submit On Every Reload -->
   <script>
      if(window.history.replaceState) {
         window.history.replaceState(null, null, window.location.href);
      }
   </script>
   
   <!-- Hide Past Date -->
   <script type="text/javascript">
      var todayDate = new Date();
      var month = todayDate.getMonth() + 1;
      var year = todayDate.getUTCFullYear() - 0;
      var tdate = todayDate.getDate();
      if (month < 10) {
        month = "0" + month
      }
      if (tdate < 10) {
        tdate = "0" + tdate;
      }
      var maxDate = year + "-" + month + "-" + tdate;
      const all = document.querySelectorAll("#calendar").forEach(function(action) {
        action.setAttribute("min", maxDate);
      });
      console.log(maxDate);
   </script>

   <script>
      function myFunction() {
      // Get the snackbar DIV
      var x = document.getElementById("snackbar");

      // Add the "show" class to DIV
      x.className = "show";

      // After 3 seconds, remove the show class from DIV
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      }
   </script>

</body>
</html>