<?php 
echo '
		<option value="America/Chicago"'; if($userdata["timezone"] == "America/Chicago") echo ' selected="1"'; echo '>(GMT-06:00) Central Time (US & Canada)</option>
		<option value="America/New_York"'; if($userdata["timezone"] == "America/New_York") echo ' selected="1"'; echo '>(GMT-05:00) Eastern Time (US & Canada)</option>
		<option value="America/Los_Angeles"'; if($userdata["timezone"] == "America/Los_Angeles") echo ' selected="1"'; echo '>(GMT-08:00) Pacific Time (US & Canada)</option>
		<option value="America/Denver"'; if($userdata["timezone"] == "America/Denver") echo ' selected="1"'; echo '>(GMT-07:00) Mountain Time (US & Canada)</option>
		<option value="Pacific/Midway"'; if($userdata["timezone"] == "Pacific/Midway") echo ' selected="1"'; echo '>(GMT-11:00) Midway Island, Samoa</option>
		<option value="America/Adak"'; if($userdata["timezone"] == "America/Adak") echo ' selected="1"'; echo '>(GMT-10:00) Hawaii-Aleutian</option>
		<option value="Etc/GMT+10"'; if($userdata["timezone"] == "Etc/GMT+10") echo ' selected="1"'; echo '>(GMT-10:00) Hawaii</option>
		<option value="Pacific/Marquesas"'; if($userdata["timezone"] == "Pacific/Marquesas") echo ' selected="1"'; echo '>(GMT-09:30) Marquesas Islands</option>
		<option value="Pacific/Gambier"'; if($userdata["timezone"] == "Pacific/Gambier") echo ' selected="1"'; echo '>(GMT-09:00) Gambier Islands</option>
		<option value="America/Anchorage"'; if($userdata["timezone"] == "America/Anchorage") echo ' selected="1"'; echo '>(GMT-09:00) Alaska</option>
		<option value="America/Ensenada"'; if($userdata["timezone"] == "America/Ensenada") echo ' selected="1"'; echo '>(GMT-08:00) Tijuana, Baja California</option>
		<option value="Etc/GMT+8"'; if($userdata["timezone"] == "Etc/GMT+8") echo ' selected="1"'; echo '>(GMT-08:00) Pitcairn Islands</option>
		<option value="America/Chihuahua"'; if($userdata["timezone"] == "America/Chihuahua") echo ' selected="1"'; echo '>(GMT-07:00) Chihuahua</option>
		<option value="America/Dawson_Creek"'; if($userdata["timezone"] == "America/Dawson_Creek") echo ' selected="1"'; echo '>(GMT-07:00) Arizona</option>
		<option value="America/Belize"'; if($userdata["timezone"] == "America/Belize") echo ' selected="1"'; echo '>(GMT-06:00) Saskatchewan</option>
		<option value="America/Cancun"'; if($userdata["timezone"] == "America/Cancun") echo ' selected="1"'; echo '>(GMT-06:00) Guadalajara</option>
		<option value="Chile/EasterIsland"'; if($userdata["timezone"] == "Chile/EasterIsland") echo ' selected="1"'; echo '>(GMT-06:00) Easter Island</option>
		<option value="America/Havana"'; if($userdata["timezone"] == "America/Havana") echo ' selected="1"'; echo '>(GMT-05:00) Cuba</option>
		<option value="America/Bogota"'; if($userdata["timezone"] == "America/Bogota") echo ' selected="1"'; echo '>(GMT-05:00) Bogota</option>
		<option value="America/Caracas"'; if($userdata["timezone"] == "America/Caracas") echo ' selected="1"'; echo '>(GMT-04:30) Caracas</option>
		<option value="America/Santiago"'; if($userdata["timezone"] == "America/Santiago") echo ' selected="1"'; echo '>(GMT-04:00) Santiago</option>
		<option value="America/La_Paz"'; if($userdata["timezone"] == "America/La_Paz") echo ' selected="1"'; echo '>(GMT-04:00) La Paz</option>
		<option value="Atlantic/Stanley"'; if($userdata["timezone"] == "Atlantic/Stanley") echo ' selected="1"'; echo '>(GMT-04:00) Faukland Islands</option>
		<option value="America/Campo_Grande"'; if($userdata["timezone"] == "America/Campo_Grande") echo ' selected="1"'; echo '>(GMT-04:00) Brazil</option>
		<option value="America/Goose_Bay"'; if($userdata["timezone"] == "America/Goose_Bay") echo ' selected="1"'; echo '>(GMT-04:00) Atlantic Time (Goose Bay)</option>
		<option value="America/Glace_Bay"'; if($userdata["timezone"] == "America/Glace_Bay") echo ' selected="1"'; echo '>(GMT-04:00) Atlantic Time (Canada)</option>
		<option value="America/St_Johns"'; if($userdata["timezone"] == "America/St_Johns") echo ' selected="1"'; echo '>(GMT-03:30) Newfoundland</option>
		<option value="America/Araguaina"'; if($userdata["timezone"] == "America/Araguaina") echo ' selected="1"'; echo '>(GMT-03:00) UTC-3</option>
		<option value="America/Montevideo"'; if($userdata["timezone"] == "America/Montevideo") echo ' selected="1"'; echo '>(GMT-03:00) Montevideo</option>
		<option value="America/Miquelon"'; if($userdata["timezone"] == "America/Miquelon") echo ' selected="1"'; echo '>(GMT-03:00) Miquelon</option>
		<option value="America/Godthab"'; if($userdata["timezone"] == "America/Godthab") echo ' selected="1"'; echo '>(GMT-03:00) Greenland</option>
		<option value="America/Argentina/Buenos_Aires"'; if($userdata["timezone"] == "America/Argentina/Buenos_Aires") echo ' selected="1"'; echo '>(GMT-03:00) Buenos Aires</option>
		<option value="America/Sao_Paulo"'; if($userdata["timezone"] == "America/Sao_Paulo") echo ' selected="1"'; echo '>(GMT-03:00) Brasilia</option>
		<option value="America/Noronha"'; if($userdata["timezone"] == "America/Noronha") echo ' selected="1"'; echo '>(GMT-02:00) Mid-Atlantic</option>
		<option value="Atlantic/Cape_Verde"'; if($userdata["timezone"] == "Atlantic/Cape_Verde") echo ' selected="1"'; echo '>(GMT-01:00) Cape Verde Is.</option>
		<option value="Atlantic/Azores"'; if($userdata["timezone"] == "Atlantic/Azores") echo ' selected="1"'; echo '>(GMT-01:00) Azores</option>
		<option value="Europe/Belfast"'; if($userdata["timezone"] == "Europe/Belfast") echo ' selected="1"'; echo '>(GMT) GMT: Belfast</option>
		<option value="Europe/Dublin"'; if($userdata["timezone"] == "Europe/Dublin") echo ' selected="1"'; echo '>(GMT) GMT: Dublin</option>
		<option value="Europe/Lisbon"'; if($userdata["timezone"] == "Europe/Lisbon") echo ' selected="1"'; echo '>(GMT) GMT: Lisbon</option>
		<option value="Europe/London"'; if($userdata["timezone"] == "Europe/London") echo ' selected="1"'; echo '>(GMT) GMT: London</option>
		<option value="Africa/Abidjan"'; if($userdata["timezone"] == "Africa/Abidjan") echo ' selected="1"'; echo '>(GMT) Monrovia</option>
		<option value="Europe/Amsterdam"'; if($userdata["timezone"] == "Europe/Amsterdam") echo ' selected="1"'; echo '>(GMT+01:00) Amsterdam</option>
		<option value="Europe/Belgrade"'; if($userdata["timezone"] == "Europe/Belgrade") echo ' selected="1"'; echo '>(GMT+01:00) Belgrade</option>
		<option value="Europe/Brussels"'; if($userdata["timezone"] == "Europe/Brussels") echo ' selected="1"'; echo '>(GMT+01:00) Brussels</option>
		<option value="Africa/Windhoek"'; if($userdata["timezone"] == "Africa/Windhoek") echo ' selected="1"'; echo '>(GMT+01:00) Windhoek</option>
		<option value="Asia/Beirut"'; if($userdata["timezone"] == "Asia/Beirut") echo ' selected="1"'; echo '>(GMT+02:00) Beirut</option>
		<option value="Africa/Cairo"'; if($userdata["timezone"] == "Africa/Cairo") echo ' selected="1"'; echo '>(GMT+02:00) Cairo</option>
		<option value="Asia/Gaza"'; if($userdata["timezone"] == "Asia/Gaza") echo ' selected="1"'; echo '>(GMT+02:00) Gaza</option>
		<option value="Africa/Blantyre"'; if($userdata["timezone"] == "Africa/Blantyre") echo ' selected="1"'; echo '>(GMT+02:00) Harare</option>
		<option value="Asia/Jerusalem"'; if($userdata["timezone"] == "Asia/Jerusalem") echo ' selected="1"'; echo '>(GMT+02:00) Jerusalem</option>
		<option value="Europe/Minsk"'; if($userdata["timezone"] == "Europe/Minsk") echo ' selected="1"'; echo '>(GMT+02:00) Minsk</option>
		<option value="Asia/Damascus"'; if($userdata["timezone"] == "Asia/Damascus") echo ' selected="1"'; echo '>(GMT+02:00) Syria</option>
		<option value="Europe/Moscow"'; if($userdata["timezone"] == "Europe/Moscow") echo ' selected="1"'; echo '>(GMT+03:00) Moscow</option>
		<option value="Africa/Addis_Ababa"'; if($userdata["timezone"] == "Africa/Addis_Ababa") echo ' selected="1"'; echo '>(GMT+03:00) Nairobi</option>
		<option value="Asia/Tehran"'; if($userdata["timezone"] == "Asia/Tehran") echo ' selected="1"'; echo '>(GMT+03:30) Tehran</option>
		<option value="Asia/Dubai"'; if($userdata["timezone"] == "Asia/Dubai") echo ' selected="1"'; echo '>(GMT+04:00) Abu Dhabi, Muscat</option>
		<option value="Asia/Yerevan"'; if($userdata["timezone"] == "Asia/Yerevan") echo ' selected="1"'; echo '>(GMT+04:00) Yerevan</option>
		<option value="Asia/Kabul"'; if($userdata["timezone"] == "Asia/Kabul") echo ' selected="1"'; echo '>(GMT+04:30) Kabul</option>
		<option value="Asia/Yekaterinburg"'; if($userdata["timezone"] == "Asia/Yekaterinburg") echo ' selected="1"'; echo '>(GMT+05:00) Ekaterinburg</option>
		<option value="Asia/Tashkent"'; if($userdata["timezone"] == "Asia/Tashkent") echo ' selected="1"'; echo '>(GMT+05:00) Tashkent</option>
		<option value="Asia/Kolkata"'; if($userdata["timezone"] == "Asia/Kolkata") echo ' selected="1"'; echo '>(GMT+05:30) Chennai</option>
		<option value="Asia/Katmandu"'; if($userdata["timezone"] == "Asia/Katmandu") echo ' selected="1"'; echo '>(GMT+05:45) Kathmandu</option>
		<option value="Asia/Dhaka"'; if($userdata["timezone"] == "Asia/Dhaka") echo ' selected="1"'; echo '>(GMT+06:00) Astana, Dhaka</option>
		<option value="Asia/Novosibirsk"'; if($userdata["timezone"] == "Asia/Novosibirsk") echo ' selected="1"'; echo '>(GMT+06:00) Novosibirsk</option>
		<option value="Asia/Rangoon"'; if($userdata["timezone"] == "Asia/Rangoon") echo ' selected="1"'; echo '>(GMT+06:30) Yangon (Rangoon)</option>
		<option value="Asia/Bangkok"'; if($userdata["timezone"] == "Asia/Bangkok") echo ' selected="1"'; echo '>(GMT+07:00) Bangkok</option>
		<option value="Asia/Krasnoyarsk"'; if($userdata["timezone"] == "Asia/Krasnoyarsk") echo ' selected="1"'; echo '>(GMT+07:00) Krasnoyarsk</option>
		<option value="Asia/Hong_Kong"'; if($userdata["timezone"] == "Asia/Hong_Kong") echo ' selected="1"'; echo '>(GMT+08:00) Beijing</option>
		<option value="Asia/Irkutsk"'; if($userdata["timezone"] == "Asia/Irkutsk") echo ' selected="1"'; echo '>(GMT+08:00) Irkutsk</option>
		<option value="Australia/Perth"'; if($userdata["timezone"] == "Australia/Perth") echo ' selected="1"'; echo '>(GMT+08:00) Perth</option>
		<option value="Australia/Eucla"'; if($userdata["timezone"] == "Australia/Eucla") echo ' selected="1"'; echo '>(GMT+08:45) Eucla</option>
		<option value="Asia/Tokyo"'; if($userdata["timezone"] == "Asia/Tokyo") echo ' selected="1"'; echo '>(GMT+09:00) Osaka</option>
		<option value="Asia/Seoul"'; if($userdata["timezone"] == "Asia/Seoul") echo ' selected="1"'; echo '>(GMT+09:00) Seoul</option>
		<option value="Asia/Yakutsk"'; if($userdata["timezone"] == "Asia/Yakutsk") echo ' selected="1"'; echo '>(GMT+09:00) Yakutsk</option>
		<option value="Australia/Adelaide"'; if($userdata["timezone"] == "Australia/Adelaide") echo ' selected="1"'; echo '>(GMT+09:30) Adelaide</option>
		<option value="Australia/Darwin"'; if($userdata["timezone"] == "Australia/Darwin") echo ' selected="1"'; echo '>(GMT+09:30) Darwin</option>
		<option value="Australia/Brisbane"'; if($userdata["timezone"] == "Australia/Brisbane") echo ' selected="1"'; echo '>(GMT+10:00) Brisbane</option>
		<option value="Australia/Hobart"'; if($userdata["timezone"] == "Australia/Hobart") echo ' selected="1"'; echo '>(GMT+10:00) Hobart</option>
		<option value="Asia/Vladivostok"'; if($userdata["timezone"] == "Asia/Vladivostok") echo ' selected="1"'; echo '>(GMT+10:00) Vladivostok</option>
		<option value="Australia/Lord_Howe"'; if($userdata["timezone"] == "Australia/Lord_Howe") echo ' selected="1"'; echo '>(GMT+10:30) Lord Howe Island</option>
		<option value="Etc/GMT-11"'; if($userdata["timezone"] == "Etc/GMT-11") echo ' selected="1"'; echo '>(GMT+11:00) Solomon Is.</option>
		<option value="Asia/Magadan"'; if($userdata["timezone"] == "Asia/Magadan") echo ' selected="1"'; echo '>(GMT+11:00) Magadan</option>
		<option value="Pacific/Norfolk"'; if($userdata["timezone"] == "Pacific/Norfolk") echo ' selected="1"'; echo '>(GMT+11:30) Norfolk Island</option>
		<option value="Asia/Anadyr"'; if($userdata["timezone"] == "Asia/Anadyr") echo ' selected="1"'; echo '>(GMT+12:00) Anadyr</option>
		<option value="Pacific/Auckland"'; if($userdata["timezone"] == "Pacific/Auckland") echo ' selected="1"'; echo '>(GMT+12:00) Auckland</option>
		<option value="Etc/GMT-12"'; if($userdata["timezone"] == "Etc/GMT-12") echo ' selected="1"'; echo '>(GMT+12:00) Fiji</option>
		<option value="Pacific/Chatham"'; if($userdata["timezone"] == "Pacific/Chatham") echo ' selected="1"'; echo '>(GMT+12:45) Chatham Islands</option>
		<option value="Pacific/Tongatapu"'; if($userdata["timezone"] == "Pacific/Tongatapu") echo ' selected="1"'; echo '>(GMT+13:00) Nuku\'alofa</option>
		<option value="Pacific/Kiritimati"'; if($userdata["timezone"] == "Pacific/Kiritimati") echo ' selected="1"'; echo '>(GMT+14:00) Kiritimati</option>';
?>