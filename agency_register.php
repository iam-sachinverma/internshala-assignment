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
       $message[] = 'Email address already exists!';
    }else{
       if($pass != $cpass){
          $message[] = 'Confirm passowrd not matched!';
       }else{
          $insert_agency = $conn->prepare("INSERT INTO `users`(name, email, password, user_type ) VALUES(?,?,?,?)");
          $insert_agency->execute([$name, $email, $cpass, $user_type]);
          $message[] = 'Registered Successfully !';

          $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
          $select_user->execute([$email, $pass]);
          $row = $select_user->fetch(PDO::FETCH_ASSOC);

          if($select_user->rowCount() > 0){
            $_SESSION['agency_id'] = $row['id'];
            header('location:index.php');
          }
       }
    }
 
}

?>

<!-- Main Content -->
<section class="form-container">

   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>" method="POST">
      
      <h3>Car Agency Register</h3>

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

      <input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" maxlength="20" required placeholder="confirm your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="hidden" name="user_type" class="box" value="agency" >
      <br>
      <p>Already have an account? <a href="login.php">Login</a></p>
      <br>
      <input type="submit" value="register now" name="submit" class="btn">

   </form>

</section>
<!-- Main Content -->
