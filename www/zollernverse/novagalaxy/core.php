<?php
require 'functions.php';
	function getName(){
			$syll = 0;
			$strBegin1 = array("ro", "xa", "de", "er", "un", "ce", "ed", "plu", "ur", "sr", "lu", "ik", "psi",  "annu", "anu", "e", "a", "i", "o", "u", "ae", "ai", "ao", "au", "ay", "ba", "be", "bu", "bi", "by", "ca", "ci", "cu", "cy", "da", "du", "di", "dy", "ea", "ee", "ei", "eo", "eu", "fa", "fe", "fi", "fo", "fu", "fy", "ga", "ge", "gi", "go", "gu", "gy", "ha", "he", "hi", "ho", "hu", "hy", "ia", "ie", "io", "iu", "iy", "ja", "je", "ji", "jo", "ju", "jy", "ka", "ke", "ki", "ko", "ku", "ky", "la", "le", "li", "lo", "lu", "ly", "ma", "me", "mi", "mo", "mu", "my", "na", "ne", "ni", "no", "nu", "ny", "oa", "oe", "oi", "oo", "ou", "oy", "pa", "pe", "pi", "po", "pu", "py", "qa", "qe", "qi", "qo", "qu", "qy", "ra", "re", "ri", "ro", "ru", "ry", "sa", "se", "si", "so", "su", "sy", "ta", "te", "ti", "to", "tu", "ty", "ua", "ui", "uo", "uo", "uy", "va", "ve", "vi", "vo", "vu", "vy", "wa", "we", "wo", "wi", "wy", "xa", "xe", "xi", "xo", "xu", "xy", "ya", "ye", "yi", "yo", "yu", "za", "ze", "zi", "zo", "zu", "zy", "inc", "oj", "ri", "th", "ni", "",);
			$strBegin2 = array("pli", "la", "sa", "den", "pe", "ra", "ro", "mas", "deo", "nad", "zu", "law", "or", "ix", "lur", "wan", "ger", "mal", "telm", "r", "ng", "tur", "an", "em", "l", "bi", "na", "ki", "ik", "ri", "os", "is", "i", "ep", "ler", "ax", "en", "an", "ek", "kre", "ul", "ae", "ai", "ao", "au", "ay", "ba", "be", "bu", "bi", "by", "ca", "ci", "cu", "cy", "da", "du", "di", "dy", "ea", "ee", "ei", "eo", "eu", "fa", "fe", "fi", "fo", "fu", "fy", "ga", "ge", "gi", "go", "gu", "gy", "ha", "he", "hi", "ho", "hu", "hy", "ia", "ie", "io", "iu", "iy", "ja", "je", "ji", "jo", "ju", "jy", "ka", "ke", "ki", "ko", "ku", "ky", "la", "le", "li", "lo", "lu", "ly", "ma", "me", "mi", "mo", "mu", "my", "na", "ne", "ni", "no", "nu", "ny", "oa", "oe", "oi", "oo", "ou", "oy", "pa", "pe", "pi", "po", "pu", "py", "qa", "qe", "qi", "qo", "qu", "qy", "ra", "re", "ri", "ro", "ru", "ry", "sa", "se", "si", "so", "su", "sy", "ta", "te", "ti", "to", "tu", "ty", "ua", "ui", "uo", "uo", "uy", "va", "ve", "vi", "vo", "vu", "vy", "wa", "we", "wo", "wi", "wy", "xa", "xe", "xi", "xo", "xu", "xy", "ya", "ye", "yi", "yo", "yu", "za", "ze", "zi", "zo", "zu", "zy", "");
			$strBegin = $strBegin1[mt_rand(0,(count($strBegin1)-1))];
			$syll++;
			if((mt_rand(0,5)) == 1){
				$strBegin .= $strBegin2[mt_rand(0,(count($strBegin2)-1))];
				$syll++;
			}
			
			$strStarName = $strBegin;
			
			if($syll < 2 AND (mt_rand(0,10)) == 1){
				$strMiddle1 = array("ik", "ol", "das", "xes", "wol", "ran", "wed", "sol", "zax", "xar", "lod", "pur", "gres", "dem", "hec", "fan", "bor", "klad", "res", "n", "ra", "ru", "ni", "bi", "na", "iker", "ca", "erc", "ki", "ler", "da", "y", "s", "si", "di", "ly",  "ae", "ai", "ao", "au", "ay", "ba", "be", "bu", "bi", "by", "ca", "ci", "cu", "cy", "da", "du", "di", "dy", "ea", "ee", "ei", "eo", "eu", "fa", "fe", "fi", "fo", "fu", "fy", "ga", "ge", "gi", "go", "gu", "gy", "ha", "he", "hi", "ho", "hu", "hy", "ia", "ie", "io", "iu", "iy", "ja", "je", "ji", "jo", "ju", "jy", "ka", "ke", "ki", "ko", "ku", "ky", "la", "le", "li", "lo", "lu", "ly", "ma", "me", "mi", "mo", "mu", "my", "na", "ne", "ni", "no", "nu", "ny", "oa", "oe", "oi", "oo", "ou", "oy", "pa", "pe", "pi", "po", "pu", "py", "qa", "qe", "qi", "qo", "qu", "qy", "ra", "re", "ri", "ro", "ru", "ry", "sa", "se", "si", "so", "su", "sy", "ta", "te", "ti", "to", "tu", "ty", "ua", "ui", "uo", "uo", "uy", "va", "ve", "vi", "vo", "vu", "vy", "wa", "we", "wo", "wi", "wy", "xa", "xe", "xi", "xo", "xu", "xy", "ya", "ye", "yi", "yo", "yu", "za", "ze", "zi", "zo", "zu", "zy", "");
				$strMiddle2 = array("les", "red", "blu", "med", "fer", "bet", "klu", "lux", "ven", "tes", "ori", "veg", "ple", "sad", "olu", "yud", "s", "ru", "bi", "ni", "na", "ke", "pler", "ssi", "ury", "dise", "ler", "da", "y", "ra", "i", "iu", "si", "sis", "ly", "lat", "ae", "ai", "ao", "au", "ay", "ba", "be", "bu", "bi", "by", "ca", "ci", "cu", "cy", "da", "du", "di", "dy", "ea", "ee", "ei", "eo", "eu", "fa", "fe", "fi", "fo", "fu", "fy", "ga", "ge", "gi", "go", "gu", "gy", "ha", "he", "hi", "ho", "hu", "hy", "ia", "ie", "io", "iu", "iy", "ja", "je", "ji", "jo", "ju", "jy", "ka", "ke", "ki", "ko", "ku", "ky", "la", "le", "li", "lo", "lu", "ly", "ma", "me", "mi", "mo", "mu", "my", "na", "ne", "ni", "no", "nu", "ny", "oa", "oe", "oi", "oo", "ou", "oy", "pa", "pe", "pi", "po", "pu", "py", "qa", "qe", "qi", "qo", "qu", "qy", "ra", "re", "ri", "ro", "ru", "ry", "sa", "se", "si", "so", "su", "sy", "ta", "te", "ti", "to", "tu", "ty", "ua", "ui", "uo", "uo", "uy", "va", "ve", "vi", "vo", "vu", "vy", "wa", "we", "wo", "wi", "wy", "xa", "xe", "xi", "xo", "xu", "xy", "ya", "ye", "yi", "yo", "yu", "za", "ze", "zi", "zo", "zu", "zy", "");
				$strMiddle = $strMiddle1[mt_rand(0,(count($strMiddle1)-1))];
				$strMiddle = (mt_rand(0,10) == 1) ? strrev($strMiddle) : $strMiddle;
				$syll++;
				if($syll > 5 AND (mt_rand(0,10)) == 1){
					$strMiddle .= $strMiddle2[mt_rand(0,(count($strMiddle2)-1))];
					$syll++;
				}
				$strStarName .= $strMiddle;
			}
			
			if($syll < 3 OR (mt_rand(0,6)) == 1){
				$strLast1 = array("ia", "pex", "ex", "ler", "ium", "es", "en", "dise", "ost", "en", "am", "ry", "us", "den", "el", "l", "n", "s", "urn", "rth", "ars", "ter", "une", "uto", "ru", "bi", "ni", "na", "ke", "pler", "ik", "euy", "ler", "da", "y", "ra", "ly", "lat", "ae", "ai", "ao", "au", "ay", "ba", "be", "bu", "bi", "by", "ca", "ci", "cu", "cy", "da", "du", "di", "dy", "ea", "ee", "ei", "eo", "eu", "fa", "fe", "fi", "fo", "fu", "fy", "ga", "ge", "gi", "go", "gu", "gy", "ha", "he", "hi", "ho", "hu", "hy", "ia", "ie", "io", "iu", "iy", "ja", "je", "ji", "jo", "ju", "jy", "ka", "ke", "ki", "ko", "ku", "ky", "la", "le", "li", "lo", "lu", "ly", "ma", "me", "mi", "mo", "mu", "my", "na", "ne", "ni", "no", "nu", "ny", "oa", "oe", "oi", "oo", "ou", "oy", "pa", "pe", "pi", "po", "pu", "py", "qa", "qe", "qi", "qo", "qu", "qy", "ra", "re", "ri", "ro", "ru", "ry", "sa", "se", "si", "so", "su", "sy", "ta", "te", "ti", "to", "tu", "ty", "ua", "ui", "uo", "uo", "uy", "va", "ve", "vi", "vo", "vu", "vy", "wa", "we", "wo", "wi", "wy", "xa", "xe", "xi", "xo", "xu", "xy", "ya", "ye", "yi", "yo", "yu", "za", "ze", "zi", "zo", "zu", "zy", "");
				$strLast = $strLast1[mt_rand(0,(count($strLast1)-1))];
				$strStarName .= $strLast;
				$syll++;
			}
			
			if(mt_rand(0,20) == 1){
				$strStarName = strrev($strStarName);
			}
			
			if(mt_rand(0,50) == 1){
				$strStarName = str_shuffle($strStarName);
			}
			
			$strStarName = ucfirst($strStarName);
			
			
			if(is_array($starList) && !in_array($strStarName, $starList)){
				$starList[] = $strStarName;
			}
			
			return $strStarName;
		}
		
		function getGasses(){
			$strGasses = "";
			$gasses[] = "";
			$gasList = array("Oxygen", "Argon", "Methane", "Nitrogen", "Helium", "Water", "Hydrogen", "Carbon Dioxide", "Nitrous Oxide", "Ozone", "Neon");
			foreach($gasList as $gas){
				if(mt_rand(0, 1000) <= 500){
					$gasses[] = $gas;
				}
			}
			unset($gasses[0]);
			$strGasses = implode(", ", $gasses);
			if($strGasses == ""){
				return "None";
			}
			return $strGasses;
		}
		
		function createUniverse($numGalaxies=100){
			for($i = 0; $i < $numGalaxies; $i++){
				$getGalaxyId = sql("SELECT id FROM galaxies ORDER BY id DESC LIMIT 1","Line 175");
				$galaxyId = ($getGalaxyId["id"]+1);
				$galaxyName = getName();
				$galaxyCheck = sql("SELECT id FROM galaxies WHERE name = '".$galaxyName."'","Line 78");
				if($galaxyCheck["id"] == ""){
					createGalaxy($galaxyName, $galaxyId);
				}
			}
		}
		
		function createGalaxy($name, $galaxyId, $numStars=10000){
			for($i=0;$i<$numStars;$i++){
				$getStarId = sql("SELECT id FROM stars ORDER BY id DESC LIMIT 1","Line 88");
				$starId = ($getStarId["id"]+1);
				$starName = getName();
				$starCheck = sql("SELECT id FROM stars WHERE name = '".$starName."'","Line 91");
				if($starCheck["id"] == ""){
					createStar($starName, $galaxyId, $starId);
				}
			}
			query("INSERT INTO galaxies(name,distance_from_center)VALUES('".$name."', '".mt_rand(10, 1000000000)."')","GALAXY");
		}
		
		function createStar($starName, $galaxyId, $starId){
			$strStarName = "<span style='font-weight: strong; font-size: 20px;'>".$starName." System</span>";
			$intStarSize = mt_rand(1989100, 509209600);
			$intExpScale = mt_rand(2, 30);
			$intStarTemp = mt_rand(5778, 400000);
			$boolRand = array(1, 0);
			$hasPlanets = $boolRand[mt_rand(0,1)];
			$numPlanets = mt_rand(0,11);
			$distanceFromCenter = mt_rand(3792548, 62137119);
			$starAge = mt_rand(100, 1000000000);
			
			if($hasPlanets AND $numPlanets > 0){
				for($j=0;$j<$numPlanets;$j++){
					$getPlanetId = sql("SELECT id FROM planets ORDER BY id DESC LIMIT 1","Line 112");
					$planetId = $getPlanetId["id"]+1;
					$planetName = getName();
					$planetCheck = sql("SELECT id FROM planets WHERE name = '".$planetName."'","Line 115");
					if($planetCheck["id"] == ""){
						createPlanet($planetName, $strStarName, ($j+1), (1000000 * ($j+1)), $starId, $planetId);
					}
				}
			}
			
			query("INSERT INTO stars(name, temperature, distance_from_center, mass, mass_scale, age, galaxy_id)VALUES('".$starName."', '".$intStarTemp."', '".$distanceFromCenter."', '".$intStarSize."', '".$intExpScale."', '".$starAge."', '".$galaxyId."')","STAR");
			
			return $strReturn;
		}
		
		function createPlanet($planetName, $star, $tempScale=1, $startingDistance=1000, $starId, $planetId){
			$strPlanetName = "<span style='font-weight: bold; font-size: 16px;'>".$planetName."</span>";
			$strReturn = $strPlanetName;
			$tempScale = ($tempScale == 0) ? 1 : $tempScale;
			$scale = $startingDistance / $tempScale;
			$distanceFromStar = $scale * $tempScale;
			$distanceFromStar = ((mt_rand(929500, 3600000) * mt_rand(1, 1000)) / $tempScale) / 100;
			$planetMass = mt_rand(5, 40000);
			$planetExpScale = mt_rand(2, 30);
			$baseTemp = (($distanceFromStar / mt_rand(2,5)) * $tempScale);
			$intPlanetTempDay = ($baseTemp / (1000 * $tempScale)) / 2;
			$intPlanetTempDay = ((($intPlanetTempDay <= 0) ? 1 : $intPlanetTempDay)) / $tempScale;
			$intPlanetTempNight = (($intPlanetTempDay) / 2.5);
			$intPlanetTempNight = floor(($intPlanetTempNight <= 0) ? ($intPlanetTempNight * -1) : $intPlanetTempNight);
			$intRad = ceil(mt_rand(0, 90));
			$intTox = ceil(mt_rand(0, 90));
			$gasses = getGasses();
			$hasMoons = 0;
			if(mt_rand(0,20) == 1){
				$hasMoons = 1;
				$numMoons = mt_rand(0, 8);
				for($i = 0; $i < $numMoons; $i++){
					$getMoonId = sql("SELECT id FROM moons ORDER BY id DESC LIMIT 1","Line 149");
					$moonId = $getMoonId["id"]+1;
					$moonName = getName();
					$moonCheck = sql("SELECT id FROM moons WHERE name = '".$moonName."'","Line 152");
					if($moonCheck["id"] == ""){
						createMoon($moonName, $strPlanetName,$intPlanetTempDay,$tempScale,$planetId,$moonId);
					}
				}
			}
			
			query("INSERT INTO planets(name, temperature, distance_from_star, mass, mass_scale, gasses, star_id, rad, tox)VALUES('".$planetName."', '".$intPlanetTempDay."', '".$distanceFromStar."', '".$planetMass."', '".$planetExpScale."', '".$gasses."', '".$starId."', '".$intRad."', '".$intTox."')","PLANET");
			return $strReturn;
		}
		
		function createMoon($moonName, $strPlanetName,$planetTemp,$scale,$planetId,$moonId){
			$strMoonName = "<span style='font-weight: bold; font-size: 14px;'>".$moonName."</span>";
			$strReturn = $strMoonName;
			$tempScale = ($tempScale <= 0) ? 1 : $tempScale;
			$moonTempDay = ceil((((($planetTemp) / 2) * 0.5) * mt_rand($tempScale, $tempScale + 4)) / 0.4);
			$moonTempNight = floor(($moonTempDay / (2.5 * $tempScale)) / mt_rand(1, 4));
			$distanceFromPlanet = mt_rand(2388, 10986);
			$moonMass = mt_rand(7, 2000);
			$moonExpScale = mt_rand(2, 10);
			$intRad = ceil(mt_rand(0, 90));
			$intTox = ceil(mt_rand(0, 90));
			$gasses = getGasses();
			
			query("INSERT INTO moons(name, temperature, distance_from_planet, mass, mass_scale, gasses, planet_id, rad, tox)VALUES('".$moonName."', '".$moonTempDay."', '".$distanceFromPlanet."', '".$moonMass."', '".$moonExpScale."', '".$gasses."', '".$planetId."', '".$intRad."', '".$intTox."')","MOON");
		}
?>