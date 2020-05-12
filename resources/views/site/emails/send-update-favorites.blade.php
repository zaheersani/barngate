<!DOCTYPE html>
<html>
<head>
	<title> Mail Rehister </title>
</head>
<body>
	<h3> Hi {{ auth()->user()->username }},  </h3>
	<p> The user {{ $user->username }} changed information of his {{ $saleUp->animal_name }} announcement in which you added as a favorite, to see it go to the following link: </p>
	<p> <a href="{{ route("sale.show", $saleUp->nickname) }}"> click animal </a> </p>
</body>
</html>