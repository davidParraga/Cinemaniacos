<?php
	session_start();
	require 'phpfunctions/conexion.php';
	$id = $_SESSION['iduser'];
	$server="localhost";
	$port="1111";
	$localpath = getcwd();
	$path="$localpath\matlab\r\n";
	$funcion="index_recomendacion($id)\r\n";
	$data= $path.$funcion.chr(0);
	try{
		$conexion_matlab = fsockopen($server, $port, $errno, $errstr, 100);
		if (!$conexion_matlab) {} 
		else 
		{
			fwrite($conexion_matlab, $data);
			fclose($conexion_matlab);
		}
	}
	catch(exception $e)
	{
		echo "Hay un problema en la conexión con el servidor de Matlab. Inténtelo más tarde.";
	}

?>

<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	
	<meta name="viewport" content="width=device-width" />
	<title>Peliculitas</title>
	<link rel="icon" type="image/png" href="logo.png">


</head>
<body>
<center>
<h4><i>Espere mientras se ejecuta el algorítmo de recomendación... </i></h4>
<div class="meter">
    <div class="bar">
        <span></span>
    </div>
    <div class="num"></div>
</div>
 </center>
 
<script>

var contador=240;
 
setTimeout(()=>{
    document.querySelector(".meter .bar span").style.display="block";
    document.querySelector(".meter .bar span").classList.add("start");
    document.querySelector(".meter .num").innerHTML=contador;
    var interval=setInterval(()=>{
        contador = contador - 1;
        document.querySelector(".meter .num").innerHTML=contador;
        if(contador<=0)
        {
            clearInterval(interval);
            redireccionarPagina();
        }
    },1000);
},500);
 
function redireccionarPagina() {
  window.location = "micuenta.php";
}

</script>

</body>
</html>
