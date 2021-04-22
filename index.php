<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="box">
      <h2>Admin Login</h2>
      <p style="color: rgb(255, 255, 255);">Enter Your Username and Password</p>
      <form action="admin/login.php" method="post">
        <div class="inputBox">
          <input type="text" name="username" required autocomplete="off" onkeyup="this.setAttribute('value', this.value);"  value="">
          <label>Username</label>
        </div>
        <div class="inputBox">
          <input type="password" name="password" required autocomplete="off" onkeyup="this.setAttribute('value', this.value);" value="">
          <label>Passward</label>
        </div>
        <input type="submit" name="submit" value="Sign In">
      </form>
    </div>
</body>
<!--</body>-->
</html>