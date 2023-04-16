<?php

include('template.php');

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   $user_type = $_POST['user_type'];
   $user_type = filter_var($user_type, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'User already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password, user_type) VALUES(?,?,?,?)");
         $insert_user->execute([$name, $email, $cpass, $user_type]);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->execute([$email, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0){
            $_SESSION['customer_id'] = $row['id'];
            header('location:index.php');
         }
      }
   }

}

?>

<!-- Main Content -->
<section class="form-container">

   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>" method="post">
      <h3>Customer Register</h3>
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
      <input type="text" name="name" required placeholder="enter your name" class="box" maxlength="50">
      <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="confirm your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="hidden" name="user_type" class="box" value="customer" >
      <input type="submit" value="register now" name="submit" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</section>
<!-- Main Content -->

