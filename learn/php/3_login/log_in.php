<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>Log in and sign up template</title>
    <link rel='stylesheet' type='text/css' href='src/css/style.css' />
    <script type='text/javascript' src='src/js/app.js'></script>
  </head>

  <body>

  <h1>Log in</h1>

  <?php
  require_once('connect_db.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = 'SELECT * FROM users WHERE username=? and password=?';
  $sth = $dbh->prepare($sql);
  $sth->execute(array($username, $password));
  $result = $sth->fetch();

  if (empty($result)) { ?>

  <p>Your username or your password is incorrect. Please try again.</p>

  <?php } else {

  if ($result['active'] === 'yes') {
    session_start();
    $_SESSION['username'] = $result['username'];
    $_SESSION['role'] = $result['role'];
  ?>

  <p>You have successfully logged in.</p>

  <?php } else { ?>

  <p>Your account has not been activated.</p>

  <?php } } ?>

  <a href='index.php'>Back to index.</a>

  </body>
</html>
