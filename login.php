<?php

include('template.php');

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){

      if($row['user_type'] == 'customer'){
         echo $row['user_type'] == 'customer';
         header('location:index.php');
         $_SESSION['customer_id'] = $row['id'];
      }else if($row['user_type'] == 'agency'){
         echo $row['user_type'] == 'agencyr';
         header('location:index.php');
         $_SESSION['agency_id'] = $row['id'];
      }

   }else{
      $message[] = 'Incorrect username or password!';
   }

}

?>

<!-- Main Content -->
<section class="form-container">

   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>" method="post">
      <h3>Login</h3>

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

      <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" name="submit" class="btn">

      <br>
      <p>OR</p>
      <br>
      <p>Don't have an account? </p>

      <a href="register.php">
         <button class="btn" style="background: #F5EA5A;" type="button">Register As Customer</button>
      </a>
      <a href="agency_register.php">
         <button class="btn" style="background: #B2A4FF;" type="button">Register As Car Agency</button>
      </a>
   </form>

</section>
<!-- Main Content -->

