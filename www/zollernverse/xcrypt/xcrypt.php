<?php
	class XCrypt {
		public $letters = array("a","?","b","!","c","@","d","$","e","#","f","g","%","h","&","i","=","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
		public $alphas = array("a","b","c","d","e","f","g","h","i","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
		public $symbols = array("!","@","#","$","%","&",":",";",".","=","?","-");
		public $numbers = array(1,2,3,4,5,6,7,8,9,0);
		public $genPass = "";
		
		public function encrypt($str){
			$hexStr = bin2hex($str);
			$lnStr = $this->ltrnmbr($hexStr);
			$rvStr = strrev($lnStr);
			$lnStr2 = $this->ltrnmbr($rvStr);
			$cx = $this->cx($lnStr2);
			return $cx;
		}
		
		public function xcrypt($str=""){
			$c = $str;
			$c = crypt($str,substr($str,0,(strlen($str)-5)));
			$c = md5($c);
			$c = base64_encode($c);
			$c = $this->encrypt($c);
			return $c;
		}
		
		public function ltrnmbr($str){
			$split = str_split($str,1);
			$i = 0;
			$r = "";
			$y = 0;
			$f = 1;
			$cs = count($split);
			while($i < $cs){
				$x = $split[$i];
				$lx = $this->letters[$x];
				if($y == 0){
					if($f == 1){
						$lx = strtoupper($lx);
						$f = 0;
					}else{
						$lx = strtolower($lx);
						$f = 1;
					}
					$ng .= $lx;
					$y = 1;
				}else{
					$ng .= bin2hex($lx);
					$y = 0;
				}
				$i++;
			}
			return $ng;
		}
		
		public function cx($str){
			$split = str_split($str,1);
			$i = 0;
			$r = substr($str,0,0);
			$f = 0;
			$g = 0;
			$y = 0;
			$cs = count($split);
			while($i <= $cs){
				$f = ($f == 1) ? 0 : 1;
				$g = ($g == 0) ? 1 : 0;
				$y += 5;
				$s = $split[$i];
				$w = ($y/5);
				if($y >= 5){
					$rm = ($y % 5);
					if($rm == 0){
						$r .= strtoupper($this->letters[($w-1)]);
					}
				}
				$t = bin2hex($s);
				if($f == 1){
					$b = $this->letters[$t];
					$r .= $b;
					if($g == 0){
						$r = strtolower($r);
						$g = 1;
					}else{
						$b = strtoupper($r);
						$g = 0;
					}
					$f = 0;
				}else{
					$r .= strtoupper($t);
					$f = 1;
				}
				if(($i % 2) == 0){
					$r .= strtoupper($t);
				}
				$i++;
			}
			$r .= strtolower(substr($r,4,(strlen($r)/2)));
			$r .= strtolower(substr($r,8,(strlen($r)/2)));
			$r = strrev($r);
			$r = (strlen($r) > 20) ? substr($r,10,20) : $r;
			return ucfirst($r);
		}
		
		public function generatePassword($strBase="xcryptpw",$boolSymbols=false,$intLength=20,$useFirst=true,$numFirst=2){
			$split = str_split($strBase,1);
			if($useFirst){
				$b = 0;
				while($b < $numFirst){
					$r .= $split[$b];
					$b++;
				}
			}else{
				$r .= $this->alphas[mt_rand(0,25)];
			}
			$i = 0;
			$ns = 0;
			while(mb_strlen($r) < $intLength){
				$spl = mt_rand(0,count($split)+1);
				$g = mt_rand(0,1);
				if($i == 5){
					$r .= strlen($r);
				}
				$mt = mt_rand(0,1);
				$r .= ($split[$spl] != "") ? $split[$spl] : $this->alphas[mt_rand(0,25)];
				$ind2 = mt_rand(0,25);
				$r .= ($g == 0) ? strtolower($this->alphas[$ind2]) : strtoupper($this->alphas[$ind2]);
				if($boolSymbols != false){
					$numSymb = count($this->symbols);
					$ind = mt_rand(0,$numSymb);
					$sym = $this->symbols[$ind];
					if($sym != "" AND $ns < mt_rand(2,6)){
						$r .= $sym;
						$ns++;
					}else{
						$r .= $this->numbers[mt_rand(0,9)];
					}
				}
				$r .= $this->numbers[mt_rand(0,9)];
				$i++;
			}
			if(mb_strlen($r) < $intLength){
				if($boolSymbols != false){
					$r .= $this->letters[mt_rand(0,(count($letters)))];
				}else{
					if(mt_rand(0,10) <= 5){
						$r .= $this->alphas[mt_rand(0,25)];
					} else {
						$r .= $this->numbers[mt_rand(0,9)];
					}
				}
			} else if(mb_strlen($r) > $intLength){
					$r = substr($r,0,$intLength);
				}
			$this->genPass = $r;
			return ucfirst($r);
		}
	}
?>