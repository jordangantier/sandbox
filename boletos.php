<?php
//Cartones de bingo que se desea emitir.
$cartones = 5000;
//Genera 99 bolillos.
for ($i=1; $i<100; $i++){
    $bolillos[$i] = $i;
}
//Genera los bingos.
for ($n=1; $n<=$cartones; $n++){
	//Numera los boletos de 1 a n.
	$boleto['numero'] = $n;
    //Selecciona 24 bolillos al azar.
	$boleto['bolillos'] = array_rand($bolillos, 24);
    //Genera la secuencia numérica.
	$total = "|";
	foreach ($boleto['bolillos'] as $value){
		$total .= $value."|";
	}
	//Genera la tirada completa de números.
	$boleto['tirada'] = $total;
    //Genera el Hash del boleto.
	$boleto['hash'] = sha1($boleto['tirada'].'omoLaRompe');
    //Empaqueta el boleto en un solo array.
	$boletos[$n] = $boleto;
}
//Compara todos los boletos en busca de repetidos.
foreach ($boletos as $key => $value){
	for ($n=1; $n <= count($boletos); $n++){
		if($n != $key){
            if($boletos[$n]['hash'] == $value['hash']){
				echo ("Boleto Repetido!: ".$key."<br>");
				break;
            }
		}
	}
}
/*
$jsonBoletos = json_encode($boletos);
echo($jsonBoletos);
*/
echo '<div>Generados '.$cartones.' cartones de bingo</div>';
echo '<div style="color:#339900">No se encontraron boletos repetidos.</div><br />';
foreach($boletos as $key => $bingo){
	echo('Cartón: '.$key.'<br />');
	echo('Tirada: '.$bingo['tirada'].'<br />');
	echo('Hash: '.$bingo['hash'].'<br /><br />');
}
