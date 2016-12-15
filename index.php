<?php

require 'src/start.php';

// var_dump($user);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Document</title>
</head>
<body>
	<?php
	if($user->member){
		echo "<p> you are a member</p>";
	}else{
		echo "<p> you are not a member</p><a href=\"member/payment.php\"> become a member</a>";
	}
	?>


</body>
</html>