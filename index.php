<?php
include_once('Auth.php');
print_r($_SESSION);
if (isset($_GET['submit'])) {
    $auth = new auth();
    $user = $auth->checkEmail();
    print_r($user['email']);
//    if ($user = $auth->checkEmail()) {
//        exit();
//    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<body>
    <form action="" method="get">
        <label for="email">Email</label>
        <input id="email" type="text" name="email" value="<?php echo $user['email'] || ''; ?>">
        <input type="submit" name="submit" value="go">
    </form>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
$(document).ready(() => {

});
</script>

