<!DOCTYPE html>
<html>
<head>
	<title> Mail Rehister </title>
</head>
<body>
	<h3> Hi {{ $msj->username }} </h3>
	<p> Seller {{ $username }} requires you to rate it for a better experience. </p>
	<p> Rate it by clicking here <a href={{ route("sale.score", ["sale_id" => $sale_id, "calificado_id" => base64_encode($username)]) }}> Qualify </a> </p>
</body>
</html>