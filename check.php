<h3>Данные успешно добавлены. Сообщение отправлено.</h3>
<h3><a href="index.php">Вернуться на главную</a></h3>

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

<?php
	$name = filter_var(trim($_POST['name']),
	FILTER_SANITIZE_STRING);
	$tel = filter_var(trim($_POST['tel']),
	FILTER_SANITIZE_STRING);
	$email = filter_var(trim($_POST['email']),
	FILTER_SANITIZE_STRING);

	if(mb_strlen($name) <3 || mb_strlen($name) >90){
		echo "Недопустимая длина логина!";
		exit();
	} else if(mb_strlen($tel) <11 || mb_strlen($tel) >30){
		echo "Недопустимая длина номера!";
		exit();
	} else if(mb_strlen($tel) <4 || mb_strlen($tel) >30){
		echo "Допустимая длина пароля - от 4 до 30 символов!";
		exit();
	}	


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



