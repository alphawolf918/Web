<?php
	ob_start();
	$con = mysql_connect("localhost","root","giga") OR exit(mysql_error());
	mysql_select_db("novagalaxy",$con) OR exit(mysql_error());
	require 'sql.php';
	require 'core.php';
$getGalaxies = mysql_query("SELECT * FROM galaxies ORDER BY id DESC LIMIT 10") OR sqlError();
		while($g = mysql_fetch_assoc($getGalaxies)){
			echo "<div style='font-size: 24px; font-weight: bold;'>".$g["name"]." Galaxy</div>
					<strong>Distance From Center:</strong> ".number_format($g["distance_from_center"])." Light Years
					<div style='height: 25px;'></div>
					<div style='margin-left: 2%'>
			";
			$getStars = mysql_query("SELECT * FROM stars WHERE galaxy_id = '".$g["id"]."' ORDER BY id DESC LIMIT 100") OR sqlError();
			while($s = mysql_fetch_assoc($getStars)){
				echo '
					<div style="font-size: 22px; font-weight: bold;">'.$s["name"].' System</div>
						<div><strong>Temp:</strong> '.number_format($s["temperature"]).'&deg; F</div>
						<div><strong>Distance From Core:</strong> '.number_format($s["distance_from_center"]).' Light Years</div>
						<div><strong>Mass:</strong> '.number_format($s["mass"]).' x 10<sup>'.$s["mass_scale"].'</sup> kg</div>
						<div style="margin-left: 4%;">
				';
				$getPlanets = mysql_query("SELECT * FROM planets WHERE star_id = '".$s["id"]."'") OR sqlError("e");
				if(mysql_num_rows($getPlanets) == 0){
					echo "No planets in this system.";
				}
				while($p = mysql_fetch_assoc($getPlanets)){
					echo '
					<div style="font-size: 20px; font-weight: bold;">Planet '.$p["name"].'</div>
						';
						$intPlanetTempDay = $p["temperature"];
						$intPlanetTempNight = (($intPlanetTempDay) / 2.5);
						$intPlanetTempNight = floor(($intPlanetTempNight <= 0) ? ($intPlanetTempNight * -1) : $intPlanetTempNight);
						echo 
							'<div><strong>Temp:</strong> '.number_format($intPlanetTempDay).'&deg; F day / '.number_format($intPlanetTempNight).'&deg; F night</div>
							<div><strong>Distance From Star:</strong> '.number_format($p["distance_from_star"]).' Light Years</div>
							<div><strong>Mass:</strong> '.number_format($p["mass"]).' x 10<sup>'.$p["mass_scale"].'</sup></div>
							<div><strong>Atmosphere:</strong> '.$p["gasses"].'</div>
							<div><strong>Radiation:</strong> '.$p["rad"].'%</div>
							<div><strong>Toxicity:</strong> '.$p["tox"].'%</div>
					';
				}
				echo "</div>
				<div style='height: 25px;'></div>";
			}
			echo "</div>
				<div style='height: 50px;'></div>";
		}
	ob_end_flush();
	mysql_close($con);
?>