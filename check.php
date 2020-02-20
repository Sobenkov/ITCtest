<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ITCtest</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="assets/css/style.css">
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>

<div class="check">
	<h3>Данные успешно добавлены. Сообщение отправлено.</h3>
	<h3><a href="index.php">Вернуться на главную</a></h3>
</div>
<!-- отправка на почту -->
<?php 

require_once('assets/phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

$name = $_POST['name'];
$email = $_POST['email'];

$mail->isSMTP();        
$mail->Host = 'smtp.mail.ru'; 
$mail->SMTPAuth = true;                               
$mail->Username = 'Sobenkov95@mail.ru'; 
$mail->Password = 'sobkonst1995'; 
$mail->SMTPSecure = 'ssl'; 
$mail->Port = 465; 

$mail->setFrom('Sobenkov95@mail.ru'); 
$mail->addAddress($email);
$mail->isHTML(true);  

$str= mysqli_connect('localhost', 'host1809744', 'f535e322', 'host1809744');
$select= mysqli_query($str, "SELECT * FROM `menu`;");

$message = '
<html>
<head>
<body>
	<ul>
		<li>Партнерам</li>
		<li>Карьера</li>
	</ul>
</body>
</html>
';

$mail->Subject = 'Информация с тестового сайта';
$mail->Body    = ' Здравствуйте ' .$name . '! Список услуг: <br> ' .$message;
$mail->AltBody = '';
if(!$mail->send()) {
    echo 'Error';
}

?>
<!-- action формы -->
<?php
	$name = filter_var(trim($_POST['name']),
	FILTER_SANITIZE_STRING);
	$tel = filter_var(trim($_POST['tel']),
	FILTER_SANITIZE_STRING);
	$email = filter_var(trim($_POST['email']),
	FILTER_SANITIZE_STRING);

	$mysql = new mysqli('localhost','host1809744','f535e322','host1809744');
	    // Проверяем, успешность соединения. 
    if (mysqli_connect_errno()) { 
        echo "<p><strong>Ошибка подключения к БД</strong>. Описание ошибки: ".mysqli_connect_error()."</p>";
        exit(); 
    }
	$mysql->query("INSERT INTO `users` (`name`, `tel`, `email`)
	VALUES('$name', '$tel', '$email')");

	$mysql->close();
?>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="assets/js/script.js"></script>
  <script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script></body>
</body>
</html>



