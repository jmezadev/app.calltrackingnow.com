<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/index.css">
  <title>CallTrackingNow</title>
</head>
<body>
  <section class="container_total_login">
    <div class="container_login_form">
      <img class="img_logo_login" src="img/logotipo_login_calltrackingnow.png" alt="">
      <form action="" method="post" id="login" class="login">
        <input type="text" class="username" name="email" id="email" placeholder="email">
        <input type="password" class="password" name="password" id="password" placeholder="password">
          <input type="hidden" value="">
        <input type="button" onclick="login()" class="submit_login" value="Login">
        <!--<div class="green-light"></div>-->
      </form>
      <a class="link_sign" href="">Sign Up</a>
      <a class="link_forgot" href="">Forgot Password</a>
    </div>
  </section>
  <script src="/js/libs/jquery-3.2.1.min.js"></script>
  <script src="/js/app/login.js"></script>
</body>
</html>
