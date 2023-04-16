<?php 

@include 'config/connect.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Car Rental</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
    
   <!-- Header -->
   <?php include 'components/header.php'; ?>
   
   <!-- content -->
   <main></main>
  
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

</body>
</html>