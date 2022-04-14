<?php
error_reporting(0);
/* 
************************
	Name:	    Extensive Server Path (XSP) 1.1.2 (an extension of PHP and XPath)
    Copyright: (C) 2012 - Present
    Programmer: Paul T. Shannon Jr. / Alpha Wolf

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

Beta Version
Configuration settings in xsp.ini
For questions or comments, e-mail admin@dreamspand.com
*************************
*/

class XSP {
	public $itemNum = 0;

	public function Parse($str){
		$memory = "";
		$toggle = 1;
		$breakDown = explode(" ",strtolower($str));
		$ln = (count($breakDown)-1);
		switch(strtolower($breakDown["0"])){
			default:
				$this->xspError($breakDown["0"]." is not a known command.");
			break;
			case 'create':
				$m = "";
				if($breakDown["2"] != "with") $this->xspError("The 'with' construct is missing.");
				if(file_exists($breakDown["1"])) $this->xspError("The file ".$breakDown["1"]." already exists.");
				if(!preg_match("/root\((.+?)\)/i",$breakDown["3"],$m)){
					$this->xspError("root() method not found.");
				}else{
					$f = fopen($breakDown["1"],"w+") OR $this->xspError("Could not create file: ".$breakDown["1"]);
					fwrite($f,"<"."?xml version=\"".$this->getXMLVersion()."\" encoding=\"".$this->getXMLEncoding()."\" ?".">\r\n") OR $this->xspError("Could write to file: ".$breakDown["1"]);
					fwrite($f,"<".$m["1"].">\r\n</".$m["1"].">");
				$memory .= "{created:".$breakDown["1"]."}";
				}
			break;
			case 'delete':
			case 'del':
				$r = str_replace(";","",$breakDown["1"]);
				if(file_exists($r)){
					unlink($r);
				}
				$memory .= "{deleted: ".$breakDown["1"]."}";
			break;
			case 'select':
				$dom = $this->xmlLoad($breakDown["3"]);
				$selectedItem = $this->XQuery($dom,$breakDown["1"]);
				$this->DOMInstance($selectedItem);
				if($breakDown["2"] != "from"){
					$this->xspError("Unable to locate 'from' construct.");
				}
				if($breakDown["4"] == "where"){
					if($breakDown["5"] != ""){
						if(preg_match("/where (.+?) = \"(.+?)\"/",$str,$m)){
							$originalPath = $breakDown["1"];
							$searchPath = $breakDown["5"];
							$valueToCheck = $m["2"];
							$this->XSearchQuery($dom,$originalPath,$searchPath,$this->itemNum,$valueToCheck);
						}else{
							$this->xspError("Unfinished 'where'.");
						}
					}else{
						$this->xspError("Unfinished 'where'.");
					}
				}else{
					$memory .= "{selected:".$selectedItem->nodeValue."}";
					echo $selectedItem->nodeValue;
				}
			break;
			case 'return':
				$dom = $this->xmlLoad($breakDown["3"]);
				$selectedItem = $this->XQuery($dom,$breakDown["1"]);
				$this->DOMInstance($selectedItem);
				if($breakDown["2"] != "from"){
					$this->xspError("Unable to locate 'from' construct.");
				}
				if($breakDown["4"] == "where"){
					if($breakDown["5"] != ""){
						if(preg_match("/where (.+?) = \"(.+?)\"/",$str,$m)){
							$originalPath = $breakDown["1"];
							$searchPath = $breakDown["5"];
							$valueToCheck = $m["2"];
							return $this->XSearchQuery($dom,$originalPath,$searchPath,$this->itemNum,$valueToCheck,"return");
						}else{
							$this->xspError("Unfinished 'where'.");
						}
					}else{
						$this->xspError("Unfinished 'where'.");
					}
				}else{
					$memory .= "{returned:".$selectedItem->nodeValue."}";
					return $selectedItem->nodeValue;
				}
			break;
			case 'returnattr':
				if(!preg_match("/^@/",$breakDown["1"])) $this->xspError("No attribute locator (@) found.");
				if($breakDown["2"] != "from") $this->xspError("Unable to locate 'from' construct.");
				$attr = str_replace("@","",$breakDown["1"]);
				$dom = $this->xmlLoad($breakDown["5"]);
				$XQuery = $this->XQuery($dom,$breakDown["3"]);
				return $XQuery->getAttribute($attr);
			break;
			case 'set':
				if($breakDown["1"] != "var"){
					if($breakDown["1"] == 'attr' OR $breakDown["1"] == 'attribute'){
						$dom = $this->xmlLoad($breakDown[$ln]);
						$XQuery = $this->XQuery($dom,$breakDown[$ln-2]);
						$this->DOMInstance($XQuery);
						if(preg_match("/@(.+?)=\"(.+?)\"/",$str,$m)){
							$XQuery->setAttribute($m["1"],$m["2"]);
							$memory .= "{Attr:[".$m["1"]."=".$m["2"]."]}";
						}
						$this->xmlSave($dom,$breakDown[$ln]);
					}
					}else{
						if(!preg_match("/= \"(.+?)\"/",$str,$m)){
							$this->xspError("Found an invalid variable declaration.");
						}else{
							$bd2 = str_replace("\"","",$breakDown["2"]);
							$dom = $this->xmlLoad("memory.xml");
							$XQuery = $this->LoadMemory();
							if(!preg_match("/var ".$bd2."/i",$XQuery)){
								$memory .= "{var ".$breakDown["2"]."=\"".$m["1"]."\"}";
							}else{
								$this->ReplaceValue("/\{var ".$breakDown["2"]."=\"(.*)\"\}/i","{var ".$breakDown["2"]."=\"".$m["1"]."\"}","memory.xml");
							}
						}
					}
			break;
			case 'echo':
			case 'print':
				if(preg_match("/&|var:/",$breakDown["1"])){
					if($breakDown["1"] == ""){
						$this->xspError("Invalid syntax.");
					}
					$bd = str_replace("&","",$breakDown["1"]);
					$bd = str_replace("var:","",$breakDown["1"]);
					if(preg_match("/var ".$bd."=\"(.+?)\"/i",$this->LoadMemory(),$m)){
						echo $m["1"];
						$memory .= "{Printed:".$m["1"]."}";
					}else{
						echo "undefined (".$bd.")";
					}
				}else{
					$this->xspError("Syntax error.");
				}
			break;
			case 'returnvar':
				if(preg_match("/&|var:/",$breakDown["1"])){
				if($breakDown["1"] == ""){
					$this->xspError("Invalid syntax.");
				}
				$bd = str_replace("&","",$breakDown["1"]);
				$bd = str_replace("var:","",$breakDown["1"]);
				if(preg_match("/var ".$bd."=\"(.+?)\"/i",$this->LoadMemory(),$m)){
					return $m["1"];
					$memory .= "{Returned:".$m["1"]."}";
				}else{
					return "undefined (".$bd.")";
				}
			}else{
				$this->xspError("Syntax error.");
			}
			break;
			case 'append':
				switch($breakDown["1"]){
					case 'element':
						$dom = $this->xmlLoad($breakDown["6"]);
						$XQuery = $this->XQuery($dom,$breakDown["4"]);
						$this->DOMInstance($XQuery);
						$query2 = $this->XQuery($dom,$breakDown["2"]);
							$domElem = $XQuery->appendChild(
									$dom->createElement($breakDown["2"])
								);
						$this->xmlSave($dom,$breakDown["6"]);
						$memory .= "{Appended Element:".$breakDown["2"]." in ".$breakDown["6"]."}";
				break;
				case 'text':
					$dom = $this->xmlLoad($breakDown[$ln]);
					$XQuery = $this->XQuery($dom,$breakDown[$ln-2]);
					$this->DOMInstance($XQuery);
					if(preg_match("/\"(.+?)\"/",$str,$m)){
						if($XQuery->nodeValue != $m["1"]){
							$XQuery->appendChild(
								$dom->createTextNode($m["1"])
							);
						}
					}
					$this->xmlSave($dom,$breakDown[$ln]);
				break;
				}
		break;
			case 'get':
				if($breakDown["1"] == "attribute" OR $breakDown["1"] == "attr"){
					if(!preg_match("/^@/",$breakDown["2"])) $this->xspError("No attribute locator found.");
					if($breakDown["3"] != "from") $this->xspError("No 'from' construct detected.");
					$attr = str_replace("@","",$breakDown["2"]);
					$dom = $this->xmlLoad($breakDown["6"]);
					$XQuery = $this->XQuery($dom,$breakDown["4"]);
					echo $XQuery->getAttribute($attr);
				}else{
					$this->xspError("No 'attr' or 'attribute' construct found.");
				}
		break;
			case 'if':
				if(preg_match("/\(var:(.+?)=(.+?)\)/i",$breakDown["1"],$m)){
					if(preg_match("/var ".$m["1"]."=\"(.+?)\"/i",$this->LoadMemory(),$n)){
						if($breakDown["2"] != "then") $this->xspError("The 'then' construct is missing.");
						if(strtolower($m["2"]) == strtolower($n["1"])){
							if(preg_match("/<(.+?)>/",$str,$o)){
								$this->Parse($o["1"]);
							}else{
								$this->xspError("Could not locate expression to evaluate.");
							}
						}else{
								if(preg_match("/else <(.+?)>/i",$str,$p)){
									$this->Parse($p["1"]);
								}
						}
					}
				}else if(preg_match("/exists\((.+?)\)/i",$breakDown["1"],$f)){
					if(preg_match("/then/i",$breakDown["2"])){
						if(preg_match("/<(.+?)>/",$str,$p)){
							if(file_exists($f["1"])){
								$this->Parse($p["1"]);
							}else{
								if(preg_match("/else <(.+?)>/i",$str,$p)){
									$this->Parse($p["1"]);
								}
							}
						}else{
							$this->xspError("Unfinished expression.");
						}
					}else{
						$this->xspError("The 'then' construct is missing.");
					}
				}
			break;
			case 'parse':
				if(preg_match("/(.+?)\.xsp/i",$breakDown["1"],$f)){
					$this->xsp_file($f["0"]);
				}else{
					$this->xspError("Syntax in file parse.");
				}
			break;
			case 'clear()':
			case 'clearmem()':
				$this->clearMemory();
			break;
			case 'clearerr()':
				$this->clearErrors();
			break;
			case 'clearall()':
				$this->clearMemory();
				$this->clearErrors();
			break;
			case 'say':
			case 'out':
				if(preg_match("/ \"(.+)\"/i",$str,$m)){
					$x = explode(" & ",$m["1"]);
					$i=0;
					while($i < count($x)){
						echo $x[$i];
						$i++;
					}
				}
				if(preg_match("/ var:(.+)/i",$str,$m)){
					$x = explode(" & ",$m["1"]);
					$i=0;
					while($i < count($x)){
						$this->Parse("print var:".$x[$i]);
						$i++;
					}
				}
			break;
			case '++':
			case 'increase':
			case 'increment':
				$variable = str_replace("}","",$breakDown["1"]);
				if(preg_match("/\{var ".$variable."=\"(.+?)\"\}/i",$this->LoadMemory(),$m)){
					if($breakDown["2"] != "by")
						$this->xspError("Parse error, 'by' construct is missing.");
					$newInt = $m["1"]+=$breakDown["3"];
					$this->ReplaceValue("/\{var ".$variable."=\"(.+?)\"\}/i","{var ".$variable."=\"".$newInt."\"}","memory.xml");
				}
			break;
			case '--':
			case 'decrease':
			case 'decrement':
				$variable = str_replace("}","",$breakDown["1"]);
				if(preg_match("/\{var ".$variable."=\"(.+?)\"\}/i",$this->LoadMemory(),$m)){
					if($breakDown["2"] != "by")
						$this->xspError("Parse error, expected 'by'.");
					$newInt = $m["1"]-=$breakDown["3"];
					$this->ReplaceValue("/\{var ".$variable."=\"(.+?)\"\}/i","{var ".$variable."=\"".$newInt."\"}","memory.xml");
				}
			break;
			case 'update':
			case 'change':
				$dom = $this->xmlLoad($breakDown[$ln]);
				$XQuery = $this->XQuery($dom,$breakDown["3"]);
				if(strtolower($breakDown["1"]) != "nodevalue" OR strtolower($breakDown["2"]) != "of" OR !$XQuery instanceof DOMNode OR $breakDown["4"] != "to" OR $breakDown[$ln-1] != "in") 
					$this->xspError("Syntax error, one or more necessary constructs are missing.");
					if(preg_match("/\"(.+)\"/i",$str,$m)){
						$this->ReplaceValue("/".$XQuery->nodeValue."/i",$m["1"],$breakDown[$ln]);
					}
			break;
			case 'new':
				if($breakDown["1"] != "class"){
					$this->xspError("Unrecognized instance: ".$breakDown["1"]);
				} else {
					if($breakDown["2"] == "")
						$this->xspError("Missing class name definition..");
					else {
						if(!is_dir("classes")){
							mkdir("classes");
						}
						$xspClassName = strtolower($breakDown["2"]);
						$xslStyle = '<?xml version="'.$this->getXMLVersion().'" encoding="'.$this->getXMLEncoding().'"?>
					  		<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
 							 <xsl:template match="class">
   							  <html>
     								 <head>
										<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        								<title>
        								  Class <xsl:value-of select="@name"/>
        								</title>
     								 </head>
      								 <body>
     								 	<b>Class: </b>
        								 <xsl:value-of select="@name"/>
        								 <br/>
       									 <b>Modifier: </b>
        								 <xsl:value-of select="@mod"/>
        								 <br/>
        								 <b>Members:</b><br/>
                         							<xsl:for-each select="member">
                          								<xsl:value-of select="."/>
                        							</xsl:for-each>
       									 <br/>
        								 <b>Variables:</b>
     								</body>
   							  </html>
  							 </xsl:template>
 						    </xsl:stylesheet>';
						if(!file_exists("classes/xsl_style.xsl")){
 						$xslF = fopen("classes/xsl_style.xsl","w+");
 						fwrite($xslF, $xslStyle);
 					}
					$this->MemoryAllocate("{Class: classes.".$xspClassName."}");
					$f = fopen("classes/".$xspClassName.".xml","w+");
					fwrite($f, '<?xml version="'.$this->getXMLVersion().'" encoding="'.$this->getXMLEncoding().'"?>
					            <?xml-stylesheet type="text/xsl" href="xsl_style.xsl" ?>
					            <class mod="Public" name="'.$xspClassName.'">
					            </class>');
					}
				}
			break;
			case 'class':
				if(!file_exists("classes/".$breakDown["1"].".xml")) 
					$this->xspError("This class does not exist, please define it first.");
					switch($breakDown["2"]){
						default:
							$this->xspError($breakDown["2"]. " is not a recognized command.");
						break;
						case 'add':
							if($breakDown["3"] == "member" || $breakDown["3"] == "mb"){
								$newMember = strtolower($breakDown["3"]);
								$this->Parse("append element member to //class in classes\/".$breakDown["1"].".xml");
								$this->Parse("append element ".strtolower($breakDown["4"])." to //member[last()] in classes\/".$breakDown["1"].".xml");
								$this->Parse("append text \"".strtolower($breakDown["4"])."\" to //".strtolower($breakDown["4"])." in classes\/".$breakDown["1"].".xml");
							}else if($breakDown["3"] == "var" || $breakDown["3"] == "variable"){
								echo "Unimplemented..";
							}else{
								echo $breakDown["3"]. " is not a child command of class.add.";
							}
						break;
					case 'delete':
						if($breakDown["2"] == "all"){
							$this->Parse("delete classes\/".strtolower($breakDown["1"]).".xml");
						}
					break;
					}
			break;
			case 'for':
				$testVar = $breakDown["1"];
				if(preg_match("/\{var ".$testVar."=\"(.+?)\"\}/",$this->LoadMemory(),$m)){
					if($breakDown["2"] != "to")
						$this->xspError("Syntax error, missing 'to' constructor.");
					if(preg_match("/\{(.+?)\}/",$str,$n)){
						$i = $m["1"];
						while($i < $breakDown["3"]){
							$cmd = str_replace("{","",$n["1"]);
							$cmd = str_replace("}","",$cmd);
							$this->Parse($cmd);
							$this->Parse("increase ".$testVar." by 1");
							$i++;
						}
						$this->Parse("set var ".$testVar." = \"".$m["1"]."\"");
					}else{
						$this->xspError("Parsable variable code not detected.");
					}
				}else{
					$this->xspError("This variable does not exist, please define it first.");
				}
			break;
			case 'mod':
			case 'module':
				switch($breakDown["1"]){
					default:
						$this->xspError($breakDown["1"]. " is not a recognized subcommand of ".$breakDown["0"]);
					break;
					case 'define':
						$modName = $breakDown["2"];
						if(!preg_match("/\{mod:".$modName.".xsp\}/",$this->LoadMemory(),$m)){
							if($breakDown["3"] == ":"){
								if(preg_match("/\{(.+?)\}/",$str,$n)){
									$nVar = str_replace(",",";\r\n",$n["1"]);
									$f = fopen($modName.".xsp", "w+");
									fwrite($f, "#!xsp-module;\r\n");
									fwrite($f, $nVar);
									$memory .= "{mod:".$modName.".xsp}";
								}else{
									$this->xspError("Syntax in module definition.");
								}
							}else{
								$this->xspError("':' operator missing from module definition.");
							}
						}else{
							$this->xspError("Module '".$modName."' already exists.");
						}
					break;
					case 'call':
						if($breakDown["2"] == ":"){
							if(preg_match("/(.+?)\(\)/",$breakDown["3"],$m)){
								$modName = $m["1"];
								if(preg_match("/\{mod:".$modName.".xsp\}/",$this->LoadMemory(),$n) OR file_exists($modName.".xsp")){
									$this->xsp_file($modName.".xsp","xsp-module");
									$memory .= "{Called: ".$modName."()}";
								}else{
									$this->xspError("'".$modName."' module is not defined.");
								}
							}else{
								$this->xspError("Syntax error in module call.");
							}
						}else{
								$this->xspError("':' operator missing from module call.");
						}
					break;
					case 'remove':
						if($breakDown["2"] != ":"){
							$this->xspError("':' operator missing from module removal.");
						}else{
							if(preg_match("/(.+?)\(\)/",$breakDown["3"],$m)){
								$modName = $m["1"];
								if(preg_match("/(\{mod:".$modName.".xsp\})/",$this->LoadMemory(),$n) OR file_exists($modName.".xsp")){
									if(file_exists($modName.".xsp")){
										unlink($modName.".xsp");
										file_put_contents("memory.xml",preg_replace("/\{mod:".$modName.".xsp\}/","",file_get_contents("memory.xml")));
									}else{
										$this->xspError($modName.".xsp does not exist.");
									}
								}else{
									$this->xspError("This module is not recognized.");
								}
							}else{
								$this->xspError("Syntax in mod name.");
							}
						}
					break;
				}
			break;
			case 'drop':
				$dom = $this->xmlLoad($breakDown[$ln]);
				$selectedItem = $this->XQuery($dom,$breakDown["1"]);
				$this->DOMInstance($selectedItem);
				if($breakDown["2"] == "from"){
					$this->deleteNode($selectedItem);
					$this->xmlSave($dom,$breakDown[$ln]);
				}else{
					$this->xspError("Unable to locate 'from' construct.");
				}
			break;
			case 'move':
				$dom1 = $this->xmlLoad($breakDown["3"]);
				$selectedItem1 = $this->XQuery($dom1,$breakDown["1"]);
				$this->DOMInstance($selectedItem1);
				if($breakDown["2"] == "from"){
					$data = $this->Parse("return ".$breakDown["1"]." from ".$breakDown["3"]);
					$this->Parse("change nodevalue of ".$breakDown["1"]." to \" \" in ".$breakDown["3"]);
					if($breakDown["4"] == "to"){
						$dom2 = $this->xmlLoad($breakDown[$ln]);
						$selectedItem2 = $this->XQuery($dom2,$breakDown["5"]);
						$this->DOMInstance($selectedItem2);
						if($breakDown["6"] == "in"){
							$this->Parse("append text \"".$data."\" to ".$breakDown["5"]." in ".$breakDown[$ln]);
						}else{
							$this->xspError("No 'in' construct detected.");
						}
					}else{
						$this->xspError("Could not locate 'to' construct.");
					}
				}else{
					$this->xspError("Unable to locate 'from' construct.");
				}
			break;
			case 'copy':
				$dom1 = $this->xmlLoad($breakDown["3"]);
				$selectedItem1 = $this->XQuery($dom1,$breakDown["1"]);
				$this->DOMInstance($selectedItem1);
				if($breakDown["2"] == "from"){
					$data = $this->Parse("return ".$breakDown["1"]." from ".$breakDown["3"]);
					if($breakDown["4"] == "to"){
						$dom2 = $this->xmlLoad($breakDown[$ln]);
						$selectedItem2 = $this->XQuery($dom2,$breakDown["5"]);
						$this->DOMInstance($selectedItem2);
						if($breakDown["6"] == "in"){
							$this->Parse("append text \"".$data."\" to ".$breakDown["5"]." in ".$breakDown[$ln]);
						}else{
							$this->xspError("No 'in' construct detected.");
						}
					}else{
						$this->xspError("Could not locate 'to' construct.");
					}
				}else{
					$this->xspError("Unable to locate 'from' construct.");
				}
			break;
			case 'dir':
			case 'directory':
				switch($breakDown["1"]){
					default:
						$this->xspError($breakDown["1"]." is not a recognized subcommand of ".$breakDown["0"].".");
					break;
					case 'mk':
					case 'make':
						if($breakDown["2"] != ""){
							mkdir($breakDown["2"]);
							$memory .= "{CreatedDirectory:".$breakDown["1"]."}";
						}else{
							$this->xspError("No valid directory specified.");
						}
					break;
					case 'rm':
					case 'remove':
					case 'del':
					case 'delete':
						if($breakDown["2"] != ""){
							if(!rmdir($breakDown["2"])){
								$this->xspError("Specified directory is not empty.");
							}
							$memory .= "{RemovedDirectory:".$breakDown["2"]."}";
						}else{
							$this->xspError("No valid directory specified.");
						}
					break;
					case 'rn':
					case 'rename':
						if($breakDown["2"] != "" AND is_dir($breakDown["2"])){
							$oldDir = $breakDown["2"];
							if($breakDown["3"] == "to"){
								$newDir = $breakDown["4"];
								rename($oldDir, $newDir);
								$memory .= "{RenamedDirectory:".$oldDir." to ".$newDir."}";
							}else{
								$this->xspError("Unable to locate 'to' construct.");
							}
						}else{
							$this->xspError("No valid directory specified.");
						}
					break;
				}
			break;
			case 'rename':
				if($breakDown["1"] != "" AND file_exists($breakDown["1"])){
					if($breakDown["2"] == "to"){
						$newName = $breakDown["3"];
						$oldName = $breakDown["1"];
						rename($oldName, $newName);
						$memory .= "{RenamedFile:".$oldName." to ".$newName."}";
					}else{
						$this->xspError("Unable to locate 'to' construct.");
					}
				}else{
					$this->xspError("No valid file specified.");
				}
			break;
			case 'variable':
			case 'var':
				$this->varCheck();
				switch($breakDown["1"]){
					default:
						$this->xspError("Unknown command.");
					break;
					case 'set':
					case 'define':
						if($breakDown["3"] == "="){
							if($breakDown["2"] != ""){
								if($breakDown["4"] != ""){
									if(preg_match("/var(iable)? set (.+?) = \"(.+?)\"/i",$str,$m)){
										$this->Parse("append element variable to /vars in bin/variables.xml");
											$this->Parse("set attr @name=\"".$m["2"]."\" to //variable[last()] in bin/variables.xml");
											$this->Parse("append text \"".$m["3"]."\" to //variable[last()] in bin/variables.xml");
									}else if (preg_match("/var(iable)? set (.+?) = eval\((.+?)\)/",$str,$n)){
											$this->Parse("append element variable to /vars in bin/variables.xml");
												$this->Parse("set attr @name=\"".$n["2"]."\" to //variable[last()] in bin/variables.xml");
												$repVar = $this->Parse($n["3"]);
												$newVal = preg_replace("/eval\((.+?)\)/",$repVar,$str);
												$this->Parse("append text \"".$repVar."\" to //variable[last()] in bin/variables.xml");
									}else{
										$this->xspError("Syntax.");
									}
								}else{    
									$this->xspError("Variable value was empty.");
								}
							}else{
								$this->xspError("Variable name was blank.");
							}
						}else{
							$this->xspError("Unknown symbol '".$breakDown["3"]."' expected '='.");
						}
					break;
					case 'get':
						$varGet = $breakDown["2"];
						if($varGet != ""){
							$returnedVar = $this->Parse("return //variable from bin/variables.xml where //variable/@name = \"".$varGet."\"");
							echo $returnedVar;
						}else{
							$this->xspError("Variable name cannot be empty.");
						}
					break;
					case 'return':
						$varGet = $breakDown["2"];
						if($varGet != ""){
							$returnedVar = $this->Parse("return //variable from bin/variables.xml where //variable/@name = \"".$varGet."\"");
							return $returnedVar;
						}else{
							$this->xspError("Variable name cannot be empty.");
						}
					break;
				}
			break;
			case 'help':
				$f = file_get_contents("Documentation.txt");
				echo nl2br($f);
			break;
			case '#':
				//Allows comments..
			case '':
				//Ignores empty XSP commands..
			break;
		}
		if($toggle) $this->MemoryAllocate($memory);
		if(preg_match("/;/",$str)){
			$statements = explode("; ",$str);
			$i=0;
			while($i<count($statements)){
				$this->Parse($statements[$i]);
				$i++;
			}
		}
	}

	public function xspError($message){
		if($this->XMLErrorLoggingEnabled()){
			if(!file_exists($this->XMLErrorLogName())){
				$f = fopen($this->XMLErrorLogName(),"a+") OR exit("Could not create error log.");
				fwrite($f,'<'.'?xml version="'.$this->getXMLVersion().'" encoding="'.$this->getXMLEncoding().'" ?'.'>
					<logs>
					</logs>');
			}
			$this->Parse("append element error to //logs in ".$this->XMLErrorLogName());
			$this->Parse("append text \"".$message."\" to //error[last()] in ".$this->XMLErrorLogName());
		}
		exit("<strong>Error:</strong> ".$message);
	}

	public function varCheck(){
		if(!is_dir("bin")){
			$this->Parse("dir mk bin");
		}
		if(!file_exists("bin/variables.xml")){
			error_reporting(0);
			$this->Parse("create bin/variables.xml with root(vars)");
			$memory .= "{Created variables.xml}";
		}
	}

	public function DOMInstance($domInst){
		if(!$domInst instanceof DOMNode)
			$this->xspError("Could not locate DOM Node instance requested.");
	}

	public function ReplaceValue($oldPattern,$newPattern,$file){
		$f = file_get_contents($file);
		$x = preg_replace($oldPattern,$newPattern,$f);
		file_put_contents($file,$x);
	}

	public function MemoryAllocate($str){
		if(!file_exists("memory.xml")){
			$this->Parse("create memory.xml with root(memory)");
		}
		$dom = $this->xmlLoad("memory.xml");
		$memoryNode = $this->XQuery($dom,"/memory");
		$this->DOMInstance($memoryNode);
		if(!preg_match("/".$str."/i",$memoryNode->nodeValue)){
			$memoryNode->appendChild(
				$dom->createTextNode($str)
			);
		}
		$this->xmlSave($dom,"memory.xml");
	}

	public function LoadMemory(){
		return $this->XQuery($this->xmlLoad("memory.xml"),"/memory")->nodeValue;
	}

	public function XQuery($dom,$str,$in=0){
		if($in >= $this->getXMLMaxSearch()){
			$this->xspError("Max search query limit reached.");
		}
		$XPath = new DOMXPath($dom);
		return ($XPath->query($str)->item($in));
	}

	public function XSearchQuery($dom,$xpath1,$xpath5,$in=0,$testVal,$mode="select"){
		$result = $this->XQuery($dom,$xpath5,$in);
		$this->DOMInstance($result);
		$fv = $result->nodeValue;
		if($fv == $testVal){
			$selectedItem2 = $this->XQuery($dom,$xpath1,$in);
			if($mode == "select"){
				echo $selectedItem2->nodeValue;
				$memory .= "{Selected:".$selectedItem2->nodeValue."}";
			}else{    
				return $selectedItem2->nodeValue;
				$memory .= "{Returned:".$selectedItem2->nodeValue."}";
			}
			$this->itemNum = 0;
			$in = 0;
		}else{
			$in++;
			if($in < $this->getXMLMaxSearch()){
				$this->XSearchQuery($dom,$xpath1,$xpath5,$in,$testVal);
			}else{
				$this->itemNum = 0;
				$in = 0;
				$this->xspError("Max search limit reached. Search string not found.");
			}
		}
	}

	public function xmlLoad($file){
		if($this->itemNum >= $this->getXMLMaxSearch()){
			$this->xspError("Max search query limit reached.");
		}
		$dom = new DOMDocument();
		$dom->formatOutput = true;
		$dom->preserveWhiteSpace = false;
		$f = str_replace(";","",$file);
		$dom->load($f);
		return $dom;
	}

	public function xmlSave($dom,$file){
		$dom->normalizeDocument();
		$dom->save($file);
	}

	public function xsp_file($f1,$file_type="xsp"){
		$x = file_get_contents($f1);
		$x = preg_replace("/\r|\n|\t/","",$x);
		$xp = explode(";",$x);
		$ind = 0;
		if($file_type == "xsp"){
			foreach($xp as $command){
				if($ind == 0){
					if($command !== "#!xsp"){
						$this->xspError("File declaration not found.");
					}
				}
				$ind++;
				if(substr($command, 0, 1) == "#") continue;
				$this->Parse($command);
			}
		}else if($file_type == "xsp-module"){
			foreach($xp as $command){
				if($ind == 0){
					if($command !== "#!xsp-module"){
						$this->xspError("Module declaration not found.");
					}
				}
				$ind++;
				if(substr($command, 0, 1) == "#") continue;
				$this->Parse($command);
			}
		}
	}

	/*
	* Following two public functions credited to 
	* Justin Sheckler of php.net.
	*/

	public function deleteNode($node) {
		$this->deleteChildren($node);
		$parent = $node->parentNode;
		$oldnode = $parent->removeChild($node);
	}

	public function deleteChildren($node) {
		while (isset($node->firstChild)) {
			$this->deleteChildren($node->firstChild);
			$node->removeChild($node->firstChild);
		}
	}

	public function getXMLEncoding(){
		$iniFile = parse_ini_file("xsp.ini");
		return $iniFile["xml_encoding"];
	}

	public function getXMLVersion(){
		$iniFile = parse_ini_file("xsp.ini");
		return $iniFile["xml_version"];
	}

	public function XMLErrorLoggingEnabled(){
		$iniFile = parse_ini_file("xsp.ini");
		return $iniFile["enable_logging"];
	}

	public function getXMLMaxSearch(){
		$iniFile = parse_ini_file("xsp.ini");
		return $iniFile["max_search"];
	}

	public function XMLErrorLogName(){
		$iniFile = parse_ini_file("xsp.ini");
		return $iniFile["log_name"];
	}

	public function clearMemory(){
		$f = fopen("memory.xml","w+");
		fwrite($f,'<'.'?xml version="'.$this->getXMLVersion().'" encoding="'.$this->getXMLEncoding().'"?'.'>
				<memory></memory>');
	}

	public function clearErrors(){
			$f = fopen($this->XMLErrorLogName(),"w+");
			fwrite($f,'<'.'?xml version="'.$this->getXMLVersion().'" encoding="'.$this->getXMLEncoding().'"?'.'>
				<logs></logs>');
	}
}
?>