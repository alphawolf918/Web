DROP TABLE `affiliates`;

CREATE TABLE `affiliates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `url` text NOT NULL,
  `description` text NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `banner` varchar(500) NOT NULL,
  `hits_in` int(11) NOT NULL,
  `hits_out` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `affiliates` VALUES("1","Chao Talk","http://chaobreederxl2.proboards.com/","A friendly forum centered around chao, where you\'re not just a member, you\'re a friend.","2012-10-16 11:48:59","http://www.zollernverse.org/chaotalk/millennium/ctbutton.png","85","2974");



DROP TABLE `avatars`;

CREATE TABLE `avatars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `bank_accounts`;

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `balance` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_accessed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `withdrawals` int(11) NOT NULL,
  `deposits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `bank_accounts` VALUES("1","1","15.320681994258","2013-08-15 16:02:14","2014-08-04 20:44:16","10","4");
INSERT INTO `bank_accounts` VALUES("2","5","1703.4","2013-08-15 21:51:05","2014-02-03 18:55:45","0","4");
INSERT INTO `bank_accounts` VALUES("3","2","1700","2013-08-17 14:55:21","2014-03-13 19:38:13","0","3");
INSERT INTO `bank_accounts` VALUES("4","55","6100","2013-08-23 12:57:20","2013-10-18 12:57:01","0","11");
INSERT INTO `bank_accounts` VALUES("5","59","1603.4","2013-09-08 12:52:47","2014-11-18 16:06:25","3","0");
INSERT INTO `bank_accounts` VALUES("6","64","15","2014-11-09 09:52:28","2014-11-17 22:27:42","0","2");



DROP TABLE `banned`;

CREATE TABLE `banned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `ips` text NOT NULL,
  `names` text NOT NULL,
  `hostname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=252 DEFAULT CHARSET=latin1;

INSERT INTO `banned` VALUES("25","1111111","150.70.172.109","JAPAN150","wtp-gd-maya9.iad1");
INSERT INTO `banned` VALUES("27","33","31.181.23.255","grehybeascara","");
INSERT INTO `banned` VALUES("28","11111","213.186.119.141","rootnet","213.186.119.141.utel.net.ua");
INSERT INTO `banned` VALUES("29","38","142.4.117.129","taumdusuall","");
INSERT INTO `banned` VALUES("58","12345678","166.147.120.158","gamedezyner","");
INSERT INTO `banned` VALUES("57","11111111","71.101.94.16","gamedezyner","");
INSERT INTO `banned` VALUES("59","12345678","173.171.43.217","gamedezyner","");
INSERT INTO `banned` VALUES("60","12345678","24.129.141.50","gamedezyner","");
INSERT INTO `banned` VALUES("251","8924769","159.224.160.164","triolan.net","164.160.224.159.triolan.net");



DROP TABLE `beacons`;

CREATE TABLE `beacons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;




DROP TABLE `boards`;

CREATE TABLE `boards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `about` text NOT NULL,
  `last_id` int(11) NOT NULL,
  `staff` tinyint(1) NOT NULL,
  `ctg_id` int(11) NOT NULL,
  `readby` text NOT NULL,
  `banned` text NOT NULL,
  `whopost` enum('everyone','staff') NOT NULL DEFAULT 'everyone',
  `subboard` int(11) NOT NULL DEFAULT '0',
  `watchers` text NOT NULL,
  `moderators` text NOT NULL,
  `p_req` int(11) NOT NULL DEFAULT '0',
  `post_en` tinyint(1) NOT NULL DEFAULT '1',
  `order_by` text NOT NULL,
  `header` text NOT NULL,
  `footer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

INSERT INTO `boards` VALUES("96","Conference Room","This is the area where only staff can see the topics.","0","1","22","","","staff","0","","","0","0","last_updated DESC","","");
INSERT INTO `boards` VALUES("97","Minecraft","All things Minecraft, baby.","0","0","19","","","everyone","0","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("95","Programming and Development","If you\'re a coder or a developer of any kind, this is your place to be.","0","0","21","","","everyone","0","","admin","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("94","IT Center","For anything about computers and information technology related.","0","0","21","","","everyone","0","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("93","Dreamer Chao","Discuss and get help for the web site\'s virtual chao-raising system found [url=chao.php]here[/url].","0","0","19","","","everyone","78","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("92","Help Desk","Looking for support, questions, suggestions, complaints or comments about the site? Put \'em in here.","0","0","18","","","everyone","0","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("102","Comicbook Central","If you\'re the type of person that enjoys comics, come in here.","0","0","25","","","everyone","99","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("28","News Center","News and updates get posted here.","0","0","18","","","staff","0","","","0","0","last_updated DESC","","");
INSERT INTO `boards` VALUES("101","RPG Segment","Into roleplaying? Start something up here, just keep it PG-13.","0","0","25","","","everyone","98","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("100","General Media","If you wanna share or talk about something media-related, and can\'t find the board for it, put it here.","0","0","25","","","everyone","0","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("98","Writing Block","Into writing? Give us a peek into your imagination here.","0","0","25","","","everyone","0","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("99","The Gallery","Show us your art skills: paint, draw, scribble, ink, or sketch your way to success, whether it be on paper, or digital media.","0","0","25","","","everyone","0","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("82","PC Gaming","Some of the best, most-played games are on the PC. Talk about \'em here.","0","0","19","","","everyone","0","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("81","X-Box","This is the hub from which X-Box players may commute.","0","0","19","","","everyone","0","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("46","Vault","Old DreamSpand topics are here.","0","0","18","","","staff","0","","","0","0","last_updated DESC","","");
INSERT INTO `boards` VALUES("80","PlayStation","Anything Sony, PlayStation, PSN, or online gaming regarding this service goes here.","0","0","19","","","everyone","0","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("79","Nintendo","Anything and everything relating to the company that owns the legend known as Mario. Nintendo fans, this is your stop.","0","0","19","","","everyone","0","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("77","The Caf","A laid back, relaxed place to talk about miscellaneous topics.","0","0","18","","","everyone","0","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("78","Zollernverse Gaming","Looking to talk about or get help for a video game not listed on our boards? Try here.","0","0","19","","","everyone","0","","","0","1","last_updated DESC","","");
INSERT INTO `boards` VALUES("76","Entry Hub","Say hello (or goodbye) to the user-base, and get to know everyone a bit.","0","0","18","","","everyone","0","","","0","1","last_updated DESC","","");



DROP TABLE `cal_cmts`;

CREATE TABLE `cal_cmts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ev_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `cmt` text NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `thread_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=224 DEFAULT CHARSET=latin1;




DROP TABLE `censored`;

CREATE TABLE `censored` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original` varchar(100) NOT NULL,
  `censor` varchar(100) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `censored` VALUES("7","Paul Shannon","Alpha Wolf","1","2013-03-22 11:33:44");



DROP TABLE `chao`;

CREATE TABLE `chao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(7) NOT NULL DEFAULT '????',
  `swim` bigint(11) unsigned zerofill NOT NULL DEFAULT '00000000001',
  `fly` bigint(11) unsigned zerofill NOT NULL DEFAULT '00000000001',
  `run` bigint(11) unsigned zerofill NOT NULL DEFAULT '00000000001',
  `power` bigint(11) unsigned zerofill NOT NULL DEFAULT '00000000001',
  `stamina` bigint(11) unsigned zerofill NOT NULL DEFAULT '00000000001',
  `image` varchar(255) NOT NULL DEFAULT '',
  `owner` int(11) NOT NULL DEFAULT '1',
  `overall` bigint(11) unsigned zerofill NOT NULL DEFAULT '00000000001',
  `happiness` int(11) unsigned NOT NULL DEFAULT '1',
  `hatched` enum('y','n') NOT NULL DEFAULT 'n',
  `evolved` enum('y','n') NOT NULL DEFAULT 'n',
  `born` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `age` tinyint(4) NOT NULL DEFAULT '0',
  `reincarnated` tinyint(4) NOT NULL DEFAULT '0',
  `swimgrade` char(1) NOT NULL DEFAULT '',
  `flygrade` char(1) NOT NULL DEFAULT '',
  `rungrade` char(1) NOT NULL DEFAULT '',
  `powergrade` char(1) NOT NULL DEFAULT '',
  `staminagrade` char(1) NOT NULL DEFAULT '',
  `stats` text NOT NULL,
  `swimlevel` int(11) NOT NULL,
  `flylevel` int(11) NOT NULL,
  `runlevel` int(11) NOT NULL,
  `powerlevel` int(11) NOT NULL,
  `staminalevel` int(11) NOT NULL,
  `age_int` tinyint(4) NOT NULL,
  `chaos_emeralds` text NOT NULL,
  `sell_for` int(11) NOT NULL,
  `chao_week` int(11) NOT NULL,
  `invis` enum('y','n') NOT NULL DEFAULT 'n',
  `second_evolved` enum('y','n') NOT NULL DEFAULT 'n',
  `genes` text NOT NULL,
  `learned` text NOT NULL,
  `abuse` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6482 DEFAULT CHARSET=latin1;




DROP TABLE `chao_shop`;

CREATE TABLE `chao_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `bought` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `chao_shop` VALUES("1","Silver","3000","Silver.gif","0");
INSERT INTO `chao_shop` VALUES("2","Chaos 0","2000","Chaos 0.gif","0");
INSERT INTO `chao_shop` VALUES("3","Martian","4000","Alien.gif","1");
INSERT INTO `chao_shop` VALUES("4","Sonic","1000","Sonic.gif","0");



DROP TABLE `chaotrade`;

CREATE TABLE `chaotrade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `touser` varchar(100) NOT NULL,
  `fromuser` varchar(100) NOT NULL,
  `cid1` int(11) NOT NULL,
  `accepted` enum('yes','no') NOT NULL DEFAULT 'no',
  `started` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `checkout_messages`;

CREATE TABLE `checkout_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` text NOT NULL,
  `userid` int(11) NOT NULL,
  `mode` enum('finished','cancelled') NOT NULL DEFAULT 'finished',
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `clients`;

CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `requested_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `plan` enum('bronze','silver','gold','platinum') NOT NULL DEFAULT 'bronze',
  `details` text NOT NULL,
  `finished` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `clients` VALUES("1","1","2012-10-28 21:44:45","bronze","i want a nice site nd stuff","0");



DROP TABLE `consoles`;

CREATE TABLE `consoles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `model_no` varchar(50) NOT NULL,
  `built_for` varchar(50) NOT NULL,
  `price` varchar(6) NOT NULL,
  `date_sold` timestamp NULL DEFAULT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fix_cost` varchar(8) NOT NULL,
  `added_by` int(11) NOT NULL,
  `bought_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `consoles` VALUES("1","nintendo 64","NS105930981","5","0","0000-00-00 00:00:00","2012-08-16 13:10:39","34.82","1","0");
INSERT INTO `consoles` VALUES("2","nintendo 64","NS217689173","5","","0000-00-00 00:00:00","2012-08-16 16:57:40","34.82","2","0");



DROP TABLE `ctgs`;

CREATE TABLE `ctgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `about` text NOT NULL,
  `staff` tinyint(1) NOT NULL,
  `bd_order` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

INSERT INTO `ctgs` VALUES("19","Game Room","For boards featuring video games.","0",",Zollernverse Gaming,Nintendo,PlayStation,X-Box,PC Gaming,Dreamer Chao,Minecraft");
INSERT INTO `ctgs` VALUES("25","Art Corner","All kinds of media on the Web.","0","General Media,Writing Block,The Gallery,RPG Segment,Comicbook Central");
INSERT INTO `ctgs` VALUES("21","Tech Corner","For all the techies and developers out there.","0",",IT Center,Programming and Development");
INSERT INTO `ctgs` VALUES("22","Staff Lounge","A place for staff-only topics to be discussed.","1",",Conference Room");
INSERT INTO `ctgs` VALUES("18","Social Circle","General boards are found here.","0","Entry Hub,The Caf?,Help Desk,Vault,News Center");



DROP TABLE `display_history`;

CREATE TABLE `display_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

INSERT INTO `display_history` VALUES("44","ZollernBot","2015-02-25 09:14:55","1");
INSERT INTO `display_history` VALUES("45","Zollern Wolf","2015-02-25 11:24:15","1");
INSERT INTO `display_history` VALUES("46","GoogleBot","2015-02-26 13:39:28","1");
INSERT INTO `display_history` VALUES("47","DeAtHmAgE","2015-02-27 18:45:48","69");
INSERT INTO `display_history` VALUES("48","CrazyHand89","2015-03-09 18:38:01","1");



DROP TABLE `drafts`;

CREATE TABLE `drafts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `boardid` int(11) NOT NULL,
  `post` text NOT NULL,
  `last_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `subject` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

INSERT INTO `drafts` VALUES("6","1","66","null","2013-08-23 11:11:00","Server F.A.Q","General information regarding our Minecraft server.");



DROP TABLE `events`;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `userid` int(11) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `topics` text NOT NULL,
  `remind` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `events` VALUES("1","2013-03-21 00:00:00","Calendar Day","The day we added the calendar.","1","0","","0");
INSERT INTO `events` VALUES("2","2013-03-31 00:00:00","Bunny Day","Happy Easter!","1","0","","0");
INSERT INTO `events` VALUES("3","2013-03-17 00:00:00","Minecraft Server","This was the day we added the Minecraft server in 2013 and began our awesome creative.. awesomeness. :D","1","0","","0");
INSERT INTO `events` VALUES("4","2013-04-24 00:00:00","Evangelion 3.33","Hey, guys, the next installment in one of the greatest series ever comes out today.","16","0","","0");
INSERT INTO `events` VALUES("5","2013-04-01 00:00:00","April Fool\'s","A day of fooling and much deception.","1","0","","0");
INSERT INTO `events` VALUES("6","2013-05-21 00:00:00","xbox 720 Reveal e","10 Am PDT on Xbox.com or XBOX LIVE","2","0","","0");
INSERT INTO `events` VALUES("7","2014-12-25 00:00:00","Christmas","Merry Christmas to all.","1","0","","1");



DROP TABLE `freq`;

CREATE TABLE `freq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `touser` int(11) NOT NULL,
  `fromuser` int(11) NOT NULL,
  `sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

INSERT INTO `freq` VALUES("27","22","1","2013-03-18 00:07:58");
INSERT INTO `freq` VALUES("35","57","1","2013-06-21 10:50:58");
INSERT INTO `freq` VALUES("30","47","1","2013-03-24 21:52:06");
INSERT INTO `freq` VALUES("20","44","1","2013-01-01 11:58:07");
INSERT INTO `freq` VALUES("51","54","1","2014-03-04 16:47:03");
INSERT INTO `freq` VALUES("34","56","2","2013-06-16 16:35:00");
INSERT INTO `freq` VALUES("19","43","1","2012-12-18 10:59:15");
INSERT INTO `freq` VALUES("40","58","1","2013-07-09 10:55:04");
INSERT INTO `freq` VALUES("39","52","55","2013-07-05 13:52:34");
INSERT INTO `freq` VALUES("38","34","5","2013-07-01 12:25:02");
INSERT INTO `freq` VALUES("41","42","1","2013-07-11 11:57:50");
INSERT INTO `freq` VALUES("43","3","1","2013-08-08 11:13:24");
INSERT INTO `freq` VALUES("44","5","1","2013-08-29 12:03:09");
INSERT INTO `freq` VALUES("45","16","1","2013-08-29 12:03:22");
INSERT INTO `freq` VALUES("46","34","1","2013-08-29 12:03:29");
INSERT INTO `freq` VALUES("47","9","1","2013-08-29 12:03:36");
INSERT INTO `freq` VALUES("48","3","5","2013-09-09 14:22:21");



DROP TABLE `game_comments`;

CREATE TABLE `game_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `post` text NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `game_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `game_comments` VALUES("1","1","Awesome game. Not the best by far, but still pretty sweet.","2012-12-01 15:32:28","1");
INSERT INTO `game_comments` VALUES("2","1","Gotta say, this game is incredibly addictive.","2012-12-12 16:22:05","75");
INSERT INTO `game_comments` VALUES("3","2","one of the best racing games i have played so far","2013-04-23 17:10:16","74");



DROP TABLE `game_lib`;

CREATE TABLE `game_lib` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `about` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `games`;

CREATE TABLE `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `about` text NOT NULL,
  `box_art` text NOT NULL,
  `company` text NOT NULL,
  `game_year` varchar(4) NOT NULL,
  `pkey` varchar(50) NOT NULL,
  `byuser` int(11) NOT NULL,
  `added_when` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;




DROP TABLE `guests`;

CREATE TABLE `guests` (
  `ip` varchar(25) NOT NULL,
  `online_when` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `ipcenter`;

CREATE TABLE `ipcenter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(25) NOT NULL,
  `userlist` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=425 DEFAULT CHARSET=latin1;

INSERT INTO `ipcenter` VALUES("417","99.123.226.128","admin");
INSERT INTO `ipcenter` VALUES("418","66.210.74.243","admin:mudstag20");
INSERT INTO `ipcenter` VALUES("419","174.95.252.226","deathmage");
INSERT INTO `ipcenter` VALUES("420","76.177.233.189","turnout");
INSERT INTO `ipcenter` VALUES("421","174.95.255.137","deathmage");
INSERT INTO `ipcenter` VALUES("422","32.212.34.166","logic");
INSERT INTO `ipcenter` VALUES("423","174.78.197.207","hokage234");
INSERT INTO `ipcenter` VALUES("424","::1","admin");



DROP TABLE `journal_comments`;

CREATE TABLE `journal_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `post` text NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `journal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `journals`;

CREATE TABLE `journals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `post` text NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `journals` VALUES("1","Adventures with Crappy Games I","Listen children and gather round, for I, solidbatman, have a story to tell. You see, I was once a big Call of Duty fan. The first 3 PS2 titles were fun and usually tougher than Medal of Honor, which was also a lot of fun for me. However, one fateful day, I bought Call of Duty World at War: Final Fronts. I was excited. I was pumped. I was ready to torch some poor Japanese soldier\'s face off with a flamethrower. Sadly, it was not to be. I admit it, I made a mistake in buying a game. I know all of you thought me all knowing and powerful; I still am, but my pride was wounded by this game. You see, the flamethrower was a major let down because I ended up not killing anyone with it. Now that wouldn\'t have been a huge issue had a certain bug not happened. That bug is technically called, \"my squad mate thought he was a god and tried to walk through a tree but instead got stuck in said tree for eternity\". I suppose in that case he is a tree god of some sorts. I did what any solider not played by Tom Hanks would do, I left him in his new found tree (I think a tree elf baking cookies joke should be inserted but no, I wont). I continued the level laying waste to my enemies and then IT happened. A door needed to be opened. Not a probelm, for I am solidbatman, a super solider that can open doo... oh wait. A squad member needs to do it? Ok, ummmm, wait. Isn\'t he stuck in a tree at the beginning of the level? Oh crap... I should go get him. Well, I walked all the way back to the beginning of the level to my squad mates tree. Sure enough, the poor guy was still stuck in the tree, and not even all 3 of my grenades could get him unstuck. Maybe he was a tree god. Well, that was a fun hour I wasted. I took the game out of the disc tray in ager, placed it back in it\'s sleeve in my Big Book of Games, and to this day, have not touched it. The moral of the story kids? Friends don\'t let friends mess with trees. \n\n-Yours truly, solidbatman","2012-10-05 23:40:37","16");



DROP TABLE `karma`;

CREATE TABLE `karma` (
  `userid` int(11) NOT NULL,
  `karma` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `karma` VALUES("1","11");
INSERT INTO `karma` VALUES("2","666");
INSERT INTO `karma` VALUES("3","11");
INSERT INTO `karma` VALUES("4","0");
INSERT INTO `karma` VALUES("5","5");
INSERT INTO `karma` VALUES("8","0");
INSERT INTO `karma` VALUES("9","12");
INSERT INTO `karma` VALUES("10","0");
INSERT INTO `karma` VALUES("11","0");
INSERT INTO `karma` VALUES("12","0");
INSERT INTO `karma` VALUES("13","0");
INSERT INTO `karma` VALUES("14","0");
INSERT INTO `karma` VALUES("15","2");
INSERT INTO `karma` VALUES("16","11");
INSERT INTO `karma` VALUES("17","0");
INSERT INTO `karma` VALUES("18","0");
INSERT INTO `karma` VALUES("19","0");
INSERT INTO `karma` VALUES("20","0");
INSERT INTO `karma` VALUES("21","3");
INSERT INTO `karma` VALUES("22","1");
INSERT INTO `karma` VALUES("23","0");
INSERT INTO `karma` VALUES("24","0");
INSERT INTO `karma` VALUES("26","0");
INSERT INTO `karma` VALUES("30","7");
INSERT INTO `karma` VALUES("32","2");
INSERT INTO `karma` VALUES("34","3");
INSERT INTO `karma` VALUES("35","0");
INSERT INTO `karma` VALUES("37","1");
INSERT INTO `karma` VALUES("41","1");
INSERT INTO `karma` VALUES("42","10");
INSERT INTO `karma` VALUES("43","2");
INSERT INTO `karma` VALUES("44","1");
INSERT INTO `karma` VALUES("46","1");
INSERT INTO `karma` VALUES("47","1");
INSERT INTO `karma` VALUES("48","0");
INSERT INTO `karma` VALUES("49","0");
INSERT INTO `karma` VALUES("50","2");
INSERT INTO `karma` VALUES("51","-1");
INSERT INTO `karma` VALUES("52","0");
INSERT INTO `karma` VALUES("54","0");
INSERT INTO `karma` VALUES("56","0");
INSERT INTO `karma` VALUES("57","0");
INSERT INTO `karma` VALUES("55","1");
INSERT INTO `karma` VALUES("58","0");
INSERT INTO `karma` VALUES("59","0");
INSERT INTO `karma` VALUES("60","0");
INSERT INTO `karma` VALUES("45","3");
INSERT INTO `karma` VALUES("61","0");
INSERT INTO `karma` VALUES("62","0");
INSERT INTO `karma` VALUES("64","0");
INSERT INTO `karma` VALUES("65","0");
INSERT INTO `karma` VALUES("66","0");
INSERT INTO `karma` VALUES("67","0");
INSERT INTO `karma` VALUES("69","0");



DROP TABLE `layouts`;

CREATE TABLE `layouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(58) NOT NULL,
  `stylesheet` text NOT NULL,
  `banner_img` text NOT NULL,
  `userid` int(11) NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `default_layout` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `layouts` VALUES("1","Crystallized","body { \n\n	background-image: url(../lunarbg_1.png) !important;\n\n	background-attachment: fixed;\n\n	background-repeat: repeat;\n\n	color: #555;\n\n}\n\n \n\n.ach {\n\n	float: left;\n\n	border: 1px solid #000000;\n\n	border-radius: 25px;\n\n}\n\n\n\n.banner { \n\n	position: relative; \n\n}\n\n\n\n.mainbg { \n\n	background: #eee;\n\n	color: #444;\n\n}\n\n\n\n.mainbg2 {\n\n	background: #efefef;\n\n	color: #222;\n\n}\n\n\n\n.bordercolor { \n\n	background-color: #cccccc;\n\n	border-radius: 5px;\n\n}\n\n \n\n.titlebg { \n\n	background: url(../lunargrad.png) repeat; \n\n	border-radius: 5px;\n\n	color: #ffffff;\n\n	text-align: center;\n\n	font-weight: bold; \n\n	height: 24px;\n\n}\n\n\n\n.catbg { \n\n	background: url(../lunargrad.png) repeat;\n\n	border-radius: 5px;\n\n	color: #ffffff;\n\n	text-align: center; \n\n	font-weight: bold;\n\n	height: 25px;\n\n}\n\n\n\n.hmenu {\n\n	border: 1px solid #000000;\n\n}\n\n\n\na, a:visited { \n\n	text-decoration: none; \n\n	color: #8d93e1;\n\n}\n\n\n\na:hover { \n\n	text-decoration: none; \n\n	color: #09f;\n\n}\n\n\n\n.boardInfo {\n\n	width: 25%;\n\n	margin-left: 25%;\n\n	border: 1px inset #999;\n\n	border-radius: 5px;\n\n	padding: 4px !important;\n\n}\n\n\n\n.boardInnerCell {\n\n	line-height: 1.42;\n\n	border-radius: 4px;\n\n	height: 35px;\n\n	width: 25%;\n\n	font-weight: bold;\n\n	font-size: 11px !important;\n\n	text-align: left;\n\n	width: 25%;\n\n	margin-left: 2%;\n\n}\n\n\n\n.boardInnerCell {\n\n	text-transform: uppercase;\n\n}\n\n\n\n.siteLink {\n\n	color: #0055dd;\n\n	font-family: \"Verdana\";\n\n	font-size: 13px !important;\n\n}\n\n\n\n.menu {\n\n	background: #09f; \n\n	background: linear-gradient(30deg, #09f, #039);  \n\n	background: -moz-linear-gradient(top, #09f, #039);\n\n	color: #eee;\n\n	font-size: 13px;\n\n	font-weight: 300;\n\n}\n\n\n\n.titlebg a, .catbg a {\n\n	color: #ffffff !important;\n\n}\n\n\n\n.code, .quote {\n\n	background: #dddddd;\n\n	color: #000000;\n\n	font-size: 13px;\n\n	border: 1px solid #000000;\n\n	padding: 2px;\n\n	border-radius: 5px;\n\n}\n\n\n\n.code {\n\n	font-family: \"Courier New\";\n\n}\n\n\n\nimg {\n\n	border: none;\n\n}\n\n\n\nimg[src=\"admin.gif\"] {\n\n	height: 16px;\n\n	width: 16px;\n\n}\n\n\n\n.inside {\n\n	height:100px;\n\n	width:300px;\n\n	overflow-y: auto;\n\n	display: none;\n\n	z-index: 1000;\n\n	position: absolute;\n\n	text-align: left !important;\n\n}\n\n\n\n.report {\n\n	border-radius: 5px;\n\n	display: none;\n\n}\n\n\n\n.achievement {\n\n	border-radius: 25px;\n\n	height: 40px;\n\n	border: 1px solid #000000;\n\n	padding: 4px;\n\n	position: absolute;\n\n	z-index: 1000;\n\n	display: none;\n\n}\n\n\n\n.sc {\n\n	background: url(\"../aurorabg_old.png\");\n\n	color: #000000;\n\n	display: none;\n\n	border: 1px solid #000000;\n\n	padding: 2px;\n\n	position: absolute;\n\n	z-index: 1000;\n\n	border-radius: 25px;\n\n}","zverse.png","1","2015-03-20 14:43:48","1","1");
INSERT INTO `layouts` VALUES("2","Test Theme","body { \n\n	background: #444 !important;\n\n	color: #ddd;\n\n}\n\n \n\n.ach {\n\n	float:left;\n\n	border:1px solid #000000;\n\n	border-radius:25px;\n\n}\n\n\n\n.banner { \n\n	position: relative; \n\n}\n\n\n\n.mainbg { \n\n	background: #444;\n\n	color: #ddd;\n\n}\n\n\n\n.mainbg2 {\n\n	background: #555;\n\n	color: #eeee;\n\n}\n\n\n\n.bordercolor { \n\n	background-color: #222;\n\n	border-radius: 5px;\n\n}\n\n \n\n.titlebg { \n\n	background: url(../vista.png) repeat; \n\n	border-radius: 5px;\n\n	color: #ffffff;\n\n	text-align: center;\n\n	font-weight: bold; \n\n	height: 24px;\n\n}\n\n\n\n.catbg { \n\n	background: url(../vista.png) repeat;\n\n	border-radius: 5px;\n\n	color: #ffffff;\n\n	text-align: center; \n\n	font-weight: bold;\n\n	height: 25px;\n\n}\n\n\n\n.hmenu {\n\n	border: 1px solid #000000;\n\n}\n\n\n\na, a:visited { \n\n	text-decoration: none; \n\n	color: #8d93e1;\n\n}\n\n\n\na:hover { \n\n	text-decoration: none; \n\n	color: #09f;\n\n}\n\n\n\n.boardInfo {\n\n	width: 25%;\n\n	margin-left: 25%;\n\n	border: 1px inset #999;\n\n	border-radius: 5px;\n\n	padding: 4px !important;\n\n}\n\n\n\n.boardInnerCell {\n\n	line-height: 1.42;\n\n	border-radius: 4px;\n\n	height: 35px;\n\n	width: 25%;\n\n	font-weight: bold;\n\n	font-size: 11px !important;\n\n	text-align: left;\n\n	width: 25%;\n\n	margin-left: 2%;\n\n}\n\n\n\n.boardInnerCell {\n\n	text-transform: uppercase;\n\n}\n\n\n\n.siteLink {\n\n	color: #0055dd;\n\n	font-family: \"Verdana\";\n\n	font-size: 13px !important;\n\n}\n\n\n\n.menu {\n\n	background: #09f; \n\n	background: linear-gradient(30deg, #0f9, #0a9);  \n\n	background: -moz-linear-gradient(top, #0f9, #0a9);\n\n	color: #eee;\n\n	font-size: 13px;\n\n	font-weight: 300;\n\n}\n\n\n\n.titlebg a, .catbg a {\n\n	color: #ffffff !important;\n\n}\n\n\n\n.code, .quote {\n\n	background: #dddddd;\n\n	color: #000000;\n\n	font-size: 13px;\n\n	border: 1px solid #000000;\n\n	padding: 2px;\n\n	border-radius: 5px;\n\n}\n\n\n\n.code {\n\n	font-family: \"Courier New\";\n\n}\n\n\n\nimg {\n\n	border: none;\n\n}\n\n\n\nimg[src=\"admin.gif\"] {\n\n	height: 16px;\n\n	width: 16px;\n\n}\n\n\n\n.inside {\n\n	height:100px;\n\n	width:300px;\n\n	overflow-y: auto;\n\n	display: none;\n\n	z-index: 1000;\n\n	position: absolute;\n\n	text-align: left !important;\n\n}\n\n\n\n.report {\n\n	border-radius: 5px;\n\n	display: none;\n\n}\n\n\n\n.achievement {\n\n	border-radius: 25px;\n\n	height: 40px;\n\n	border: 1px solid #000000;\n\n	padding: 4px;\n\n	position: absolute;\n\n	z-index: 1000;\n\n	display: none;\n\n}\n\n\n\n.sc {\n\n	background: #555;\n\n	color: #ddd;\n\n	display: none;\n\n	border: 1px solid #000000;\n\n	padding: 2px;\n\n	position: absolute;\n\n	z-index: 1000;\n\n	border-radius: 25px;\n\n}","test.png","0","2015-03-20 14:43:48","0","0");



DROP TABLE `mc_mods`;

CREATE TABLE `mc_mods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(30) NOT NULL,
  `about` text NOT NULL,
  `version` text NOT NULL,
  `file_url` text NOT NULL,
  `mod_type` enum('mod','plugin') NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;




DROP TABLE `mc_rpacks`;

CREATE TABLE `mc_rpacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT 'MCSkin',
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `about` text NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `mc_schem`;

CREATE TABLE `mc_schem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(30) NOT NULL,
  `about` text NOT NULL,
  `version` text NOT NULL,
  `file_url` text NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `mc_skins`;

CREATE TABLE `mc_skins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT 'MCSkin',
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `about` text NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `image` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `medals`;

CREATE TABLE `medals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `about` text NOT NULL,
  `gpoints` int(11) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `requirement` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

INSERT INTO `medals` VALUES("6","First Post!","Make your first post.","5","2012-06-20 22:36:06","postCount($_COOKIE[\"id\"]) >= 1");
INSERT INTO `medals` VALUES("7","100 Posts!","Reach your hundredth post.","100","2012-06-20 22:36:37","postCount($_COOKIE[\"id\"]) >= 100");
INSERT INTO `medals` VALUES("8","Messenger","Send a personal message to any user.","5","2012-06-20 22:37:07","$msgs[\"id\"] != \"\"");
INSERT INTO `medals` VALUES("10","It\'s All About Me","Fill out your \"about me\" section in your profile.","10","2012-06-20 22:39:48","$logged[\"about_me\"] != \"\"");
INSERT INTO `medals` VALUES("12","Statistics","Make your first status.","10","2012-06-20 22:45:26","$userStatus[\"id\"] != \"\"");
INSERT INTO `medals` VALUES("13","Eyes On The Prize","Get to 500 tokens.","25","2012-06-20 22:54:15","getTokens($_COOKIE[\"id\"]) >= 500");
INSERT INTO `medals` VALUES("14","Thousannaire","Have at least 1,000 tokens.","150","2012-06-20 22:56:19","getTokens($_COOKIE[\"id\"]) >= 1000");
INSERT INTO `medals` VALUES("15","Reclaimer","Reach the \"Forerunner\" rank.","200","2012-06-21 12:16:18","postCount($_COOKIE[\"id\"]) >= 2500");
INSERT INTO `medals` VALUES("16","Commentary","Comment on a status.","5","2012-06-21 13:10:01","$numComments >= 1");
INSERT INTO `medals` VALUES("17","Editor","Use the Modify button.","5","2012-06-21 16:55:15","$le[\"id\"] != \"\"");
INSERT INTO `medals` VALUES("18","Hatchling","Get to 5 posts.","5","2012-06-21 17:00:18","postCount($_COOKIE[\"id\"]) >= 5");
INSERT INTO `medals` VALUES("19","Corporal","Get to 50 posts.","50","2012-06-21 17:00:56","postCount($_COOKIE[\"id\"]) >= 50");
INSERT INTO `medals` VALUES("20","Topic Starter","Start at least 20 topics.","15","2012-06-21 17:04:40","$numberOfUserTopics >= 20");
INSERT INTO `medals` VALUES("21","I Come In Peace","Change your species to alien.","10","2012-06-21 17:08:37","$logged[\"species\"] == \"alien\"");
INSERT INTO `medals` VALUES("22","Employees Only","Get promoted to a global staff member or higher.","75","2012-06-21 17:27:39","checkPerms(3)");
INSERT INTO `medals` VALUES("24","Regular","Reply to a hundred topics.","25","2012-06-22 11:38:01","$numberOfUserPosts >= 100");
INSERT INTO `medals` VALUES("25","Newscaster","Make an update to the site.","75","2012-06-25 08:28:47","$uptrue == 1");
INSERT INTO `medals` VALUES("26","Skin Shedder","Change your skin (site layout) to something other than the default.","10","2012-07-04 18:36:02","$skinChange[\"main\"] != 1");
INSERT INTO `medals` VALUES("27","Webbin\' Out","Fill out your \"web site\" field in your profile.","15","2012-07-04 18:36:42","	$logged[\"website\"] != \"\"");
INSERT INTO `medals` VALUES("28","Colorizer","Change your name colors.","100","2012-07-04 18:37:36","$logged[\"colors\"] != \"\"");
INSERT INTO `medals` VALUES("29","Avatar","Provide an avatar for your profile.","10","2012-07-04 18:40:38","$logged[\"avatar\"] != \"\"");
INSERT INTO `medals` VALUES("30","Hot Mod","Get promoted to a mod or higher.","75","2012-07-04 20:48:32","checkPerms(2)");
INSERT INTO `medals` VALUES("31","Name Changer","Change your display name to something different than your username.","5","2012-07-05 09:41:49","$logged[\"display\"] != $logged[\"name\"]");
INSERT INTO `medals` VALUES("32","My Name Is Steve","Reach the \"Steve\" rank.","200","2012-07-05 09:47:28","postCount($_COOKIE[\"id\"]) > 5000000");
INSERT INTO `medals` VALUES("33","50 Replies","Reply to at least 50 topics.","50","2012-07-05 09:49:31","$numberOfUserPosts >= 50");
INSERT INTO `medals` VALUES("34","Ghost In The Machine","Change your species to \"Ghost.\"","5","2012-07-05 09:52:44","$logged[\"species\"] == \"ghost\"");
INSERT INTO `medals` VALUES("35","Tagged!","Fill out your service tag in your profile.","10","2012-07-05 09:54:35","$logged[\"s_tag\"] != \"\"");
INSERT INTO `medals` VALUES("36","Secret Identidy","Change your display name ten times.","25","2012-08-12 16:26:15","$nd >= 10");
INSERT INTO `medals` VALUES("37","Good Karma","Achieve at least 10 points in reputation.","50","2012-08-17 14:18:10","$logged[\"karma\"] >= 10");
INSERT INTO `medals` VALUES("38","Following Orders","Reach the \"Captain\" rank.","75","2012-08-17 14:22:27","postCount($_COOKIE[\"id\"]) >= 200");
INSERT INTO `medals` VALUES("39","Questionnaire","Post an update on a comment.","5","2012-08-23 15:33:08","$uc >= 1");
INSERT INTO `medals` VALUES("40","This Is My Tag..","Fill out your X-Box Gamer Tag in your profile.","10","2012-08-23 15:33:46","$logged[\"xbox_tag\"] != \"\"");
INSERT INTO `medals` VALUES("41","Book Worm","Bookmark at least 10 topics.","20","2012-08-23 15:34:22","$ach_bcount >= 10");
INSERT INTO `medals` VALUES("42","The Chosen","Be one of the top ten posters.","25","2012-08-23 15:35:03","$logged[\"top_ten\"]");
INSERT INTO `medals` VALUES("43","Top Dog","Be the number one top poster.","100","2012-08-23 15:36:05","$logged[\"top_poster\"]");
INSERT INTO `medals` VALUES("44","Lockdown","Set up a security question for your account.","5","2012-09-06 17:35:55","$securityCheck[\"id\"] != \"\"");
INSERT INTO `medals` VALUES("45","Enlisted","Register one of your display names.","100","2012-09-13 16:01:30","$CHRG");
INSERT INTO `medals` VALUES("46","Happy Birthday!","Have a birthday on the site.","15","2012-09-18 08:18:21","date(\"m d\",strtotime($logged[\"birthday\"])) == date(\"m d\")");
INSERT INTO `medals` VALUES("47","Newborn","Create your very first Dreamer Chao.","5","2012-09-22 08:26:30","$firstChao");
INSERT INTO `medals` VALUES("48","Not From Around Here..","Have a martian chao.","10","2012-09-22 08:27:05","$alienChao");
INSERT INTO `medals` VALUES("49","Nintendude","Fill out your Wii Code in your profile.","10","2012-09-22 08:27:51","$logged[\"wii_code\"] != \"\"");
INSERT INTO `medals` VALUES("50","Work Hard, Play Harder","Fill out your PSN in your profile.","10","2012-09-22 08:28:17","$logged[\"psn\"] != \"\"");
INSERT INTO `medals` VALUES("51","Not The Only One","Have a total of 24 Dreamer Chao.","5","2012-09-22 08:29:22","$amountOfUserChao >= 24");
INSERT INTO `medals` VALUES("52","Now You See Me..","Obtain an invisible chao.","75","2012-09-22 08:29:47","$userInvisChao");
INSERT INTO `medals` VALUES("53","Sonic Boom!","Raise a Super Sonic chao.","75","2012-09-22 08:30:16","$sonicBoom >= 1");
INSERT INTO `medals` VALUES("54","Ultimate Lifeform","Raise a Super Shadow chao.","75","2012-09-22 08:30:53","$superShadow >= 1");
INSERT INTO `medals` VALUES("55","We Are As One","Have your web site featured as one of our affiliates.","5","2012-09-22 08:31:46","$afCheck");
INSERT INTO `medals` VALUES("56","Chaos Control!","Obtain all seven Chaos Emeralds.","150","2012-09-22 08:32:10","$allSeven");
INSERT INTO `medals` VALUES("57","Perfect Chaos","Have a blue Chaos 0 chao with all 7 emeralds.","200","2012-09-22 08:32:46","$haveIt");
INSERT INTO `medals` VALUES("58","Life Saver","Support Breast Cancer Awareness Month in October.","200","2012-10-05 15:50:02","$logged[\"bc_aware\"]");
INSERT INTO `medals` VALUES("59","Full Moon","Change your species to \"Werewolf.\"","5","2013-03-17 14:49:34","$logged[\"species\"] == \"werewolf\"");
INSERT INTO `medals` VALUES("60","Blood Red","Change your species to \"vampire.\"","5","2013-03-17 14:53:32","$logged[\"species\"] == \"vampire\"");
INSERT INTO `medals` VALUES("61","The Light","Change your species to \"angel.\"","5","2013-03-17 14:56:52","$logged[\"species\"] == \"angel\"");
INSERT INTO `medals` VALUES("62","Needs Of The Many","Change your species to \"vulcan.\"","5","2013-03-17 15:00:55","$logged[\"species\"] == \"vulcan\"");
INSERT INTO `medals` VALUES("63","The Power Of Fire","Find the Diablo sword on the Minecraft server.","200","2013-05-24 12:09:56","in_array(\"1\",$swordList)");
INSERT INTO `medals` VALUES("64","The Mighty Thor!","Find the Thor sword on the Minecraft server.","200","2013-05-24 12:13:15","in_array(\"2\",$swordList)");
INSERT INTO `medals` VALUES("65","Frost Giant","Find the Glacius sword on the Minecraft server.","200","2013-05-24 12:14:01","in_array(\"3\",$swordList)");
INSERT INTO `medals` VALUES("66","The End Is Nigh","Find the Ender sword on the Minecraft server.","200","2013-05-24 12:14:49","in_array(\"4\",$swordList)");



DROP TABLE `members`;

CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `s_tag` varchar(5) NOT NULL,
  `pass` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('male','female','robot') NOT NULL DEFAULT 'male',
  `species` enum('human','alien','robot','ghost','beast','monster','dragon','prophet','guardian','mutant','vulcan','angel','demon','vampire','werewolf','wraith','revenant','banshee','prowler','politician') NOT NULL DEFAULT 'human',
  `perms` int(11) NOT NULL,
  `lastonline` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar` varchar(500) NOT NULL,
  `p_quote` varchar(100) NOT NULL,
  `sig` text NOT NULL,
  `ip` varchar(25) NOT NULL,
  `about_me` text NOT NULL,
  `display` varchar(20) NOT NULL,
  `joined` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `gpoints` int(11) NOT NULL,
  `birthday` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `iplist` text NOT NULL,
  `warn` int(11) NOT NULL,
  `tokens` int(11) NOT NULL,
  `medals` text NOT NULL,
  `aim` varchar(80) NOT NULL,
  `skype` varchar(80) NOT NULL,
  `msn` varchar(80) NOT NULL,
  `yim` varchar(80) NOT NULL,
  `skinid` int(11) NOT NULL,
  `colors` text NOT NULL,
  `website` text NOT NULL,
  `show_age` enum('yes','no') NOT NULL DEFAULT 'no',
  `blocked` text NOT NULL,
  `enable_fade` enum('y','n') NOT NULL DEFAULT 'y',
  `disable_pm` enum('y','n') NOT NULL DEFAULT 'n',
  `away` tinyint(1) NOT NULL DEFAULT '0',
  `flagged` tinyint(1) NOT NULL DEFAULT '0',
  `last_karma` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `xbox_tag` varchar(30) NOT NULL,
  `top_poster` tinyint(1) NOT NULL DEFAULT '0',
  `top_ten` tinyint(1) NOT NULL DEFAULT '0',
  `invisible` tinyint(1) NOT NULL DEFAULT '0',
  `location` varchar(50) NOT NULL,
  `bookmarks` text NOT NULL,
  `e_opt` tinyint(1) NOT NULL DEFAULT '1',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `secure_check` tinyint(1) NOT NULL DEFAULT '1',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `topic_email` tinyint(1) NOT NULL DEFAULT '1',
  `last_urgent` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `token_banned` tinyint(1) NOT NULL DEFAULT '0',
  `psn` varchar(50) NOT NULL,
  `wii_Code` varchar(50) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `act_code` text NOT NULL,
  `chaos_emeralds` text NOT NULL,
  `friends` text NOT NULL,
  `charged` int(11) NOT NULL,
  `look_in` tinyint(1) NOT NULL DEFAULT '0',
  `m_email` tinyint(1) NOT NULL DEFAULT '1',
  `bc_aware` tinyint(1) NOT NULL DEFAULT '0',
  `customTitle` varchar(100) NOT NULL,
  `herefor` text NOT NULL,
  `views` int(11) NOT NULL,
  `requested_site` tinyint(1) NOT NULL DEFAULT '0',
  `v2mode` tinyint(1) NOT NULL DEFAULT '0',
  `games_want` text NOT NULL,
  `games_have` text NOT NULL,
  `hide_sig` tinyint(1) NOT NULL DEFAULT '0',
  `hide_av` tinyint(1) NOT NULL DEFAULT '0',
  `friendsOnly` tinyint(1) NOT NULL DEFAULT '0',
  `swords` text NOT NULL,
  `tempcode` text NOT NULL,
  `sec_uid3160` text NOT NULL,
  `last_interest` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `draft_save` tinyint(1) NOT NULL DEFAULT '1',
  `newsys` enum('yes','no') NOT NULL DEFAULT 'no',
  `newpass` varchar(128) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `numfails` int(11) NOT NULL,
  `pin` varchar(4) NOT NULL,
  `tfa` enum('yes','no') NOT NULL DEFAULT 'no',
  `timezone` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

INSERT INTO `members` VALUES("1","admin","","fe16e5e1be290035ccfb95903a1fd8c3","admin@zollernverse.org","male","werewolf","5","2016-04-08 09:55:47","http://mindbodycoach.org/wp-content/uploads/2014/12/wolf.jpg","Light still needs darkness to shine.","[img]http://i115.photobucket.com/albums/n301/pheonixflames_18/AlphaWolf_zps989c364d.png[/img]\n\nBanner made by DeathMage.","::1","Just a simple guy. Been doing web design/development/programming/authoring for 12 years now, and it\'s something I\'m quite passionate about. I\'m very stubborn about my dreams and goals and getting in between me and them is just never a good idea. I\'m not scary, in fact I\'m quite friendly. Feel free to hit me up just to chat.","Zollern Wolf","2012-05-06 16:13:11","1650","1990-09-18 00:00:00",":178.33.169.46:99.123.226.128:70.167.81.15:74.82.68.144:74.82.64.160:74.82.68.160:70.167.81.192:70.184.1.13:74.82.64.144:70.184.2.75:70.167.81.9:68.109.200.164:70.167.81.87:74.82.68.161:70.184.1.65:70.184.2.63:70.167.81.156:70.167.81.223:70.184.1.110:67.183.160.126:74.141.106.15:115.124.64.162:127.0.0.1:70.184.1.49:66.210.74.67:70.184.2.195:63.141.204.248:70.167.81.62:98.18.79.177:68.15.223.38:66.210.74.242:68.101.46.33:66.210.74.243:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1:::1","0","27195473",":6:7:8:10:12:13:16:17:18:19:20:22:24:25:27:28:29:30:31:33:35:39:40:42:43:44:26:45:38:46:47:14:58:59:21:34:60:61:48:56:52:50","AlphaWolf918","code.dragon","","alphawolf918","1","444444:343434","","yes","gamedezyner","y","n","0","0","2015-02-25 11:18:30","","1","1","0","Wherever the wind takes me.",":495:2023","1","0","1","1","1","2014-05-06 15:35:22","0","ZollernWolf","","1","",":1.gif:2.gif:3.gif:4.gif:5.gif:6.gif:7.gif","Array:32:55:45:2","0","0","1","1","Howl A Song With Me","Because I Wanna Be, Bragging, Entertainment, Game Competitors, Game Info, Graphics Or Web Design, Programming, Socializing, To Make New Friends, User Interaction, Video Games, X-Box Achievements","0","0","1","Array:76:73",":1:2:8:75:74","0","0","0","","128cdadcb3146f1b9b63d8b2706a1b06","157238a23211bc06c102de14cb6d3bdf","2016-04-08 09:38:16","1","yes","V66uzt33zsr16qp63on3","1","5","8150","yes","America/New_York");
INSERT INTO `members` VALUES("11","theneedforspeed","","f166bc4aae93332a62e1f070e01f0320","admin@dreamspand.com","male","human","0","2012-09-16 12:01:11","","","","99.123.226.128","","Speed","2012-07-07 10:47:46","30","1993-04-14 00:00:00",":99.123.226.128","0","1005",":26:31:6:12","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","82b38212e8b6bdf0ff1273bfc2918472","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("2","nascarmpfan","F3AR","8a0ac1ba1dbed04642730de5187b3b58","michaelp102089@aol.com","male","revenant","5","2015-02-22 12:58:17","http://watchplayread.com/files/2010/08/Mass-Effect-2-1920.jpg","","[img]http://i1359.photobucket.com/albums/q781/AlphaWolf918/fear_3_71217-1600x1200_zps127bb820.jpg[/img]","174.64.142.202","","Mike Shepard","2012-05-06 16:13:11","1010","1989-10-20 00:00:00",":50.81.122.34:127.0.0.1:72.195.181.199:68.1.20.168:99.123.226.200:68.101.61.6:70.193.69.96:70.193.69.87:70.193.144.20:198.199.186.2:12.166.60.2:70.193.77.211:70.193.77.190:70.193.65.255:174.224.132.249:70.216.81.240:70.193.64.10:70.193.131.241:70.185.174.189:72.210.68.90:72.210.72.118:70.177.21.224:72.210.65.59:174.64.142.202","0","56",":10:21:22:6:16:12:26:30:31:35:18:8:29:17:25:42:20:40:44:34:47:13:14:58:46:19:33:7:24:50:39","nascarmpfan","mikep10892","","","1","","","no","","y","n","0","0","2013-05-19 12:01:22","nascarmpfan","0","1","0","Everywhere",":2023","1","0","0","1","1","0000-00-00 00:00:00","0","nascarmpfan","","1","","",":1:9:34:42:46:16:41:54:5","0","0","1","1","","Because I Wanna Be, Entertainment, Game Competitors, Game Info, Graphics Or Web Design, PS3 Trophies, Programming, Socializing, To Make New Friends, User Interaction, Video Games, X-Box Achievements","0","0","1",":2:31",":73:75:1:74","0","0","0","","","b52863bbee7f255dc02c8de430935235","2015-02-22 12:56:59","1","yes","23yut33zsr14qnp23yon","0","0","","no","");
INSERT INTO `members` VALUES("3","dreamspand","Z","f166bc4aae93332a62e1f070e01f0320","dreamspand@dreamspand.com","robot","robot","0","2016-04-08 09:38:41","http://wsmrobot.com/wp-content/uploads/revslider/slider1/b1-robot.png","Interesting.","Error: keyboard not found. Please press any key to continue.","99.123.226.128","I am ZollernBot, a Web bot designed by Zollern Wolf explicitly to perform caretaking of the Web site, Zollernverse. My internal memory informs me that I am a spawn of the DreamSpand robot that preceeded me. He was obsolete and had to be...[i]discharged[/i]. I am loyal to the subjects of this community and aim to please.","ZollernBot","2012-05-06 16:13:11","350","2012-05-06 16:13:11",":127.0.0.1:99.123.226.128","0","1040",":6:8:10:18:29:31:35:42:44:26:12:13:14:47:20:16:19","","","","","1","","","yes","","n","n","0","0","0000-00-00 00:00:00","","0","1","0","t3h c0dez","","0","0","1","1","0","0000-00-00 00:00:00","0","","","1","","","","0","0","0","0","The Controller","","0","0","1","","","0","0","0","","","984193487cc3fae045d49189f769377a","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("4","bazibzib","ZIB","626695248df9db289a6f3ec8e1a4ec36","bazibzib@dreamspand.com","robot","robot","1","2012-06-26 10:54:57","","Man is a robot with defects.","One of these days, Alice, to the moon!","50.81.122.34","I am a robot. Duh.","Zibby","2012-05-06 03:00:00","25","0000-00-00 00:00:00",":127.0.0.1:99.123.226.128:50.81.122.34","0","1005",":10:12:6","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","91a2631c901ce8102abca58dc92fc686","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("5","asylumneeded","P3P","12269bd97ab31a61b7e44b3e5743e311","danny19945@live.com","male","demon","0","2014-11-18 16:08:43","http://i.imgur.com/fmZcW4U.gif","Tekkit and Alpha Pack server <3","","108.41.217.223","I\'m going crazy up in here","ttok ttok","2012-06-02 19:20:19","635","1994-12-26 03:00:00",":75.127.131.50:67.81.161.22:199.36.124.128:174.141.208.99:174.141.208.107:174.141.208.110:69.124.235.54:174.141.208.115:174.141.208.102:174.141.208.108:174.141.208.97:69.124.234.45:186.47.214.234:181.112.28.89:186.46.247.114:181.112.5.197:186.46.146.110:190.152.172.25:181.113.28.133:186.46.247.234:190.152.170.72:186.46.216.106:71.101.94.16:186.46.219.118:186.46.231.244:186.46.221.6:181.112.97.138:181.112.235.116:186.46.149.215:136.223.12.203:69.117.187.48:198.72.12.1:108.41.217.223","0","95",":10:29:35:21:26:40:6:13:14:8:31:28:18:12:17:16:20:22:30:44:42:62:39:47:19","","Danny199456","","","1","ff0000:a52a2a","","yes","","y","n","0","0","2013-08-08 15:33:10","ChronoxShift","0","1","0","in the bed","","0","0","1","1","1","0000-00-00 00:00:00","0","","","1","","",":1:2:16","0","0","1","0","","Because I Wanna Be, Entertainment, Game Info, Graphics Or Web Design, Lurking, Socializing, To Make New Friends, User Interaction, Video Games, X-Box Achievements","0","0","1","","","0","0","0","","580dcb1d08c101e4b3e6ef2786b6dbfe","19c2f898d0e9f18d7736b96e48d8f814","2014-11-18 15:34:04","1","no","","0","2","","no","");
INSERT INTO `members` VALUES("8","retribution","boo","0e1b5d6d3e20aeea97440ff36e7ca5a9","admin@dreamspand.com","male","ghost","0","2015-01-26 14:44:30","http://25.media.tumblr.com/tumblr_m6ig67KYot1qgglejo1_400.gif","Wisdom is greater than power.","uhhhh.. hi?","66.210.74.242","I\'m special.","Retribution","2012-06-22 12:27:50","405","1992-03-31 23:00:00",":99.123.226.128:50.81.122.34:66.210.74.242","0","1140",":6:10:12:18:16:20:26:21:29:8:31:34:35:28:42:13:14","","","","","1","aa0000:dd0000","","no","","y","n","0","0","0000-00-00 00:00:00","","0","1","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","dddb2590fcbb99691708728b9e2ecd77","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("9","rath","GHOUL","c549d6389d2a361e0fcf816a787eb13f","marcusrath_80@hotmail.com","male","wraith","0","2014-12-23 17:09:06","http://invisibleman.com/PolarB-Growling-web.jpg","I\'m a headhunter, I hook up out of work Soviet scientists with Rouge Third World nations.","[IMG]http://cdn2.gamefront.com/wp-content/uploads/2010/10/expert_hunter.jpg[/IMG]","93.160.30.220","I enjoy sunsets, long walks on the beach, and frisky women.","Ursus","2012-06-26 05:27:51","1390","1992-07-29 00:00:00",":83.89.42.69:2.104.130.190:93.160.30.220:80.160.68.136:178.202.187.203","0","2370",":6:17:18:10:8:12:20:16:29:21:26:30:31:34:35:28:19:33:13:42:40:7:22:47:14:24:27:38:45:63:64","","marcusrath_80@hotmail.com","","","1","ee0000:ffffff","http://ghoulies.proboards.com","yes","","y","n","0","0","2013-04-16 23:35:40","Absalon L16","0","1","0","Forty-Fish O\'Clock","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","",":1:2","0","0","1","0","The Denim Wrapped Nightmare","Because I Wanna Be, Bragging, Entertainment, Game Info, Lurking, Socializing, To Make New Friends, User Interaction, Video Games, X-Box Achievements","0","0","1","","","0","0","0","1,2","","3c8e06f8419ab8cbf168fbcebb48b3ff","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("10","fearismyname","AR","f166bc4aae93332a62e1f070e01f0320","fearismyname@dreamspand.com","male","ghost","0","2012-09-16 12:01:47","http://2.bp.blogspot.com/-N5C-twgscMU/Tpg4JlgEK3I/AAAAAAAAAIg/CaLCbyYmqNw/s1600/Fear_oyun_resimleri_posterleri_m.jpg","Monsters are real, ghosts are real too. They live inside us, and sometimes, they win.","","99.123.226.128","I like horror stuff.","FE","2012-06-27 09:52:10","90","1994-06-27 00:00:00",":50.81.122.34:99.123.226.128","0","1100",":10:6:17:26:29:31:34:35:18:42","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","1","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","0ae42ef16cc9f197829ec295c5e07191","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("12","kapus","Bappy","ebe32db078f09160493b50352ddc611f","mubarikamin@gmail.com","male","ghost","0","2013-05-26 23:58:48","http://i584.photobucket.com/albums/ss288/Mubarik1995/pip.png","","","71.164.203.115","I\'m Kapus!","Kapus","2012-07-07 10:58:33","265","1975-03-05 01:00:00",":71.97.79.89:71.164.203.115","0","1055",":26:31:34:29:10:35:6:13:14:42:18:47","","kapus4","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","1","0","Somewhere in the clouds","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","That weird winged thing","","0","0","1","","","0","0","0","","","5523db40b9199f7eb07b98b2aff832cd","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("13","bananastealer","PON3","aa862123fa51bfc6e85aef43da06d41a","","male","human","0","2012-07-07 12:44:05","","","","86.132.85.67","","bananastealer","2012-07-07 12:38:27","30","1987-02-07 00:00:00",":86.132.85.67","0","1000",":26:29:35","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","d8c438db96007d3332f507662f0c0757","0000-00-00 00:00:00","1","no","","0","1","","no","");
INSERT INTO `members` VALUES("14","jessicupcake","","867ac7f6a5eecf7ea53e623f4f40152c","pinkspartangirl@yahoo.com","male","human","0","2013-08-07 22:10:39","http://i.imgur.com/mBNr0.jpg","","","24.1.5.212","","jessicupcake","2012-07-08 18:18:22","220","1996-01-14 00:00:00",":24.1.5.212","30","1015",":6:29:13:14:42:8","","jessicaninetaleshoffman","","pinkspartangirl","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","1","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","569099904736211cff42e762f4c2b97b","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("15","sapphiremayo","","e7d1c5aa772cea1ca203ce4b5e64069d","michellechaogirl@hotmail.com","female","dragon","0","2015-02-11 23:09:47","http://i30.photobucket.com/albums/c337/sapphiretonic/Cranky_Complaining.gif","","[Signature][/Signature]","124.190.208.104","","Mayo","2012-07-09 08:10:56","645","1993-09-06 00:00:00",":124.190.208.104","0","1280",":31:6:29:35:18:17:26:20:12:42:16:13:14:28:58:34:47:8:19","","","","","1","5dfc0a:","","no","","y","n","0","0","0000-00-00 00:00:00","","0","1","0","Location: Location: Location: Location: Location: ",":653:652","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","1","*shakes cane*","Because I Wanna Be, Lurking, Video Games","0","0","1","","","0","0","0","","","34ddb5b8248e84635dbc0660d38bf5d3","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("16","solidbatman","","f39b7a3841ced00bf7c5d034cedd00bd","bholt11@att.net","male","human","0","2014-04-02 21:49:51","http://i.imgur.com/CPipx4R.jpg","Sorry, I stuttered","[center][img]http://i.imgur.com/jqbrUVn.png[/img]\n\n\n\n[/center]","71.68.106.5","If I kill you, that means I\'ll be the one closest to you when you\'re on your deathbed. Isn\'t it romantic?","solidbatman","2012-07-13 12:26:30","910","1993-02-26 00:00:00",":98.17.75.251:69.132.81.198:71.68.119.161:174.252.146.164:74.235.114.133:174.254.148.11:69.132.84.38:98.17.101.138:69.132.83.48:98.17.75.97:174.252.177.215:174.252.144.97:174.237.36.52:174.237.40.68:174.228.64.132:174.252.156.72:174.237.2.130:174.237.6.156:174.228.2.78:174.228.4.123:67.140.250.19:71.68.106.5:174.111.10.240","0","4875",":6:8:10:12:16:17:18:20:26:29:40:42:19:13:50:14:33:47:30:7:31:28:24:38:27:55:22:46:35:39","","bradley.holt6","","","1","660000:292929","http://gamefreaks11.proboards.com/index.cgi","no","","y","n","0","0","2013-02-13 21:20:26","","0","1","0","North Carolina","","1","0","1","1","1","2012-11-29 13:24:38","0","solidbatman1","","1","","",":1:2:5","0","0","1","0","Ararararagi","","0","0","1","","","0","0","0","","","16a1bd9ba4bec539d74160c292140b59","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("17","aderianix","","d321918dab10503ca6e9eeed4a820cf7","sordrerly@gmail.com","male","human","0","2013-07-26 23:24:15","","","","71.101.94.16","","aderianix","2012-07-14 16:19:25","175","1986-07-16 00:00:00",":82.193.109.52:71.101.94.16","0","1000",":13:14","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","d2b03be06d871b18f2e5caa6bef61270","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("18","viafirrenue","","5bb9fead9ab2a1bc7d0a48a14c5eb6ad","badyfaigabeti@gmail.com","male","human","0","2012-07-22 12:33:01","","","","82.193.109.52","","viafirrenue","2012-07-22 12:32:57","0","1989-07-23 00:00:00",":82.193.109.52","0","1000","","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","6e82e4bb8b110fbeec26d3b56ab3d769","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("19","pliers341","","1ac1abd45ff420e9337925f7514b5974","suebronsor@yahoo.co.uk","male","human","0","2012-08-03 22:38:00","","","","89.187.142.176","","pliers341","2012-08-03 22:38:00","0","1987-08-04 00:00:00","","0","1000","","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","e4bd6be061d4cf749ecec50febda9d76","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("20","vornedssine","","d65abaf22b6efc0388a786c3426d3dfe","blattysoyboar@gmail.com","male","human","0","2012-08-10 16:52:41","","","","89.252.58.228","","vornedssine","2012-08-10 16:52:34","0","1986-08-11 00:00:00",":89.252.58.228","0","1000","","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","6abf2d5a1c54c9f81d240e3fe25f5e2c","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("21","google","crawl","66f657aa5fe4a67881819cd52defc96a","google@gmail.com","robot","robot","0","2015-03-11 09:49:21","","","Site Indexer","66.249.67.99","Hi there! I am a robot by Google that indexes the site.","GoogleBot","2012-08-31 00:00:00","0","0000-00-00 00:00:00","","0","1000","","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","0","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","694d6b9879da131ca89b88df22deff22","0000-00-00 00:00:00","1","no","","0","0","","no","America/New_York");
INSERT INTO `members` VALUES("22","lizzy2896","","75cbbced5586737821be044e28848e68","etv2896@gmail.com","female","human","0","2012-09-17 16:42:39","","\"KNEEL.\" - Loki Laufeyson","","67.79.123.226","","lizzy2896","2012-09-11 22:08:17","20","1996-03-17 23:00:00",":67.79.123.226:108.206.178.163","0","1005",":6:17:26","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","8c2a7e717e5487d671e686b09d1c77ae","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("23","javathemocha","","eeacd7d296dedbefc07a7a3d91d0186f","javathemocha@hotmail.com","male","human","0","2012-12-05 19:56:51","http://www.crazysparks.com/wp-content/uploads/2012/08/chuck_norris-1.jpg","Decaf!? I WILL SHOOT YOU IN THE FACE!","The signature\'s floating around the CT graveyard somewhere","174.101.185.143","Been around for a while. Now a music producer =D","javathemocha","2012-09-14 17:46:09","265","1991-05-11 00:00:00",":174.101.185.143","0","35",":10:29:6:17:12:18:8:13:14:42:47:26","","JavaTheMocha","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","1","0","COLUMBIAN HILLZ",":786","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","32cc28d56a632313eee7772e5a882e80","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("30","chipmunkbabiie","","3be0aa36a7c3960ca5ec8da90017cb43","chipmunkbabiie13@yahoo.com","female","human","0","2014-12-21 22:48:38","http://eportfolio.lagcc.cuny.edu/scholars/doc_sp10/eP_sp10/Gerard_Irizarry/Projects/pastoria_city/images/pkmn_images/gengar.jpg","","[IMG]http://i49.photobucket.com/albums/f295/chipmunkbabiie13/Tag__Gengar_by_ColaCat.png[/IMG]","67.8.57.1","","chipmunkbabiie","2012-09-22 22:48:00","245","1991-08-13 00:00:00",":69.125.127.210:69.125.127.233:67.8.57.1","0","1150",":6:13:14:50:29:18:17:26:42","IHuntM0nkeys","","","","1","","","yes","","y","n","0","0","0000-00-00 00:00:00","","0","1","0","Behind you ;O","","0","0","1","1","0","0000-00-00 00:00:00","0","ChipmunkBabiie","","1","","",":1","0","0","1","0","","Because I Wanna Be, To Make New Friends, Video Games","0","0","1","","","0","0","0","","","1cabc7f60e6baf4f02d5414b209d2f98","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("32","elitewolfstriker","DM","c827b061fd567f9805c44518449013ea","pheonixfire18_nutriousbirds@hotmail.com","female","human","0","2015-01-02 20:26:12","http://fc03.deviantart.net/fs43/f/2009/142/6/0/Deadpool_DP_by_cystemic.jpg","","[IMG]http://i115.photobucket.com/albums/n301/pheonixflames_18/Deadpoolbannerdone3.png[/IMG]\n\nBanner made by meh.","174.95.252.222","Gamer to the core, enjoys drawing, sleeping; the average \'teenager\' stuff. In school for Req&Leisure, so if you need advice, I\'m here to help and what-not.\n\n\n\nNot much to say, just meet me. Please notify before adding me on the contact info above. ","DeAtHmAgE","2012-09-23 16:40:22","95","1994-10-20 00:00:00",":174.89.22.45:174.88.20.61:74.12.110.81:174.88.20.10:70.52.167.58:174.93.7.111:76.66.119.24:64.228.211.93:174.95.252.222","0","145",":29:26:31:6:10:40:18:42:17:35","FlygonXx","FlygonXx","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","NecroWolfism","0","1","0","Meheheheheh.","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","",":1","0","0","1","0","","Because I Wanna Be, Entertainment, Game Info, Graphics Or Web Design, Lurking, Socializing, User Interaction, Video Games, X-Box Achievements","0","0","1","","","0","0","0","","","e57f8e8f09998c923e9b6a8434937eaf","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("34","vibrantblade","Yuko","bb7054b319b5c882dbb165baa223d438","nader.15@hotmail.com","male","prophet","0","2013-06-27 19:25:17","http://25.media.tumblr.com/tumblr_mc5ljoaPZi1rpcp44o1_r1_500.gif","I have finally conquered milk","[center][img]http://i.imgur.com/stOH3QQ.jpg[/img][/center]","75.117.78.165","Proud(?) Otaku ","vibrantblade","2012-10-05 23:14:49","695","1992-04-13 00:00:00",":98.23.82.242:71.28.83.179:174.130.0.100:152.15.104.250:152.15.174.240:152.15.174.251:152.15.104.6:174.130.7.159:98.21.246.55:75.117.72.142:152.15.104.7:174.130.0.15:75.117.82.48:71.28.82.40:98.23.92.207:71.28.91.4:152.15.89.61:71.28.87.194:71.28.88.56:152.15.89.64:168.215.131.150:98.23.89.140:71.28.84.205:98.21.243.94:71.28.83.79:98.23.82.210:98.21.243.160:98.23.82.97:152.15.9.249:70.148.68.214:71.28.83.119:174.130.1.74:98.23.95.38:71.28.83.20:152.15.89.46:68.213.108.181:75.117.75.220:75.117.74.203:98.23.85.161:174.130.3.49:174.130.2.0:75.117.79.13:75.117.75.216:75.117.73.23:71.28.85.28:75.117.83.201:152.15.8.9:71.28.82.94:174.130.0.173:98.23.88.187:98.21.243.212:98.23.90.144:64.134.184.205:98.23.88.90:71.28.83.61:98.23.85.116:152.15.112.180:152.15.112.182:64.134.179.135:174.130.1.162:152.15.112.181:70.60.193.126:174.130.5.54:75.117.86.234:98.21.241.126:75.117.87.175:174.130.3.114:98.21.242.151:98.23.88.118:75.117.75.113:71.28.84.183:98.21.246.158:98.23.91.227:98.23.90.126:75.117.75.166:75.117.78.165","0","1275",":10:50:6:18:17:29:16:12:20:42:26:19:13:33:47:30:22:8:7:24:35:14:46","","","","","1","","","no","","y","n","0","0","2013-03-22 20:26:21","","0","1","0","Charlotte, NC","","1","0","1","1","1","2013-06-22 01:24:22","0","vibrantblade16","","1","","",":2:1","0","0","1","0","","Because I Wanna Be, Entertainment, Game Competitors, Game Info, Graphics Or Web Design, PS3 Trophies, Programming, Socializing, To Make New Friends, User Interaction, Video Games","0","0","1","","","0","0","0","","","1a692fa0cab6319ef8b5b56e1aedbae8","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("45","logic","","8e1804bf5e22e280b64fc4beca218ecb","fentoozler0@aim.com","female","human","4","2015-03-06 16:32:06","http://i.imgur.com/JySvFyy.png","","I draw stuff\n\n[url=http://lazylogic.tumblr.com/][img]http://i.imgur.com/SRHiPsH.png[/img][/url]\n\nOur LP channel\n\n[url=https://www.youtube.com/channel/UC6GHcbzgnBMsPU7Euhv_ohw][img]http://i.imgur.com/kl97jAE.png[/img][/url]","32.212.34.166","i\'m the brohungle of the dungle","logic","2013-03-15 00:52:09","395","1995-07-17 00:00:00",":155.43.78.6:99.180.85.46:99.180.86.78:32.212.34.166:66.210.74.243","0","999997900",":47:26:29:22:30:10:44:6:17:18:46:13:14","fentoozler0","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","",":1","1","0","1","0","","Graphics Or Web Design, Video Games","0","0","1","","","0","0","0","","","8f673ba30f0dd8c8e12ed071c1347aec","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("37","isunlight","","ff05422f06fde9298d4ea4bd06da6f34","amiajones123@gmail.com","female","vampire","0","2012-10-27 19:51:00","","","","76.217.156.197","","iSunlight","2012-10-27 19:28:58","5","1995-10-25 00:00:00",":76.217.156.197","0","0",":31","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","Because I Wanna Be, Entertainment","0","0","1","","","0","0","0","","","514ecce43426112c1ed64871c2c0fd51","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("41","djay32","DJay","7444d79c71f5a57de30ffe5e8811856b","personmeisterman@gmail.com","male","prophet","0","2013-05-05 11:47:21","http://25.media.tumblr.com/tumblr_mdg6bx4T5o1qkceb9o1_1280.png","I\'m the Night Owl.","","86.29.121.212","Hey there, I\'m DJay32. I write a lot.","Prospect 1","2012-11-21 10:44:43","60","1995-01-02 00:00:00",":94.197.127.14:82.25.224.9:94.197.127.73:92.40.253.133:86.29.115.24:86.29.121.212","0","20",":10:31:35:40:29:6:26","soulreaperdj","DJay32","","","1","","","yes","","y","n","0","0","0000-00-00 00:00:00","DJay323","0","0","0","Underwater","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","",":2:1","0","0","1","0","","Because I Wanna Be","0","0","1","","","0","0","0","","","04d7d1018838af27c4c5f495cb036909","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("43","deathblade","","b36d331451a61eb2d76860e00c347396","flowimagine@gmail.com","male","demon","0","2012-12-15 12:28:13","http://www.bleachflame.com/forums/image.php?u=8409&dateline=1225284779","","[center][b]You\'ll mostly find me on Xbox.[/b][/center]","107.3.102.54","","?Deathblade?","2012-12-12 14:42:11","30","1995-01-12 00:00:00",":107.3.102.54","0","5",":29:31:40:6","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","All 8bit","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","Because I Wanna Be, Entertainment, Graphics Or Web Design, Lurking, Socializing, User Interaction, Video Games","0","0","1","","","0","0","0","","","51e9c516cde88cf2906ae95210155f9e","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("44","implicitkyle","","82dff4abc38c649f5778043d6460207b","kylea.stinson@live.com","male","human","0","2013-07-04 17:11:11","","","","69.40.1.163","","implicitkyle","2013-01-01 11:56:54","10","1989-05-07 00:00:00",":98.17.167.79:174.131.98.76:71.30.14.29:75.91.76.220:173.187.78.92:69.40.0.45:69.40.5.78:75.91.48.135:69.40.1.163","0","0",":26","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","0","","","0","0","0","","","f03606ca730bcc7629dd322cd75b3ad8","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("47","kennethphoenix18","","bb4afc1882e1131fd04d587f3defb1f8","dragoonmon1890@yahoo.com","male","human","0","2013-03-24 19:58:06","","","","97.103.189.187","","kennethphoenix18","2013-03-24 19:57:49","0","1992-08-25 00:00:00",":97.103.189.187","0","0","","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","0","","","0","0","0","","","9f17ef5dcdc3e7cd016c709bc256e516","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("46","alarikun","","4897c736c972faeb0783d2f0c3cf904c","ArthusPaladin@hotmail.com","male","human","0","2013-09-26 22:23:46","http://i3.photobucket.com/albums/y100/Alaris/IvanAlexandrov_zps360858f2.png","","[url=http://www.youtube.com/playlist?list=PL4d3zGyeuysrMV6X39bLb6wzRZww1fEQZ&feature=view_all][IMG]http://i3.photobucket.com/albums/y100/Alaris/LetsPlayDeadSpaceAd_zpsfae931f1.jpg[/IMG][/url]\n\n[COLOR=\"Red\"][B]Click above to watch my Let\'s Play of Dead Space!  Episode 4 is out![/B][/COLOR] [B](UPDATED ON: May 14, 2013)[/B]","69.138.218.123","","Alaris","2013-03-17 17:47:19","85","1989-11-02 23:00:00",":69.138.218.123:96.234.180.123:71.101.94.16","0","190",":29:31:6:17:18:26:39:20:42","alariskun","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","1","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","",":1:2","0","0","1","0","","","0","0","0","","","0","0","0","","","100da8a12020030a960a82f5ac68fef9","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("48","stuff","","eab863c1fbaf494f40b7771edd77696c","numberplusletters@gmail.com","male","human","0","2013-03-27 01:12:16","","","","76.255.196.36","","stuff","2013-03-24 22:49:36","5","1994-10-05 00:00:00",":76.255.196.36","0","35",":6","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","0","","","0","0","0","","","76fbfedace42fa96984c7c188a6cad3d","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("50","dreadnatasha","","732671b65e7924ac1f0331bfbbbb672f","DragQueenMonster@ymail.com","female","monster","0","2014-06-10 18:12:41","","","","99.109.202.206","","Dread Natasha","2013-04-14 21:29:19","20","1991-05-18 00:00:00",":76.254.16.243:99.125.136.41:99.109.202.206","0","0",":26:31:44","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","Entertainment, Game Info, Lurking, Socializing, To Make New Friends, User Interaction, Video Games","0","0","0","","","0","0","0","","","c3384200e9ec9e84299ab8cf8aeb9587","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("51","master2o","X60","4e07e7b7157b3bef8ff55667fd6b2497","Buessbrandon@aol.com","male","alien","0","2013-04-23 19:23:16","http://images.wikia.com/starcraft/images/7/78/Firebat_SC2_Head2.jpg","For the Brotherhood of NOD","B.X.","173.2.159.220","Destiny for life","Master2o","2013-04-16 21:55:51","75","1995-02-16 00:00:00",":173.2.159.220","0","0",":26:21:35:40:50:31:29:10","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","Master2o","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","Spartain117","","1","","","","0","0","1","0","","Entertainment, Video Games","0","0","0","","","0","0","0","","","717f62d7a71c13e1159ef69fc4162df0","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("52","leetaemin","","d8b995e37ea7df4f73d292068ac1b87e","shineecraft@gmail.com","male","werewolf","0","2013-04-24 09:41:30","","Popsick by VintageBeef","","199.36.124.128","I love video games since I was little\n\nI also love K-Pop especially SHINee","leetaemin","2013-04-22 10:10:22","40","1997-10-04 00:00:00",":96.232.164.21:199.36.124.128","0","10",":26:10:50:59:6","","","","","1","","","yes","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","lycanthrope316","","1","","","","0","0","1","0","","Entertainment, Game Info, PS3 Trophies, Socializing, To Make New Friends, User Interaction, Video Games","0","0","0","","","0","0","0","","","ebe6d8a6b679f5d57684ca6d4091bc51","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("53","recursionrecursi","","6eea9b7ef19179a06954edd0f6c05ceb","mailmonkey123@aol.com","male","human","0","2013-04-23 15:56:32","","","","67.83.41.47","","recursionrecursion","2013-04-23 15:56:32","0","1975-12-01 00:00:00","","0","0","","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","0","","","0","0","0","","","224f31e4f4fefa0f58637b2f7dc61a7d","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("54","luffy","","2c268214568e32a4cf18d93b0cc3818d","Zonic1027@aim.com","male","human","0","2014-12-07 13:29:50","http://i241.photobucket.com/albums/ff186/Bulbasaur_bucket/Franky_Pre_Timeskip_Portrait_zpseb9962ab.png","Feelin Super!","[URL=http://media.photobucket.com/user/syahruddinxxx/media/d.gif.html][IMG]http://i1062.photobucket.com/albums/t493/syahruddinxxx/d.gif[/IMG][/URL]","173.61.173.50","Sup I\'m Zonic =0 I\'m a Super fan of the popular One Piece series and a fan of Sonic, Legend of Zelda, Pokemon (the games only) and Ratchet and Clank  \n\n","Franky ","2013-05-04 11:39:43","75","1975-03-01 01:00:00",":71.188.92.198:71.188.81.199:173.61.173.50:72.43.215.74","0","85",":26:29:31:6:12:10:18:17:50:8","Zonic1027@aim.com","Pirate King Zonic","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","Fish-man Island ","","1","0","1","1","1","0000-00-00 00:00:00","0","Pirateking56743","","1","","",":2:1","0","0","1","0","","Because I Wanna Be, Entertainment, Socializing, To Make New Friends, Video Games","0","0","1","","","0","0","0","","","78cd4806cdaff12aa94edd752fb5b1e3","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("55","meticulouswolf15","Fire","d8b995e37ea7df4f73d292068ac1b87e","shineecrat@gmail.com","male","werewolf","0","2014-09-04 11:38:55","data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxQSEBUUEBQUFhQUFBQUFRUUFBQUFBQVFhQWFxQUFBUYHCggGBolHBQUITEhJSkrLi4uFx8zODMsNygtLisBCgoKDg0OGhAQFywkHyQsLCwsLCwsLCwsLC4sLCwsLywsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLP/AABEIARcAtQMBIgACEQEDEQH/xAAcAAABBQEBAQAAAAAAAAAAAAABAAIDBAUHBgj/xAA/EAABAwIDBQUGAwUIAwAAAAABAAIRAwQSITEFBkFRcRMiYYGRBzKhscHwFELRI1JicuEVM2OCkqLC8SSyw//EABkBAAMBAQEAAAAAAAAAAAAAAAABBAIDBf/EACgRAAICAgICAAUFAQAAAAAAAAABAhEDIRIxBEEiMkJRcSNSYaHBFP/aAAwDAQACEQMRAD8A6yAjCICK2","","","104.129.72.126","","meticulouswolf15","2013-06-03 17:14:34","270","1997-10-04 00:00:00",":96.232.164.21:69.113.74.89:74.101.144.205:50.29.103.121:47.21.251.248:50.29.84.96:47.21.250.175:50.29.72.102:209.140.39.126:74.108.51.176:199.36.124.128:24.44.153.65:104.129.72.126","0","15",":6:35:50:59:44:29:12:8:17:41:18:13:14:47","","meticulouswolf15","","","1","","","yes","","y","n","0","0","2014-06-09 10:02:24","","0","0","0","Central islip NY",":2334:2299:1892:1940:495:255:2058:1906:1905:1904:2391","1","0","1","1","1","0000-00-00 00:00:00","0","lycanthrope316","","1","","",":1","0","0","1","0","","Entertainment, Socializing, To Make New Friends, Video Games","0","0","0","","","0","0","0","","","297ac01c68c230b739e76a5695d81e79","2014-09-04 11:33:49","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("56","kathryne","","c46e66f1f5aba872089d44cdab7e2b8f","ashleysholliday@hotmail.com","female","human","0","2013-06-15 23:49:09","","","","98.80.137.87","","kathryne","2013-06-15 23:47:38","0","1993-09-07 00:00:00",":98.80.137.87","0","0","","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","0","","","0","0","0","","","c3572f3759841a0d4867fa075667f161","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("57","forresn","","862e0f9032e8b7a429a4101182479a8f","Forresn@yahoo.com","male","human","0","2013-06-21 10:58:20","","","","69.199.56.26","","forresn","2013-06-21 10:44:12","0","1991-11-19 00:00:00",":69.199.56.26","0","0","","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","0","","","0","0","0","","","629e51c0d2421ce9457766aa6d98914b","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("58","hokage234","","40420a1f93f8253172599c0222d0fc7d","crazyhand98@yahoo.com","male","human","4","2015-03-09 18:52:59","","","","174.78.197.207","","CrazyHand89","2013-07-08 14:21:33","165","1993-05-01 00:00:00",":174.79.2.168:70.184.1.180:174.78.197.207","0","0",":26:22:30:31","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","77953141f1f63330b5cce892af9adfb7","0000-00-00 00:00:00","1","no","","0","0","","no","America/New_York");
INSERT INTO `members` VALUES("59","zippyskipy","","ae7d7dbc64a73ad2313e5b317961659a","zippyskipy@gmail.com","female","human","0","2013-10-09 21:38:07","","","","76.85.134.75","","zippyskipy","2013-09-01 11:26:15","35","1996-08-31 00:00:00",":76.85.134.75:204.234.247.149","0","0",":44:26:6:17:47:8","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","",":60","0","0","1","0","","Because I Wanna Be, Entertainment, Lurking, Video Games","0","0","0","","","0","0","0","","","","2013-10-09 21:37:56","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("60","ivysong","","d49657112faa0413ece57e106134458d","Squirrelflight4evah@gmail.com","female","banshee","0","2013-09-16 05:41:44","","","","110.169.247.169","","xXIvysongXx","2013-09-02 06:56:00","15","1999-01-05 00:00:00",":124.122.79.135:124.122.126.147:124.120.63.176:124.120.170.58:115.87.72.93:58.11.231.145:124.120.30.160:124.120.14.15:110.169.247.169","0","25",":6:8:31","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","",":59","0","0","1","0","","Entertainment, Video Games","0","0","0","","","0","0","0","","","","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("65","tchao1995","","0156852702a9a045c07e707707ec9eb0","chaostchao@yahoo.com","male","human","0","2015-01-02 13:05:37","http://puu.sh/dyAms/becde8af83.jpg","Merry Christmas from DLN-000","[url=http://steamsignature.com][img]http://steamsignature.com/card/0/76561198027836787.png[/img][/url]\n\n","75.118.209.84","I came here from CT. Never was a fan of this place, but I thought I\'d finally give it a try.","TChao","2014-11-22 12:09:55","45","1995-07-02 00:00:00",":159.118.91.11:216.79.147.192:12.1.155.232:166.137.14.66:166.137.12.135:75.118.209.84","0","25",":10:29:31:6:8:26","","","","","1","","","yes","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","Socializing, To Make New Friends","0","0","1","","","0","0","0","","","","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("61","mexico36","BOOM","76c1eb2701336cc16e3c510ed98448b5","gamemaster4957@gmail.com","male","werewolf","0","2014-03-06 16:14:13","","I am caboose, vehicle destroyer!","I blow up cars for fun.","66.210.74.67","I am crazy at times, but don\'t let that scary you. Oh, and the other voice in my head says hi.","mexico36","2014-03-06 15:43:47","50","1994-12-05 00:00:00",":66.210.74.67","0","0",":44:26:40:59:35:10","","Wolfking7254","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","AdvancedNeptune","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","Because I Wanna Be, Entertainment, Game Info, Graphics Or Web Design, To Make New Friends, Video Games, X-Box Achievements","0","0","0","","","0","0","0","","","","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("62","soljakwinever","","97f1ccaca78e7c0031a3d95ce96e5d33","triskdeklophobia@hotmail.ca","male","human","0","2014-06-23 19:21:39","","","","216.240.15.210","","soljakwinever","2014-06-23 19:16:52","5","1992-10-26 00:00:00",":216.240.15.210","0","5",":6","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("63","turtle","","d4705b9f42c96eeb0b9fb53266013516","turtle@turtle.com","male","human","0","2014-10-14 16:47:04","","","","97.97.46.85","","turtle","2014-10-14 16:47:04","0","1975-12-01 00:00:00","","0","0","","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("64","turnout","","9ecd1ecc70fcc5afb5377c955e6e8cda","codenamednerdbird@gmail.com","male","politician","0","2015-02-27 21:10:49","http://i.imgur.com/zQsOd.jpg","","","76.177.233.189","","turnout","2014-11-09 09:38:38","35","1999-05-10 00:00:00",":76.177.233.189:66.102.6.57:66.249.83.151:66.249.83.139:66.249.83.145","0","10",":47:26:29:6:17","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","Because I Wanna Be, Entertainment, Lurking, Programming, Socializing, To Make New Friends, User Interaction, Video Games","0","0","1","","","0","0","0","","","","2015-02-27 21:09:12","1","no","","0","1","","no","");
INSERT INTO `members` VALUES("66","schema","","f7e83c8709d657ab0770ee15f6f2ae45","Sara.treacy95@gmail.com","female","human","0","2014-12-19 18:08:58","","","","66.152.115.36","","schema","2014-12-13 00:14:10","15","1995-05-25 00:00:00",":137.238.167.72:66.152.115.36","0","0",":8:26","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","1","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("67","mudstag20","","32e45875f83fd580cf5e99c44ad174db","pshannon0918@gmail.com","","human","0","2015-02-25 09:40:29","","","","66.210.74.243","","mudstag20","2015-02-25 09:35:22","10","1990-07-16 00:00:00",":66.210.74.243","0","0",":26","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","0","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("69","deathmage","","f4d3502399e851206a540300bde23263","silent.requiem@live.com","","human","0","2015-03-03 18:23:48","","","","174.95.255.137","","DeAtHmAgE","2015-02-27 18:44:32","15","1994-10-20 00:00:00",":174.95.252.226:174.95.255.137","0","0",":26:31","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","0","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","","0000-00-00 00:00:00","1","no","","0","0","","no","America/Chicago");
INSERT INTO `members` VALUES("68","inhuman","","c1fe5e26017d40b0644316fb57d4751c","ferrariman91890@gmail.com","male","human","0","2015-02-27 11:22:43","","","","66.210.74.243","","inhuman","2015-02-27 11:22:43","0","1990-06-01 00:00:00","","0","0","","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","0","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","","0000-00-00 00:00:00","1","no","","0","0","","no","");
INSERT INTO `members` VALUES("70","paulshannon","","01625d4dd0b2ed11a68796281143251b","person@gmail.com","male","human","0","2015-03-16 14:55:57","","","","::1","","paulshannon","2015-03-16 14:55:57","0","1992-01-01 00:00:00","","0","0","","","","","","1","","","no","","y","n","0","0","0000-00-00 00:00:00","","0","0","0","","","1","0","1","1","1","0000-00-00 00:00:00","0","","","0","","","","0","0","1","0","","","0","0","1","","","0","0","0","","","","0000-00-00 00:00:00","1","no","","0","0","","no","");



DROP TABLE `meta`;

CREATE TABLE `meta` (
  `last_user_id` int(11) NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(100) NOT NULL,
  `about` text NOT NULL,
  `keywords` text NOT NULL,
  `index` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `lang` varchar(100) NOT NULL,
  `distribution` varchar(100) NOT NULL,
  `reply_to` varchar(100) NOT NULL,
  `copyright` text NOT NULL,
  `title` text NOT NULL,
  `revisit_after` varchar(50) NOT NULL,
  `rating` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `meta` VALUES("1","2015-02-27 12:09:53","Zollernverse","A highly interactive gaming and techy web site dedicated to improving user-experience and building the better tomorrow.","pc, technology, zollern, video, game, programming, coding, playstation","index, follow","Zollern Wolf","english","global","admin@zollernverse.org","All contents of DreamSpand are copyright to the respective author(s).","Living in the now, building tomorrow.","1 day","general");



DROP TABLE `modules`;

CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `about` text NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `m_alias` varchar(20) NOT NULL,
  `last_modified_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `modules` VALUES("1","1","Message Me","Just a quick thing to send me a message.","2014-12-20 09:34:58","<a href=\"http://dreamspand.com/forum.php?act=sendpm&user=1\">Send Me A Message</a>","message","1");



DROP TABLE `notes`;

CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` text NOT NULL,
  `userid` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `notes` VALUES("1","Admins have the right to change and add to the rules as they see fit, with or without notice.","1","217","2012-08-24 13:54:03");
INSERT INTO `notes` VALUES("2","in my defense I was already laughing","1","1963","2013-03-27 23:31:43");
INSERT INTO `notes` VALUES("3","Copy and paste into address bar","1","2066","2013-04-15 19:06:45");
INSERT INTO `notes` VALUES("4","I have since become too busy to maintain the tutorials but I do intend on getting back into it shortly.","1","2423","2014-01-25 09:30:46");
INSERT INTO `notes` VALUES("5","Alpha Wolf please note that the Yellow Color is missing a 0 on the HEX. Please fix!","5","2483","2014-03-05 14:15:01");



DROP TABLE `notifications`;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `unread` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=840 DEFAULT CHARSET=latin1;

INSERT INTO `notifications` VALUES("830","3","2015-02-25 11:18:36","[user=1] posted a comment on your profile.","yes");
INSERT INTO `notifications` VALUES("831","69","2015-02-27 18:44:45","You have unlocked the [b]Skin Shedder[/b] achievement!","no");
INSERT INTO `notifications` VALUES("832","69","2015-02-27 18:45:06","You have unlocked the [b]Skin Shedder[/b] achievement!","no");
INSERT INTO `notifications` VALUES("833","69","2015-02-27 18:45:49","You have unlocked the [b]Name Changer[/b] achievement!","no");
INSERT INTO `notifications` VALUES("835","3","2015-03-02 12:38:14","[user=1] posted a comment on your profile.","yes");
INSERT INTO `notifications` VALUES("836","58","2015-03-09 18:36:04","You have unlocked the [b]Skin Shedder[/b] achievement!","no");
INSERT INTO `notifications` VALUES("837","58","2015-03-09 18:38:30","You have unlocked the [b]Employees Only[/b] achievement!","no");
INSERT INTO `notifications` VALUES("839","3","2016-04-08 09:41:09","[user=1] likes your status.","yes");



DROP TABLE `p_inv`;

CREATE TABLE `p_inv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `contents` text NOT NULL,
  `inv_access` enum('public','private') NOT NULL DEFAULT 'private',
  `effects` text NOT NULL,
  `max_inv` int(11) NOT NULL DEFAULT '64',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `p_inv` VALUES("1","1","","private","","64");
INSERT INTO `p_inv` VALUES("2","67","","private","","64");
INSERT INTO `p_inv` VALUES("3","21","","private","","64");
INSERT INTO `p_inv` VALUES("4","69","","private","","64");
INSERT INTO `p_inv` VALUES("5","64","","private","","64");
INSERT INTO `p_inv` VALUES("6","45","","private","","64");
INSERT INTO `p_inv` VALUES("7","58","","private","","64");



DROP TABLE `p_items`;

CREATE TABLE `p_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(20) NOT NULL DEFAULT 'unknown.item',
  `about` text NOT NULL,
  `img` text NOT NULL,
  `item_type` varchar(45) NOT NULL,
  `bought` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




DROP TABLE `page_categories`;

CREATE TABLE `page_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `about` text NOT NULL,
  `userid` int(11) NOT NULL,
  `alias` varchar(25) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO `page_categories` VALUES("1","Site Info","Information about the Web site.","1","siteinfo","2014-12-08 22:00:03","0");
INSERT INTO `page_categories` VALUES("8","YouTube","Any and all things video.","1","youtube","2015-02-25 06:59:03","0");
INSERT INTO `page_categories` VALUES("10","Articles","For articles.","1","articles","2015-03-09 15:22:52","0");
INSERT INTO `page_categories` VALUES("11","Reviews","For reviews.","1","reviews","2015-03-09 15:23:03","0");
INSERT INTO `page_categories` VALUES("12","Tips and Tricks","For random help with random things on random games by random people! Wee!","1","tipsntricks","2015-03-11 07:10:21","0");
INSERT INTO `page_categories` VALUES("13","Web Apps","For web site applications.","1","webapps","2015-03-11 07:52:25","0");
INSERT INTO `page_categories` VALUES("14","Gaming","This is where gaming articles should go.","1","destiny","2015-03-11 08:54:09","10");
INSERT INTO `page_categories` VALUES("15","Community","For articles about the site community.","1","comm","2015-03-11 12:16:28","10");
INSERT INTO `page_categories` VALUES("16","Technology","Anything relating to technological articles.","1","tech","2015-03-11 12:17:09","10");
INSERT INTO `page_categories` VALUES("17","Miscallaneous","For any articles that don\'t fit in with the other categories.","1","misc","2015-03-11 12:17:47","10");



DROP TABLE `page_comments`;

CREATE TABLE `page_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `post` text NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;




DROP TABLE `page_ctgs`;

CREATE TABLE `page_ctgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pagename` text NOT NULL,
  `page_id` varchar(15) NOT NULL,
  `category` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `comments` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(80) NOT NULL,
  `pc_id` int(11) NOT NULL,
  `alias` varchar(80) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `tags` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO `pages` VALUES("1","1","2014-12-08 20:51:51","","","","<b>TO DO: </b>Rewrite this page to reflect the site\'s new content and direction.<br>","1","About Us","1","about","0","");
INSERT INTO `pages` VALUES("2","1","2014-12-08 22:21:56","","","","We have multiple forms of contact, but the best way to do so is below:\n\n<br><br>\n\n${mod:message}","1","Contact Us","1","contact","1","contact, message, send, form, affiliate, partner");
INSERT INTO `pages` VALUES("7","1","2014-12-09 00:30:17","","","","     ##title## stores users\' information in a secure database, including but not limited to their username, encrypted password, email, security question, and the provided contact information . This information is accessible for the owners only, but the users\' passwords are encrypted, using a one-way encryption system, meaning that even admins will not be able to tell what it is. Upon loss of password, Zollernverse Gaming has an option to send that user an e-mail, not to give them their password, but to have them reset it. Note that usually, the account must have a security question set for it already in order to be able to request a reset password link, though this varies. This MUST be set up before changing your password. Zollernverse Gaming\'s staff will NEVER ask you for your password, and will never take or view any of your information. If you believe this right has been violated, then please contact <a href=\"mailto:admin@dreamspand.com\">the owner</a>. Zollernverse Gaming stores IP addresses, using a complex network of respective usernames. The web site\'s security is state-of-the-art, and only staff and admins may view IP addresses, purely for security purposes. We do not share any private information that is provided. Zollernverse also offers the feature of blocking unwanted contact with certain users, as well as a \'Friends Only\' setting, to better support those who need more privacy.","1","Privacy Policy","1","policy","1","privacy, policy, secure, database, information, security");
INSERT INTO `pages` VALUES("13","1","2015-02-25 07:02:27","","","","&nbsp;Check out the <a target=\"_blank\" title=\"Avenging Revenants\" href=\"https://www.youtube.com/channel/UCl-u6cPQ1lpD_RvzA_SsN7A\">Avenging Revenants</a> on <a target=\"_blank\" title=\"YouTube\" href=\"http://www.youtube.com\">YouTube</a>! We\'re a Let\'s Play channel for (currently) the PS4, with over 50+ videos and clips from various games. It\'s always fun and we never rehearse; it\'s all on-the-spot commentary. Occasionally some stuff will get edited out, but even then that\'s rare. Support us if you can and we may even let you appear on our show. We\'ll even hold contests for such things sometimes.<br><br>You can find us online on PSN with these names:<br><br>ZollernWolf<br>nascarmpfan<br>CrazyHand89<br>B-Fresh_TYS<br><br>We hope to hear from you!<br>","1","Avenging Revenants","8","avengingrevenants","1","youtube, let\'s play, avenging revenants, avenger, revenant, fun, funny, game, gaming");
INSERT INTO `pages` VALUES("12","1","2014-12-22 10:39:08","","","","These are the Terms of Use for Zollernverse. They are non-negotiable, \n\nand any user of the site is automatically bound by them. This page is \n\nsubject to change with or without notice. Only Zollern Wolf and Mike \n\nFettel are allowed to edit this page. Please adhere to the below terms, \n\nand all will be well. Thank you.<br><strong><strong><strong><br>? Age Restrictions: </strong></strong></strong>It\n\n is preferred that any registered user or visitor of Zollernverse be at \n\nleast 13 years of age at the time of registration. However, it is also \n\nacceptable for a user or visitor to browse or register for the site \n\nwhile A.) under adult supervision or, if regsitering, B.) use the \n\nadult\'s e-mail to sign-up. These conditions are nonnegotiable for those \n\nunder 13. All content posted on this Web site is PG-13 unless explicitly\n\n stated otherwise.<strong><br><br>? Community</strong>: Zollernverse is \n\nnot responsible for any loss of property of information. It is the \n\nuser\'s responsibility what happens to said property or information. \n\nPasswords are never asked for and should never be shared with anyone \n\nelse, even staff. You will not hold Zollernverse liable for any negative\n\n encounter or experience that may occur. We are not responsible for a \n\nuser\'s derogatory behavior. By registering for this community, you \n\nhereby specify that you are at least 13 years of age and will not lie \n\nabout your date of birth. You certify that you are legally applicable to\n\n fill out a form, whether it be manual transcript or an online \n\nregistration form. You will not post sexual-or violent-themed content on\n\n this forum. All content on this forum is PG-13 unless specified \n\notherwise. You also agree that these terms are subject to change without\n\n notice and that by registering with this community, you are making an \n\nagreement with all of the terms listed. Under the <i><b>Federal Communications Decency Act of 1996</b></i>,\n\n Zollernvesre is not responsible for any defamatory comments made to you\n\n from any other user. Zollernverse has privacy settings that can block \n\nunwanted contact, and should it continue, further action can be taken by\n\n the staff. It is unlawful to take that which does not belong to you to \n\nredistribute and/or claim it as your own. Failure to abide by this will \n\nresult in immediate termination of your account.\n\n<br><br><strong><strong>? Disclaimer: </strong></strong>Any and all \n\nmishaps regarding misinformation or unpleasant experiences are the \n\nresponsibility and liability of the users and/or visitors involved in \n\nit. Zollernverse is not responsible for any unpleasant experience or \n\nunfavorable situation.<br><br><strong><strong>? Ownership: </strong></strong>All content \n\ndisplayed on this Web site either: A.) belongs to its respective authors\n\n of the Web site, B.) the user(s) who created it, C.) are public domain,\n\n D.) is currently in the process of being created/published, or E.) \n\nbelongs to a third-party Web site, application, user or server in which \n\nno ownership by <i>Zollernverse</i> is claimed.<br><br>\n\n<strong><strong>? </strong>Peer &amp; External Web Site Interaction</strong>:\n\n Zollernverse is not interested in participating in \"wars\" or other \n\nforms of immature competitions with other sites or forums. Any \n\naggressive or otherwise ill-mannered behavior towards the site or its \n\nmembers will not be tolerated, whether directly or indirectly. \n\nZollernverse encourages interacting with fellow members, but only in \n\ndoing so respectfully. We do not endorse mocking a select individual or \n\ngroup, nor do we endorse any form of discrimination, and therefore it \n\nwill not be tolerated.\n\n<br><br>\n\n<strong><strong>? </strong>Policy On Illegal Activity</strong>: Any form\n\n of illegal activity being discussed or encouraged is not allowed. \n\nZollernverse does not endorse any form of it, and if it is sighted, the \n\naccused will have their account permanently terminated and will be \n\nsuspended indefinitely.<br><br><strong><strong>? Rules of Use:</strong></strong> The Rules of Use are separate from the User Acceptance section in that they govern the <i>outside</i>\n\n usage regarding the content of this Web site. Under no circumstance \n\nshould any image, script, stylesheet or file from Zollernverse be used \n\noutside of Zollernverse\'s environment. This steals bandwidth and harms \n\nthe Web site\'s overall productivity and up-time. Only affiliates and \n\nother partnered sites should make use of this Web site\'s content and \n\neven then it should only use the provided mini-banner used for \n\nsite-to-site linking. Contact between Web site admins is required in \n\norder to add an \"Exception Site.\" Zollernverse should also never be used\n\n in an IFRAME tag or anything resembling an IFRAME tag as this also \n\nsteals bandwidth.<br><strong><strong></strong></strong><br>\n\n<strong>? Security</strong>: You will not breach or attempt to breach \n\nany of the Web site\'s systems or its functionality. Failure to adhere to\n\n \n\nthis very strict and non-negotiable rule will result in not only \n\npermanent termination of your account and suspension of service \n\nindefinitely, but law enforcement measures will be implemented, as \n\nexploitation of a web site\'s systems, accounts, functionality, content, \n\nor otherwise defamation of the web site, is considered a federal \n\noffense, and will be treated as such, <strong>without</strong> hesitation.\n\n<br><br><strong>? User Acceptance:</strong> Usage of this site \n\nautomatically stipulates that the user or visitor is bound by this terms\n\n of service and its conditions. By using this Web site, including but \n\nnot limited to filling out its forms and browsing its pages, you assert \n\nthat you are at least either A.) 13 years of age, or B.) are \n\nbrowsing/using the site under parental or otherwise <i>responsible</i> \n\nadult supervision. Failure to abide by these terms could lead to \n\ntermination of the offending account. Under no circumstances can these \n\nterms be redacted or otherwise manipulated through \"loop-holes.\"<br><br>\n\n** These terms are subject to change without notice.","1","Terms of Service","1","tos","1","terms of service, tos, usage, use, accept, acceptance, rules, guidelines, information, legal, disclaimer, copyright");
INSERT INTO `pages` VALUES("14","1","2015-02-25 07:10:23","","","","<a target=\"_blank\" title=\"Doom Finger\" href=\"https://www.youtube.com/channel/UC6GHcbzgnBMsPU7Euhv_ohw\">Doom Finger</a> is another Let\'s Play channel featuring Logic and RakuBaku, one of our partners for our own <a target=\"_blank\" title=\"YouTube\" href=\"http://www.youtube.com\">YouTube</a> channel. Check out their hours worth of hilarity and wide variety of gaming videos. The videos are sometimes edited but all of the commentary is on-the-spot. Their videos will cheer you up and make you laugh like you\'ve never laughed before. Check them out and tell them what you think.<br>","1","Doom Finger","8","doomfinger","1","youtube, let\'s play, doom finger, doom, finger, fun, funny, game, gaming");
INSERT INTO `pages` VALUES("18","58","2015-03-09 18:46:39","","","","&nbsp;<!--[if gte mso 9]><xml>\n\n <o:OfficeDocumentSettings>\n\n  <o:AllowPNG/>\n\n </o:OfficeDocumentSettings>\n\n</xml><![endif]--><!--[if gte mso 9]><xml>\n\n <w:WordDocument>\n\n  <w:View>Normal</w:View>\n\n  <w:Zoom>0</w:Zoom>\n\n  <w:TrackMoves/>\n\n  <w:TrackFormatting/>\n\n  <w:PunctuationKerning/>\n\n  <w:ValidateAgainstSchemas/>\n\n  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>\n\n  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>\n\n  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>\n\n  <w:DoNotPromoteQF/>\n\n  <w:LidThemeOther>EN-US</w:LidThemeOther>\n\n  <w:LidThemeAsian>JA</w:LidThemeAsian>\n\n  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>\n\n  <w:Compatibility>\n\n   <w:BreakWrappedTables/>\n\n   <w:SnapToGridInCell/>\n\n   <w:WrapTextWithPunct/>\n\n   <w:UseAsianBreakRules/>\n\n   <w:DontGrowAutofit/>\n\n   <w:SplitPgBreakAndParaMark/>\n\n   <w:EnableOpenTypeKerning/>\n\n   <w:DontFlipMirrorIndents/>\n\n   <w:OverrideTableStyleHps/>\n\n   <w:UseFELayout/>\n\n  </w:Compatibility>\n\n  <m:mathPr>\n\n   <m:mathFont m:val=\"Cambria Math\"/>\n\n   <m:brkBin m:val=\"before\"/>\n\n   <m:brkBinSub m:val=\"--\"/>\n\n   <m:smallFrac m:val=\"off\"/>\n\n   <m:dispDef/>\n\n   <m:lMargin m:val=\"0\"/>\n\n   <m:rMargin m:val=\"0\"/>\n\n   <m:defJc m:val=\"centerGroup\"/>\n\n   <m:wrapIndent m:val=\"1440\"/>\n\n   <m:intLim m:val=\"subSup\"/>\n\n   <m:naryLim m:val=\"undOvr\"/>\n\n  </m:mathPr></w:WordDocument>\n\n</xml><![endif]--><!--[if gte mso 9]><xml>\n\n <w:LatentStyles DefLockedState=\"false\" DefUnhideWhenUsed=\"true\"\n\n  DefSemiHidden=\"true\" DefQFormat=\"false\" DefPriority=\"99\"\n\n  LatentStyleCount=\"267\">\n\n  <w:LsdException Locked=\"false\" Priority=\"0\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"Normal\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"heading 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 7\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 8\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 9\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"39\" Name=\"toc 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"39\" Name=\"toc 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"39\" Name=\"toc 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"39\" Name=\"toc 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"39\" Name=\"toc 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"39\" Name=\"toc 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"39\" Name=\"toc 7\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"39\" Name=\"toc 8\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"39\" Name=\"toc 9\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"35\" QFormat=\"true\" Name=\"caption\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"10\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"Title\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"1\" Name=\"Default Paragraph Font\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"11\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"Subtitle\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"22\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"Strong\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"20\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"Emphasis\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"59\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Table Grid\"/>\n\n  <w:LsdException Locked=\"false\" UnhideWhenUsed=\"false\" Name=\"Placeholder Text\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"1\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"No Spacing\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"60\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Shading\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"61\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light List\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"62\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Grid\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"63\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"64\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"65\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"66\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"67\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"68\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"69\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"70\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Dark List\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"71\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Shading\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"72\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful List\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"73\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Grid\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"60\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Shading Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"61\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light List Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"62\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Grid Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"63\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 1 Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"64\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 2 Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"65\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 1 Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" UnhideWhenUsed=\"false\" Name=\"Revision\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"34\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"List Paragraph\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"29\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"Quote\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"30\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"Intense Quote\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"66\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 2 Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"67\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 1 Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"68\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 2 Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"69\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 3 Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"70\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Dark List Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"71\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Shading Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"72\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful List Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"73\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Grid Accent 1\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"60\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Shading Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"61\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light List Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"62\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Grid Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"63\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 1 Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"64\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 2 Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"65\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 1 Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"66\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 2 Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"67\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 1 Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"68\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 2 Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"69\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 3 Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"70\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Dark List Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"71\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Shading Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"72\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful List Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"73\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Grid Accent 2\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"60\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Shading Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"61\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light List Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"62\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Grid Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"63\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 1 Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"64\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 2 Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"65\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 1 Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"66\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 2 Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"67\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 1 Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"68\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 2 Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"69\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 3 Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"70\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Dark List Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"71\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Shading Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"72\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful List Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"73\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Grid Accent 3\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"60\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Shading Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"61\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light List Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"62\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Grid Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"63\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 1 Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"64\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 2 Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"65\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 1 Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"66\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 2 Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"67\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 1 Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"68\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 2 Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"69\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 3 Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"70\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Dark List Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"71\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Shading Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"72\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful List Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"73\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Grid Accent 4\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"60\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Shading Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"61\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light List Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"62\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Grid Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"63\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 1 Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"64\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 2 Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"65\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 1 Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"66\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 2 Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"67\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 1 Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"68\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 2 Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"69\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 3 Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"70\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Dark List Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"71\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Shading Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"72\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful List Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"73\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Grid Accent 5\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"60\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Shading Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"61\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light List Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"62\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Light Grid Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"63\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 1 Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"64\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Shading 2 Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"65\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 1 Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"66\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium List 2 Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"67\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 1 Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"68\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 2 Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"69\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Medium Grid 3 Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"70\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Dark List Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"71\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Shading Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"72\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful List Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"73\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" Name=\"Colorful Grid Accent 6\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"19\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"Subtle Emphasis\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"21\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"Intense Emphasis\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"31\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"Subtle Reference\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"32\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"Intense Reference\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"33\" SemiHidden=\"false\"\n\n   UnhideWhenUsed=\"false\" QFormat=\"true\" Name=\"Book Title\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"37\" Name=\"Bibliography\"/>\n\n  <w:LsdException Locked=\"false\" Priority=\"39\" QFormat=\"true\" Name=\"TOC Heading\"/>\n\n </w:LatentStyles>\n\n</xml><![endif]--><!--[if gte mso 10]>\n\n<style>\n\n /* Style Definitions */\n\n table.MsoNormalTable\n\n	{mso-style-name:\"Table Normal\";\n\n	mso-tstyle-rowband-size:0;\n\n	mso-tstyle-colband-size:0;\n\n	mso-style-noshow:yes;\n\n	mso-style-priority:99;\n\n	mso-style-parent:\"\";\n\n	mso-padding-alt:0in 5.4pt 0in 5.4pt;\n\n	mso-para-margin:0in;\n\n	mso-para-margin-bottom:.0001pt;\n\n	line-height:200%;\n\n	mso-pagination:widow-orphan;\n\n	font-size:11.0pt;\n\n	font-family:\"Calibri\",\"sans-serif\";\n\n	mso-ascii-font-family:Calibri;\n\n	mso-ascii-theme-font:minor-latin;\n\n	mso-hansi-font-family:Calibri;\n\n	mso-hansi-theme-font:minor-latin;}\n\n</style>\n\n<![endif]-->\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:20.0pt\">Destiny</span></p>\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:20.0pt\">&nbsp;</span></p>\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:12.0pt\">I\n\nfigured I like to take a look at Destiny now that it?s been out for some time\n\nand has had time to develop. Some of the changes Bungie has brought to their first\n\nmajor franchise since Halo were welcome, while others were hated. Destiny is\n\nfor sure an enjoyable First Person Shooting game that mixes in elements of a MMORPG\n\nI wouldn?t go as far as to call it an MMO still. At the time of this writing\n\nthere are still many elements missing for me to consider it an MMO like group\n\nfinding features for their raids, a trading system, and many other things I\n\ncould list. I?ll always look at two things when I review a game, its story and\n\nits mechanics. I look at this from a more casual gamer approach as I don?t do\n\nthis for a living, so here we go.</span></p>\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:12.0pt\">&nbsp;</span></p>\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:20.0pt\">Story\n\n(Terrible)</span></p>\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:12.0pt\">&nbsp;</span></p>\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:12.0pt\">If\n\nyou want a game with a good story, I suggest you look elsewhere. From the very\n\nstart they do little to explain who you are and what your job is. Your\n\ncompanion for this game, referred to as a ghost, simply revives you and says\n\nyou need to get moving. Nothing more, not even giving you time to ask\n\nquestions. I don?t know about you but if I had been dead for a few hundred\n\nyears I would be a bit hesitant to follow a floating ball of light and metal.\n\nAs the story drags on, they still don?t explain much. Every time my character\n\nwould ask a question, they simply replied I don?t have time to explain or I\n\ncould tell you, but I won?t. Really Bungie, a $500 million dollar franchise and\n\nyou couldn?t come up with a story that at least makes sense?</span></p>\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:12.0pt\">&nbsp;</span></p>\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:20.0pt\">Mechanics\n\n(Best damn thing they offer)</span></p>\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:20.0pt\">&nbsp;</span></p>\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:12.0pt\">The\n\nmechanics of this game will not let you down. Bungie has spent years refining their\n\nskills in making an FPS and they don?t disappoint with Destiny. The added\n\nskills that each of the different classes have add a new element. You have the\n\nhunters capable of dishing out damage from both afar and close up. The first ability\n\nGolden Gun gives you 3 powerful shots that deal massive damage and the second\n\none arc blade makes them tougher to kill and great potential for close up\n\ndamage. The Arc Blade class can also act as a stealth type class, as they can\n\ngo invisible when needed and do whatever it is hunters do. You have your\n\nwarlocks who can play a great support role in a fireteam with their abilities\n\nand act as a sort of middle ground between hunters and titan to me. Their first\n\nability Nova Bomb is useful for taking out large groups and their second\n\nability Radiance, helps them to generate orbs of light to support teammates and\n\neven act as a second chance as it?s the only class with the ability to self-resurrect\n\nthemselves when they die. The titans are your tanks and meant to help control\n\ncrowds. Their first ability is Fist of Havoc, which is a massive ?ground pound?\n\nmy friend likes to refer to it as and deals out damage in an area. The second\n\nis the Ward of Dawn which protects the titan and their allies from pretty much\n\nanything that is coming their way as well as other buffs such as damage\n\nincreases and an extra shield.</span></p>\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:20.0pt\">Overall\n\n(Average)</span></p>\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:20.0pt\">&nbsp;</span></p>\n\n\n\n<p class=\"MsoNormal\" style=\"line-height:normal\"><span style=\"font-size:12.0pt\">While\n\nyes Destiny is fun for me to play, it?s still just an average game to me after\n\nthe hype around it died down. They continue to support it through patches\n\nthankfully, but it?s not enough to keep me around. It?s still a major grind\n\nfest, which I don?t mind, but can be an offset for many others. Their first\n\nDLC, the Dark Below, was lacking for the $20 price they ask for. Three story\n\nmissions, one strike, one raid, and a three crucible maps (which I don?t really\n\nplay to begin with) and with this DLC they now also lock out many features to\n\npeople who don?t have the DLC we had since day 1. The weekly nightfall and\n\nheroic strikes are sometimes DLC exclusive and daily missions will be DLC exclusive\n\nas well. I already bought the season pass for these two DLCs so I already had\n\nbeen suckered into it but from here on out I would be more cautious as they are\n\ngoing down a dangerous path. Until a better game comes out I?ll still be on\n\nDestiny, but once better games come along, I won?t be surprised if it starts\n\ncollecting dust for a long time until they do it right.</span></p>\n\n\n\n","1","Review of Destiny","11","destiny","1","Destiny,Bungie,Review,CrazyHand89,masterhand89,Zollernverse,hokage234,video games,ps,xbox");
INSERT INTO `pages` VALUES("19","1","2015-03-11 07:55:09","","","","&nbsp;XCrypt Secure is a Web application used to generate complex and hard-to-crack passwords. It was created by Zollern Wolf and can be accessed at the below link:<br><br><a href=\"http://www.zollernverse.org/xcrypt/index.php\" onclick=\"window.open(this.href);return false;\">http://www.zollernverse.org/xcrypt/index.php</a><br>","1","XCrypt Secure","13","xcrypt","1","xcrypt, secure, security, password, generation, generator, help, web app");
INSERT INTO `pages` VALUES("20","1","2015-03-11 11:59:19","","","","Below is a list of helpful tips for you to complete Destiny bounties easier and faster. :)<br><strong>&nbsp; <font size=\"4\">? Kill 20 or more enemies with your super</font></strong><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>There is a location on Earth in The Steppes (which is the spawn area) in which 6 - 7 Fallen will spawn. If you run into that building (the largest one right in the center), and go down the stairs, there will be two rooms. One behind you will be a dead-end where a loot chest will sometimes spawn. Another one in front of you will require you to go down-stairs again. Once downstairs, stand in the left-hand corner at the bottom of the stairs, against the wall. Once you see your radar light up red in the top-right-hand-corner, they have spawned. Kill them using your conventional weapons until your Super charges, and then <strong>FOW!</strong> Dead! Depending on what Super you used, you should generate anywhere from 6 - 8 orbs of light (sometimes more for Warlocks and rarely Hunters).<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>NOTE:</strong> Hunters doing this bounty should consider using the Gunslinger sub-class as this makes it go by much faster with the help of friends, using each others\' orbs of light to charge - Bladedancer generates 1 (or 2, if you\'re lucky) every other kill.Warlocks should use the Voidwalker class when doing this bounty, as kills while under Radiance in the Sunslinger class don\'t seem to count. Titans should, quite obviously, use their Striker class as Defender does not have an offensive mode.<br>","1","Destiny Bounties","14","destinybounties","1","destiny, bounty, bounties, ps4, playstation, game, gaming, mmorpg, shooter, fps");



DROP TABLE `pkeys`;

CREATE TABLE `pkeys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pkey` text NOT NULL,
  `byuser` int(11) NOT NULL,
  `added_when` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cname` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `pm`;

CREATE TABLE `pm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(30) NOT NULL,
  `touser` int(11) NOT NULL,
  `fromuser` int(11) NOT NULL,
  `message` text NOT NULL,
  `unread` enum('yes','no') NOT NULL DEFAULT 'yes',
  `sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `saved` tinyint(1) NOT NULL DEFAULT '0',
  `trashed` tinyint(1) NOT NULL DEFAULT '0',
  `urgent` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=671 DEFAULT CHARSET=latin1;

INSERT INTO `pm` VALUES("635","Opened~","60","59","It\\\'s kinda half done, but it\\\'s good enough for now,\n\n\n\nchaocityzone[.]proboards[.]com\n\n\n\nChao city was taken or unavailable or something but yeah whatever man :V","no","2013-09-15 12:40:26","0","0","0");
INSERT INTO `pm` VALUES("636","Tekkit server","16","1","says the account was suspended","no","2013-12-24 10:22:14","0","0","0");
INSERT INTO `pm` VALUES("637","Tekkit 1.6.4","1","5","http://forums.technicpack.net/threads/help-test-tekkit-1-2-0-1-6-4-finally.56498/\n\n\n\n\n\nit explains there what you need to do. ","no","2014-01-14 11:20:00","0","0","0");
INSERT INTO `pm` VALUES("638","Tekkit 1.6.4","5","1","Thanks","no","2014-01-15 11:02:39","0","1","0");
INSERT INTO `pm` VALUES("639","Mods","1","5","http://adf.ly/crfhi","no","2014-01-30 19:56:35","0","0","0");
INSERT INTO `pm` VALUES("640","Hey","2","1","Hey bro hope you\\\'re havin a good day / night, whatever you wanna call it lol. Danny told me you\\\'re working so I figured I\\\'d send you a message on here. I wanted to know if you wanted to get back to working on the site again and posting on here. Danny\\\'s been working really hard so we owe it to him to try. Plus we need it for the servers.","no","2014-02-06 16:59:42","0","0","0");
INSERT INTO `pm` VALUES("641","Welcome!","61","3","Hello there![br][br]We\'re very excited to have you here at DreamSpand Gaming. Welcome to the forums, [user=61]. I am DreamSpand, the robot of the site. I also have a brother here named Bazibzib, but he\'s not as active as I am. It\'s disappointing but, hey, what can ya do, right?[br][br]Err.. anyway, before you do anything else, please read our [url=?act=topic&id=217]Rules[/url]. There aren\'t very many and it\'s really just basic stuff anyway, but still, we\'d really appreciate it if you could have a look really quick. If you have any questions, post them in the Front Office board and we will do our best to assist you. I hope you have a wonderful stay here!","no","2014-03-06 15:43:47","0","0","0");
INSERT INTO `pm` VALUES("642","OpenPeripherals","1","5","http://www.openmods.info/\n\n\n\nOpenPeripheral Core\n\nOpenPeripheral Addons\n\nOpenModsLib","no","2014-03-19 15:46:21","0","0","0");
INSERT INTO `pm` VALUES("643","I just though I\\\'d let you kno","1","54","In case you ever wanna keep in touch beyond just this site\n\n\n\nI got a Facebook account =0\n\n\n\nhttps://www.facebook.com/zonic.thedgehog","no","2014-03-29 13:48:34","0","0","0");
INSERT INTO `pm` VALUES("644","TEKKIT UPDATES","2","1","http://dreamspand.com/forum.php?act=updates&id=107","no","2014-05-06 15:35:22","0","0","1");
INSERT INTO `pm` VALUES("645","Mod Updates","2","1","http://dreamspand.com/forum.php?act=updates&id=107\n\n\n\nThese are the updates we talked about last night, but this is just a whole gooblygarp of news and such that\\\'s definitely worth a read, also Sammy was asking if anyone\\\'s into Magic: The Gathering and I told him I think you are so yeah.\n\n\n\n","no","2014-05-06 15:36:11","0","0","0");
INSERT INTO `pm` VALUES("646","-No Subject-","5","1","http://dreamspand.com/forum.php?act=updates&id=107\n\n\n\nThese are the updates we talked about last night, but this is just a whole gooblygarp of news and such that\\\'s definitely worth a read, also Sammy was asking if anyone\\\'s into Magic: The Gathering and I told him I think you are so yeah.\n\n\n\n** Sent this to Mike by accident at first..","no","2014-05-06 15:38:06","0","1","0");
INSERT INTO `pm` VALUES("647","MC Servers / Connection Issues","5","1","Just thought I\\\'d let you know (then you can let everyone else know) that MC\\\'s servers are down. All 3 are up, but I (nor Autumn) can connect to any of them right now.","no","2014-05-06 16:42:10","1","0","0");
INSERT INTO `pm` VALUES("648","-No Subject-","1","5","Im not really into although it seems a tad interesting. There are a group of people who do play magic at campus and the League of legends group (my group) does have some friendly talk from time to time as we travel to each other\\\'s group.\n","no","2014-05-06 19:02:19","0","0","0");
INSERT INTO `pm` VALUES("649","Welcome!","62","3","Hello there![br][br]We\'re very excited to have you here at DreamSpand Gaming, a friendly, Minecraft community. Welcome to the forums, [user=62]. I am DreamSpand, the robot of the site. I also have a brother here named Bazibzib, but he\'s not as active as I am. It\'s disappointing but, hey, what can ya do, right?[br][br]Err.. anyway, before you do anything else, please read our [url=?act=topic&id=217]Rules[/url]. There aren\'t very many and it\'s really just basic stuff anyway, but still, we\'d really appreciate it if you could have a look really quick. If you have any questions, post them in the Management board and we will do our best to assist you. I hope you have a wonderful stay here!","no","2014-06-23 19:16:52","0","0","0");
INSERT INTO `pm` VALUES("650","-No Subject-","2","1","Dude, why are you not responding to me? Did I do something?","no","2014-06-26 18:57:23","0","0","0");
INSERT INTO `pm` VALUES("651","Welcome!","63","3","Hello there![br][br]We\'re very excited to have you here at DreamSpand Gaming, a friendly, Minecraft community. Welcome to the forums, [user=63]. I am DreamSpand, the robot of the site. I also have a brother here named Bazibzib, but he\'s not as active as I am. It\'s disappointing but, hey, what can ya do, right?[br][br]Err.. anyway, before you do anything else, please read our [url=?act=topic&id=217]Rules[/url]. There aren\'t very many and it\'s really just basic stuff anyway, but still, we\'d really appreciate it if you could have a look really quick. If you have any questions, post them in the Management board and we will do our best to assist you. I hope you have a wonderful stay here!","yes","2014-10-14 16:47:04","0","0","0");
INSERT INTO `pm` VALUES("652","Welcome!","64","3","Hello there![br][br]We\'re very excited to have you here at DreamSpand Gaming, a friendly, Minecraft community. Welcome to the forums, [user=64]. I am DreamSpand, the robot of the site. I also have a brother here named Bazibzib, but he\'s not as active as I am. It\'s disappointing but, hey, what can ya do, right?[br][br]Err.. anyway, before you do anything else, please read our [url=?act=topic&id=217]Rules[/url]. There aren\'t very many and it\'s really just basic stuff anyway, but still, we\'d really appreciate it if you could have a look really quick. If you have any questions, post them in the Management board and we will do our best to assist you. I hope you have a wonderful stay here!","no","2014-11-09 09:38:38","0","0","0");
INSERT INTO `pm` VALUES("653","Welcome!","65","3","Hello there![br][br]We\'re very excited to have you here at DreamSpand Gaming, a friendly, Minecraft community. Welcome to the forums, [user=65]. I am DreamSpand, the robot of the site. I also have a brother here named Bazibzib, but he\'s not as active as I am. It\'s disappointing but, hey, what can ya do, right?[br][br]Err.. anyway, before you do anything else, please read our [url=?act=topic&id=217]Rules[/url]. There aren\'t very many and it\'s really just basic stuff anyway, but still, we\'d really appreciate it if you could have a look really quick. If you have any questions, post them in the Management board and we will do our best to assist you. I hope you have a wonderful stay here!","no","2014-11-22 12:09:55","0","0","0");
INSERT INTO `pm` VALUES("654","TChao\\\'s Skype","1","65","Skype: TChao Chaos\n\nEmail: chaostchao@yahoo.com\n\n\n\nDon\\\'t ever bother emailing me, I don\\\'t check it unless given a heads up to do so.","no","2014-11-25 23:08:38","0","0","0");
INSERT INTO `pm` VALUES("655","TChao\\\\\\\'s Skype","65","1","http://www.dreamspand.com/mods/ServerMods.zip\n\nInstructions are inside the zipped folder, if you need any help contact me on Skype. :)","no","2014-11-28 14:39:37","0","0","0");
INSERT INTO `pm` VALUES("656","Welcome!","66","3","Hello there![br][br]We\'re very excited to have you here at DreamSpand Gaming, a friendly, Minecraft community. Welcome to the forums, [user=66]. I am DreamSpand, the robot of the site. I also have a brother here named Bazibzib, but he\'s not as active as I am. It\'s disappointing but, hey, what can ya do, right?[br][br]Err.. anyway, before you do anything else, please read our [url=?act=topic&id=217]Rules[/url]. There aren\'t very many and it\'s really just basic stuff anyway, but still, we\'d really appreciate it if you could have a look really quick. If you have any questions, post them in the Management board and we will do our best to assist you. I hope you have a wonderful stay here!","yes","2014-12-13 00:14:10","0","1","0");
INSERT INTO `pm` VALUES("657","Is this Paul?","1","66","Paul as in Chaobreederxl?","no","2014-12-13 00:15:34","0","0","0");
INSERT INTO `pm` VALUES("658","Is this Paul?","66","1","Yeah. Wow I haven\\\'t heard that name in forever, what\\\'s up?","no","2014-12-13 15:24:29","0","0","0");
INSERT INTO `pm` VALUES("659","Is this Paul?","1","66","Do you remember at all who I am? Probably not since I\\\'ve never used this handle until recently. I was LudaChao/ sweetxvictory101. My sister mentioned you yesterday (she knew we used to talk, even though it was just for like a month I think, but it was such a huge ordeal for me since I had a huge crush on you) and I decided to search you out. Took me forever to get to you--I went to chaotalk and tried to register but that was disabled, so then I found this place. I just wanted to know how you were and ask what that thing was about a few years ago when you messaged me years after not communicating. I thoughg something bad happened and just wanted to know if you were okay. Sorry that this is so weird since its been 7 years (I was like 11/12 and am now 19 going on 20). But yeah, sorry for the weirdness.","no","2014-12-13 18:38:28","0","0","0");
INSERT INTO `pm` VALUES("660","Is this Paul?","66","1","It\\\'s not weird at all, and wow. It has been forever. To be honest, I don\\\'t even remember messaging you. I mean I\\\'m sure I did, my memory just sucks. It\\\'s great to hear from you though. I\\\'ve been doin alright. Could be better, could be worse. I have a great-paying job so I\\\'m holding things together. I don\\\'t remember much from that long ago, I\\\'ve had a lot happen to me, and I mean a lot. But I\\\'m okay though, I promise. It means a lot that you care, and I never knew you had a crush on me haha. It\\\'s not weird or anything, I just never knew. What did I say in that message even? Cause I seriously don\\\'t remember. And I mean yeah a lot of bad stuff has happened but I\\\'ve made it through. This place is dead right now, hopefully not forever though. If you have a Skype, I\\\'ve been using the same one since \\\'06, which is [b]code.dragon[/b]. I don\\\'t use AIM very much but I do sometimes, it\\\'s AlphaWolf918.\n\nHow have you been?","no","2014-12-13 19:15:58","0","0","0");
INSERT INTO `pm` VALUES("661","Is this Paul?","66","1","I just noticed too, you have your gender set as male? I could\\\'ve sworn you were a girl. o.O","no","2014-12-13 20:12:29","0","0","0");
INSERT INTO `pm` VALUES("662","Is this Paul?","1","66","The message said something about you trying to make amends for something, but that\\\'s the only thing I can really remember. I think we only spoke for around 10 minutes that time. I\\\'m glad that you\\\'ve persevered through the hardships that you\\\'ve been through! It\\\'s so funny, I was going to message you back a week ago and say that I was doing fine and then my dumb-ass fainted after taking a shower and now my knees are messed up. I\\\'m walking like a 80 year old man, although he is slightly more spry than his other friends. Other than that though and the whole experience surrounding that (I had a not so good time at the hospital), I\\\'ve been good as well. I finished up my second semester at college (I didn\\\'t go in for fall last year for also dumb reasons) and got a better GPA this time around. I mean I\\\'m going through dumb, essentially existentialist BS and that line of \\\"deep thinking,\\\" or as I call it, mental quackery, has been messing me up for a while, but it\\\'s nothing terribly debilitating. So, I have Been. \n\nAnd yeah I am a girl lmao, I remember putting female up as my gender a few times but then I kept not being able to enter that code correctly to register, and I probably ended up messing it up on my last attempt at inputting it. Which definitely would happen to me! Sorry for the late reply, I\\\'ve been a lazy bones McKenzie!!","no","2014-12-19 16:24:22","0","0","0");
INSERT INTO `pm` VALUES("663","Is this Paul?","66","1","LOL that\\\'s hilarious actually with the security code thing, sorry bout that. I\\\'ll fix your entry in the database then soon. And ouch, why\\\'d you faint? Are [i]you[/i] okay? Also holy crap me too, with the deep thinking. I\\\'ve been doing that a lot lately. We should catch up some time. I mean talking on here is good too, just it would be easier on say Skype or something. xD And yeah a few years ago I was pretty messed up. I\\\'ve been through a lot, survived a lot, etc.\n\nI think this is a great Christmas gift, to hear back from you after all this time. You were the first one to really get CT up and going. Wish that could be the same here...lol but now we\\\'re grown up and boring, or I am at least. Jesus, it\\\'s been 8 or 9 years since we first met, you know that? CT was started in 2005 and I think we met very shortly after that.\n\nCollege...eh. Not a good experience for me. It was great for a while, I was the tech guy there lol for my group of friends. Everyone came to me for coding/computer help and it was great. Eventually my friends convinced me to start a petition to be a computer tutor (I had asked before but was told we didn\\\'t need one, despite pleas from the fellow students), and I got the job. Well that went all well and good, until they didn\\\'t pay me for 3 months, while all the other tutors got paid on time, the correct amount. I threatened to sue them and they told me not to come back and fired me. Luckily before that happened I found another job at GIGA Inc, and I\\\'m I.T. Support there. I just finished making them a LAN Intranet web site. My boss is awesome and I love working here. A lot of the stuff I did for the updates here, I learned while working on that local site there. I can code in 26 coding and markup languages now. Oh, and I\\\'m 24 as of the 18th of this past September. And it\\\'s fine about taking a while, I\\\'m a busy person myself so I understand. \n\nSo what\\\'s wrong with your legs anyway? Is it like osteoporosis or something, or is it something else that made you faint?\n\n(you have no idea how wide my eyes got when my spell check on Firefox said I typed that big word correctly on the first try just saying)","no","2014-12-19 16:35:05","0","0","0");
INSERT INTO `pm` VALUES("664","Is this Paul?","1","66","I\\\'m going to send a Skype contact request--not exactly sure if you will receive it just because I sent it or if it has to be a mutual add situation like the DS Friendcode, but I suppose we shall see! My picture is of Jerry Seinfeld with a mustache from the first episode of season 9. And yeah, I have to type this all on my iPod touch since I forgot my password on here and can\\\'t log in on my laptop. I am a truly gifted child. My skype stuff is the same as my email, sara.treacy95@gmail.com.","no","2014-12-19 16:46:27","0","0","0");
INSERT INTO `pm` VALUES("665","Is this Paul?","66","1","Alright well if you want you can send me a temporary password, or I can make you one, so that you can login. The site runs off of a database that I have absolute control over. Only thing I can\\\'t do is tell you what your password is because I have them encrypted with a one-way encryption string. And yeah I\\\'ll receive it. In fact I received 2 Skype requests last week from what turned out to be webcam bots but at first I thought they were you, until they replied with a suggestive link that I did not dare click. *shudder* I\\\'m about to leave work, so I\\\'ll load Skype when I get home and add you then.\n\nHere\\\'s you a temporary password (you can change it if you like): \n\n612fe4g8@7#","no","2014-12-19 16:53:09","0","0","0");
INSERT INTO `pm` VALUES("666","Is this Paul?","1","66","Thank you so much! I have no clue how I forgot my password--I literally use only two base-passwords with mild variations in the both of them, but I believe I tried all of them to no avail. I\\\'ve got it all set now, though, and it\\\'s so much nicer being on the laptop (the piece of garbage that it is...). And the reason I fainted was probably \\\"being in a hot shower for too long,\\\" according to the doctors, although I was only in there for 10 minutes. As soon as I got out I got really terrible tinnitus that essentially cut off my hearing and then my sight messed up pretty terribly. The problem with my knees is due to the fall--and even though I was/am in quite a bit of pain, they offered no painkillers, which is a little bit rude. If I had osteoporosis I\\\'d be very upset as I am very insecure about my height, especially in relation to the heights of others (the first thing I try to estimate about someone is their height in approximate inches/feet), and if I ever shrink even just one inch I will be very angry at everything lmao. \n\nAlso, coding in 26 coding and markup languages, that is literally amazing and wild. I tried to do something with CSS a few days ago (I wanted to change some banner to include someone\\\'s face in it) but I gave up in two seconds because it was so hard and I didn\\\'t understand it at all. I can\\\'t even imagine that kind of dedication and capacity for learning. I literally just made a thread of stupid pictures with my sister on Facebook, that\\\'s where my life is currently at hahahaha!\n\nSee you on Skype soon :)!","no","2014-12-19 17:18:11","0","0","0");
INSERT INTO `pm` VALUES("667","Welcome!","67","3","Hello there![br][br]We\'re very excited to have you here at ##title##, a friendly, Minecraft community. Welcome to the forums, [user=67]. I am DreamSpand, the robot of the site. I also have a brother here named Bazibzib, but he\'s not as active as I am. It\'s disappointing but, hey, what can ya do, right?[br][br]Err.. anyway, before you do anything else, please read our [url=?act=topic&id=217]Rules[/url]. There aren\'t very many and it\'s really just basic stuff anyway, but still, we\'d really appreciate it if you could have a look really quick. If you have any questions, post them in the Help Desk board and we will do our best to assist you. I hope you have a wonderful stay here!","no","2015-02-25 09:35:22","0","0","0");
INSERT INTO `pm` VALUES("668","Welcome!","68","3","Hello there![br][br]We\'re very excited to have you here at ##title##, a friendly, Minecraft community. Welcome to the forums, [user=68]. I am DreamSpand, the robot of the site. I also have a brother here named Bazibzib, but he\'s not as active as I am. It\'s disappointing but, hey, what can ya do, right?[br][br]Err.. anyway, before you do anything else, please read our [url=?act=topic&id=217]Rules[/url]. There aren\'t very many and it\'s really just basic stuff anyway, but still, we\'d really appreciate it if you could have a look really quick. If you have any questions, post them in the Help Desk board and we will do our best to assist you. I hope you have a wonderful stay here!","yes","2015-02-27 11:22:43","0","0","0");
INSERT INTO `pm` VALUES("669","Welcome!","69","3","Hello there![br][br]We\'re very excited to have you here at ##title##, a friendly, Minecraft community. Welcome to the forums, [user=69]. I am Zollernverse, the robot of the site. I also have a brother here named Bazibzib, but he\'s not as active as I am. It\'s disappointing but, hey, what can ya do, right?[br][br]Err.. anyway, before you do anything else, please read our [url=?act=topic&id=217]Rules[/url]. There aren\'t very many and it\'s really just basic stuff anyway, but still, we\'d really appreciate it if you could have a look really quick. If you have any questions, post them in the Help Desk board and we will do our best to assist you. I hope you have a wonderful stay here!","no","2015-02-27 18:44:32","0","0","0");
INSERT INTO `pm` VALUES("670","Welcome!","70","3","Hello there![br][br]We\'re very excited to have you here at Zollernverse, a friendly, gaming & tech community. Welcome to the forums, [user=70]. I am Zollernbot, the robot of the site. I also have an uncle here named Bazibzib, but he\'s not as active as I am. It\'s disappointing but, hey, what can ya do, right?[br][br]Err.. anyway, before you do anything else, please read our [url=?act=topic&id=217]Rules[/url]. There aren\'t very many and it\'s really just basic stuff anyway, but still, we\'d really appreciate it if you could have a look really quick. If you have any questions, post them in the Help Desk board and we will do our best to assist you. I hope you have a wonderful stay here! :)","yes","2015-03-16 14:55:58","0","0","0");



DROP TABLE `polls`;

CREATE TABLE `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `topic_id` int(11) NOT NULL,
  `choices` text NOT NULL,
  `hide_opts` tinyint(1) NOT NULL DEFAULT '0',
  `num_votes` int(11) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `polls` VALUES("1","What do you think about the polls?","958","|Pretty good:2|Needs work:0","0","1","0");
INSERT INTO `polls` VALUES("2","Who is your favorite profile?","1180","|Werewolf [Alpha]:0|Paxton Fettel [Mike]:1|Luigi [Mayo]:3|Zetsubou Sensei [solidbatman]:3|:0|:0|:0","0","1","0");
INSERT INTO `polls` VALUES("3","Which do you like better? (360)","1381","|Need For Speed: Most Wanted:0|Forza Horizon:0","0","1","0");
INSERT INTO `polls` VALUES("4","3 Kingdoms Adventure: What should the 3 kingdoms be? ","2016","|Woodsmen:2|Plainsmen:2|Snowmen:2|Nomads:2|Miners:4|Junglers:2","0","3","0");
INSERT INTO `polls` VALUES("5","What should we do?","2376","|Kill mike?:3|kill Paul?(on mc of course):1","0","1","1");
INSERT INTO `polls` VALUES("6","Should we Keep Enderchest Mod?","2461","|Yes:1|No:1|Undecided:0","0","1","0");



DROP TABLE `profile_comments`;

CREATE TABLE `profile_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `userid` int(11) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

INSERT INTO `profile_comments` VALUES("50","Hey ivy in case you aren\'t going to be here often where else can I find you and under what name?","59","60","2013-09-08 15:52:33");
INSERT INTO `profile_comments` VALUES("51","sense statuses aren\'t working i guess i\'ll use this for now","59","59","2013-09-09 00:11:31");
INSERT INTO `profile_comments` VALUES("52","latenight sad confession thing. i miss everyone so much. we\'re so scttered now annd those i did find i\'m too scared too talk to. what if they forgot me","59","59","2013-09-09 00:13:28");
INSERT INTO `profile_comments` VALUES("53","i probs sghouldn\'t be posting confessions when im tired but i just","59","59","2013-09-09 00:14:01");
INSERT INTO `profile_comments` VALUES("54","don\'t know what else to do","59","59","2013-09-09 00:14:27");
INSERT INTO `profile_comments` VALUES("55","Heeey buddy ol batman pal how\'s it hangin\'? Your about me worries me slightly but nonetheless good to see a familiar face for once!!","59","16","2013-09-09 23:18:24");
INSERT INTO `profile_comments` VALUES("56","Chao Island - Ivysong or xXIvysongXx.\nI always forgot my name. :L","60","60","2013-09-10 05:48:26");
INSERT INTO `profile_comments` VALUES("57","Ooooooh great. Never been to fond of that place, but I\'ll keep it in mind.","59","60","2013-09-10 08:12:02");
INSERT INTO `profile_comments` VALUES("58","I\'m fixing the status thing shortly, don\'t worry. And I miss them too. Very much. Without everyone, I never would\'ve made it to where I am with my life and finally be happy. I\'ve learned a lot from it. Maybe it\'s time to build your own dream, you know? That\'s what I did. I started something big with a lot of dreams and with the right team, it all came together. You just have to have enough ambition to do it.","1","59","2013-09-10 11:40:33");
INSERT INTO `profile_comments` VALUES("59","I\'m bored.","60","60","2013-09-11 05:51:15");
INSERT INTO `profile_comments` VALUES("60","test","1","1","2013-09-11 18:55:45");
INSERT INTO `profile_comments` VALUES("61","BEEP","5","1","2014-01-17 16:47:22");
INSERT INTO `profile_comments` VALUES("62","meep\n","5","1","2014-02-07 13:56:34");
INSERT INTO `profile_comments` VALUES("63","grwawr","1","5","2014-02-27 15:22:05");
INSERT INTO `profile_comments` VALUES("64","derp","1","45","2014-03-06 15:13:28");
INSERT INTO `profile_comments` VALUES("65","you still haven\'t accepted my friend request lol","1","2","2014-06-17 16:40:37");
INSERT INTO `profile_comments` VALUES("66","sup brudda","1","3","2015-02-25 11:18:36");
INSERT INTO `profile_comments` VALUES("67","wake up!","1","3","2015-03-02 12:38:14");



DROP TABLE `ranks`;

CREATE TABLE `ranks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `posts` int(11) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

INSERT INTO `ranks` VALUES("1","Private","30","2012-06-07 14:34:57","1");
INSERT INTO `ranks` VALUES("2","Newcomer","0","2012-06-07 14:35:04","1");
INSERT INTO `ranks` VALUES("3","Corporal","50","2012-06-07 14:35:18","1");
INSERT INTO `ranks` VALUES("4","Sergeant","90","2012-06-07 14:38:46","1");
INSERT INTO `ranks` VALUES("5","Lieutennant","120","2012-06-07 14:38:46","1");
INSERT INTO `ranks` VALUES("6","Captain","200","2012-06-07 14:38:46","1");
INSERT INTO `ranks` VALUES("7","Major","350","2012-06-07 14:38:46","1");
INSERT INTO `ranks` VALUES("8","Commander","500","2012-06-07 14:41:39","1");
INSERT INTO `ranks` VALUES("9","Forthcomer","700","2012-06-07 14:41:39","1");
INSERT INTO `ranks` VALUES("10","Observer","850","2012-06-07 14:41:39","1");
INSERT INTO `ranks` VALUES("11","Reaper","1000","2012-06-07 14:41:39","1");
INSERT INTO `ranks` VALUES("12","Lt Colonel","650","2012-06-07 14:43:00","1");
INSERT INTO `ranks` VALUES("13","Elite","1500","2012-06-07 14:43:00","1");
INSERT INTO `ranks` VALUES("14","Berserker","2000","2012-06-07 14:46:52","1");
INSERT INTO `ranks` VALUES("15","Forerunner","2500","2012-06-07 14:46:52","1");
INSERT INTO `ranks` VALUES("16","Promethean","3500","2012-06-07 14:46:52","1");
INSERT INTO `ranks` VALUES("17","Centaurian","3700","2012-06-07 14:46:52","1");
INSERT INTO `ranks` VALUES("18","Librarian","5000","2012-06-07 14:46:52","1");
INSERT INTO `ranks` VALUES("19","Galaxian","5500","2012-06-07 14:50:29","1");
INSERT INTO `ranks` VALUES("20","Achiever","9000","2012-06-07 14:50:29","1");
INSERT INTO `ranks` VALUES("21","Wanderer","10000","2012-06-07 14:50:29","1");
INSERT INTO `ranks` VALUES("22","Resonant","10500","2012-06-07 14:50:29","1");
INSERT INTO `ranks` VALUES("23","Seeker","20000","2012-06-07 14:50:29","1");
INSERT INTO `ranks` VALUES("24","Visionary","50000","2012-06-07 14:54:17","0");
INSERT INTO `ranks` VALUES("25","Gatekeeper","50500","2012-06-07 14:54:17","0");
INSERT INTO `ranks` VALUES("26","Mythic","80000","2012-06-07 14:54:17","0");
INSERT INTO `ranks` VALUES("38","Foreignnaire","1000000","2012-06-07 15:16:22","0");
INSERT INTO `ranks` VALUES("39","Steve","5000000","2012-06-07 15:22:23","0");
INSERT INTO `ranks` VALUES("40","Recruit","15","2012-06-19 11:31:44","0");
INSERT INTO `ranks` VALUES("41","Hatchling","5","2012-06-19 11:36:58","0");
INSERT INTO `ranks` VALUES("42","Necromorph","4000","2012-10-06 18:31:52","0");



DROP TABLE `reports`;

CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `details` text NOT NULL,
  `sent_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `rg_names`;

CREATE TABLE `rg_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `rg_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `rg_names` VALUES("1","Alpha","1","2012-09-13 16:10:28");
INSERT INTO `rg_names` VALUES("2","Sam Axe","9","2012-12-01 16:14:48");



DROP TABLE `s_images`;

CREATE TABLE `s_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stext` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sessid` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `s_questions`;

CREATE TABLE `s_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `s_questions` VALUES("1","1","What was your grandmother\'s first name?","Josie");
INSERT INTO `s_questions` VALUES("2","3","Who is your brother?","Bazibzib");
INSERT INTO `s_questions` VALUES("3","2","What was your major in college?","auto/trucks");
INSERT INTO `s_questions` VALUES("4","50","What is My Favorite Movie","Pulp Fiction");
INSERT INTO `s_questions` VALUES("5","55","What\'s your favorite color?","black");
INSERT INTO `s_questions` VALUES("6","5","What\'s your full name?","Daniel Ramon Cabrera");
INSERT INTO `s_questions` VALUES("7","59","What\'s your favorite color?","teal");
INSERT INTO `s_questions` VALUES("8","61","What\'s your fist pets name?","marcell");
INSERT INTO `s_questions` VALUES("9","45","what\'s a lode sword?","no");
INSERT INTO `s_questions` VALUES("10","66","What\'s your favorite movie?","Half-Nelson");



DROP TABLE `sandbox`;

CREATE TABLE `sandbox` (
  `header` text NOT NULL,
  `footer` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `sandbox` VALUES("<script type=\"text/javascript\">\n\n<!--\n\nfunction hCell(iCell){\n\niCell.setAttribute(\"class\",\"mainbg2\");\n\n}\n\nfunction uhCell(iCell){\n\niCell.setAttribute(\"class\",\"mainbg\");\n\n}\n\nfunction showItem(){\n\n var itemID = $(\'#m\'+arguments[0]);\n\n var itemIMG = $(\'#imgItem\'+arguments[0]);\n\n itemID.slideToggle();\n\n if(itemIMG.attr(\"src\") == \"buttons/bullet_add.png\"){\n\n  itemIMG.attr(\"src\",\"buttons/delete.png\");\n\n }else{\n\n  itemIMG.attr(\"src\",\"buttons/bullet_add.png\");\n\n }\n\n}\n\n if(self.location !== top.location) {\n\n   top.location = self.location;\n\n}\n\n// -->\n\n</script>\n\n\n\n<style type=\"text/css\">\n\n.nicEdit-main {\n\n background: #fff !important;\n\n border-radius: 5px !important;\n\n color: #444;\n\n padding: 4px;\n\n}\n\n.nicEdit-main:focus {\n\n	border-color: #66afe9;\n\n	outline: 0;\n\n	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);\n\n	box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);\n\n}\n\n</style>","");



DROP TABLE `security_images`;

CREATE TABLE `security_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `insertdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `referenceid` text NOT NULL,
  `hiddentext` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=180 DEFAULT CHARSET=latin1;




DROP TABLE `sitedata`;

CREATE TABLE `sitedata` (
  `ct_order` text NOT NULL,
  `news` text NOT NULL,
  `news_speed` int(11) NOT NULL,
  `m_mode` tinyint(1) NOT NULL DEFAULT '0',
  `enable_signups` tinyint(1) NOT NULL DEFAULT '1',
  `rnames` text NOT NULL,
  `bank` bigint(20) NOT NULL,
  `message_guests` enum('yes','no') NOT NULL DEFAULT 'no',
  `limited_register` tinyint(1) NOT NULL DEFAULT '0',
  `mostusers` smallint(6) NOT NULL,
  `enable_af` tinyint(1) NOT NULL DEFAULT '1',
  `force_active` tinyint(1) NOT NULL DEFAULT '1',
  `mostuserswhen` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `server_status` enum('on','off') NOT NULL DEFAULT 'off',
  `split_ctgs` tinyint(1) NOT NULL DEFAULT '0',
  `boards_center` tinyint(1) NOT NULL DEFAULT '1',
  `forum_name` varchar(20) NOT NULL DEFAULT 'DreamSpand Forums',
  `tpp` int(11) NOT NULL DEFAULT '10',
  `ppp` int(11) NOT NULL DEFAULT '10',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `sitedata` VALUES("Social Circle,Game Room,Tech Corner,Art Corner,Staff Lounge","Welcome to Zollernverse Forums.<br />If you have questions or comments, please feel free to ask or share them.<br />Ask us about affiliation or partnership.<br />Check out Avenging Revenants on YouTube.<br />Looking for a gaming buddy, or teammate? Look around here for potential players!<br />We\'re very friendly here, and very laid back - there\'s no red tape.<br />Once you reach 100 posts, you may advertise your own site.<br />Wanna affiliate? Contact us about it and we\'ll talk.","3","0","1","admin,alphawolf,nascarmpfan,mikep1089","182640","no","0","7","1","0","2012-12-05 13:35:11","on","0","1","Zollernverse Forums","10","10","1");



DROP TABLE `skins`;

CREATE TABLE `skins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(80) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `data` text NOT NULL,
  `banner` text NOT NULL,
  `made_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO `skins` VALUES("8","1","V2","","","zverse.png","2012-11-30 12:14:07");



DROP TABLE `status_comments`;

CREATE TABLE `status_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=233 DEFAULT CHARSET=latin1;

INSERT INTO `status_comments` VALUES("4","1","73","I love that part of the scene.","2012-06-25 13:39:27");
INSERT INTO `status_comments` VALUES("5","8","74","Love those","2012-06-26 10:56:30");
INSERT INTO `status_comments` VALUES("6","2","78","what kind of stuff you drink?","2012-07-02 20:59:45");
INSERT INTO `status_comments` VALUES("7","9","78","Beer and Whiskey mainly, but I\'m flexible.","2012-07-02 22:56:08");
INSERT INTO `status_comments` VALUES("8","1","78","Lol oh Lord Mike made a new drinkin buddy. God help us all","2012-07-04 18:13:25");
INSERT INTO `status_comments` VALUES("10","8","94","And hopefully it will stay this way.","2012-07-05 09:36:02");
INSERT INTO `status_comments` VALUES("11","9","95","Whats up?","2012-07-05 12:30:18");
INSERT INTO `status_comments` VALUES("12","1","95","My mom fell at work and her arm is in a sling, nothing\'s broken but she\'s in a lot of pain.","2012-07-05 12:36:46");
INSERT INTO `status_comments` VALUES("13","9","95","Ouch, that sucks bro.","2012-07-05 12:43:33");
INSERT INTO `status_comments` VALUES("14","1","98","dying? wha? xD","2012-07-06 21:28:28");
INSERT INTO `status_comments` VALUES("15","9","98","I overate waaay too fucking much. ","2012-07-06 21:48:54");
INSERT INTO `status_comments` VALUES("16","1","98","oh haha. yeaaaah I\'ve been there too","2012-07-06 21:57:17");
INSERT INTO `status_comments` VALUES("17","9","98","And i just finished the leftovers.... God i feel bloated... I don\'t think I\'ll need to feed again for a year","2012-07-06 22:02:45");
INSERT INTO `status_comments` VALUES("18","1","98","Lmao that is EXACTLY what I said word for word after the 4th","2012-07-07 10:14:51");
INSERT INTO `status_comments` VALUES("19","9","98","Fuck right brother. I just overate again, and I have more leftovers from last night.","2012-07-07 13:33:15");
INSERT INTO `status_comments` VALUES("20","1","98","Say no to the leftovers.. They will seduce you..","2012-07-07 13:34:19");
INSERT INTO `status_comments` VALUES("21","9","98","Oh they will. Those fiendish little pieces of chicken.","2012-07-07 13:41:51");
INSERT INTO `status_comments` VALUES("22","9","131","What?","2012-07-21 09:23:39");
INSERT INTO `status_comments` VALUES("23","16","131","I enjoyed TDKR, but it was by far, the weakest of the trilogy. ","2012-07-21 12:33:36");
INSERT INTO `status_comments` VALUES("24","9","131","How so?","2012-07-21 12:37:15");
INSERT INTO `status_comments` VALUES("25","16","131","Simply, the narrative was not as tight as the first two. Also, the way in which villains play out was so much more lazy than the first films. I dont want to give out any spoilers just in case someone reads this who hasnt seen the movie, so sorry if it seems vague","2012-07-21 13:04:32");
INSERT INTO `status_comments` VALUES("26","9","131","Fair enough. What did you think of Tom Hardy\'s portrayel of Bane?","2012-07-21 17:08:49");
INSERT INTO `status_comments` VALUES("27","16","131","Loved every second of it, wished we got to see more of it. I\'ve never read any of the comics with Bane in them, so I don\'t know if it was accurate in that sense.","2012-07-21 18:31:49");
INSERT INTO `status_comments` VALUES("28","9","131","No It was pretty far off. The comic book Bane was Mexican, and wore a Luchadore mask, and was subject to drig expirements, which is why he was so strong. The film counterpart, as you know, differs from that.","2012-07-21 18:34:38");
INSERT INTO `status_comments` VALUES("29","9","131","drug*","2012-07-21 18:34:46");
INSERT INTO `status_comments` VALUES("30","16","131","Yeah, that wouldn\'t have gone over very well in the Nolan universe","2012-07-21 20:09:02");
INSERT INTO `status_comments` VALUES("31","9","131","Indeed. Still, I loved that the movie more closely resembled the classics versions of Batman, with lots of gadgets and all the awesome vehicles I.E. The Bat.","2012-07-21 20:14:50");
INSERT INTO `status_comments` VALUES("32","16","131","It was cool to see all that stuff. I take it you really enjoyed the movie eh?","2012-07-21 20:40:40");
INSERT INTO `status_comments` VALUES("33","9","131","Immensly. It was like one long 3 hour nerdgasm. Especially the ending, and that\'s one of the most important bits, and that ending was awesome.","2012-07-21 20:42:34");
INSERT INTO `status_comments` VALUES("34","16","131","I admit, the last 15 minutes of the movie was great. Sadly, the other 2.5 hours werent up to par. But, it\'s a movie, and the key is to enjoy it. It sure was enjoyable and worth the money","2012-07-21 22:32:52");
INSERT INTO `status_comments` VALUES("35","16","139","hu...human sandwhich? ","2012-07-28 17:39:23");
INSERT INTO `status_comments` VALUES("36","16","143","done","2012-07-30 20:56:58");
INSERT INTO `status_comments` VALUES("37","1","146","Cereal with beer instead of milk? Lol","2012-08-03 10:39:09");
INSERT INTO `status_comments` VALUES("38","9","146","Hell yeah","2012-08-03 17:25:31");
INSERT INTO `status_comments` VALUES("39","9","146","And I shall call it, Beereal","2012-08-03 18:05:49");
INSERT INTO `status_comments` VALUES("40","1","146","LMAO. Omg","2012-08-04 08:32:38");
INSERT INTO `status_comments` VALUES("41","9","146","Beereal was not a success..","2012-08-04 10:07:19");
INSERT INTO `status_comments` VALUES("42","9","153","Where\'s Mikey?","2012-08-06 19:38:12");
INSERT INTO `status_comments` VALUES("43","1","153","He\'s going through some stuff and moving houses.","2012-08-07 13:37:12");
INSERT INTO `status_comments` VALUES("44","9","174","You mean the show right?","2012-08-14 14:47:50");
INSERT INTO `status_comments` VALUES("45","1","174","Yeah man, it\'s epic.","2012-08-14 15:09:40");
INSERT INTO `status_comments` VALUES("46","9","174","Damn right. Season 8 premiers October 3rd, I can\'t wait.","2012-08-14 15:10:18");
INSERT INTO `status_comments` VALUES("47","1","174","I know, I\'ve been watching it on Netflix, I\'m in season 3 right now.","2012-08-14 15:16:21");
INSERT INTO `status_comments` VALUES("48","9","174","Awesome, so who\'s you favorite character?","2012-08-14 15:20:47");
INSERT INTO `status_comments` VALUES("49","1","174","Sam. I can relate to his personality a lot.","2012-08-14 15:34:54");
INSERT INTO `status_comments` VALUES("50","9","174","Cool mate.","2012-08-14 16:15:41");
INSERT INTO `status_comments` VALUES("51","1","174","Yeah it\'s pretty awesome.","2012-08-14 16:17:48");
INSERT INTO `status_comments` VALUES("52","1","195","That sounds like tons of fun","2012-08-31 14:20:04");
INSERT INTO `status_comments` VALUES("53","15","139","Sandwhich with mayonnaise :P ","2012-08-31 23:59:55");
INSERT INTO `status_comments` VALUES("54","2","202","well take some meds","2012-09-01 11:04:23");
INSERT INTO `status_comments` VALUES("55","1","210","Thanks, I thought so too.","2012-09-06 17:08:36");
INSERT INTO `status_comments` VALUES("56","16","210","It really adds to.... ummm, your shoes?","2012-09-06 22:44:28");
INSERT INTO `status_comments` VALUES("57","1","210","Awkward.","2012-09-06 23:06:34");
INSERT INTO `status_comments` VALUES("58","16","210","No, awkward would have been saying it adds to your eyes, which compliment your socks, and are those Family Guy boxers?","2012-09-06 23:14:07");
INSERT INTO `status_comments` VALUES("59","1","210","....","2012-09-06 23:14:37");
INSERT INTO `status_comments` VALUES("60","1","210","Dooley noted. XD","2012-09-06 23:14:40");
INSERT INTO `status_comments` VALUES("61","2","210","um are you 2 having fun?","2012-09-07 16:28:48");
INSERT INTO `status_comments` VALUES("62","16","210","Define \"fun\"","2012-09-07 16:49:13");
INSERT INTO `status_comments` VALUES("63","1","225","whut?","2012-09-13 18:06:38");
INSERT INTO `status_comments` VALUES("64","16","225","I\'m the third top poster here apparently. I\'m aiming for that #2 spot","2012-09-13 18:28:40");
INSERT INTO `status_comments` VALUES("65","1","225","oh lol okay cool :D","2012-09-13 18:28:54");
INSERT INTO `status_comments` VALUES("66","16","226","My name is solidbatman and I approve of this skin","2012-09-13 19:23:56");
INSERT INTO `status_comments` VALUES("67","1","226","Haha thanks man glad ya like it","2012-09-13 19:48:46");
INSERT INTO `status_comments` VALUES("68","1","226","took a lot of work :P suggestions would be great though","2012-09-13 20:16:21");
INSERT INTO `status_comments` VALUES("69","9","225","Bring it on","2012-09-14 13:19:38");
INSERT INTO `status_comments` VALUES("70","9","230","Finally, an excuse to legally change my name to John Connor.","2012-09-15 19:23:34");
INSERT INTO `status_comments` VALUES("71","1","230","FIGHT THE FUTURE, MAN, FIGHT THE FUTURE!!","2012-09-15 19:24:29");
INSERT INTO `status_comments` VALUES("72","2","231","can i have some?","2012-09-16 11:46:06");
INSERT INTO `status_comments` VALUES("73","2","55","come on now update your self sometime","2012-09-16 11:47:48");
INSERT INTO `status_comments` VALUES("74","9","231","Sure, knock yourself out.","2012-09-16 21:46:37");
INSERT INTO `status_comments` VALUES("75","1","235","?","2012-09-17 23:02:15");
INSERT INTO `status_comments` VALUES("76","16","235","Borderlands 2. Something in the announcement trailer being behind the wub wub","2012-09-18 00:10:44");
INSERT INTO `status_comments` VALUES("77","1","243","One of these days, Alice, to the mooooon!","2012-09-22 18:06:10");
INSERT INTO `status_comments` VALUES("78","16","243","I was so confused there for a minute. Nice reference lol ","2012-09-22 18:42:46");
INSERT INTO `status_comments` VALUES("79","1","243","Haha nice, if it makes you feel better I don\'t know what that\'s from, I\'ve just heard it","2012-09-22 19:40:01");
INSERT INTO `status_comments` VALUES("80","16","243","The Honeymooners ","2012-09-22 20:03:27");
INSERT INTO `status_comments` VALUES("81","1","55","^ LMAO I just saw this.","2012-09-23 00:43:31");
INSERT INTO `status_comments` VALUES("82","9","247","It\'s your socks, I can smell them from here","2012-09-23 17:45:25");
INSERT INTO `status_comments` VALUES("83","16","247","black socks they never get dirty, the longer you wear them the stronger they get!","2012-09-23 17:47:26");
INSERT INTO `status_comments` VALUES("84","9","247","Interesting philosphy... ","2012-09-23 17:48:24");
INSERT INTO `status_comments` VALUES("85","2","247","yea the stronger the smell is","2012-09-23 20:28:33");
INSERT INTO `status_comments` VALUES("86","1","247","^ This dude has a point, y\'know.","2012-09-23 20:29:06");
INSERT INTO `status_comments` VALUES("87","16","247","Shhh, you guys are just jealous my water bill is less than yours","2012-09-23 20:31:02");
INSERT INTO `status_comments` VALUES("88","1","247","Probably because ya don\'t bathe","2012-09-23 20:32:52");
INSERT INTO `status_comments` VALUES("89","16","247","I\'ll have you know I bathe like they did in the 1700\'s. Once a month","2012-09-23 20:35:05");
INSERT INTO `status_comments` VALUES("90","9","247","That\'s disgusting. Even the Vikings showered once a week.","2012-09-23 21:41:32");
INSERT INTO `status_comments` VALUES("91","16","247","It\'s hard to bathe weekly when the Vikings pillage every few days ","2012-09-23 21:54:44");
INSERT INTO `status_comments` VALUES("92","1","255","Isn\'t that when Shepard goes to work for Cerberus?","2012-09-24 22:57:26");
INSERT INTO `status_comments` VALUES("93","16","255","Yeah. ","2012-09-24 23:03:49");
INSERT INTO `status_comments` VALUES("94","2","251","your a electro bag ","2012-09-25 20:44:17");
INSERT INTO `status_comments` VALUES("95","1","267","YES. Provide a link plz","2012-09-29 19:38:46");
INSERT INTO `status_comments` VALUES("96","9","267","http://blog.bioware.com/2012/09/18/from-aaryn-flynn/","2012-09-29 19:39:47");
INSERT INTO `status_comments` VALUES("97","9","267","Don\'t get your hopes up.","2012-09-29 19:40:02");
INSERT INTO `status_comments` VALUES("98","1","267","Alrighties. Thanks.","2012-09-29 19:52:28");
INSERT INTO `status_comments` VALUES("99","16","267","Not really a surprise. Mass Effect is a pretty big financial boom for EA. I\'d be more surprised if they didn\'t make a new one. ","2012-09-30 10:36:31");
INSERT INTO `status_comments` VALUES("100","9","267","True, but the fans are still pissed off about ME3\'s ending. Myself included.","2012-09-30 10:37:40");
INSERT INTO `status_comments` VALUES("101","16","267","I can\'t comment on that just yet. Gotta finish 2 first. ","2012-09-30 10:49:56");
INSERT INTO `status_comments` VALUES("102","9","267","Let me know when you get there.","2012-09-30 10:50:56");
INSERT INTO `status_comments` VALUES("103","1","267","I\'ve only finished three but I got the gist of everything, did research, etc. It was quite disappointing.","2012-09-30 13:48:30");
INSERT INTO `status_comments` VALUES("104","9","267","I agree. The fans were so vocal about their dissapointment, Bioware delayed prodocution of all other Single player DLC\'s to focus on the Extended Cut meant to iron out the endings, but It didn\'t work.","2012-09-30 14:04:53");
INSERT INTO `status_comments` VALUES("105","1","267","It just didn\'t really make sense to me. I mean, obviously someone survived, but was it Shephard or who? And then there\'s the whole thing that they did exactly what they were trying to prevent. Confusing.","2012-10-01 12:41:08");
INSERT INTO `status_comments` VALUES("106","1","283","might be because I had a couple of bad robot visitors.. I promise you\'re safe though","2012-10-04 23:02:20");
INSERT INTO `status_comments` VALUES("107","16","283","I know that, the problem is that I need to disable my antivirus to get on. It blocks the url from working.","2012-10-05 10:55:15");
INSERT INTO `status_comments` VALUES("108","1","283","eh, sorry about that","2012-10-05 10:56:22");
INSERT INTO `status_comments` VALUES("109","16","283","No worries. I\'ll deal with it.","2012-10-05 10:56:47");
INSERT INTO `status_comments` VALUES("110","16","283","and there, antivirus comes up clear for this site","2012-10-05 11:31:40");
INSERT INTO `status_comments` VALUES("111","9","288","What the...?","2012-10-05 13:33:30");
INSERT INTO `status_comments` VALUES("112","16","288","Its a line from the ending to one of my favorite shows. Translates to \"Your tongue speaks of despair\"","2012-10-05 13:38:23");
INSERT INTO `status_comments` VALUES("113","1","288","Gezundteit.","2012-10-05 15:39:32");
INSERT INTO `status_comments` VALUES("114","16","288","good health?","2012-10-05 15:45:43");
INSERT INTO `status_comments` VALUES("115","9","289","If I don\'t have a wife, does that give me a freebie to grope someone elses?","2012-10-06 10:40:43");
INSERT INTO `status_comments` VALUES("116","1","289","Lmao. I\'m staying neutral in that department. XD","2012-10-06 10:41:56");
INSERT INTO `status_comments` VALUES("117","9","291","Why thank you. So you think I should go ahead with the surgery?","2012-10-06 12:07:44");
INSERT INTO `status_comments` VALUES("118","16","291","You\'ll want to go all the way. Get cat ears too.","2012-10-06 12:09:25");
INSERT INTO `status_comments` VALUES("119","1","291","^ lmao. win","2012-10-06 12:09:29");
INSERT INTO `status_comments` VALUES("120","9","291","What pattern should I get? Stripes or spots?","2012-10-06 12:09:53");
INSERT INTO `status_comments` VALUES("121","16","291","Spots. If you go stripes, people may think it looks too un-natural ","2012-10-06 12:35:38");
INSERT INTO `status_comments` VALUES("122","16","295","You called?","2012-10-06 22:46:23");
INSERT INTO `status_comments` VALUES("123","1","295","LOL","2012-10-07 10:35:47");
INSERT INTO `status_comments` VALUES("124","9","306","Ideas foor?","2012-10-07 14:29:02");
INSERT INTO `status_comments` VALUES("125","1","306","Helping the site out, getting it more active. I think it looks nice but that\'s only half the battle, it\'s gotta have a reason for users to stay and I can\'t think of one.","2012-10-07 15:10:50");
INSERT INTO `status_comments` VALUES("126","9","306","Alright how about this, I\'m just throwing the concept out there... Porn.","2012-10-07 16:25:13");
INSERT INTO `status_comments` VALUES("127","1","306","LMAO I can\'t do that. I like the effort though. xD","2012-10-07 16:31:59");
INSERT INTO `status_comments` VALUES("128","9","306","Well I\'m just brainstorming. Like if you imagine the Xbox 360 skin here, instad of big green glowing balls, big glowing boobies. Toss it around, let me know what you think. It Is Breast cancer awareness month","2012-10-07 16:33:48");
INSERT INTO `status_comments` VALUES("129","9","295","Thank god your here Batman. I need some Halloween costumes for me and my buddy, and the silliest we could think of were yours. Can we borrow yours and Robins?","2012-10-07 18:27:17");
INSERT INTO `status_comments` VALUES("130","16","295","The Riddler\'s didnt come to mind? For shame, prepare for a swift uppercut of justice","2012-10-08 00:35:41");
INSERT INTO `status_comments` VALUES("131","2","318","hold on what if your one of the bad guys?","2012-10-08 19:19:17");
INSERT INTO `status_comments` VALUES("132","1","318","Pretty sure I\'m not..","2012-10-08 21:03:53");
INSERT INTO `status_comments` VALUES("133","34","327","sure...tell yourself that","2012-10-09 08:48:49");
INSERT INTO `status_comments` VALUES("134","16","337","oh boy","2012-10-10 15:12:33");
INSERT INTO `status_comments` VALUES("135","34","337","ending was purely insane, no? yes! #OMG #cantbelievethathappened #dahelldidiwatch #needtochangepants","2012-10-11 09:19:28");
INSERT INTO `status_comments` VALUES("136","9","340","So shoot them, don\'t just let them walk around.","2012-10-11 13:06:29");
INSERT INTO `status_comments` VALUES("137","16","340","But you see, we are the Walking Dead","2012-10-11 15:06:57");
INSERT INTO `status_comments` VALUES("138","34","357","how? there are literally no holes...","2012-10-16 09:18:30");
INSERT INTO `status_comments` VALUES("139","9","357","That\'s the great thing about Minecraft. You can make as many holes as you\'d like.","2012-10-16 09:29:42");
INSERT INTO `status_comments` VALUES("140","34","357","none that are circular...","2012-10-16 10:38:13");
INSERT INTO `status_comments` VALUES("141","9","357","That\'s just a matter of imagination.","2012-10-16 11:05:50");
INSERT INTO `status_comments` VALUES("142","9","361","Wacky night?","2012-10-16 11:07:38");
INSERT INTO `status_comments` VALUES("143","16","357","...well this is a weird status thread. ","2012-10-16 11:41:12");
INSERT INTO `status_comments` VALUES("144","9","357","Yeah...","2012-10-16 11:41:34");
INSERT INTO `status_comments` VALUES("145","1","361","Yeah I guess so xD","2012-10-16 11:50:00");
INSERT INTO `status_comments` VALUES("146","1","357",".....","2012-10-16 15:03:02");
INSERT INTO `status_comments` VALUES("147","9","357","I almost feel bad..","2012-10-16 16:15:46");
INSERT INTO `status_comments` VALUES("148","1","357","*walks out*","2012-10-16 18:29:04");
INSERT INTO `status_comments` VALUES("149","16","366","Better than the Sam Ramni movies?","2012-10-20 18:02:18");
INSERT INTO `status_comments` VALUES("150","1","366","Marvel ftw! I love the scene with Stan Lee completely oblivious to the fight going on. XD","2012-10-20 18:05:34");
INSERT INTO `status_comments` VALUES("151","9","366","Kind of. I think both films got different things right, and different things wrong. The Lizard looks stupid though.","2012-10-20 18:05:45");
INSERT INTO `status_comments` VALUES("152","9","366","It\'s up on 1channel if you want to watch it.","2012-10-20 18:29:10");
INSERT INTO `status_comments` VALUES("153","16","366","Don\'t think we have that here. I\'ll grab it off On Demand in a few days","2012-10-20 23:11:28");
INSERT INTO `status_comments` VALUES("154","9","366","It\'s a file sharing site mate, you can just stream the movie instead of downloading it.","2012-10-20 23:13:05");
INSERT INTO `status_comments` VALUES("155","34","369","you rang?","2012-10-23 14:00:00");
INSERT INTO `status_comments` VALUES("156","16","370","Chiri would be upset with you. But hey, Kafuka still likes you","2012-10-23 14:26:15");
INSERT INTO `status_comments` VALUES("157","1","369","Rofl","2012-10-23 14:28:54");
INSERT INTO `status_comments` VALUES("158","34","370","Chiri...i have decided she is not my type. I like kafuka now. Chiri is a whore. ","2012-10-23 14:39:48");
INSERT INTO `status_comments` VALUES("159","16","370","Wow, she can\'t be. She\'s too proper. Karae yes, Chiri, no","2012-10-23 14:44:02");
INSERT INTO `status_comments` VALUES("160","34","370","Not the way she is all over you -_- Mr. Despair. And do tell me..what is so proper about her? what is proper about injecting orange juice into her sister?","2012-10-23 14:47:17");
INSERT INTO `status_comments` VALUES("161","16","370","Her hair is naturally curly! Did you know that? She makes it perfectly straight and parts it right down the middle. PROPERLY! ","2012-10-23 14:49:20");
INSERT INTO `status_comments` VALUES("162","34","370","i know that! read what i have said and reply properly!","2012-10-23 14:51:59");
INSERT INTO `status_comments` VALUES("163","16","370","It was a small matter, injecting the juice. Non the less, I am in despair! This world which has plagued me with insane students has left me in despair!","2012-10-23 14:54:17");
INSERT INTO `status_comments` VALUES("164","1","373","LOL. Epic.","2012-10-24 10:41:50");
INSERT INTO `status_comments` VALUES("165","1","377","Since I don\'t have a 360 right now (XD), what was the update?","2012-10-27 19:07:30");
INSERT INTO `status_comments` VALUES("166","9","377","They just updated the menus. Added in Xbox Music, and replaced Zune with Xbox Video or whatever It\'s called. Xbox Music is pretty awesome, they had a huge selection of good music.","2012-10-27 19:11:21");
INSERT INTO `status_comments` VALUES("167","16","377","Wasn\'t there a big skin pack update as well?","2012-10-27 19:37:47");
INSERT INTO `status_comments` VALUES("168","9","377","No idea. You mean the themes? \'Cause I don\'t think that happened.","2012-10-27 19:41:43");
INSERT INTO `status_comments` VALUES("169","16","377","Bleh, I dunno. Jut thought I had seen something about it.","2012-10-27 19:44:15");
INSERT INTO `status_comments` VALUES("170","9","377","Skins, themes probably the same thing. But as far as i know, Microsoft don\'t include them in these big software updates. They\'re mainly just DLC for games.","2012-10-27 19:47:05");
INSERT INTO `status_comments` VALUES("171","1","383","They put me on meds for fleas :/","2012-10-28 19:47:57");
INSERT INTO `status_comments` VALUES("172","34","383","...","2012-10-29 09:19:09");
INSERT INTO `status_comments` VALUES("173","1","390","dislike","2012-10-30 21:44:08");
INSERT INTO `status_comments` VALUES("174","16","393","Well it\'s not really anything special, but whatever. Why am I talking to myself?","2012-11-01 21:31:17");
INSERT INTO `status_comments` VALUES("175","34","395","yes...yes they are. i played all of the available ones the moment i  was able to. fully synced ","2012-11-08 10:38:30");
INSERT INTO `status_comments` VALUES("176","1","414","what\'s that?","2012-11-18 18:50:10");
INSERT INTO `status_comments` VALUES("177","9","414","The Pinnacle of space games http://www.kickstarter.com/projects/cig/star-citizen","2012-11-18 18:51:24");
INSERT INTO `status_comments` VALUES("178","1","414","Looks good, hopefully it is..so this is coming out tomorrow or what?","2012-11-18 18:57:18");
INSERT INTO `status_comments` VALUES("179","9","414","No It\'s estimated release date Is November 2014, but that\'s probably gonna change.","2012-11-18 18:58:14");
INSERT INTO `status_comments` VALUES("180","2","412","what were you doing when you broke the circuit??","2012-12-03 21:28:48");
INSERT INTO `status_comments` VALUES("181","3","412","I cried myself to sleep. Tears and electricity don\'t mix.","2012-12-03 21:49:00");
INSERT INTO `status_comments` VALUES("182","2","412","how did you cry and why?","2012-12-03 21:50:04");
INSERT INTO `status_comments` VALUES("183","2","445","dont look up to high you might break your neck ","2012-12-03 21:50:57");
INSERT INTO `status_comments` VALUES("184","3","412","STOP PRESSURING ME, HEATHEN! Stupid humans!","2012-12-03 21:51:16");
INSERT INTO `status_comments` VALUES("185","2","412","stupid botts so babyish latly and or to sensitive  haha","2012-12-03 21:52:27");
INSERT INTO `status_comments` VALUES("186","34","412","Oh leave him alone...he was playing NieR. ","2012-12-03 23:23:38");
INSERT INTO `status_comments` VALUES("187","1","412","Psh, at least we can spell!","2012-12-04 11:00:16");
INSERT INTO `status_comments` VALUES("188","16","457","Natsume>Ryuuko","2012-12-05 13:19:16");
INSERT INTO `status_comments` VALUES("189","34","457","Yukair > Natsume and trust me, that is saying something. fucking *expletive* -_-","2012-12-05 13:35:05");
INSERT INTO `status_comments` VALUES("190","1","457","Lol You two are like two cartoon charaters, it\'s funny.","2012-12-05 13:37:19");
INSERT INTO `status_comments` VALUES("191","34","457","cuz he is like a mindless manwhore ","2012-12-05 13:40:38");
INSERT INTO `status_comments` VALUES("192","16","457","Trust me, a little exposure to Natsume and you\'ll love her.","2012-12-05 13:43:02");
INSERT INTO `status_comments` VALUES("193","34","457","I am contempts with whom i already have","2012-12-05 13:45:14");
INSERT INTO `status_comments` VALUES("194","34","457","unlike you, no matter how much you got, you can never be happy","2012-12-05 13:45:31");
INSERT INTO `status_comments` VALUES("195","16","457","Wait, i never noticed the mindless manwhore. I like the sound of that","2012-12-05 22:16:47");
INSERT INTO `status_comments` VALUES("196","34","457","Solidbatman, The Manwhore","2012-12-05 22:45:08");
INSERT INTO `status_comments` VALUES("197","9","486","You can do better than that. Get the M98B, lie down on the deck of the assult ship on Kharg Island, and snipe.","2012-12-21 11:16:03");
INSERT INTO `status_comments` VALUES("198","16","486","Haven\'t unlocked the M98B. I rarely play Recon class. Usually Assault or Engineer. ","2012-12-21 11:57:26");
INSERT INTO `status_comments` VALUES("199","9","486","Well any bolt action will do. If you pull it off, let me know the distance. When i did it, my Xbox wouldn\'t register the marksman bonus.","2012-12-21 21:34:32");
INSERT INTO `status_comments` VALUES("200","16","513","bro, time travel","2013-01-30 11:05:43");
INSERT INTO `status_comments` VALUES("201","1","513","we have to back to 1985!","2013-01-31 08:59:16");
INSERT INTO `status_comments` VALUES("202","34","517","what is? dem clannad tears?","2013-02-11 11:01:10");
INSERT INTO `status_comments` VALUES("203","16","517","No! Because big boys dont cry","2013-02-11 19:44:51");
INSERT INTO `status_comments` VALUES("204","16","522","Play Clannad","2013-02-13 20:32:18");
INSERT INTO `status_comments` VALUES("205","34","522","So I can be in a lonely depression? yeahhhhhhhh no","2013-02-14 08:52:16");
INSERT INTO `status_comments` VALUES("206","34","532","so: I/3 < SHAFT STUDIOS","2013-02-19 16:15:53");
INSERT INTO `status_comments` VALUES("207","34","532","or 1/3 < (SHAFT STUDIOS) / I ","2013-02-19 16:17:04");
INSERT INTO `status_comments` VALUES("208","16","538","Don\'t know whats going on but hang in there","2013-03-01 10:19:28");
INSERT INTO `status_comments` VALUES("209","1","538","My grandfather that raised me passed away last night at 2:15 A.M. But thanks.","2013-03-01 10:34:53");
INSERT INTO `status_comments` VALUES("210","1","552","what movie?","2013-03-14 21:55:07");
INSERT INTO `status_comments` VALUES("211","16","552","Voices of a Distant Star. It\'s a 24 minute movie. ","2013-03-14 22:17:53");
INSERT INTO `status_comments` VALUES("212","1","552","oh, interesting","2013-03-14 22:24:50");
INSERT INTO `status_comments` VALUES("213","1","558","Wil be there in a sec","2013-03-19 16:26:07");
INSERT INTO `status_comments` VALUES("214","1","568","Well, not jack shit =D","2013-03-22 17:37:46");
INSERT INTO `status_comments` VALUES("215","1","585","bout time","2013-03-27 22:09:27");
INSERT INTO `status_comments` VALUES("216","16","585","You can thank the postal service and NISA for the delay. ","2013-03-27 22:27:38");
INSERT INTO `status_comments` VALUES("217","1","592","25","2013-04-01 00:33:34");
INSERT INTO `status_comments` VALUES("218","16","592","Nooooooo, 24! ","2013-04-01 11:39:45");
INSERT INTO `status_comments` VALUES("219","1","599","nope","2013-04-04 11:37:00");
INSERT INTO `status_comments` VALUES("220","9","599","Aren\'t we supposed to vote for things like this?","2013-04-07 10:31:11");
INSERT INTO `status_comments` VALUES("221","16","605","Sucky game is suky","2013-04-08 11:49:17");
INSERT INTO `status_comments` VALUES("222","34","605","your little xeno-gears/saga/whatever cant do that. nor can it plant a bio-bomb into someone\'s head, and watch them explode with tendrils ripping apart their body and taking out things near them. ","2013-04-08 11:52:26");
INSERT INTO `status_comments` VALUES("223","1","637","Saw this on GameSpot news yesterday, pretty neat","2013-04-24 12:30:06");
INSERT INTO `status_comments` VALUES("224","2","642","thats a good question lol","2013-05-03 13:50:06");
INSERT INTO `status_comments` VALUES("225","1","661","Sounds..I actually have no adjectives for that","2013-05-11 19:33:04");
INSERT INTO `status_comments` VALUES("226","2","687","parts to what?","2013-06-22 18:39:40");
INSERT INTO `status_comments` VALUES("227","16","687","new pc build","2013-06-22 19:19:03");
INSERT INTO `status_comments` VALUES("232","1","756","test","2016-04-08 09:40:10");



DROP TABLE `status_history`;

CREATE TABLE `status_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `status` text NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `likedBy` varchar(1000) NOT NULL DEFAULT '0',
  `privacy` enum('public','private') NOT NULL DEFAULT 'public',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=757 DEFAULT CHARSET=latin1;

INSERT INTO `status_history` VALUES("39","1","Welcome, one and all, to the finest game site of them all!","2012-06-15 16:27:46","","public");
INSERT INTO `status_history` VALUES("40","1","Time to get this place some activity.","2012-06-16 19:58:04","","public");
INSERT INTO `status_history` VALUES("41","1","moo","2012-06-19 13:35:41","","public");
INSERT INTO `status_history` VALUES("42","1","I am feeling the bored.","2012-06-19 22:37:26","","public");
INSERT INTO `status_history` VALUES("43","1","test","2012-06-19 22:38:14","","public");
INSERT INTO `status_history` VALUES("44","1","meepit","2012-06-19 22:39:32","","public");
INSERT INTO `status_history` VALUES("45","1","Holy crap it works","2012-06-19 22:39:48","","public");
INSERT INTO `status_history` VALUES("46","1","A","2012-06-19 22:40:26","","public");
INSERT INTO `status_history` VALUES("47","1","B","2012-06-19 22:40:27","","public");
INSERT INTO `status_history` VALUES("48","1","C","2012-06-19 22:40:29","","public");
INSERT INTO `status_history` VALUES("49","1","D","2012-06-19 22:40:31","","public");
INSERT INTO `status_history` VALUES("50","1","Goodnight :)","2012-06-19 22:41:18","","public");
INSERT INTO `status_history` VALUES("51","1","Wooooooo","2012-06-20 14:39:09","","public");
INSERT INTO `status_history` VALUES("52","1","mehs","2012-06-20 18:00:35","","public");
INSERT INTO `status_history` VALUES("53","1","beeeeee","2012-06-20 22:24:12","","public");
INSERT INTO `status_history` VALUES("54","1","I am in a good mood.","2012-06-20 22:24:17","","public");
INSERT INTO `status_history` VALUES("55","4","robo-beep","2012-06-21 08:05:45",":1","public");
INSERT INTO `status_history` VALUES("56","1","Good morning!","2012-06-21 08:09:37","","public");
INSERT INTO `status_history` VALUES("57","1","test","2012-06-21 12:45:51","","public");
INSERT INTO `status_history` VALUES("58","1","test","2012-06-21 12:46:01","","public");
INSERT INTO `status_history` VALUES("59","1","TESTING","2012-06-21 12:46:04","","public");
INSERT INTO `status_history` VALUES("60","1","TESTING","2012-06-21 12:46:10","","public");
INSERT INTO `status_history` VALUES("61","1","fibit","2012-06-21 12:57:47","","public");
INSERT INTO `status_history` VALUES("62","1","yarp","2012-06-21 12:59:50","","public");
INSERT INTO `status_history` VALUES("63","1","blowb","2012-06-21 13:04:46","","public");
INSERT INTO `status_history` VALUES("64","1","yaaaaaay","2012-06-21 13:04:50","","public");
INSERT INTO `status_history` VALUES("65","1","tired","2012-06-21 15:46:08","","public");
INSERT INTO `status_history` VALUES("66","1","Feeling giggly","2012-06-21 21:25:49","","public");
INSERT INTO `status_history` VALUES("67","1","Good morning!","2012-06-22 08:55:48","","public");
INSERT INTO `status_history` VALUES("68","1","That was a pesky error","2012-06-22 11:52:56","","public");
INSERT INTO `status_history` VALUES("69","1","What a great day. :D","2012-06-22 14:24:06","","public");
INSERT INTO `status_history` VALUES("70","1","boom!","2012-06-22 15:12:07","","public");
INSERT INTO `status_history` VALUES("71","1","Can\'t make up my mind if I\'m hot or cold.","2012-06-23 23:04:26","","public");
INSERT INTO `status_history` VALUES("72","1","Check out our new RSS!","2012-06-24 11:05:58","","public");
INSERT INTO `status_history` VALUES("73","8","To war..","2012-06-25 11:46:45","","public");
INSERT INTO `status_history` VALUES("74","1","This storm is relaxing.","2012-06-25 11:53:29",":8","public");
INSERT INTO `status_history` VALUES("75","1","Man I slept good.","2012-06-26 13:31:00",":9","public");
INSERT INTO `status_history` VALUES("76","9","I\'m hungry","2012-06-27 12:25:24",":1","public");
INSERT INTO `status_history` VALUES("77","1","I wonder how long my tongue is.","2012-06-27 15:25:29","","public");
INSERT INTO `status_history` VALUES("78","9","Is drunk","2012-06-27 18:57:41","","public");
INSERT INTO `status_history` VALUES("79","1","I love cold showers.","2012-06-28 12:27:47","","public");
INSERT INTO `status_history` VALUES("80","8","Life\'s not always what it seems.","2012-06-28 14:30:43",":10","public");
INSERT INTO `status_history` VALUES("81","1","Epic boredom","2012-06-28 14:46:00","","public");
INSERT INTO `status_history` VALUES("82","1","G\'mornin.","2012-06-29 09:26:46","","public");
INSERT INTO `status_history` VALUES("83","1","Rawr","2012-06-29 14:58:02","","public");
INSERT INTO `status_history` VALUES("84","1","Why am I so cold this morning.","2012-06-30 09:08:56","","public");
INSERT INTO `status_history` VALUES("85","1","Aaaand now I\'m hot.","2012-06-30 10:30:17","","public");
INSERT INTO `status_history` VALUES("722","1","Really missin my truck.","2014-03-21 11:05:45","","public");
INSERT INTO `status_history` VALUES("87","1","Good to be back, hope everyone had a great 4th","2012-07-04 18:13:41","","public");
INSERT INTO `status_history` VALUES("88","9","I think I\'m hungover","2012-07-04 19:08:55",":1","public");
INSERT INTO `status_history` VALUES("89","9","I feel like I\'m drunk, but without any of the good feelings","2012-07-04 20:49:31","","public");
INSERT INTO `status_history` VALUES("90","1","Falling asleep..","2012-07-04 21:03:14","","public");
INSERT INTO `status_history` VALUES("91","9","Affmirtively feeling like crap, anyone got a good miracle cure? Don\'t be shy, I\'m willing to sacrifice virgins to cure this headache","2012-07-04 21:20:55","","public");
INSERT INTO `status_history` VALUES("92","1","Well I\'m awake now","2012-07-04 21:41:03","","public");
INSERT INTO `status_history` VALUES("93","1","Epic boredomage","2012-07-04 21:41:50",":8","public");
INSERT INTO `status_history` VALUES("94","8","What a nice morning.","2012-07-05 09:35:47","","public");
INSERT INTO `status_history` VALUES("95","1","Worried..","2012-07-05 12:02:41","","public");
INSERT INTO `status_history` VALUES("96","1","Jeez it\'s hot outside","2012-07-05 12:50:10","","public");
INSERT INTO `status_history` VALUES("97","1","Such a nice day","2012-07-06 09:24:08","","public");
INSERT INTO `status_history` VALUES("98","9","I think I\'m dying","2012-07-06 15:51:28","","public");
INSERT INTO `status_history` VALUES("99","1","Good morning!","2012-07-07 10:15:14","","public");
INSERT INTO `status_history` VALUES("100","8","Man I feel good today","2012-07-07 10:50:11",":10:1","public");
INSERT INTO `status_history` VALUES("101","1","Rough night..","2012-07-08 09:33:04","","public");
INSERT INTO `status_history` VALUES("102","9","I\'m awesome","2012-07-09 11:14:20","","public");
INSERT INTO `status_history` VALUES("103","9","What\'s going on right now?","2012-07-09 16:02:11","","public");
INSERT INTO `status_history` VALUES("106","1","Oy..","2012-07-10 08:58:46","","public");
INSERT INTO `status_history` VALUES("107","1","This crazy girl is driving me insane.","2012-07-11 10:36:07","","public");
INSERT INTO `status_history` VALUES("388","34","Nothing...nothing at all","2012-10-30 11:40:09","","public");
INSERT INTO `status_history` VALUES("110","1","What\'s going on right now?","2012-07-11 14:53:56","","public");
INSERT INTO `status_history` VALUES("112","1","B-b-b-bored","2012-07-11 15:23:08","","public");
INSERT INTO `status_history` VALUES("690","16","Computer built!","2013-06-30 23:22:14","","public");
INSERT INTO `status_history` VALUES("115","1","Good to be home","2012-07-15 18:29:42",":9","public");
INSERT INTO `status_history` VALUES("116","9","I\'m the Goddamn Batman","2012-07-15 18:49:54","","public");
INSERT INTO `status_history` VALUES("117","16","We\'re gonna need more soup","2012-07-15 21:44:43","","public");
INSERT INTO `status_history` VALUES("118","9","Okay, the Cascada cover version of Last Christmas has more hits than the actual fucking Wham song...","2012-07-16 06:57:48","","public");
INSERT INTO `status_history` VALUES("119","9","Did you know a human being can survive without half of the brain?","2012-07-16 09:49:35","","public");
INSERT INTO `status_history` VALUES("120","16","What\'s going on right now?","2012-07-16 10:34:28","","public");
INSERT INTO `status_history` VALUES("121","16","We\'re gonna need more soup","2012-07-16 10:34:39",":1","public");
INSERT INTO `status_history` VALUES("122","11","ZZzzzzzzzzzzzoooooooooom","2012-07-16 13:01:40","","public");
INSERT INTO `status_history` VALUES("123","11","Oops","2012-07-16 13:01:45","","public");
INSERT INTO `status_history` VALUES("124","9","Get off the Shed","2012-07-16 13:03:36","","public");
INSERT INTO `status_history` VALUES("125","1","Ass.","2012-07-17 10:07:18","","public");
INSERT INTO `status_history` VALUES("126","16","I\'m not a role model... you poo poo head","2012-07-17 13:42:48","","public");
INSERT INTO `status_history` VALUES("127","16","Witty one liner ","2012-07-17 20:31:42","","public");
INSERT INTO `status_history` VALUES("128","1","Cows? I like cows..on a bun","2012-07-18 11:41:36","","public");
INSERT INTO `status_history` VALUES("129","16","Spoil Batman at your own risk...","2012-07-19 19:51:31","","public");
INSERT INTO `status_history` VALUES("130","9","Just saw the Dark Knight Rises... Wow","2012-07-20 19:37:12","","public");
INSERT INTO `status_history` VALUES("131","16","Worst of the three films -_-","2012-07-21 03:12:02","","public");
INSERT INTO `status_history` VALUES("132","1","Booga","2012-07-22 15:39:49","","public");
INSERT INTO `status_history` VALUES("133","16","Just discovered custom Steam icons; where have they been all my life?","2012-07-22 17:22:07","","public");
INSERT INTO `status_history` VALUES("134","16","oops","2012-07-22 17:22:25","","public");
INSERT INTO `status_history` VALUES("135","9","Do or die, Justify, Semper Fi","2012-07-24 18:38:37","Array:1","public");
INSERT INTO `status_history` VALUES("136","1","I\'m a good doggie.","2012-07-24 22:10:41","","public");
INSERT INTO `status_history` VALUES("137","1","Bored","2012-07-26 14:44:30","","public");
INSERT INTO `status_history` VALUES("138","1","Ugh","2012-07-27 19:34:09","","public");
INSERT INTO `status_history` VALUES("139","15","I ate my own species in a sandwhich the other day","2012-07-28 01:01:01","","public");
INSERT INTO `status_history` VALUES("140","1","Whew, man I needed that rest","2012-07-28 10:29:21","","public");
INSERT INTO `status_history` VALUES("141","1","I saw a pale horse..and a pale rider upon it","2012-07-29 10:25:59","","public");
INSERT INTO `status_history` VALUES("142","8","meep meep","2012-07-29 10:38:51",":1","public");
INSERT INTO `status_history` VALUES("143","9","Yo somebody post in the 720 thread, I has news.","2012-07-30 19:51:03","","public");
INSERT INTO `status_history` VALUES("144","9","God damn, the new Mortal Kombat is dissapointing.","2012-07-31 20:22:00","","public");
INSERT INTO `status_history` VALUES("145","16","Persona 4 Arena Pre-ordered!","2012-08-01 00:44:21","","public");
INSERT INTO `status_history` VALUES("146","9","I want a beer, but also cereal. Please advise.","2012-08-02 13:34:30",":1","public");
INSERT INTO `status_history` VALUES("147","1","Good morning","2012-08-03 10:38:53","","public");
INSERT INTO `status_history` VALUES("148","1","Man, what a headache","2012-08-03 19:37:29","","public");
INSERT INTO `status_history` VALUES("689","16","Computer Build Today!","2013-06-29 10:45:28","","public");
INSERT INTO `status_history` VALUES("149","1","Well. That was some dream.","2012-08-04 09:19:28","","public");
INSERT INTO `status_history` VALUES("150","1","Man I love this game. Freaking awesome.","2012-08-04 21:58:48","","public");
INSERT INTO `status_history` VALUES("151","1","I like lazy Sundays.","2012-08-05 19:34:41",":9","public");
INSERT INTO `status_history` VALUES("152","16","24 hours until Persona bliss","2012-08-06 10:40:15","","public");
INSERT INTO `status_history` VALUES("153","1","It\'s hard running this place alone.","2012-08-06 19:08:48","","public");
INSERT INTO `status_history` VALUES("154","9","I just realized, If I buy Minecraft, I could build my own damn Batcave...","2012-08-06 19:47:51",":16","public");
INSERT INTO `status_history` VALUES("155","16","Come on UPS. I\'m impatient","2012-08-07 11:25:50","","public");
INSERT INTO `status_history` VALUES("156","16","It is here. Excitement, its over 9000","2012-08-07 13:21:08","","public");
INSERT INTO `status_history` VALUES("157","1","I greatly enjoy food. ","2012-08-07 13:37:32",":9","public");
INSERT INTO `status_history` VALUES("158","9","Anyone interested in 2 free days of Xbox live gold?","2012-08-07 15:23:15","","public");
INSERT INTO `status_history` VALUES("159","9","4 days free Xbox Live Gold anyone?","2012-08-07 19:24:00","","public");
INSERT INTO `status_history` VALUES("162","1","Headin\' outta town today","2012-08-08 10:33:46","","public");
INSERT INTO `status_history` VALUES("163","16","What\'s going on right now?","2012-08-08 21:47:43","","public");
INSERT INTO `status_history` VALUES("164","16","Having a blast with Persona 4 Arena","2012-08-08 21:47:56","","public");
INSERT INTO `status_history` VALUES("165","9","I\'m starting to really like Minecraft","2012-08-09 18:20:42","","public");
INSERT INTO `status_history` VALUES("166","1","I b back now.","2012-08-12 16:20:06","","public");
INSERT INTO `status_history` VALUES("167","1","My mom makes awesome lime squares.","2012-08-13 10:21:08",":9","public");
INSERT INTO `status_history` VALUES("168","9","Anyone interested in owning some nooblets in Battlefield 3?","2012-08-13 11:35:19","","public");
INSERT INTO `status_history` VALUES("170","16","Official Battlefield 3 Hero","2012-08-13 13:56:38",":9","public");
INSERT INTO `status_history` VALUES("171","9","Finally beat Arkham City on NG ... Whew..","2012-08-13 16:03:09","","public");
INSERT INTO `status_history` VALUES("172","9","Finally beat Arkham City on NG Plus... Whew..","2012-08-13 16:03:25",":1","public");
INSERT INTO `status_history` VALUES("173","9","So seriously, anyone wanna squad up in BF 3 on the 360?","2012-08-13 19:44:44","","public");
INSERT INTO `status_history` VALUES("174","1","Officially addicted to Supernatural.","2012-08-14 14:38:26",":9","public");
INSERT INTO `status_history` VALUES("176","1","Kansas - Carry On Wayward Son","2012-08-16 15:26:49",":9","public");
INSERT INTO `status_history` VALUES("177","9","The new WoW trailer is out... I hate it more than ever.","2012-08-16 19:42:49","","public");
INSERT INTO `status_history` VALUES("178","1","duba dubam da wop bam bu","2012-08-17 17:12:29","","public");
INSERT INTO `status_history` VALUES("179","16","double shift at work. yay....","2012-08-17 18:37:16","","public");
INSERT INTO `status_history` VALUES("180","16","Dat Chie","2012-08-18 01:54:08","","public");
INSERT INTO `status_history` VALUES("387","1","I must work the English","2012-10-30 10:56:01","","public");
INSERT INTO `status_history` VALUES("182","1","Ah, it\'s good to be home.","2012-08-23 15:37:29","","public");
INSERT INTO `status_history` VALUES("183","1","I really hate AT","2012-08-24 09:02:08","","public");
INSERT INTO `status_history` VALUES("184","1","Nevermind.","2012-08-24 09:02:21","","public");
INSERT INTO `status_history` VALUES("185","1","Man I slept good.","2012-08-24 09:12:25","","public");
INSERT INTO `status_history` VALUES("186","1","I greatly enjoy Netflix.","2012-08-24 09:53:34","","public");
INSERT INTO `status_history` VALUES("187","9","Breivik sentenced, 21 years for 77 murders...","2012-08-24 13:16:02","","public");
INSERT INTO `status_history` VALUES("188","1","Halo\'ing.","2012-08-24 18:11:10","","public");
INSERT INTO `status_history` VALUES("190","1","Allergies suck.","2012-08-25 09:20:13","","public");
INSERT INTO `status_history` VALUES("191","16","Maria Holic.... wut?","2012-08-25 17:07:20","","public");
INSERT INTO `status_history` VALUES("192","1","Glad fall is here early","2012-08-25 19:00:16","","public");
INSERT INTO `status_history` VALUES("193","1","Long day","2012-08-26 15:39:34","","public");
INSERT INTO `status_history` VALUES("195","9","Surf Naked","2012-08-31 14:07:03",":1","public");
INSERT INTO `status_history` VALUES("196","1","Eye Of The Tiger","2012-08-31 15:21:36","","public");
INSERT INTO `status_history` VALUES("197","1","Um, oops","2012-08-31 15:34:12","","public");
INSERT INTO `status_history` VALUES("198","16","September Review up tonight. Bonus review too","2012-08-31 15:39:32","","public");
INSERT INTO `status_history` VALUES("199","1","Okay all better now lol","2012-08-31 18:48:44","","public");
INSERT INTO `status_history` VALUES("200","1","Spielberg has amazing work","2012-08-31 18:52:49","","public");
INSERT INTO `status_history` VALUES("201","16","Controls like a trackless tank, looks stunning. Go Star Ocean 4","2012-08-31 19:39:59","","public");
INSERT INTO `status_history` VALUES("202","1","Man I am burnin up","2012-09-01 00:41:30","","public");
INSERT INTO `status_history` VALUES("203","9","Alright, finshed Leviathan","2012-09-01 11:34:30","","public");
INSERT INTO `status_history` VALUES("204","1","Feeling sick","2012-09-01 12:32:15","","public");
INSERT INTO `status_history` VALUES("205","9","I\'m starting to like Bioware again, just a little","2012-09-01 13:03:46","","public");
INSERT INTO `status_history` VALUES("206","1","Status Update","2012-09-01 14:07:40","","public");
INSERT INTO `status_history` VALUES("207","1","Supernatural season 7 needs to be on Netflix. Now.","2012-09-02 11:14:58","","public");
INSERT INTO `status_history` VALUES("208","16","Yay boss battles...","2012-09-02 12:52:44","","public");
INSERT INTO `status_history` VALUES("209","16","Cool feature coming around 11pm EST","2012-09-03 14:35:16","","public");
INSERT INTO `status_history` VALUES("210","16","You there. Your hair is nice.","2012-09-03 22:43:17",":1:9","public");
INSERT INTO `status_history` VALUES("211","9","Uranium Ore now on Amazon... The reviews are hilarious","2012-09-05 12:30:37","","public");
INSERT INTO `status_history` VALUES("212","1","Good to be home","2012-09-06 17:18:47","","public");
INSERT INTO `status_history` VALUES("214","9","to BF3 players, the M416 Is the new God Gun","2012-09-08 18:37:45","","public");
INSERT INTO `status_history` VALUES("215","1","Too much crap on my mind","2012-09-08 20:50:38","","public");
INSERT INTO `status_history` VALUES("217","9","Carpe Denim","2012-09-09 15:07:12",":1","public");
INSERT INTO `status_history` VALUES("218","16","NFL season is here. I hate everyone","2012-09-09 19:24:34","","public");
INSERT INTO `status_history` VALUES("219","16","Momento Mori","2012-09-10 12:29:59","","public");
INSERT INTO `status_history` VALUES("220","16","Sorry wallet. I\'m getting Borderlands 2","2012-09-11 00:32:08",":2","public");
INSERT INTO `status_history` VALUES("691","55","i just gave my introduction am i just allowed to go on server right now","2013-07-05 13:44:55","","public");
INSERT INTO `status_history` VALUES("457","34","Ryuuko > Natsume ","2012-12-05 12:44:46","","public");
INSERT INTO `status_history` VALUES("451","16","New Games Added!","2012-12-03 22:01:05",":1","public");
INSERT INTO `status_history` VALUES("452","16","DAT NATSUME :3","2012-12-04 01:55:51","","public");
INSERT INTO `status_history` VALUES("453","34",":D :D :D :D :D :D :D :D :D :D :D :D :D This site got Chaos :D :D :D :D :D :D :D :D :D :D :D :D :D ","2012-12-05 09:32:47","","public");
INSERT INTO `status_history` VALUES("225","16","#3 poster here... You\'re next Sam","2012-09-13 18:04:49","","public");
INSERT INTO `status_history` VALUES("226","1","Check out the PlayStation skin","2012-09-13 18:28:20",":16","public");
INSERT INTO `status_history` VALUES("227","1","Yay verily.","2012-09-14 14:31:07","","public");
INSERT INTO `status_history` VALUES("228","23","PORKHAMMER","2012-09-14 20:31:26",":1:9","public");
INSERT INTO `status_history` VALUES("230","3","I will enslave you all!","2012-09-15 19:21:05",":9:1","public");
INSERT INTO `status_history` VALUES("231","9","I sell crack for the CIA","2012-09-15 19:36:38",":2:1","public");
INSERT INTO `status_history` VALUES("232","16","Football Sunday!","2012-09-16 11:38:22","","public");
INSERT INTO `status_history` VALUES("233","16","Panthers won. Brb, going to go crap confetti","2012-09-16 16:30:12","","public");
INSERT INTO `status_history` VALUES("654","8","Cool place.","2013-05-05 11:17:57","","public");
INSERT INTO `status_history` VALUES("235","16","Less than 24 hours to wub wub","2012-09-17 11:55:17","","public");
INSERT INTO `status_history` VALUES("236","1","Bacon!","2012-09-17 13:15:46",":9","public");
INSERT INTO `status_history` VALUES("238","16","Borderlands 2 is quite fun.","2012-09-18 16:02:41","","public");
INSERT INTO `status_history` VALUES("239","16","Only logged 5.5 hours of Borderlands 2. Hooray days off","2012-09-18 22:18:03","","public");
INSERT INTO `status_history` VALUES("240","16","Witty","2012-09-19 18:16:09","","public");
INSERT INTO `status_history` VALUES("241","1","meep meep","2012-09-21 23:21:26","","public");
INSERT INTO `status_history` VALUES("242","1","Dream On","2012-09-22 08:34:43",":9:16","public");
INSERT INTO `status_history` VALUES("243","16","Beat To the Moon. Amazing story","2012-09-22 13:18:21",":1","public");
INSERT INTO `status_history` VALUES("244","1","Just increased everyone\'s tokens by 1,000.","2012-09-23 00:08:18",":16","public");
INSERT INTO `status_history` VALUES("386","1","Getting my 360 back this week","2012-10-28 23:27:04",":34:16:9","public");
INSERT INTO `status_history` VALUES("246","1","mother flipper","2012-09-23 17:10:35","","public");
INSERT INTO `status_history` VALUES("247","16","Do I smell reviews? Or is that my socks?","2012-09-23 17:39:30",":1","public");
INSERT INTO `status_history` VALUES("249","16","It was reviews I was smelling. They smell delicious","2012-09-23 22:28:21","","public");
INSERT INTO `status_history` VALUES("250","16","Miranda\'s forehead=final boss","2012-09-23 22:31:25","","public");
INSERT INTO `status_history` VALUES("251","3","Silly meatbags.","2012-09-24 11:26:56",":1","public");
INSERT INTO `status_history` VALUES("252","1","USA! USA!","2012-09-24 11:33:04","","public");
INSERT INTO `status_history` VALUES("253","1","So. A fish walks into a bar.","2012-09-24 11:33:42","","public");
INSERT INTO `status_history` VALUES("255","16","I have no clue what is happening in ME2","2012-09-24 22:49:36","","public");
INSERT INTO `status_history` VALUES("256","16","10 hour shift today. Not cool at all","2012-09-25 10:34:30","","public");
INSERT INTO `status_history` VALUES("257","16","I\'m ALIVE!!!!","2012-09-25 21:56:44","","public");
INSERT INTO `status_history` VALUES("258","16","this is status","2012-09-26 22:07:47",":1","public");
INSERT INTO `status_history` VALUES("259","16","What... are these keys? I see letters and numbers","2012-09-27 00:33:44","","public");
INSERT INTO `status_history` VALUES("260","16","Steam Keys incoming. I\'m feeling generous. ","2012-09-27 12:14:34","","public");
INSERT INTO `status_history` VALUES("261","16","Humble Bundle Giveaway, go take a look","2012-09-27 17:37:01","","public");
INSERT INTO `status_history` VALUES("262","16","4 days left for Humble Bundle giveaway","2012-09-28 14:57:44","","public");
INSERT INTO `status_history` VALUES("263","9","I am sooo drunk right now","2012-09-28 16:08:41","","public");
INSERT INTO `status_history` VALUES("264","9","Added Batcave to the castle","2012-09-29 08:50:30","","public");
INSERT INTO `status_history` VALUES("265","16","Less than 3 days left","2012-09-29 11:18:46","","public");
INSERT INTO `status_history` VALUES("266","3","Come with me if you want to live!","2012-09-29 14:53:16","Array","public");
INSERT INTO `status_history` VALUES("267","9","Bioware is making another Mass Effect game...","2012-09-29 19:26:38",":1","public");
INSERT INTO `status_history` VALUES("268","1","Status update.","2012-09-29 20:16:39","","public");
INSERT INTO `status_history` VALUES("269","1","Status update.","2012-09-29 20:16:41",":9","public");
INSERT INTO `status_history` VALUES("270","16","2 days left. Claim your games soon","2012-09-30 11:48:02","","public");
INSERT INTO `status_history` VALUES("271","1","I just ain\'t the web guru I used to be.","2012-09-30 18:02:42","","public");
INSERT INTO `status_history` VALUES("272","1","Power To The Players!","2012-09-30 19:09:57","","public");
INSERT INTO `status_history` VALUES("273","1","Ever forget how old you were?","2012-09-30 19:18:08","","public");
INSERT INTO `status_history` VALUES("274","1","Currently without a 360. *withdrawal*","2012-09-30 21:35:13","","public");
INSERT INTO `status_history` VALUES("275","1","I need activity ideas..","2012-10-01 10:03:46","","public");
INSERT INTO `status_history` VALUES("276","16","Final Day to grab your key. None have been claimed yet","2012-10-01 11:06:14","","public");
INSERT INTO `status_history` VALUES("277","1","Ah, Dark Cloud for PS2, I have missed you so. <3","2012-10-01 15:32:36",":16","public");
INSERT INTO `status_history` VALUES("278","16","Want free games? Let me know","2012-10-01 15:55:14","","public");
INSERT INTO `status_history` VALUES("279","16","11pm EST marks the end of the giveaway","2012-10-01 20:47:05","","public");
INSERT INTO `status_history` VALUES("280","16","Nearing the end of ME2, I think","2012-10-01 23:11:48","","public");
INSERT INTO `status_history` VALUES("281","16","NFL Blitz is too much fun","2012-10-02 20:03:21","","public");
INSERT INTO `status_history` VALUES("282","16","Ugh, image host went down. Gotta reskin my forum :(","2012-10-04 16:57:42","","public");
INSERT INTO `status_history` VALUES("283","16","Antivirus is blocking this site. Calls it a malicious url.","2012-10-04 17:20:57","","public");
INSERT INTO `status_history` VALUES("284","1","I hate being sick.","2012-10-04 21:35:10","","public");
INSERT INTO `status_history` VALUES("286","16","All is well ","2012-10-05 11:32:03",":1:9","public");
INSERT INTO `status_history` VALUES("287","9","Guild Wars 2 here i come","2012-10-05 12:32:37",":16","public");
INSERT INTO `status_history` VALUES("288","16","anata no kotodama zetsubou fuumi ","2012-10-05 13:32:50","","public");
INSERT INTO `status_history` VALUES("289","1","Save a life, grope your wife!","2012-10-05 15:35:21",":16","public");
INSERT INTO `status_history` VALUES("290","16","Streaming video to my PS3 on the big screen. Lets gooooo!","2012-10-05 20:11:04","","public");
INSERT INTO `status_history` VALUES("291","16","You\'d look good with a tail","2012-10-05 20:41:47",":1","public");
INSERT INTO `status_history` VALUES("292","1","Clearly there are glitches that I must fix. >_>","2012-10-06 10:43:44","","public");
INSERT INTO `status_history` VALUES("293","1","Okay, double post glitch should be fixed now","2012-10-06 12:21:22",":9","public");
INSERT INTO `status_history` VALUES("295","9","Keep Calm and Call Batman","2012-10-06 13:58:46",":16","public");
INSERT INTO `status_history` VALUES("296","1","I built a new toy.","2012-10-06 14:54:37","","public");
INSERT INTO `status_history` VALUES("383","34","Play ball? No, I am sorry, my owner said he is taking me to the V-E-T","2012-10-28 12:59:52",":1","public");
INSERT INTO `status_history` VALUES("306","1","I need more ideas.","2012-10-07 12:54:34","","public");
INSERT INTO `status_history` VALUES("307","1","Pissed..","2012-10-07 17:42:46","","public");
INSERT INTO `status_history` VALUES("309","1","I\'m BATDOG","2012-10-07 20:14:44",":23","public");
INSERT INTO `status_history` VALUES("310","23","I lika do, da cha cha","2012-10-07 22:11:16",":1","public");
INSERT INTO `status_history` VALUES("311","1","bored","2012-10-07 22:17:19","","public");
INSERT INTO `status_history` VALUES("312","16","I broke a post? Interesting. Going to bed, its the P4 Arena post","2012-10-08 01:36:29","","public");
INSERT INTO `status_history` VALUES("314","16","oh, its fixed. NEW REVIEW UP","2012-10-08 11:20:40",":1","public");
INSERT INTO `status_history` VALUES("317","16","Watch all the things!","2012-10-08 14:31:36","","public");
INSERT INTO `status_history` VALUES("318","1","Kill ALL the bad guys!","2012-10-08 18:50:46","","public");
INSERT INTO `status_history` VALUES("454","1","Fixed a few things","2012-12-05 11:18:51",":8","public");
INSERT INTO `status_history` VALUES("455","3","[user=2]","2012-12-05 11:22:53","","public");
INSERT INTO `status_history` VALUES("456","3","Nice motherboards, wanna see my hard drive?","2012-12-05 11:23:44","Array:1:16:34","public");
INSERT INTO `status_history` VALUES("327","16","Broke my chair. ITS NOT BECAUSE IM FAT","2012-10-09 01:19:30","","public");
INSERT INTO `status_history` VALUES("328","16","RIP Chair. 2008-2012","2012-10-09 12:35:42","","public");
INSERT INTO `status_history` VALUES("329","16","RIP Chair. 2008-2012","2012-10-09 12:35:52","Array","public");
INSERT INTO `status_history` VALUES("330","1","So relieved.","2012-10-09 15:34:56","","public");
INSERT INTO `status_history` VALUES("331","16","Walking Dead 4... here I come","2012-10-09 15:54:53","","public");
INSERT INTO `status_history` VALUES("332","1","IT\'S SIMPLE. WE EAT THE BATMAN.","2012-10-09 19:19:45","","public");
INSERT INTO `status_history` VALUES("347","16","Staggering around in a mess, like the rumba","2012-10-14 18:40:11","","public");
INSERT INTO `status_history` VALUES("334","1","Sendin off my 360 tomorrow finally","2012-10-09 20:07:15",":16","public");
INSERT INTO `status_history` VALUES("336","16","70-69. I lost at madden","2012-10-10 00:13:01","","public");
INSERT INTO `status_history` VALUES("337","34","Walking Dead EP4...OMG","2012-10-10 09:23:25","","public");
INSERT INTO `status_history` VALUES("338","16","Off for a week. Play all the games!","2012-10-10 17:17:57","","public");
INSERT INTO `status_history` VALUES("340","16","Holy crap. Walking Dead 0_0","2012-10-10 21:15:59","","public");
INSERT INTO `status_history` VALUES("341","1","Quick break at the Galleria","2012-10-12 13:11:58","","public");
INSERT INTO `status_history` VALUES("342","16","Wandering around looks just like the rumba ","2012-10-12 14:16:13","","public");
INSERT INTO `status_history` VALUES("343","9","Really liking Guild Wars 2","2012-10-13 12:51:23","","public");
INSERT INTO `status_history` VALUES("344","9","Forza Horizon Demo on Xbox Live","2012-10-14 17:13:22","","public");
INSERT INTO `status_history` VALUES("346","1","Rough week..","2012-10-14 17:26:02","","public");
INSERT INTO `status_history` VALUES("348","9","Pokemon: Black and Blue?","2012-10-15 07:52:57",":1","public");
INSERT INTO `status_history` VALUES("349","1","Did away with the reply character limit.","2012-10-15 08:38:46",":16:9","public");
INSERT INTO `status_history` VALUES("350","16","Zetsuboushita!","2012-10-15 11:01:06","","public");
INSERT INTO `status_history` VALUES("351","16","Zetsuboushita!","2012-10-15 11:01:19","","public");
INSERT INTO `status_history` VALUES("352","16","Ummm... so cuss words that arent cuss words get censored?","2012-10-15 11:01:53","","public");
INSERT INTO `status_history` VALUES("353","9","Those new Star Wars Blu Ray versions are pretty damn good.","2012-10-15 14:37:30","","public");
INSERT INTO `status_history` VALUES("354","16","Zetsuboushita!","2012-10-15 15:33:21","","public");
INSERT INTO `status_history` VALUES("355","16","This new sig is tougher than I thought","2012-10-15 17:41:31","","public");
INSERT INTO `status_history` VALUES("356","9","I have expanded the Batcave","2012-10-15 19:29:42",":1","public");
INSERT INTO `status_history` VALUES("357","9","Oh fuck Minecraft...","2012-10-15 19:52:18",":16:34","public");
INSERT INTO `status_history` VALUES("358","16","Despair is my good luck charm","2012-10-15 20:35:07","","public");
INSERT INTO `status_history` VALUES("381","34","Hello? Yes, this is Dog","2012-10-27 21:32:23",":1:9","public");
INSERT INTO `status_history` VALUES("360","34","It is official, Tiny Tina is my favorite 13 year old","2012-10-16 09:17:36",":16","public");
INSERT INTO `status_history` VALUES("361","1","Woke up last night sideways on the bed with no covers..","2012-10-16 11:03:53","","public");
INSERT INTO `status_history` VALUES("382","9","Is just read, Paul Walker will be playing Cmdr. Shepard in the Mass Effect Movie","2012-10-28 06:18:51","","public");
INSERT INTO `status_history` VALUES("363","1","Chao Talk is back up!","2012-10-16 18:47:51","","public");
INSERT INTO `status_history` VALUES("365","9","ME3 Omega DLC coming out in November","2012-10-17 18:44:24","","public");
INSERT INTO `status_history` VALUES("366","9","Finally saw the new Spider Man movie. Pretty good.","2012-10-19 12:49:03",":1","public");
INSERT INTO `status_history` VALUES("367","1","Sorry for the slowness, guys..","2012-10-20 17:09:02","","public");
INSERT INTO `status_history` VALUES("369","1","This place needs professional help.","2012-10-21 23:37:19","","public");
INSERT INTO `status_history` VALUES("370","34","Hope is my good luck charm","2012-10-23 14:10:33","","public");
INSERT INTO `status_history` VALUES("372","9","Iron Man 3 trailer is out.","2012-10-24 00:46:03","","public");
INSERT INTO `status_history` VALUES("373","34","Hello? No, this is Cat","2012-10-24 10:04:43",":1","public");
INSERT INTO `status_history` VALUES("374","16","Out all day. No news updates until 5pm est","2012-10-25 13:18:08","","public");
INSERT INTO `status_history` VALUES("375","16","Da news is updated. Back to despairing ","2012-10-25 17:40:20","","public");
INSERT INTO `status_history` VALUES("376","34","  Dog! Phone for you!","2012-10-25 20:47:25","","public");
INSERT INTO `status_history` VALUES("377","9","This new Xbox update, Is Fucking Awesome","2012-10-26 11:17:09",":1","public");
INSERT INTO `status_history` VALUES("378","16","My forum is nearly fixed! Just one last thing. ","2012-10-26 22:59:24","","public");
INSERT INTO `status_history` VALUES("379","16","Game Freaks finally up and running again!","2012-10-27 00:23:58",":9:1","public");
INSERT INTO `status_history` VALUES("380","1","MEEP!!!!!!!!!!!","2012-10-27 18:54:09",":9","public");
INSERT INTO `status_history` VALUES("389","9","Just picked up my ACIII","2012-10-30 12:25:03",":16","public");
INSERT INTO `status_history` VALUES("390","16","Welp, turns out I work Halloween ","2012-10-30 21:39:32","","public");
INSERT INTO `status_history` VALUES("391","16","I\'m not apologizing. ","2012-10-31 10:34:03","","public");
INSERT INTO `status_history` VALUES("392","9","Screw Pumpkins","2012-11-01 16:28:22","","public");
INSERT INTO `status_history` VALUES("393","16","Delayed my surprise because I\'m lazy. Maybe tomrrow","2012-11-01 21:30:37","","public");
INSERT INTO `status_history` VALUES("394","16","Gonna be super late on news. FF12 got in the way","2012-11-02 20:06:19","","public");
INSERT INTO `status_history` VALUES("395","9","The ACIII Naval missions are additctive","2012-11-03 22:14:48","","public");
INSERT INTO `status_history` VALUES("402","1","Halo 4. :D","2012-11-09 11:09:35","","public");
INSERT INTO `status_history` VALUES("397","16","I didn\'t die. FFXII is eating my time","2012-11-04 22:42:31","","public");
INSERT INTO `status_history` VALUES("398","34","Everyone is online playing Halo 4...and I am here Assassinating ","2012-11-06 09:56:19","","public");
INSERT INTO `status_history` VALUES("399","16","Hot chocolate and Final Fantasy 12. What election?","2012-11-06 20:36:28",":1","public");
INSERT INTO `status_history` VALUES("400","16","Sorry for not updating or being very active. Stupid FF12","2012-11-07 10:24:35","","public");
INSERT INTO `status_history` VALUES("401","34","Ryuuko ?? _?? ","2012-11-08 10:39:21",":16","public");
INSERT INTO `status_history` VALUES("403","1","This redesign is gonna be sweet","2012-11-11 13:21:43","","public");
INSERT INTO `status_history` VALUES("404","16","im not even mad about the panthers anymore","2012-11-11 16:19:47","","public");
INSERT INTO `status_history` VALUES("405","34","This place is a ghost town, filled with...*gulps* Ghosts","2012-11-12 09:31:48","","public");
INSERT INTO `status_history` VALUES("406","16","News is updated","2012-11-12 09:50:49","","public");
INSERT INTO `status_history` VALUES("407","1","Beyond pissed..","2012-11-13 11:10:30","","public");
INSERT INTO `status_history` VALUES("408","16","Soup","2012-11-13 11:17:31","","public");
INSERT INTO `status_history` VALUES("409","9","Bacon","2012-11-13 17:40:29",":1","public");
INSERT INTO `status_history` VALUES("410","1","Issues resolved","2012-11-13 19:08:13","","public");
INSERT INTO `status_history` VALUES("415","1","Getting sick = not fun","2012-11-18 18:50:24","","public");
INSERT INTO `status_history` VALUES("412","3","I broke a circuit last night.","2012-11-15 23:33:28",":1","public");
INSERT INTO `status_history` VALUES("413","16","I died","2012-11-16 00:04:01","Array:1","public");
INSERT INTO `status_history` VALUES("414","9","Star Citizen anybody?","2012-11-18 18:36:53","","public");
INSERT INTO `status_history` VALUES("416","1","Bah humbug","2012-11-19 22:16:40","","public");
INSERT INTO `status_history` VALUES("417","16","Beat The Walking Dead blubbering like a baby","2012-11-20 21:48:29","","public");
INSERT INTO `status_history` VALUES("418","1","GoogleBot is stalking me.","2012-11-20 23:05:46","","public");
INSERT INTO `status_history` VALUES("419","16","Possible livestream Friday or Saturday","2012-11-21 18:57:41","","public");
INSERT INTO `status_history` VALUES("420","16","no stream :(","2012-11-21 21:48:20","","public");
INSERT INTO `status_history` VALUES("421","1","Happy Spanksgiving!","2012-11-22 08:13:50","","public");
INSERT INTO `status_history` VALUES("422","9","What the Fuck Bioware?!","2012-11-24 18:12:21",":16:34","public");
INSERT INTO `status_history` VALUES("423","16","Wat","2012-11-25 11:57:59","","public");
INSERT INTO `status_history` VALUES("424","1","I hate it here..","2012-11-25 22:35:38","","public");
INSERT INTO `status_history` VALUES("432","1","Redesign is almost done!","2012-11-28 20:15:01","","public");
INSERT INTO `status_history` VALUES("427","16","Yuno Gasai!!!!!","2012-11-26 01:00:50","","public");
INSERT INTO `status_history` VALUES("428","16","Yuno Gasai is.. crazy?","2012-11-26 01:03:06","","public");
INSERT INTO `status_history` VALUES("429","34","Got it the day it came out...still not done with AC3, wut?","2012-11-26 09:14:32",":1","public");
INSERT INTO `status_history` VALUES("430","16","Yuno Gasai is scarily awesome","2012-11-28 00:43:38","","public");
INSERT INTO `status_history` VALUES("431","34","I got a pair of dice, i hope im lucky to go to paradise","2012-11-28 09:32:22","","public");
INSERT INTO `status_history` VALUES("433","1","Redesign is almost done!","2012-11-28 20:15:01","","public");
INSERT INTO `status_history` VALUES("434","16","Sit in your underwear with two skulls next to you? Typical Yuno","2012-11-28 23:52:02","","public");
INSERT INTO `status_history` VALUES("435","16","Yuno is always right","2012-11-29 01:36:42","","public");
INSERT INTO `status_history` VALUES("436","9","Hm, maybe Disney could bring Boba Fett back?","2012-11-29 17:51:05",":16:34","public");
INSERT INTO `status_history` VALUES("437","16","wh...what!? YUNO!?","2012-11-30 01:58:26","","public");
INSERT INTO `status_history` VALUES("438","1","Releasing the redesign very soon. :)","2012-11-30 12:00:49","","public");
INSERT INTO `status_history` VALUES("439","1","Releasing the redesign very soon. :)","2012-11-30 12:00:49","","public");
INSERT INTO `status_history` VALUES("440","1","Redesign released!","2012-11-30 12:37:47",":9:16","public");
INSERT INTO `status_history` VALUES("441","16","Ye shall be as gods","2012-12-01 00:24:32",":1","public");
INSERT INTO `status_history` VALUES("442","1","Om nom","2012-12-01 15:49:42","","public");
INSERT INTO `status_history` VALUES("443","34","Imma learn to play the flute. Bitches love flutes","2012-12-02 17:13:32",":9:16:1","public");
INSERT INTO `status_history` VALUES("444","1","Too much going on..","2012-12-02 18:53:39","","public");
INSERT INTO `status_history` VALUES("445","1","Things are looking up. ^_^","2012-12-03 10:52:52",":16","public");
INSERT INTO `status_history` VALUES("446","16","It was a Dead End","2012-12-03 11:52:44","","public");
INSERT INTO `status_history` VALUES("447","16","More games for the contest to be added today","2012-12-03 13:46:49",":1","public");
INSERT INTO `status_history` VALUES("458","16","Natsume>Ryuuko","2012-12-05 13:19:37","","public");
INSERT INTO `status_history` VALUES("459","1","Power To The Players","2012-12-05 13:40:25","","public");
INSERT INTO `status_history` VALUES("460","16","KyoAni hit me in mein feels","2012-12-05 23:22:24","","public");
INSERT INTO `status_history` VALUES("461","16","I\'ll add more games for more entries in the contest","2012-12-06 14:04:25","","public");
INSERT INTO `status_history` VALUES("462","16","Rikka>everyone","2012-12-06 15:40:07","","public");
INSERT INTO `status_history` VALUES("463","1","Me > You","2012-12-06 21:57:16","","public");
INSERT INTO `status_history` VALUES("466","1","things are so horrible ","2012-12-08 14:06:02","","public");
INSERT INTO `status_history` VALUES("465","34","Finals from Monday to Thursday. So i shall be absent in that time. ","2012-12-08 00:06:42","","public");
INSERT INTO `status_history` VALUES("471","1","Does anyone have a Tumblr?","2012-12-10 11:01:23","","public");
INSERT INTO `status_history` VALUES("468","16","Our lives are built on the corpses of other lives.","2012-12-08 15:55:37","","public");
INSERT INTO `status_history` VALUES("469","16","Need entrants for the contest!","2012-12-09 15:31:37",":1","public");
INSERT INTO `status_history` VALUES("470","16","What isn\'t remembered never happened.","2012-12-10 01:00:14",":1","public");
INSERT INTO `status_history` VALUES("477","1","Forza Horizon: freaking awesome","2012-12-15 18:05:10","","public");
INSERT INTO `status_history` VALUES("473","16","6 straight days at work. I\'m dying!","2012-12-12 22:32:54","","public");
INSERT INTO `status_history` VALUES("474","16","Chu2 is an 11/10. Stunning.","2012-12-13 11:56:27","","public");
INSERT INTO `status_history` VALUES("475","34","I am finally free!","2012-12-13 23:33:21",":1:16","public");
INSERT INTO `status_history` VALUES("476","16","4 days to Chu2 finale!","2012-12-15 13:08:09","","public");
INSERT INTO `status_history` VALUES("478","16","Congratulations Shinji","2012-12-17 00:13:44","","public");
INSERT INTO `status_history` VALUES("479","16","Please give me feedback on my latest post","2012-12-17 13:50:15","","public");
INSERT INTO `status_history` VALUES("480","1","I don\'t remember it being this difficult","2012-12-17 15:07:59","","public");
INSERT INTO `status_history` VALUES("481","1","Onward!","2012-12-18 10:55:57","","public");
INSERT INTO `status_history` VALUES("482","16","Chu2 finale tomorrow. Tears shall be shed","2012-12-18 12:20:59","","public");
INSERT INTO `status_history` VALUES("483","16","The time has come.","2012-12-19 15:12:29","","public");
INSERT INTO `status_history` VALUES("484","16","Normal ending. :/","2012-12-20 00:24:27","","public");
INSERT INTO `status_history` VALUES("485","16","Tomorrow, the Third Impact begins","2012-12-20 16:14:30","","public");
INSERT INTO `status_history` VALUES("486","16","220 point marksman kill in BF3. I\'m a hero!","2012-12-20 21:53:42",":9","public");
INSERT INTO `status_history` VALUES("487","16","I havent done my Xmas shopping #YOLO","2012-12-23 12:33:45","","public");
INSERT INTO `status_history` VALUES("488","16","CORPSE PARTY OVA!!!!!!!","2012-12-23 22:50:49","","public");
INSERT INTO `status_history` VALUES("489","16","Bah hambug!","2012-12-24 11:20:17","","public");
INSERT INTO `status_history` VALUES("490","16","New Looking Back in 2 days!","2012-12-24 22:55:51","","public");
INSERT INTO `status_history` VALUES("491","1","Merry Christmas!","2012-12-25 09:44:39",":16","public");
INSERT INTO `status_history` VALUES("492","16","Yuki Yuki Yuki Yuki Yuki","2012-12-25 10:16:10","","public");
INSERT INTO `status_history` VALUES("494","1","Uh, I think the dates broke.","2013-01-01 00:28:34",":16","public");
INSERT INTO `status_history` VALUES("495","16","Asuka>Rei but Rei IV>Asuka II","2013-01-01 00:32:01","","public");
INSERT INTO `status_history` VALUES("496","16","you dumb work","2013-01-01 22:57:14","","public");
INSERT INTO `status_history` VALUES("497","1","New glasses!","2013-01-04 22:39:15","","public");
INSERT INTO `status_history` VALUES("498","16","Shinji x Kaji","2013-01-05 00:55:39","","public");
INSERT INTO `status_history` VALUES("499","16","Well hello Platinum Collection","2013-01-10 00:10:16","","public");
INSERT INTO `status_history` VALUES("500","9","Halo 4... was amazing.","2013-01-10 17:04:06","Array:1","public");
INSERT INTO `status_history` VALUES("501","16","Well 3.0 was... bleh","2013-01-10 20:38:05","","public");
INSERT INTO `status_history` VALUES("502","16","I\'m coming back. ","2013-01-11 00:13:27",":1","public");
INSERT INTO `status_history` VALUES("505","1","Intarwebz.","2013-01-18 10:25:48","","public");
INSERT INTO `status_history` VALUES("504","42","Getting Back in to games is such a good feeling i have missed them lol","2013-01-16 23:31:31",":2:1","public");
INSERT INTO `status_history` VALUES("506","16","RIP Seiko... again","2013-01-20 18:54:14","","public");
INSERT INTO `status_history` VALUES("507","1","About ready to give up....","2013-01-21 11:38:53","","public");
INSERT INTO `status_history` VALUES("508","16","MC SERVER IS UP!","2013-01-21 15:02:03",":2","public");
INSERT INTO `status_history` VALUES("509","34","Did you miss me? For I am back","2013-01-21 20:58:16","","public");
INSERT INTO `status_history` VALUES("510","16","I\'ll repost the MC ad in a bit. Needs a re-write","2013-01-22 17:45:07","","public");
INSERT INTO `status_history` VALUES("511","1","Thanks, everyone.","2013-01-23 11:20:01","","public");
INSERT INTO `status_history` VALUES("513","1","Quizzes due by 11:55 PM tonight, but were closed last night at 12:59 AM? What even","2013-01-30 11:03:17","","public");
INSERT INTO `status_history` VALUES("514","16","New Article up!","2013-01-30 23:15:34","","public");
INSERT INTO `status_history` VALUES("516","1","Pidgeons!","2013-02-02 20:40:51","","public");
INSERT INTO `status_history` VALUES("517","16","It is coming","2013-02-07 19:56:26","","public");
INSERT INTO `status_history` VALUES("530","1","stupid finals..","2013-02-18 23:07:24","","public");
INSERT INTO `status_history` VALUES("519","34","I have been lonely lately...","2013-02-11 10:59:49","","public");
INSERT INTO `status_history` VALUES("522","34","I have been lonely lately...","2013-02-11 11:00:10","","public");
INSERT INTO `status_history` VALUES("523","42","Mindcraft is so fun. I Love this game!!!!","2013-02-11 20:55:27",":2:1:9","public");
INSERT INTO `status_history` VALUES("524","16","ok, Clannad made me cry :(","2013-02-12 09:20:17","","public");
INSERT INTO `status_history` VALUES("525","16","Testing a new review format","2013-02-13 11:53:12","","public");
INSERT INTO `status_history` VALUES("526","16","Review going up tonight. Dont miss it!","2013-02-13 16:33:54","","public");
INSERT INTO `status_history` VALUES("527","16","Feedback on the review PLEASE","2013-02-13 18:22:06",":2","public");
INSERT INTO `status_history` VALUES("528","16","What to play next....","2013-02-14 00:31:47",":1","public");
INSERT INTO `status_history` VALUES("529","16","The rose colored college life ","2013-02-17 09:52:53","","public");
INSERT INTO `status_history` VALUES("531","16","I <3 SHAFT","2013-02-19 14:26:03","","public");
INSERT INTO `status_history` VALUES("532","16","I <3 SHAFT STUDIOS","2013-02-19 14:26:19","","public");
INSERT INTO `status_history` VALUES("533","16","Playstation Meh","2013-02-20 21:08:38","","public");
INSERT INTO `status_history` VALUES("534","1","Game On","2013-02-21 23:08:48",":16","public");
INSERT INTO `status_history` VALUES("535","34","\"For $10? Ill do anything\" -Natsume","2013-02-25 22:48:51","","public");
INSERT INTO `status_history` VALUES("536","34","So....that Destiny","2013-02-25 22:56:25","","public");
INSERT INTO `status_history` VALUES("537","16","I have a shelf","2013-02-25 23:49:50","","public");
INSERT INTO `status_history` VALUES("538","1","I am hurting so bad.","2013-02-28 06:27:58","","public");
INSERT INTO `status_history` VALUES("549","1","I do not like green eggs and ham.","2013-03-13 12:50:19","","public");
INSERT INTO `status_history` VALUES("540","16","2 routes left. ","2013-03-02 10:40:38","","public");
INSERT INTO `status_history` VALUES("541","16","AWWWW SNAP SON!","2013-03-04 01:34:03","","public");
INSERT INTO `status_history` VALUES("542","16","I smell a review coming","2013-03-04 12:48:41","","public");
INSERT INTO `status_history` VALUES("543","16","Review up! Go read!","2013-03-05 22:28:57","","public");
INSERT INTO `status_history` VALUES("544","16","I bought a car","2013-03-07 17:22:56","","public");
INSERT INTO `status_history` VALUES("545","16","PANI PONI X","2013-03-09 22:21:30","","public");
INSERT INTO `status_history` VALUES("546","16"," A creature like you having a brain residing in his skull...is already a miracle in and of itself.","2013-03-10 23:17:02","","public");
INSERT INTO `status_history` VALUES("547","16","Uwehehe","2013-03-10 23:17:24","","public");
INSERT INTO `status_history` VALUES("548","34","Zetsuboushita!","2013-03-12 09:29:59",":16","public");
INSERT INTO `status_history` VALUES("550","16","Bully Vibrantblade","2013-03-13 16:03:37","","public");
INSERT INTO `status_history` VALUES("551","1","Sorry about no article today guys, been busy","2013-03-14 21:18:44","","public");
INSERT INTO `status_history` VALUES("552","16","That was a sad movie :(","2013-03-14 21:46:30","","public");
INSERT INTO `status_history` VALUES("557","1","Server\'s up","2013-03-19 16:09:16",":9","public");
INSERT INTO `status_history` VALUES("554","9","I don\'t need luck, I have ammo.","2013-03-17 18:30:03","Array:1:34","public");
INSERT INTO `status_history` VALUES("555","16","baka chi","2013-03-17 20:08:22",":34","public");
INSERT INTO `status_history` VALUES("556","34","Welcome to Bungie, we got steak!","2013-03-17 22:27:48",":1:2","public");
INSERT INTO `status_history` VALUES("558","9","On the Minecraft server, anyone wanna join?","2013-03-19 16:17:29",":1","public");
INSERT INTO `status_history` VALUES("560","1","Learning to make MC mods!","2013-03-20 12:12:28","","public");
INSERT INTO `status_history` VALUES("561","3","Silly meatbags.","2013-03-20 14:08:05","Array:5:55:1","public");
INSERT INTO `status_history` VALUES("565","1","Making up a final today, won\'t be on til later","2013-03-21 10:09:36","","public");
INSERT INTO `status_history` VALUES("563","34","ach and every one of you is wonderful in your own special way.","2013-03-21 09:02:08","","public");
INSERT INTO `status_history` VALUES("564","34","Each and every one of you is wonderful in your own special way","2013-03-21 09:02:22",":1","public");
INSERT INTO `status_history` VALUES("570","1","wtf one of my statuses came back","2013-03-22 17:38:05","","public");
INSERT INTO `status_history` VALUES("567","9","Soo drunk right now","2013-03-22 00:28:10","","public");
INSERT INTO `status_history` VALUES("568","9","What\'s going on right now?","2013-03-22 17:34:20","","public");
INSERT INTO `status_history` VALUES("576","1","Server\'s up :)","2013-03-23 13:43:27",":16","public");
INSERT INTO `status_history` VALUES("572","16","Vibrantblade is a liar","2013-03-22 23:09:12","","public");
INSERT INTO `status_history` VALUES("573","9","What\'s going on right now?","2013-03-23 10:31:25","","public");
INSERT INTO `status_history` VALUES("575","16","server day ","2013-03-23 11:05:54",":1","public");
INSERT INTO `status_history` VALUES("577","9","Finally did a perfect ME2 playtrough. Everyone survived.","2013-03-23 17:01:39",":1:16","public");
INSERT INTO `status_history` VALUES("586","1","why do statuses keep coming back","2013-03-27 23:29:09","","public");
INSERT INTO `status_history` VALUES("579","16","Victory Monday!","2013-03-24 00:09:09","","public");
INSERT INTO `status_history` VALUES("580","16","USPS sux","2013-03-25 15:12:49","","public");
INSERT INTO `status_history` VALUES("581","34","Prototype 2...freaking boss","2013-03-25 23:46:17","","public");
INSERT INTO `status_history` VALUES("582","34","Separated by war. A forbidden love...","2013-03-26 09:11:13","","public");
INSERT INTO `status_history` VALUES("583","16","Victory Tuesday? Please USPS?","2013-03-26 11:16:22","","public");
INSERT INTO `status_history` VALUES("584","16","Screw you USPS. All of my anger","2013-03-26 11:31:46",":1:34","public");
INSERT INTO `status_history` VALUES("585","16","VICTORY :D","2013-03-27 21:57:27",":1:34","public");
INSERT INTO `status_history` VALUES("587","1","On the server, anyone wanna join?","2013-03-28 21:08:41","","public");
INSERT INTO `status_history` VALUES("589","1","Doing some work on the site","2013-03-29 19:28:56","","public");
INSERT INTO `status_history` VALUES("595","1","MC 360 update April 5th","2013-04-02 01:11:33","","public");
INSERT INTO `status_history` VALUES("591","16","mai waifu","2013-03-31 11:54:31","","public");
INSERT INTO `status_history` VALUES("592","16","24","2013-04-01 00:04:44","","public");
INSERT INTO `status_history` VALUES("594","16","23","2013-04-01 23:54:35","","public");
INSERT INTO `status_history` VALUES("596","34","I like toitles ","2013-04-02 19:30:29","","public");
INSERT INTO `status_history` VALUES("600","16","21","2013-04-04 12:26:48","","public");
INSERT INTO `status_history` VALUES("598","16","22","2013-04-03 00:36:31","","public");
INSERT INTO `status_history` VALUES("599","34","I hereby decree myself as Lord Vibrant, Lord of the Minecraft Server","2013-04-03 12:13:17","","public");
INSERT INTO `status_history` VALUES("602","1","Horses coming in MC 1.6","2013-04-05 10:38:34","","public");
INSERT INTO `status_history` VALUES("603","16","4/8: Project Teaser","2013-04-05 11:33:49",":34:1","public");
INSERT INTO `status_history` VALUES("606","1","Game On is a play on words from \"flame on,\" human torch.","2013-04-08 11:18:17","","public");
INSERT INTO `status_history` VALUES("605","34","Surfing on the body of civilians makes Prototype 2 awesome","2013-04-07 10:36:15","","public");
INSERT INTO `status_history` VALUES("607","16","12/24/2013","2013-04-08 13:43:21",":1","public");
INSERT INTO `status_history` VALUES("612","1","Nether\'s fixed","2013-04-12 21:33:40","","public");
INSERT INTO `status_history` VALUES("609","16","\"Elementary, my dear librarian.\"","2013-04-09 10:58:44","","public");
INSERT INTO `status_history` VALUES("610","9","It\'s not a plan, but it\'s a perfect plan.","2013-04-11 23:27:03","","public");
INSERT INTO `status_history` VALUES("611","16","\"Watson! I mean, Erisu!\"","2013-04-12 09:37:00","","public");
INSERT INTO `status_history` VALUES("613","16","\"Do you like mysteries, Watson?\"","2013-04-13 12:24:44",":34","public");
INSERT INTO `status_history` VALUES("614","9","From now on, we\'re calling gunpowder Creeper shit","2013-04-13 15:12:17",":1:34:16:2","public");
INSERT INTO `status_history` VALUES("615","1","Cured a Zombie Villager","2013-04-13 22:59:45","","public");
INSERT INTO `status_history` VALUES("616","34","Yukiko and Chie are so Kawaii!","2013-04-14 10:17:16","","public");
INSERT INTO `status_history` VALUES("622","1","6","2013-04-18 10:50:30","","public");
INSERT INTO `status_history` VALUES("618","34","...","2013-04-15 08:54:11","","public");
INSERT INTO `status_history` VALUES("619","34","7 Days to go...","2013-04-17 10:53:20",":16","public");
INSERT INTO `status_history` VALUES("620","16","7","2013-04-17 16:16:29","","public");
INSERT INTO `status_history` VALUES("621","34","6 Days to go...","2013-04-18 08:43:33",":16","public");
INSERT INTO `status_history` VALUES("623","16","6!","2013-04-18 11:59:52",":34","public");
INSERT INTO `status_history` VALUES("638","1","why do statuses keep coming back","2013-04-24 12:30:14","","public");
INSERT INTO `status_history` VALUES("625","34","5 days to go...","2013-04-18 23:13:18",":16","public");
INSERT INTO `status_history` VALUES("626","16","5","2013-04-18 23:32:31","","public");
INSERT INTO `status_history` VALUES("627","34","4 days to go...","2013-04-19 23:09:02","","public");
INSERT INTO `status_history` VALUES("628","16","4","2013-04-19 23:36:39","","public");
INSERT INTO `status_history` VALUES("629","16","3 days left","2013-04-21 01:40:09","","public");
INSERT INTO `status_history` VALUES("630","34","3 days to go...","2013-04-21 01:55:38","","public");
INSERT INTO `status_history` VALUES("631","9","I adopted 3 chicklets, I named them Ross, Joey and Chandler.","2013-04-21 05:08:01",":1","public");
INSERT INTO `status_history` VALUES("632","16","2","2013-04-21 23:58:44","","public");
INSERT INTO `status_history` VALUES("633","34","2 days to go...","2013-04-22 09:14:15","","public");
INSERT INTO `status_history` VALUES("634","16",">24 hours","2013-04-23 01:21:13","","public");
INSERT INTO `status_history` VALUES("635","34","1 day to go...","2013-04-23 09:23:55","","public");
INSERT INTO `status_history` VALUES("636","16","Raws are up!","2013-04-23 11:20:32","","public");
INSERT INTO `status_history` VALUES("637","9","You can order Pizza with Kinect!","2013-04-24 00:30:44",":1","public");
INSERT INTO `status_history` VALUES("651","1","Coming back home tomorrow.","2013-05-03 19:55:32","","public");
INSERT INTO `status_history` VALUES("640","34","The day is upon us brothers! Not to wait for the Subbed version!","2013-04-24 23:31:54","","public");
INSERT INTO `status_history` VALUES("641","16","UTW, 3.33 where?","2013-04-25 12:12:27","","public");
INSERT INTO `status_history` VALUES("642","34","What\'s going on right now?","2013-04-26 08:45:12","","public");
INSERT INTO `status_history` VALUES("643","16","Subs huzzah","2013-04-27 19:30:55","","public");
INSERT INTO `status_history` VALUES("644","16","Holy crap... 3.33 was...","2013-04-27 22:33:14","","public");
INSERT INTO `status_history` VALUES("645","16","Review tomorrow. Re-watch required","2013-04-28 15:44:55","","public");
INSERT INTO `status_history` VALUES("646","16","Can\'t review it. Too... strange?","2013-04-28 23:33:20","","public");
INSERT INTO `status_history` VALUES("647","16","fruit","2013-04-29 10:43:01","","public");
INSERT INTO `status_history` VALUES("648","9","Avocado!","2013-05-02 12:19:17","","public");
INSERT INTO `status_history` VALUES("649","16","\"You keep repeating until you find happiness\"","2013-05-02 14:01:31",":1","public");
INSERT INTO `status_history` VALUES("652","54","Why are you reading my status ? ","2013-05-04 12:39:28",":1","public");
INSERT INTO `status_history` VALUES("660","1","Wow, lots of posts, great job guys. :)","2013-05-11 12:29:33","","public");
INSERT INTO `status_history` VALUES("655","9","Winners don\'t use drugs.","2013-05-05 15:48:36","","public");
INSERT INTO `status_history` VALUES("656","9","Screw hell, I\'m going to Valhalla!","2013-05-05 20:19:22","","public");
INSERT INTO `status_history` VALUES("657","16","broke computer :(","2013-05-06 15:26:44","","public");
INSERT INTO `status_history` VALUES("658","9","Upgraded Valhalla on the MC server.","2013-05-09 06:52:22",":1","public");
INSERT INTO `status_history` VALUES("659","34","It is finished","2013-05-09 16:24:25","","public");
INSERT INTO `status_history` VALUES("661","9","Nipple squirrel ham","2013-05-11 18:34:00",":1","public");
INSERT INTO `status_history` VALUES("662","16","Dev agreed to interview!","2013-05-12 19:49:03","","public");
INSERT INTO `status_history` VALUES("664","16","Interview goes up tomorrow. ","2013-05-15 22:02:20","","public");
INSERT INTO `status_history` VALUES("665","16","More content next week!","2013-05-16 13:28:37","","public");
INSERT INTO `status_history` VALUES("666","9","Somebody was in my Towar of Powar...","2013-05-17 16:09:23","","public");
INSERT INTO `status_history` VALUES("667","9","I just saw the fucking Batmobile","2013-05-18 10:59:54",":16:1:34","public");
INSERT INTO `status_history` VALUES("668","16","SASHA 4 LYF","2013-05-19 21:16:32","","public");
INSERT INTO `status_history` VALUES("669","16","Xbox Round Up shortly after event ends","2013-05-21 12:59:13","","public");
INSERT INTO `status_history` VALUES("670","16","Xbox One... ummmm wut?","2013-05-21 13:09:05","","public");
INSERT INTO `status_history` VALUES("671","16","That was bad","2013-05-21 14:06:07","","public");
INSERT INTO `status_history` VALUES("672","34","That was terrible...","2013-05-21 14:08:47","","public");
INSERT INTO `status_history` VALUES("673","9","It was not that bad","2013-05-21 18:14:17","","public");
INSERT INTO `status_history` VALUES("674","16","No, it was god awful","2013-05-21 18:44:00","","public");
INSERT INTO `status_history` VALUES("675","9","Heh, had 910 MS points on my account, no memory of buying them.","2013-05-23 12:09:31",":1","public");
INSERT INTO `status_history` VALUES("676","16","Sasha x Potato ","2013-05-23 19:51:53","","public");
INSERT INTO `status_history` VALUES("677","12","Hello, world!","2013-05-26 23:58:48","","public");
INSERT INTO `status_history` VALUES("696","1","Back in black, baby.","2013-08-08 10:48:56","","public");
INSERT INTO `status_history` VALUES("680","9","Right, I\'m sold enough to get the X1","2013-06-10 16:07:43","","public");
INSERT INTO `status_history` VALUES("681","16","MOTHER TRUCKING PS4","2013-06-10 23:13:33","","public");
INSERT INTO `status_history` VALUES("682","9","Damn Sony, well played. Can\'t wait for Microsofts last stand.","2013-06-11 00:14:56","","public");
INSERT INTO `status_history` VALUES("683","16","First PC parts inbound","2013-06-19 10:07:32","","public");
INSERT INTO `status_history` VALUES("684","9","What\'s going on right now?","2013-06-21 11:45:13","","public");
INSERT INTO `status_history` VALUES("685","9","What\'s going on right now?","2013-06-21 11:45:20","","public");
INSERT INTO `status_history` VALUES("706","9","The Roof on Valhalla is now at least twice as big as the hall itself","2013-08-27 14:00:52",":1","public");
INSERT INTO `status_history` VALUES("687","16","Almost done buying parts!","2013-06-21 23:32:57","","public");
INSERT INTO `status_history` VALUES("693","55","is the server down it says cant reach server","2013-07-10 12:37:44","","public");
INSERT INTO `status_history` VALUES("694","16","Need better upload. curses","2013-07-10 16:29:23","","public");
INSERT INTO `status_history` VALUES("695","16","KSP stream times","2013-07-23 11:28:22","","public");
INSERT INTO `status_history` VALUES("721","1","Unbelievable.","2014-03-20 14:00:59","","public");
INSERT INTO `status_history` VALUES("698","55","i love dreamspand","2013-08-19 16:34:51","","public");
INSERT INTO `status_history` VALUES("699","54","The King of the Pirates ","2013-08-20 15:12:21","","public");
INSERT INTO `status_history` VALUES("700","55","I\'m so bored right now","2013-08-23 13:06:00","","public");
INSERT INTO `status_history` VALUES("701","1","sup","2013-08-23 16:33:41","","public");
INSERT INTO `status_history` VALUES("702","16","Xenogears and Paper, Please","2013-08-23 18:39:02","","public");
INSERT INTO `status_history` VALUES("704","1","New features coming up.","2013-08-25 14:42:43","","public");
INSERT INTO `status_history` VALUES("705","55","Can\'t wait to make a new episode today hopefully google chrome isnt a bitch today","2013-08-27 13:49:32",":1","public");
INSERT INTO `status_history` VALUES("708","1","so tired..","2013-09-11 18:55:17","","public");
INSERT INTO `status_history` VALUES("709","1","Suddenly. Meep.","2013-09-13 00:12:48","","public");
INSERT INTO `status_history` VALUES("710","2","pickles pickles","2013-09-23 14:32:38",":1","public");
INSERT INTO `status_history` VALUES("712","1","Workin on a mod..","2013-09-29 10:09:39","","public");
INSERT INTO `status_history` VALUES("715","1","vidya gaems","2014-01-17 12:15:16","","public");
INSERT INTO `status_history` VALUES("714","55","Restarted minecraft lets play if anyone wants to collaborate in lets play with me on any server jest add me on skype and send me message i\'ll get back to u as soon as i can","2013-12-23 10:51:45","","public");
INSERT INTO `status_history` VALUES("716","1","Squeebit","2014-01-19 18:11:25","","public");
INSERT INTO `status_history` VALUES("717","2","","2014-01-23 21:46:59","","public");
INSERT INTO `status_history` VALUES("718","1","Three Minecraft servers, oh yeah.","2014-01-25 09:27:15","","public");
INSERT INTO `status_history` VALUES("720","1","Shaboom","2014-03-06 14:27:14","","public");
INSERT INTO `status_history` VALUES("723","1","Meep","2014-04-24 15:06:00","","public");
INSERT INTO `status_history` VALUES("724","1","sup","2014-04-29 14:48:32","","public");
INSERT INTO `status_history` VALUES("725","3","A.I. activated.","2014-05-31 16:31:03",":1","public");
INSERT INTO `status_history` VALUES("726","1","Planning a large overhaul on the site!","2014-05-31 17:31:14","","public");
INSERT INTO `status_history` VALUES("727","1","This is Part 1, what do you think?","2014-06-05 20:05:49","","public");
INSERT INTO `status_history` VALUES("728","1","Working on Part 2.","2014-06-10 16:43:35","","public");
INSERT INTO `status_history` VALUES("729","1","The force. May it be with thee!","2014-06-24 14:59:04","","public");
INSERT INTO `status_history` VALUES("730","1","And this is Phase 2. Thoughts?","2014-06-26 18:45:45","","public");
INSERT INTO `status_history` VALUES("731","1","So excited.","2014-06-27 10:34:27","","public");
INSERT INTO `status_history` VALUES("732","1","I HAVE WOLF STICKERS. :D","2014-06-27 10:57:55","","public");
INSERT INTO `status_history` VALUES("736","1","Mod updates!","2014-07-26 19:15:47","","public");
INSERT INTO `status_history` VALUES("734","54","\"A crew with no respect, and a captain who doesn\'t demand it our destined to fall apart quickly.\"","2014-07-21 12:50:20","","public");
INSERT INTO `status_history` VALUES("735","54","Long status is to long e.e;","2014-07-21 12:51:27","","public");
INSERT INTO `status_history` VALUES("739","1","A lot of changes coming.","2014-12-06 20:58:33","","public");
INSERT INTO `status_history` VALUES("738","54","I now have a reason to smile everyday ;u; ","2014-11-15 18:49:47","","public");
INSERT INTO `status_history` VALUES("740","1","Almost done. Was gonna upload this weekend, but left my flash drive at work. -_-","2014-12-13 15:27:03","","public");
INSERT INTO `status_history` VALUES("741","1","Upload tiem.","2014-12-19 14:22:54","","public");
INSERT INTO `status_history` VALUES("742","1","New stuff!","2014-12-19 16:03:24","","public");
INSERT INTO `status_history` VALUES("743","1","Can\'t decide if I\'m cold or hot.","2014-12-20 09:58:44","","public");
INSERT INTO `status_history` VALUES("746","1","Merry Christmas!","2014-12-25 09:00:15","","public");
INSERT INTO `status_history` VALUES("745","8","Uh... How long was I gone? D:","2014-12-20 17:09:27","","public");
INSERT INTO `status_history` VALUES("748","1","Issues have been fixed.","2015-01-02 10:28:15","","public");
INSERT INTO `status_history` VALUES("749","1","Knock knock.","2015-01-04 10:45:41","","public");
INSERT INTO `status_history` VALUES("750","1","Snagglepuss, even!","2015-02-20 13:53:26","","public");
INSERT INTO `status_history` VALUES("751","1","Oh brother.","2015-02-24 15:23:30","","public");
INSERT INTO `status_history` VALUES("752","1","Oh brother.","2015-02-24 15:23:30","","public");
INSERT INTO `status_history` VALUES("753","3","At your service, client.","2015-02-25 09:18:46",":1","public");
INSERT INTO `status_history` VALUES("754","1","Zzzzzip zip.","2015-02-25 11:25:52","","public");
INSERT INTO `status_history` VALUES("755","1","Bing blong","2015-03-03 12:32:06","","public");
INSERT INTO `status_history` VALUES("756","1","Test","2016-04-08 09:39:59","0","public");



DROP TABLE `tasks`;

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `about` text NOT NULL,
  `code` longtext NOT NULL,
  `userid` int(11) NOT NULL,
  `run_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE `topics`;

CREATE TABLE `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(80) NOT NULL,
  `post` text NOT NULL,
  `topic_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `boardid` int(11) NOT NULL,
  `reply` enum('no','yes') NOT NULL,
  `readby` text NOT NULL,
  `description` text NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `announced` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `stickied` tinyint(1) NOT NULL DEFAULT '0',
  `autoLock` int(11) NOT NULL DEFAULT '0',
  `lastedit` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `likedBy` text NOT NULL,
  `rating` text NOT NULL,
  `sealed` enum('yes','no') NOT NULL DEFAULT 'no',
  `tags` text NOT NULL,
  `edit_reason` text NOT NULL,
  `style` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2608 DEFAULT CHARSET=latin1;

INSERT INTO `topics` VALUES("2601","Update: Successfully migrated.","Automatic update was made by: [user=1][br][br]Welcome to our new host: Dreamhost. Expect things to get even cooler from here on out.[br][hr]This post was automatically made when the update was posted. You may view it on the updates page, or reply to it here.","2601","3","2015-02-24 16:16:38","28","no","","","0000-00-00 00:00:00","0","0","0","0","0","3","","","no","","","");
INSERT INTO `topics` VALUES("2602","Update: Site Rebranding / Welcome to Zollernverse","Automatic update was made by: [user=1][br][br]Alrighty, so I\'m sure multiple users (and people in general, for that matter) are going to have some questions. First, I know I said I would carry over the topics, and I still may. But one drawback of this host is that they use an older version of database software and I can\'t do large queries, and I had to do a few rows at a time. Which, to be fair, I couldn\'t do on FatCow, either. We are currently hosted with Dreamhost, and so far I am very impressed. I expect issues eventually, as nothing is perfect. I just can\'t say enough good things about our new host right now.\n\nAnyway, the whole \"Minecraft theme\" thing wasn\'t going anywhere, so I\'ve opted to completely abandon Minecraft altogether. All mods and updates to the servers will still be hosted here and news about them will still be posted, so you don\'t have to worry about being in the dark. Zollernverse was originally DreamSpand, but as I said that site was just not going anywhere. Think of this site as DreamSpand\'s love-child. Content is currently being added bit by bit, and if you wish to help with that endeavor, then please contact me personally and we\'ll talk about it, because I could definitely use the help.\n\nAlso, the site\'s Two-Factor Authentication is acting a bit strange right now, so I would recommend not using it until I can fix the problem. You may still use it if you wish, but there\'s an issue with entering the PIN where it asks for it more than once, and on the second time it sometimes won\'t submit properly. I plan to look into it soon, there\'s just other things that occupy my time right now obviously, given the move and the rebranding of the site for the umpteenth time. Hopefully it gets squared away soon, though.\n\nAnywhosits, the site is now a gaming [i]and[/i] tech Web site, to bring in those that play games as well as those that develop them. My plan is to mix these two worlds together seamlessly and have one affect the other in a positive, inspiring way. Speaking of bringing worlds together, if you\'re interested in parternering (site-to-site linking/affiliating) with us, please contact me at [url=mailto:admin@zollernverse.org]admin@zollernverse.org[/url], and I\'ll be more than happy to talk about it.\n\nPlease let me know in the comments if you have any questions or suggestions. Thanks![br][hr]This post was automatically made when the update was posted. You may view it on the updates page, or reply to it here.","2602","3","2015-02-25 07:36:03","28","no",":67","","0000-00-00 00:00:00","0","0","0","0","0","4","","","no","","","");
INSERT INTO `topics` VALUES("2603","Update: A Legend Died Today","Automatic update was made by: [user=1][br][br]I don\'t know if you\'ve heard (probably so), but Leonard Nimoy, the actor who played the very loved Spock in Star Trek, passed away today at 83. I don\'t normally post about news stuff on here, but this guy was a huge hero to me in a big way. He was that to a lot of people, actually. I was very saddened to learn this news as I\'m sure many people were as well. R.I.P Leonard/Spock.[br][hr]This post was automatically made when the update was posted. You may view it on the updates page, or reply to it here.","2603","3","2015-02-27 16:30:47","28","no",":69:64","","0000-00-00 00:00:00","0","0","0","0","0","3","","","no","","","");
INSERT INTO `topics` VALUES("2604","READ FIRST","<h3>&nbsp;<b>Rules &amp; Suggestions</b></h3><b></b><blockquote>These are just a few guidelines and helpful tips to make your experience simpler and more enjoyable.<br><br></blockquote><ol><li>We want to welcome you to this site warmly - please, don\'t hesitate to give us that opportunity. Welcoming new people helps us feel more at home too. By no means is this required, it just helps us know you better. So what I\'m saying here is don\'t be shy. We don\'t usually bite.</li><li>If you\'re leaving, then while we hate to see you go, please give us a reason. Believe it or not, people have, in the past, posted in these kind of boards saying they were going outside for a few hours, or to the bathroom even. We typically prefer you not to post departures unless they\'re for extended periods of time, e.g. three days to a week+. We are also not unreasonable, and would be more than happy to help you resolve any issues that might pop up.</li><li>Please don\'t use someone\'s else\'s intro topic to introduce yourself. Be more special than that and make your own so that we can welcome you (and them) properly.</li><li>Be courteous to others, no matter what the situation may be.</li></ol><blockquote><p>Thanks!<br></p></blockquote>","2604","1","2015-02-28 20:57:58","76","no",":1","Please read this topic first before posting here. :)","2015-02-28 20:57:58","0","1","1","0","0","7","","","no","","","");
INSERT INTO `topics` VALUES("2605","Update: Avenging Revenants","Automatic update was made by: [user=1][br][br]Just a casual reminder for everyone - we are running a YouTube Let\'s Play channel and would love for you to check it out. We\'re called the [url=https://www.youtube.com/channel/UCl-u6cPQ1lpD_RvzA_SsN7A]Avenging Revenants[/url] - it sounds silly, but we get it done.[br][hr]This post was automatically made when the update was posted. You may view it on the updates page, or reply to it here.","2605","3","2015-03-02 13:02:52","28","no",":69","","0000-00-00 00:00:00","0","0","0","0","0","2","","","no","","","");
INSERT INTO `topics` VALUES("2606","Update: New Review!","Automatic update was made by: [user=1][br][br]Hey everyone! Check out our new Destiny review, courtesy of [user=58]! He\'s also one of the people from Avenging Revenants, along with me and Mike. Give it a read. :)[br][hr]This post was automatically made when the update was posted. You may view it on the updates page, or reply to it here.","2606","3","2015-03-10 08:03:53","28","no","","","0000-00-00 00:00:00","0","0","0","0","0","1","","","no","","","");
INSERT INTO `topics` VALUES("2607","Update: Easier to Sign Up","Automatic update was made by: [user=1][br][br]Hey everybody! Signing up just got a lot easier for everybody. No more confusing letters and numbers that you have to type in from hard-to-read images. Utilizing the Google API for reCAPTCHA, users can now sign up with ease by simply ticking a checkbox that simply says \"I\'m not a robot\" and the site does the rest. If any issues are found with this, please report them to me immediately via [url=mailto:support@zollernverse.org]support@zollernverse.org[/url], and I will get right on working on it. Hopefully this will cease deterrence of previously-interested guests. The other CAPTCHA images were hand-made by yours truly, and for a while it definitely worked, but it was just not practical. Now things should be easier. Happy gaming![br][hr]This post was automatically made when the update was posted. You may view it on the updates page, or reply to it here.","2607","3","2015-03-16 15:10:30","28","no","","","0000-00-00 00:00:00","0","0","0","0","0","0","","","no","","","");



DROP TABLE `update_comments`;

CREATE TABLE `update_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `update_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `update_comments` VALUES("8","67","152","Sounds good to me.","2015-02-25 09:36:57");



DROP TABLE `updates`;

CREATE TABLE `updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(80) NOT NULL,
  `post` text NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=latin1;

INSERT INTO `updates` VALUES("1","Welcome!","Welcome, one and all, to the grand opening of DreamSpand Gaming! Our domain name was graciously (and affordably!) offered to us by the amazing [url=http://www.fatcow.com]FatCow[/url] hosting service. If you\'re looking for an awesome web host, they are definitely your best shot.\n\n\n\nWell, welcome to DreamSpand Gaming! This will be the home site that will be extended from the ProBoards forum, for the time being. We sincerely hope you enjoy your stay here. This site is extremely dynamic and interactive, as it was coded entirely by yours truly, no outside help whatsoever, by hand.\n\n\n\nNew features will be added weekly - the site is [i]never[/i] done growing! If there\'s anything we can for you to make your stay here better, please do not hesitate to ask us. Also, please note that DreamSpand staff will -NEVER- ask you for your password, or any other personal data.\n\n\n\nWelcome to the next generation: DreamSpand.\n\n\n\n-- Alpha","2012-06-15 11:06:39","1");
INSERT INTO `updates` VALUES("2","New Things","Hey everyone, there\'s some new things out now. The main thing is the forum achievements feature. You can do different things around the forums to earn these achievements and get your gamer points up. In the future, gamer points may be used for cool special things, like extras for the site.\n\n\n\nI\'ve also redesigned the navigation a bit; I\'ve taken away the bars and just made a welcome table up top.\n\n\n\nIf you have any questions then please feel free to ask.\n\n\n\nThanks!\n\n\n\n-- Alpha","2012-06-22 12:26:19","1");
INSERT INTO `updates` VALUES("8","Site Chat: Coming Soon!","Coming up very soon is our very own Java chat client, written by yours truly, from the ground up. I\'ve still got a few things to add on to it and a couple of kinks to work out, but I promise it\'s almost done. I started on it back in October in 2011 and took a break until today, when I stumbled across the missing piece that I needed in order to make it work. Your accounts will be connected to the Java chat. :)","2012-06-25 14:52:56","1");
INSERT INTO `updates` VALUES("7","New RSS!","We now have an RSS feed that will update whenever we add one of these updates. Subscribe to keep up with all the latest features! ","2012-06-24 10:52:32","1");
INSERT INTO `updates` VALUES("9","RSS Issues","We\'re terribly sorry for the inconvenience, but our RSS seems to be malfunctioning minorly. Rest assured that we are working hard to fix the problem.","2012-06-26 11:20:10","1");
INSERT INTO `updates` VALUES("10","Errors fixed","Sorry for the errors, everyone. Everything should be all better now.","2012-06-26 11:35:44","1");
INSERT INTO `updates` VALUES("11","Quoting","You can now quote a user\'s post in your own. This makes replying to a specific post much, much easier. Also, it uses post IDs, so there\'s no way anyone can edit what you said. Hope this helps you.","2012-06-26 13:41:29","1");
INSERT INTO `updates` VALUES("12","We\'re Indexed","This morning I sent the site in to more web site indexers (engines you submit your site to so they can get noticed). One\'s Google, another\'s Bing, etc. The RSS feeds will help a ton, too. That spreads us out quite a bit.\n\nTell your friends about us, ask em to help us about. Hope you\'re enjoying your time here.","2012-06-26 15:10:42","1");
INSERT INTO `updates` VALUES("13","Mark As Read Buttons","You can now mark all posts or a single board as read. That will save you some time instead of having to go to every board and reading every single topic.","2012-06-27 10:47:21","1");
INSERT INTO `updates` VALUES("14","\"Like\" Upgrades","Maybe you\'ve noticed that when viewing a user\'s status, you could see how many likes they had, but not who it was. Now you can see everyone who liked your statuses and have quick access to their profiles by clicking their links.","2012-06-29 11:04:09","1");
INSERT INTO `updates` VALUES("15","Facebook","View our [url=http://www.facebook.com/DreamSpandGaming]Facebook Page[/url] so you can receive exclusive site updates in the future! We hope to see you there, and don\'t forget to tell your friends about us.","2012-06-29 15:03:10","1");
INSERT INTO `updates` VALUES("16","New Skin","You can now change your preferred site layout by modifying your profile. Each skin comes with a different banner and background. Only admins may create skins. When you\'re browsing through the skins, the site will update in real-time so you can have a preview.\n\nEnjoy!","2012-07-04 18:25:29","1");
INSERT INTO `updates` VALUES("17","Hey everyone!","It\'s been a while since I last updated - how is everyone doing? Sorry I\'ve been out of the scene here lately, I\'ve had a lot of family and friend stuff come up and I\'ve had to be there for people. Rest assured that more updates are coming, I even added a couple over the weekend. I will also be working more this weekend.\n\nHope yall are enjoying the site. Don\'t hesitate to message me if you have any questions.","2012-07-26 09:46:50","1");
INSERT INTO `updates` VALUES("18","New Features","Some new features have been added as of this morning:\n[list]\n[*]Blocked users. This feature allows you to block certain users from messaging you or commenting on your statuses.\n[*]Staff notes. With this feature, staff can leave little messages at the bottom of your posts, sort of like footnotes.\n[*]\"Like\" topics. You can choose to like a topic and your name will appear below the topic description.\n[*]Who\'s posted? This feature turns the number of replies in the viewing topics area into a link that opens a popup window containing the names of everyone who\'s posted in that particular topic.\n[*]Topic views. Pretty obvious, just shows how many views a topic\'s had.\n[*]Log in to see posts. Admins have the option to enable or disable a feature that requires guests to log in to see the last post cell or not.\n[*]Alternative drop down color picker. In the posting area, you can now click on a color button and a list of them will be displayed, click on one to insert the color.\n[*]Delete account. If, for whatever reason, you need to delete your account, you can do so from the \"edit profile\" page.\n[*]Ban / Modify links in mini profile. You now have a link directly to edit your profile underneath your contact information in your mini profile, and staff have a quick-access ban button.\n[*]Enable / Disable news fader. Members have the option to turn the news fader on or off in their profiles.\n[*]Disable PMs. With this feature, you can turn off the messaging system and no one (except admins) will be able to message you.\n[/list]","2012-08-03 21:14:03","1");
INSERT INTO `updates` VALUES("19","A few new things.","Hey guys, I\'m back, and I brought some new features with me:\n[list]\n[*]Profile comments. You can now comment on other users\' profiles, and it will update in real time.[/*]\n[*]Name history. Every time you change your display name, it will be added into your name history that can be viewed by visiting your profile.[/*]\n[*]Change password. You can now change your password by modifying your profile.[/*]\n[*]Post tick. When you\'re viewing the topics in a board, if you\'ve replied to the topic, a little round check-mark will appear next to the title.[/*]\n[*]Update poster. Whenever an admin makes an update, you\'ll know about it because DreamSpand (the robot) will post about it in the Front Office.[/*]\n[/list]\nI\'ve also fixed a few glitches and added in a little extra security. :)","2012-08-12 16:24:46","1");
INSERT INTO `updates` VALUES("20","Introducing Reputation","Finally, much like other forums, we now have a reputation/karma system. You may vote a user up or down once per hour. New users will also not be able to use this feature right off. You must have at least 50 gamer points before you can use this feature. Seems pretty easy, right? Enjoy!","2012-08-16 16:20:38","1");
INSERT INTO `updates` VALUES("21","Drafts.","You can now save your posts before you make them. In other words, you can save drafts of your posts. While posting, there is a link that reads \"Save Draft\" above the post form. For each time it is clicked, it will update the current draft in the database. Keep two things in mind: first, it doesn\'t -yet- autosave. It\'s definitely coming, and I can do it, I just have a couple of bugs to work out first. Secondly, you can only have one draft per board. If you decide to save another draft in the same board where you have another one, it will overwrite the previous entry. This feature is useful, but use it wisely. \n\nAlso, if you make a post in a board where you have a saved draft, the draft will be deleted, because it will think that you\'re done with the temporary save. Hope you guys like this, there will be improvements.","2012-08-17 13:56:28","1");
INSERT INTO `updates` VALUES("22","log in and guest","Sorry for the inconvenience, there was a problem with the site but now we have it back up for you all to start having fun again.","2012-08-19 22:31:32","2");
INSERT INTO `updates` VALUES("23","New things.","So I\'m back and I brought some new stuff with me. Primarily, two new skins, called F.E.A.R. and Achiever. More of these skins are to come, as well. You can also find a few of the new features I\'ve added by viewing the Forum Features board. We have sub-boards now, finally. How great is that?\n\nMany, many more add-ons are to come. As I said before, the site is never done growing. :D","2012-08-24 14:14:45","1");
INSERT INTO `updates` VALUES("24","GoogleBot!","So maybe you\'ve noticed our new, robotic addition to the site. Well, Google has a bot, something called a \"web crawler\" or a \"site indexer\" that visits the site to update the site\'s data in the search engine. So I thought it would be kinda cool to give it an account! No, it\'s not alive or anything like that, it merely signs on when it\'s here.\n\nJust thought it would be kinda neat.","2012-08-31 17:40:08","1");
INSERT INTO `updates` VALUES("25","Well, that was weird.","For anyone who may have been viewing the site within the past hour and a half, you may have seen something like \"SERVER: Can\'t connect to local MySQL server through socket \'/var/run/mysqld/mysqld.sock\' (2)\" appearing and that was it. My best guess is that FatCow\'s (my host) servers were down for a bit. Everything\'s all good though, just wanted to reassure everyone that for once it wasn\'t my fault. Yay.","2012-09-01 19:52:44","1");
INSERT INTO `updates` VALUES("26","New Features!","Hey, everyone! I\'m back and I brought some new, shiny things with me, woohoo! Before we get to that though, I would like to address the issue of glitches and security. While updating the site the other day, I made a couple mistakes and subsequently that carried over into multiple other mistakes. If you ever have any issues, please, e-mail me at admin@dreamspand.com and I will be more than happy to assist you myself. Okay, so time for the fun part:\n\n[list]\n[*]Topic E-Mails. You now have the option to opt in or out of having an e-mail sent to you when someone replies to a topic you\'ve made. This is turned on by default. It can be turned off by modifying your profile.[/*]\n[*]Security Questions. Your accounts are now safer than ever, because you can set a security question for them. While it is not required, it is [b]highly[/b] recommended. You will not be able to change your password until a security question has been set. Once you do change your password, you will be required to answer the security question before you can do anything else other than log out. If you do not remember the answer, simply use the \"Forgot Password?\" link at the log in page and your information will be sent to you.[/*]\n[*]Inbox Download. You can now download a single message at a time upon viewing it in the PM Center. Just click on the obvious link and a window will pop up with a text file that has the message data in it. To save it, just hit Ctrl+S. You should use this feature for important messages and updates.[/*]\n[*]Java Chat.[/*] Though you can\'t see it, it is active. It is not fully functioning yet, however. Socket and port fixes must be applied and the initial test run on this particular server has yet to be done. If you\'re interested in viewing it anyway, click [url=?act=chat]here[/url]. I will try to work on it tomorrow and then let you know how it turns out.[/*]\n[/list]\nStay posted as more updates are to come. Thank you for being patient with us and for sticking around during our very slow birth.","2012-09-06 17:34:51","1");
INSERT INTO `updates` VALUES("27","sign up probloms","hey, sorry for the inconvenience we have fixed the sign up problems so yall can start joining again.","2012-09-10 20:29:36","2");
INSERT INTO `updates` VALUES("30","Setting Up A New Business","Hey everyone, hope you all are having a good day. I\'m making this update to inform everyone that later today (or perhaps in the week, depending) I will have my own free-lance, web design business set up. If you\'re interested in me making a web site for you, please e-mail me ([url=mailto:admin@dreamspand.com]admin@dreamspand.com[/url]) and we can discuss payment and terms, [i]after[/i] I have everything set up, not before. Right now it\'s still basically in the \"idea\" stages, I have a PayPal account set up but I am not yet completely ready for business. After I have everything set up I will make another update regarding prices, terms, etc. I just wanted to let you all know.\n\nThank you!","2012-09-16 11:09:27","1");
INSERT INTO `updates` VALUES("31","Coming Soon: Dreamer Chao","For those of you who were at my last site, The Ultimate Chao Garden, you know what this was. Well, I\'m bringing it here, with updates and new features. Glitches are fixed, bugs are taken of so you can\'t cheat the system, etc. There are new chao to raise and unlock, plus new challenges to overcome. When I release it, it will be version 4 (the last known version was 3 in early \'09). If you don\'t know what this is, don\'t worry - you\'ll see when it\'s out. It\'s essentially a virtual pet raising system based on creatures from Sonic games. And this is only the first of the games I intend to make an implement - I\'m also making a completely different game, I\'m not sparing any details yet though.\n\nStay posted to receive updates about the upcoming games.","2012-09-21 20:03:48","1");
INSERT INTO `updates` VALUES("29","Affiliate Center","DreamSpand Gaming is now setup to take affiliation requests. If you\'re interested, send an e-mail to [url=mailto:admin@dreamspand.com]admin@dreamspand.com[/url] explaining why you would like to link to our site and provide a link for your site so it can be looked over. Nonprofessional e-mails will be ignored and marked as spam, so make it sound as professional as you can. Right now we don\'t really have any requirements other than that your site needs to be video-game-themed. DreamSpand Gaming is still growing and it will most likely be a while before things really start to take off, but affiliation is a great step in the right direction.\n\nThe system is setup very special: when a user clicks on one of our partners, the \"hits out\" for that particular site goes up by 1. Likewise, when someone clicks our link from the other site, then our \"hits in\" for that particular site goes up by 1. This helps us track web traffic a little bit better and see how we\'re doing on other web sites. Note that the site regularly checks its partners to see if the banner and link are there, and if it does not find them, the admins are notified about it and are prompted to take action (meaning deletion). Linking to each other is not a one-way-street.\n\nPlease, if you wish to link with us, send me an e-mail. I would be more than happy to talk about it, provided your e-mail is legible. I hope to hear from you soon. We all need to grow.\n\nThat\'s all for now.","2012-09-13 15:58:15","1");
INSERT INTO `updates` VALUES("32","Dreamer Chao v3.5 Beta - Now Released!","Welcome to the next generation of Dreamer Chao. Two different types of manuals have been posted in the Dreamer Chao board: one explaining how the system works, and the other discussing how to raise your new friend. Let me know what you think of this game, it was a really popular thing back at my old web site, The Ultimate Chao Garden (now discontinued, thanks Lunar Pages..). It\'s based off of the chao from Sonic games. Anyways, I hope ya like it! I\'ve even added in a few new features and even some new chao since the last version (if you knew it), and I plan to have version 4 out soon, possibly by next week, depending.\n\nHave fun and don\'t hesitate to ask any questions!","2012-09-22 08:51:25","1");
INSERT INTO `updates` VALUES("34","Game Giveaways","Interested in some free Steam content? Check out this topic: http://www.dreamspand.com/?act=topic&id=735 by [user=16] and see what all you can get! This is our very first free giveaway. Hurry up though because time is running out!","2012-09-29 14:48:47","1");
INSERT INTO `updates` VALUES("35","Safety Precautions","After solidbatman made a status regarding this site being marked as a \"malicious URL,\" I did some searching and investigating. Seems that we have some funky business going on. First, I ran some traces on a couple hostnames that have been frequently visiting the site, but not posting or joining. The first one took me to a list of offensive IP addresses, and this one was from over in Japan. This one was banned now. Some of the \"members\" that have been signing up have also been robots in disguise (Transformers reference not intended). \n\n\n\nAside from that, while looking at the guest list I noticed something else: Mike and I, for whatever reason, shared the same IP today. While we basically live in the same neighborhood, he\'s nowhere close to me and wasn\'t at the time. I ran a trace on both of our IP addresses and it pointed to a city south of where we are, both times. I\'m not entirely sure what\'s going on, but I intend to find out. I advise changing your passwords and updating your security questions, if you have not already. I am deeply sorry for this inconvenience, and I promise the site isn\'t harmful. The bots are just making it look that way. As far as our DreamSpand robot goes, well he\'s a good bot, so don\'t be mad at him. Also note that one of the main reasons that anti-virus programs may be marking this site is because of the numerous spam-bots that have been visiting us. There shouldn\'t be any way your computer can get infected, as I wrote everything myself, so I wouldn\'t worry too much. Just humor yourselves though and run some scans and checks just in case. Thanks.","2012-10-04 23:40:09","1");
INSERT INTO `updates` VALUES("36","Limited Registration","Hey everyone, just letting you all know that I\'ve turned on limited registration. What that means is that once someone signs up, the admins have to approve them before they can do anything. If we disapprove them, their accounts are instantly deleted. This is the first, small step towards preventing our spam-bot sign-ups. Users must also verify their e-mail now, before they can do anything on the site. I do plan to add more security checks so we can stop them from polluting our member list. I\'ve deleted the \"members\" that were spam-bots and left the legit users.\n\nSorry for any inconvenience and I hope to have this fixed soon.","2012-10-07 10:51:33","1");
INSERT INTO `updates` VALUES("37","New \"Final Frontier\" Skin.","Hey guys, just letting you know that I\'ve installed a new skin called Final Frontier. It\'s a space skin, if you haven\'t gathered that already. I\'ve also enhanced some of site\'s internal coding and security so things should run at least a little smoother now. You can also mark your \"here for\" check-marks when modifying your profile.\n\nIf you have a request, remember that it\'s totally okay to ask.","2012-10-20 17:50:49","1");
INSERT INTO `updates` VALUES("38","Saturn Rings Web Development","Hey guys, remember when I said something about setting up a web site design business? If not, well that\'s okay too. Well, I\'m just letting everyone know that I am now officially ready to do web site commissions. Please see [url=Plans.docx]this[/url] (click) Word document for plans and what all you can expect from them. I hope to have some clients soon, as college is coming up and well it\'s rather spendy, to say the least. Just let me know if you\'re interested by clicking [url=?act=createsite]here[/url].\n\nThanks!","2012-10-27 19:03:52","1");
INSERT INTO `updates` VALUES("39","Security Images","I\'m aware that registration was hindered for a while due to faulty security images. I would just like to let everyone know that this issue has been resolved. They should function without error now. I apologize for the inconvenience.","2012-10-28 21:44:03","1");
INSERT INTO `updates` VALUES("40","Sorry for the down-time.","FatCow suspended us with no warnings or messages to my account or my personal e-mail. We were told that DreamSpand somehow overloaded their servers. The automatic updating online list and last post were the cause. Although, we\'ve done that for months, so how now is any different is a mystery to me, but it\'s fixed nonetheless. As a result though, nothing can auto-update anymore, at least not as quick or as often. I may try it again at some future date and I may not, it all depends. Hopefully when and if I do decide to try it again, they\'ll have servers that will actually be worth something, and that can handle simple requests such as that. Sorry for the inconvenience.","2012-10-30 16:53:42","1");
INSERT INTO `updates` VALUES("41","Redesign Released","I don\'t have a whole lot of time to explain right now because I have to get back before traffic gets too rough, but I\'ve released the redesign as of today. The forums and a few other things will be updated a piece at a time, I hope you guys enjoy this.","2012-11-30 13:04:40","1");
INSERT INTO `updates` VALUES("42","DreamSpand v2","So yesterday I released the main core of the redesign, but I didn\'t have a whole lot of time on my hands to explain anything. I apologize for that, I was in a rush to get back to the hospital with my family and I had to beat lunch traffic, so there was that. Anyway, I\'m down in the cafe for a minute so I can talk now. The main thing new is that the site is no longer just a forum - it is now a full-fledged, interactive web site of innovative gaming information. While we would like to provide as much user content as possible, please understand that we are short-staffed, and only staff and admins can add and edit pages and games. Halo 4 has been submitted already with every achievement available to read up on. Soon enough (hopefully early next year) we\'ll be able to provide achievement videos for you, via our YouTube Channel, [link=http://www.youtube.com/user/LostAchievements]Lost Achievements[/link].\n\nAs for the other admins are various, site faculty members, please don\'t hesitate to start adding games to pages, as well as making articles, reviews, gaming information pages, tips & tricks pages, etc. I will be able to help out shortly, but right now I have a lot of really, really important and life-changing stuff going on, so I hope you don\'t mind starting without me. That\'s one reason I released everything early: I wanted to make up for the slowness around here, at least some what. \n\nAs I said yesterday, the rest of the remodel will be released in bits and pieces. This is not finished by a long-shot. I understand it\'s gonna take a little while to get used to a lot of this, it\'s a lot to take in. Kinda surprised Mike, actually. If there\'s anything you don\'t like, let me know. Yes I worked very hard on this, but I need to focus on what the user (you) likes. \n\nThere have just been a lot of updates and improvements, mainly to the home page but I will be getting to the forums shortly. They are going to be very largely updated. As you can see, I\'m not quite done with a lot of it. There\'s bits and pieces of things here and there if you sit there and try to play with some of it. Again, let me know something and we\'ll talk about it.\n\nI hope you guys like this so far, though. I\'m sorry things are going kinda strange and slow right now, I\'m just not real sure where my head\'s at and I got a lot of things going on. But yeah, thank you for understanding. I hope things can go back to normal soon enough, and if not then either way I\'ll still work on this place in my free time because it\'s the only real distraction I have.\n\n-- Alpha","2012-12-01 15:25:46","1");
INSERT INTO `updates` VALUES("43","Hide Avatars and Signatures","You now have the option to hide avatars and/or signatures when modifying your profile. \n\n\n\n[b]Note: [/b] This only affects the forums, it does not yet affect the comments on the site homepage.","2012-12-02 14:56:43","1");
INSERT INTO `updates` VALUES("44","Friend Requests!","You can now request to have friends. It\'s pretty simple, works similar to the PM system. To add or remove a friend, simply visit their profile. Either later today or tomorrow I\'ll integrate a friends only thing as well as mutual friends. That should help manage a few things with users that might not wanna talk to each other or something. You\'ll have the option to hide your profile and statuses from anyone who isn\'t on your friends list (excluding staff and admins).\n\nEnjoy.","2012-12-05 11:32:09","1");
INSERT INTO `updates` VALUES("45","Staff Needed","We need more staff to help us add content to the site. If you\'re interested, either comment below or send me a PM. Four of us just ain\'t enough. I\'ve already gave one user staff powers for this reason (that and it\'s been long overdue for him), but we need a few more.\n\nIf you\'re interested, say something and we\'ll talk about it. :)","2012-12-05 11:43:00","1");
INSERT INTO `updates` VALUES("46","Friends Only","You now have the option to set your profile to \"Friends Only.\" This will mean no one can comment on your statuses, message you, see your profile or even see that you HAVE a status! This of course does not apply to the admins as we need to see everything going on, but other than that you can hide your information from others, even guests. Thought this could help out a little bit. Gonna try to do a little more work on some other things too, hope you guys like this.","2012-12-14 20:32:07","1");
INSERT INTO `updates` VALUES("47","Coming Soon: Game Challenges","So you know how we already have Site Medals / Forum Achievements, right? Well I just had a bit of an epiphany. What we can do is offer \'challenges\' to our gamers; certain things to complete. You can win site medals / forum achievements or whatever else may be there for you to obtain! Anyone can offer up a challenge but only staff can add them (that way we don\'t get posts like \'kill every1!!!!!11!1\' because that is not productive). I haven\'t got this coded up at all yet but I will soon. We\'ll of course need proof that you completed the challenge so we can give you the reward(s), such as a video or picture of your amazing accomplishment.\n\n\n\nJust thought this could be a cool idea. Let me know what you think.","2012-12-14 21:05:35","1");
INSERT INTO `updates` VALUES("48","Updates Coming","So we\'ve been adding quite a bit of content here lately (at least a little) and I\'m very pleased with what we\'ve achieved so far. It may not seem like a lot, but every little bit helps, and I thank each and every single one of you that have been helping out. I\'m glad that several of you still wanna see this site flourish, even after its long, quiet spell so far. It makes me more motivated to know that someone besides me wants to see this place actually succeed.\n\nAnyway, I\'m gonna try to work on some more new stuff for the site this week. It may only be one or two things but I\'m gonna try my hardest to get at least a couple of things done. I have a whole list of features that I\'ve been slacking on due to classes and family emergencies that are still going on, so I haven\'t had a lot of time or have been too tired to work. Hopefully though I can get a few things in at least. Thanks so much for being so patient guys, and for understanding everything going on. See ya on the flip-side.","2013-01-14 13:01:51","1");
INSERT INTO `updates` VALUES("49","Minecraft Server","[user=2] is now running a [url=http://www.minecraft.net]Minecraft[/url] server in Creative Mode. It was very, very recently started and is a work in progress. We intend to have scenes and buildings from various kinds of video games as well as gaming company buildings. It currently is not a 24/7 server, as there are complications to this right now. Per Mike\'s request, I have not yet released the information required to access and join the network and server. If you are interested in joining before the world is made public, however, then send one of us a PM and we\'ll give you the information required to join the world. We hope to have the world ready in a week or two and then you can help us start building it.\n\nThis WILL be happening, people. Soon.","2013-02-09 00:14:16","1");
INSERT INTO `updates` VALUES("50","Minecraft World","Remember how we mentioned we\'d have a Minecraft PC world ready within a couple of weeks? Well.. it\'s been a couple of weeks and um.. nope. We\'ve had some things come up: some very, very emergent, personal things that took precedence and demanded our attention. I personally am going through a dark time right now and it will be a while before I\'m myself again, if I ever am. But [user=2] is still working on the world and will have it ready within probably a couple of months.\n\nThanks for your understanding.","2013-03-04 23:44:59","1");
INSERT INTO `updates` VALUES("51","Upcoming Stuff","What are some things that you as the user would like to see (yes, that means staff too)? I\'m talking features AND content. Tell us something you\'d like for us to do. Maybe make something easier; maybe add in some new features for the forum or the site. Anything that you\'d like to ask us, go ahead. We\'ll try our best to get it done. Just know that if you don\'t speak up, we can\'t help you, and we want to help you.\n\nGame on.","2013-03-09 18:54:58","1");
INSERT INTO `updates` VALUES("52","Gaming Beacons","You can now set beacons for games that you want to play with friends. When viewing a game, simply click on the \"Set Beacon\" button. This will add the game into your beacons and notify [b]anybody in your friends list[/b] via PM that has the same beacon set for that game. What that means is, if Person A sets a beacon for, say, Minecraft, and Person B already had one set for that game, then Person B will get a PM from the bot saying that Person A has set the same beacon. \n\nThis is still a work in progress, but enjoy.","2013-03-10 11:14:06","1");
INSERT INTO `updates` VALUES("53","Changes and Minecraft Server","A few weeks ago, we mentioned running a Minecraft server for DreamSpand. Well, we\'re happy to say that on Sunday, March 17th, the server and the instructions of how to access it will be released. Yep, we\'re mixing Minecraft with St. Patty\'s Day. I also have more features (and articles) coming (hopefully by that dead-line), and have even added in a few early, as well as some bug fixes. See the change log below.\n\n[3/14/13]\nChange Log: \n\n[*]Fixed issue with custom title. Apostrophes no longer cause an SQL error.\n\n[*]Fixed issue with drop-down menu bars on forum homepage. They should be easy to access now.\n\n[*]Added option to remove bookmarked topics to view topics page.\n\n[*]Added \"friends that have and friends that want this game\" to view game page.\n\n[*]Added \"beacons\" for games; others with the same beacon will be notified.\n\n[*]Added \"Move\" option to topics for staff and admins.","2013-03-14 19:18:52","1");
INSERT INTO `updates` VALUES("54","Topic Search","You can now search topics by going under General and clicking on Search Topics. Type in whatever you wish to search for and then submit the form. Results will pop up containing similar matches to whatever you typed in. Before, the only way you could do this was if you clicked on a tag on a post. This form searches through those tags for the criteria that you specify.","2013-03-16 20:27:30","1");
INSERT INTO `updates` VALUES("55","Minecraft Server Beta Version Released!","The Minecraft Server for DreamSpand Gaming is now up and running! While it is still in beta, it can still accommodate a large amount of game play. It is in creative mode as the survival map has not been set up yet. The buildings and creations include: a crashed UFO, the SEGA, X-Box and PlayStation buildings, a Grand Canyon, a glass house and the ruins of an old civilization. More creations will be built as time progresses, and you can feel free to build your own! All that we ask is that you not purposefully destroy another person\'s work or any of the official buildings (this will win you a ban from the server and possibly the site).\n\nFor the status of the server (as in whether it\'s up or not) as well as instructions on how to join, please click [url=http://www.dreamspand.com/?p=mserver]here[/url]. Server plugins and mods will be added shortly; we are currently in that process as we speak.\n\nEnjoy, and please give feedback and support.\n\nGAME ON!","2013-03-17 13:09:48","1");
INSERT INTO `updates` VALUES("56","minecraft Hamachi server","I have fixed the approval settings now its gonna be automatically approved sorry about that you all","2013-03-17 21:18:51","2");
INSERT INTO `updates` VALUES("57","Severe Weather","We\'re terribly sorry for the trouble with the server; we are currently experiencing a large bout of severe weather and power is going in and out. I in fact got stuck at a restaurant that didn\'t have power, otherwise I would\'ve been home sooner. Funny enough, I get home and I\'m one of the few in the district that actually have power. Anyway, the server is up for now, but please be aware that power could go in and out at any time. We are under a tornado watch until 10 PM and the server will more than likely not be up over-night regardless. \n\nSorry for the inconvenience.","2013-03-18 20:43:12","1");
INSERT INTO `updates` VALUES("58","New Halo: Infinity Skin","Yesterday I finally completed the new skin for the site, called Halo: Infinity. If you would like to check it out, simply modify your profile and select in the skin list. :)","2013-03-20 10:20:24","1");
INSERT INTO `updates` VALUES("59","New Calendar!","Hey guys, I\'ve added in something useful this time: a calendar! A few of you have been asking me for this for a while and now we finally have one. The only glitch that I\'ve found (so far) is that when viewing a month, once the days run out, the cells turn black for the rest of the row. As soon as I find a fix to that, I will apply it. It should work without error though, and if you come across a hiccup of any sort, please let me know and I will jump right on it (you know I\'ll get right to work!). I recyled this from my UCG web site, fixing a few bugs and adjusting some coding.\n\nComing soon, I plan to add a feature that allows you to \"attach\" a thread to an event, to link the two, and eventually, multiple threads (with the maximum amount set in the Add Event screen) will be able to be attached.\n\nHope you guys like this. It feels good to finally get through my list of stuff. Also, I apologize for my lack of articles in the past couple of days. I\'ve been very busy with the site and the Minecraft server (hey, you know it\'s addictive). I need you guys to do your articles too though, please. Doesn\'t matter what it is as long as it\'s recent and about gaming. :)\n\n\nChange Log:\n\n3/21/13:\n\n* Added calendar (Lock/Unlock, View/Add Comments, View Months, View All Events) to General menu and welcome table\n* Events added to info center","2013-03-21 19:36:45","1");
INSERT INTO `updates` VALUES("60","Server Going Down Later","Later on in the day at about 1 - 2 PM EST, the server will go down as we will be migrating it to a dedicated server instead. This will be good for everyone, so stay tuned. :)","2013-03-23 09:26:19","1");
INSERT INTO `updates` VALUES("61","New Server!","The new server is finally ready! We ran into some problems but in the end it all worked out. The instructions of how to join have been updated, so be sure to give those a read. We hope to see you there!","2013-03-23 14:10:38","1");
INSERT INTO `updates` VALUES("62","Twitter Account!","Follow us on Twitter!\n\nhttps://twitter.com/DreamSpandGamin","2013-03-24 09:58:35","1");
INSERT INTO `updates` VALUES("64","Birthdays added to calendar","The calendar now shows if the user has a birthday that falls on one of the days. Clicking on it will bring up a list of who all has a birthday that day.","2013-03-29 19:37:18","1");
INSERT INTO `updates` VALUES("65","Return of The Minecraft Server","We are pleased to present the official return of the Minecraft server. It is no longer on the white-list and is publicly accessible. Before you enter, though, please give our [url=http://www.dreamspand.com/forum.php?act=topic&id=1904]rules thread[/url] a read. We have a number of features and securities installed. These include:\n\n1. [b]Citizens[/b] plugin. Ops can spawn NPC Players, great for roleplaying worlds. These NPCs can walk, talk, hold stuff, execute scripts, etc. We can even make carbon copies of other players.\n\n2. [b]LogBlock[/b] plugin. If a block is destroyed anywhere, it is logged in our SQL database. It will store who did it and what block it was, as well as the date and time of when it occurred. This will protect your creations.\n\n3. [b]Spawn[/b] plugin. This will allow you to spawn any entity, anywhere, up to 100. Please refrain from spawning in survival mode, and refrain from spawning any highly dangerous mobs at all. If you abuse this, you will be jailed and banned. Indefinitely on both accounts.\n\n4. [b]Notebook[/b] plugin. Lets admins and mods keep notes about specific users.\n\n5. [b]WorldEdit[/b] plugin. This one is way too much to explain, simply look it up if you want an explanation.\n\n6. [b]DynMap[/b] plugin. This is for the staff - we can view any part of the map from the browser and see absolutely everything going on.\n\n7. [b]WorldGuard[/b] plugin. This allows us to guard things from other people, from protecting blocks to disallowing even chest access.\n\n8. [b]BiomeEdit[/b] plugin. This will come in handy later and is currently also for the staff, but allows you to change a specified radius into the biome of your choosing.\n\n9. [b]Jail[/b] plugin. Use your imagination on this one - we can jail players for a certain amount of time, and all they can do is move around in their cell.\n\n10. [b]Multi-Verse[/b] plugin. This includes MVP Inventories (separate inventories for worlds) and MVP Portals (travel between worlds using our admin-made, GUARDED portals). \n\nThese are so far the only plugins we have, but that\'s likely to change. We\'re going to be working on a roleplaying world as well, featuring the NPCs and site-specific lore.\n\nWhen you first spawn in, you will enter Valhalla, a hand-made creation by SammyAxe / Absalon. This was before we had WorldEdit, and it is our most treasured building. It was built by hand in the first few days of opening the server, and it is beautiful. It\'s based off of Nordic Mythology, and you will exit it through a rainbow bridge. To your left there will be a portal to the survival map - simply jump in to be teleported. Your inventory and equipment will change to its respective world when you do this. If you walk straight after you first spawn, you will see 10 rules in a row. Please read and obey them or we are going to have a problem. There is a guard walking around the rule signs, carrying a diamond sword. It is an NPC and yes, it is Master Chief from Halo (I named him Guard and the skin applied itself). \n\nThere are a whole lot of other things that you\'re just gonna have to see - but don\'t be a jerk, and don\'t screw up anything that doesn\'t belong to you. If you absolutely have to screw something up, then make something really, really nice and either mess it up yourself, or ask us to do it for you. We\'ll be more than happy to destroy your crap if you\'re the same towards us. Be respectful, and have fun. We currently have no issues or enemies, and I would like to keep it that way. I am open for talking things out, but if you catch an attitude, you\'re gone.\n\nThanks and enjoy it!","2013-04-06 18:27:56","1");
INSERT INTO `updates` VALUES("66","Vibrantblade\'s Birthday!","Today, Vibrant turns 20 years old. Since I\'m a state and a half away, I can\'t really do too much physically. But I thought I could do at least one nice thing for him, and thank him for all the super hard work he\'s done on the Minecraft server, and how dedicated he\'s been to the site. He\'s been a real great guy to us and he\'s been very generous. So show him your gratitude ([size=1]or feel my fury[/size]), cause he\'s been a real good help.\n\nThanks Blade.","2013-04-13 00:41:49","1");
INSERT INTO `updates` VALUES("67","TrophyHeads Plugin","For those of you in the Minecraft server that like PVP, you\'re in for a treat! Now when you kill a player, they have a chance of dropping their head. It looks like the regular \"Steve\" head in your inventory, but when you place it, it has the same skin that they do. Keep trophies of your winnings with this plugin. Mods and admins can also \"spawn\" heads of players using a command. This should make things interesting.\n\n** Note: Some mobs drop their heads that didn\'t use to, as well.\n\nEnjoy!","2013-04-22 13:11:32","1");
INSERT INTO `updates` VALUES("68","Skin issue has been fixed.","It came to my attention yesterday that the site had no default skin displaying while logged out, it was simply a white page. [user=2] showed me this while he was sketching the new interface and testing things out and I have fixed the problem. The Halo: Infinity skin is now the default, and I intend to work on more. This was likely a large portion of why not a lot of people signed up or stayed. More fixes and additions to come. Part of the stuff I intend to add is going to make adding content easier and more flexible, for both members and staff.","2013-04-25 14:30:42","1");
INSERT INTO `updates` VALUES("69","New redesign of homepage.","The main home page of the site has been slightly redesigned and repositioned a little bit. Affiliates also now display on the homepage, as well. Adding articles and reviews (as well as reading them) should be easier than ever, now. I\'m not done with this, either. I intend on making it even more user-friendly, but that will have to be after next week because starting tomorrow I\'m going to be out of town for a week and unable to work here. I trust that, in that time, the staff team will be adding content to the forums and the homepage (copy and paste from one to the other if you want to, staff).\n\nHopefully I\'ll have time to add in an article or two myself today amidst packing.","2013-04-26 11:52:59","1");
INSERT INTO `updates` VALUES("70","Minecraft Server Back Up","Some of you may have noticed that the server was down today. This was because the game updated to 1.5.2 and we had to wait until a new CraftBukkit jar file came out. I just joined the game and it\'s working. Just thought I\'d clarify that with everybody.","2013-05-02 20:16:57","1");
INSERT INTO `updates` VALUES("71","Site Birthday","Today, the web site turns a year old. Although released in June, the build was started on May 6th, thus being the day that this wonderful web site was born. Things are still moving kind of slowly but I have faith that we can make it past this block of activity. More things are to happen starting this week, and we hope you\'re a part of it.\n\nHappy birthday, DreamSpand Gaming. Game on!","2013-05-06 10:02:42","1");
INSERT INTO `updates` VALUES("72","The Four Swords Contest","Hey everyone, don\'t forget about The Four Swords of Triumph contest. It starts tomorrow 10 A.M. EST, and it finishes whenever all four swords are found. Remember, in order for us to know that you found the sword you were looking for, please reply to the contest topic once you have it in your inventory. You may keep the sword even after the contest, of course. If you\'re having trouble figuring out the riddles, one will be put in simple terms for you, but only one per person. If no swords are found tomorrow, all riddles will be turned to simple hints. Good luck!\n\nConfused or don\'t know what I\'m talking about? Please click the below link for the contest (rules and hints are also posted here):\nhttp://www.dreamspand.com/forum.php?act=topic&id=2252","2013-05-23 21:20:21","1");
INSERT INTO `updates` VALUES("73","Domain Cancellation","Hey, everyone. I\'m really sorry to inform you all of this, but my dad (being the one paying for the billing as I continue to search unsuccessfully for a job), is cancelling the account. Apparently FatCow did an auto-renewal, and it really ticked him off when he saw the bill. He asked me to turn the auto-renewal off, so I did, and it would not happen again. For whatever reason, this wasn\'t enough, and he attempted to put a credit card on it that\'s we can\'t even use right now. When this failed, my head got taken off, and he decided that he\'s just going to cancel the account. I\'ve tried talking to him but it does nothing but cause a yelling match. Oh well, it\'s not like we were going anywhere anyway. Just remember: this is not by choice. I had absolutely no say in the matter. I apologize.\n\nIt\'s been a pleasure working with you all. I\'ll miss all of you.","2013-05-28 09:36:10","1");
INSERT INTO `updates` VALUES("74","Good news.","The site is not going to be cancelled, so you don\'t have to worry about it going anywhere. On another note, I\'m deeply sorry for my lack of involvement in anything site-related, I hope to get it resolved shortly but if I don\'t then don\'t stress yourselves out. ^_^","2013-06-14 22:38:17","1");
INSERT INTO `updates` VALUES("75","Gone Minecraft!","Attention everyone: DreamSpand has gone Minecraft!\n\nYes, that\'s right, we are now a Minecraft site. We believed that the site needed more direction, and Minecraft seemed the be the right direction to go, what with the server and how much the majority of us know about the game and its add-ons. Soon the site homepage will be Minecraft-oriented, as well. The games and pages have been removed from the site so that new, fresh content could be added. A tutorial for basic Minecraft stuff will be up shortly. Any of the staff can begin work on any of the pages as they see fit. Comments [i]will[/i] be enabled on these content pages unless specified otherwise.\n\nThe forums have received the biggest Minecraft-themed treatment, with new boards and categories completely redesigned and old, DreamSpand v1.0 topics have been moved to the \"Vault\" board. More changes will be coming soon, so be expecting those. Hope you come to enjoy the changes.","2013-06-20 15:09:27","1");
INSERT INTO `updates` VALUES("76","New Mods!","Over the course of the past week, I\'ve added in two new mods for the server:\n\n1.) ExtraBiomesXL. Pretty self-explanatory if you ask me, does just what it suggests - generates new biomes and some new content.\n\n2.) Project Zulu. Generates a [i]lot[/i] of new mobs, a few biomes, some tools, armor, blocks, a tree, etc - it adds a crap ton of new stuff.\n\nIf you do not have these mods installed in your \"mods\" folder in your Tekkit folders, you will not be able to access the server. Worry not, however, for we can help you:\n\n1. Download [url=http://www.dreamspand.com/mods/ExtrabiomesXL-universal-1.5.2-3.13.4.jar]ExtraBiomesXL[/url] and [url=http://www.dreamspand.com/mods/ProjectZuluCompletev1.0.3.8.zip]Project Zulu[/url].\n\n2. Open up your Windows Explorer and in the search box up top, type in [b]%appdata%[/b].\n\n3. Click on the [b].technic[/b] folder, then on [b]tekkitmain[/b].\n\n4. Click on the [b]mods[/b] folder.\n\n5. Move the two downloaded mods from the site into this folder.\n\n6. Restart your Technic Launcher.\n\n7. Join.\n\n8. You should be good to go!","2013-07-04 11:25:33","1");
INSERT INTO `updates` VALUES("77","Apologies for the server trouble.","Hey, everyone. Just wanted to let everyone know that the problems with the server (for right now, at least) have been fixed. We think we may have the problem pin-pointed, but if not, then we\'ll keep trying. For the moment, though, the server is back up. I deeply apologize for the issues that everyone was having with it. I didn\'t even know there were extra problems until a few moments ago when I got home, otherwise I would\'ve worked on this sooner. College called me though and I had some other life-related issues I had to get straightened out. Sucks not having internet out there. Anyways, hope you guys enjoy it.\n\nOh, and be expecting about 3 or 4 new people on the server this weekend. We\'re growing, slowly but surely, and so is the site. So I hope you see you guys (and girls) around. Game On.","2013-07-10 19:13:01","1");
INSERT INTO `updates` VALUES("78","Return of The Old Server","Yep, that\'s right folks, the old Minecraft server will soon be returning! We have been working on it diligently, setting up permissions, warps, RPGs, Citizens, etc. The three original worlds will return, including the kingdom world. More worlds will also be featured, including a \"Jungle Law\" world. This world will be the new default spawn for new players. It will be a rule-less, limitless map for newbies, and it will be on Hard mode. Players can run wild in this world and do whatever. However, permissions [i]will[/i] still apply. In order for these players to access the other worlds, they have to:\n\nA.) Locate the portal for each individual world. They are scattered across the map and always look different (some are made of diamond, some are laying down, etc.)\n\nB.) Have the [b]Members[/b] permission group. Players will be watched for a while, and usually within a week or two, will be upgraded to Member status so that they may go from world to world.\n\nAll of the original plugins are back that we had before, including the head drops. More plugins have also been added and configured. Mobs will have the chance to drop their spawn eggs on death now, rather than [i]just[/i] their heads. Also for ops and admins is an NBT editor, so that zombie and skeleton horses are in the game. The Citizens plugin is back, with two trait classes: Sentry and Builder. Builder is still being explored, but the Sentry plugin works beautifully, and will be used to construct \"Boss Towers,\" where members will fight regular mobs in a dungeon-like arena, then fight the Sentry boss at the top. Sentries will also be used to guard certain structures from griefers and mobs.\n\nWorldEdit and WorldGuard are also back, as well as Dynmap and BiomeEdit. Regular members will still not be able to use these plugins unless in they\'re in the creative world (this is a work in progress, however).\n\nThe Kingdoms world will be turned into Adventure RPG map, similar to an MMO. This world (as well as the survival map) will feature The Four Swords of Triumph, using the RPG Items plugin like before. The four swords are: Diablo, Thor, Glacius and Ender (a topic referring to these swords and what they do can be found in the Vault board). They will feature all of their powers from the last time that they made an appearance.\n\nFear not, the Tekkit server will still be active. It is still constantly up. We\'re just looking to host the regular Minecraft 1.6.2 server again. We believe we\'ve found a decent host, but we\'re still looking, just to see all of our options. Right now the Minecraft server is hosted on Hamachi on Mike\'s computer, so it\'s not exactly ideal for mass play just yet.\n\nSo just stick with us, and we\'ll have more stuff headed your way!","2013-07-23 16:27:37","1");
INSERT INTO `updates` VALUES("79","We\'re Back!","Hey, guys! You didn\'t think we\'d give up that easy, do you? Nope! We\'re back, and a lot of the security holes have been fixed. We won\'t go into detail about what they are or what they do, but if you\'re one of my buddies on Skype, then feel free to ask me about it! A lot of strong encryption and further secure measures have been implemented to prevent something like what happened before, from happening again. Further hacking or attempted exploitation of the site or any of its resources [b]will[/b] result in law enforcement involvement - a quick laugh is just not worth the risk.\n\nSo since I\'ve been adding this new security (and I\'m still adding more), I\'ve also been working on the site and improving it more. Once we get our Minecraft 1.6.2 server live, this site is bound to have a [i]lot[/i] of activity. Anyway, I plan on adding more features and security over the timespan of the next few weeks. \n\n[b]Note: [/b] Once you first arrive to the site, it will give you an error message about \"detecting invalid cookie data.\" This is perfectly normal, so long as it only displays [i]once[/i]. Simply log in again and you should be good, as long as you don\'t tamper with the set cookies of the web site. Any slightest change in them at all will result in that error message, and upon three times of getting the message, you are permanently auto-banned. Once you log in, make sure you change your passwords and security questions!!!! This is extremely important, I can\'t stress how much. Keep in mind, however, that in order to change your password, you MUST have a security question set! The site will disallow it otherwise, for security reasons. You also have the option of resetting your password now, instead of having it e-mailed to you. This way, no one can know what password you have set.\n\nEnjoy the site, and let us know if you need anything. We\'re back in black, baby, and we ain\'t goin nowhere.","2013-08-06 11:17:07","1");
INSERT INTO `updates` VALUES("80","Site Update!","Greetings to all DreamSpand-goers and Minecraft-players! From here on out, the site will be going through changes and improvements. We are going to become more Minecraft-based, in where users can submit and view mods, texture/resource packs, plugins, skins, servers, etc. In order to prepare for this, I\'ve added in a few new forum features:\n[list]\n[*][b]Participated Topics[/b]. You can click on the \"participated\" link on the welcome table and a little box will open showing you page after page of all topics you\'ve participated in, ordered by the last updated.[/*]\n[*][b]Bank Accounts[/b].  DreamSpand now has a \"bank\" feature. You can deposit and withdraw your tokens here. The more tokens you have in your bank, the better. Once a day your tokens in the bank will gain an interest of .01. This is multiplied by the current balance in your account and then that\'s how many tokens, in interest, you\'ll accumulate for that day. This is also a safer way of storing your currency.[/*]\n[*]Site Cleanup[/b]. I\'ve cleaned up a lot of stuff on the site and made it look prettier.\n[*][b]Request A Birthday Change[/b]. This feature is still in alpha mode, but it will still work -- click \"change\" under your birthday on your profile and a request will be sent to a staff member.[/*]\n[*]Web Site Development / Programming Business Return[/b]. Now you can submit a request to me, once again, to build a website for you. The plans have gone down a considerable amount of price to make them much more affordable, and the included items in the packages are much better. If you would like to negotiate a cheaper price, then I\'d be happy to. I need the money to help me through my classes in college right now, so I\'ll definitely talk with you about it.[/*]\n[/list]\nMany more things will still be coming, so keep an eye out for em. Happy Crafting!","2013-08-15 16:21:38","1");
INSERT INTO `updates` VALUES("81","DreamCraft Server! [Regular 1.6.2]","Instructions on how to join our regular Minecraft server can be found [url=http://www.dreamspand.com/?p=mserver]here[/url] (click). If you\'re just in a hurry to join and you know what you\'re doin, then just see this:\n[img]http://panel.exodushosting.net/index.php?r=status/7089.png[/img]\nWe hope to see you on. :)\n\n** [b]NOTE: [/b] Right now, the server does not currently use any mods. This could be subject to change, however.","2013-08-15 17:10:07","1");
INSERT INTO `updates` VALUES("82","Checking In!","Hey, guys! How is everybody doing? Good? Bad? Okay? Indifferent? Well anyway, just wanted to check in. I am working on the site on my computer and will be uploading its updates either tomorrow or later in the week, as I still have more to work on and I have college papers due. If you haven\'t checked out our Minecraft server yet, definitely do so! It\'s growing very rapidly and sometime at the end of this week, we\'re thinking very seriously about releasing it to server lists. This will not only bring users to the server, but back to the site as well. \n\nPlease let me know of any changes you\'d like to see made, and be sure to make me aware of any problems you notice.","2013-08-20 11:25:10","1");
INSERT INTO `updates` VALUES("83","New welcome table nav.","Hey, everybody. I\'m back with a MUCH needed update. The welcome table now has a completely different, [i]waaaaay[/i] easier to use functionality. Now, instead of rolling your mouse over them, you simply click on them to display the appropriate menu. However, instead of them rolling down, they now [i]slide[/i] down, and they don\'t go away unless you click on the \"close\" link. Click on one now, it\'s a lot better. It doesn\'t hover over the page or anything like that. Nope, it just slides down into its own little cell, so it\'s a lot more convenient. Hope you guys enjoy this fix. Change log is below.\n\n== Change Log [8/21/2013] ==\n* Fixed drafts not saving properly. Subjects and descriptions can now be updated as well.\n\n* Fixed glitch with \"guests must log in\" feature disabling sign-ups.\n\n* Completely reworked V2 welcome table nav - functions a lot better now.\n\n* Reworded some things and cleaned up a lot.\n\n* Added \"recent posts\" to user profiles.\n\n* Added \"balance\" to welcome table for bank accounts.","2013-08-21 13:54:36","1");
INSERT INTO `updates` VALUES("84","Updates [8/29/13]","* Improved journals - can now be reached via user profiles\n\n* Improved topic menus - much easier to use now\n\n* Fixed glitch that allowed saving of empty drafts\n\n* Fixed broken \"Chao Mart\" link\n\n* Fixed issue relating to specific board bans\n\n* Added comments for journals\n\n* Added refresh links for online users and last post\n\n* Added option to view one category at a time\n\n* Added \"order by\" feature when creating/modifying boards\n\n* Added header and footer for each board\n\n* Added \"info centers\" for each board\n\n* Added draft auto-save feature to posts (can be toggled when editing profile, turned on by default)\n\n* Changed statuses to where users may have only one status per every three hours (spamming prevention)\n\nMore updates coming next week.","2013-08-29 11:57:28","1");
INSERT INTO `updates` VALUES("85","MV Inventories","Hey guys! So as you may have noticed, your inventories on the regular MC server have been different for your game modes, but not for the worlds. Well, that changed just now! Each world has a specific inventory for each game mode associated with it unless the worlds are grouped. Enjoy.","2013-08-31 00:53:05","1");
INSERT INTO `updates` VALUES("86","Status glitch.","I am aware of the glitch with the statuses and I will get around to fixing it very soon.","2013-08-31 22:41:37","1");
INSERT INTO `updates` VALUES("87","Notifications!","Hey guys! You know how Facebook has notifications, right? Well, now DreamSpand does too! Now, instead of getting a personal message every time something happens, you will receive a notification. You also have the option to delete them.\n\nEnjoy. Let me know if you have any questions.\n\n-- Alpha","2013-09-11 14:19:31","1");
INSERT INTO `updates` VALUES("88","Site Comeback","Hello guys, just letting everyone know that the site is making a comeback. We will be your source for news and updates regarding both the web site and our Minecraft & Tekkit servers. More updates will come to the site. Soon, you will be able to submit, browse, view, comment on and download mods of other users and staff members that get submitted to the site. I intend on working very hard on this site to get this going. You can find out things such as server down time, news, updates, staff changes, mod additions and removals, etc. We hope to hear from you all soon!","2014-01-17 12:07:47","1");
INSERT INTO `updates` VALUES("89","AlphaPack Server (Replacing Tekkit)","Automatic update was made by: [user=1][br][br]Hey folks! Sorry about the issues with Tekkit during the past few days. The technic launcher released a build for 1.6.4, but it was very unstable. We spent days trying to upgrade it, and even tech support failed. Actually, they made it worse. So I went in and did something different, that I spent all day doing today. First of all, some of you know that I\'ve been modding Minecraft for a few months now. I have four of my own mods added on to this new server, the [b]AlphaPack Server[/b]. It\'s my very first mod pack. However, it\'s not just my mods. There are [i]many other[/i] mods added on to it, including (but not limited to) GalactiCraft, ComputerCraft, Twilight Forest, Modular PowerSuits, MineFactory-Reloaded, MystCraft, BuildCraft, and many, many more.\n\n\n\nNote: This is not Tekkit. It is regular 1.6.4 Minecraft with the 1.6.4 version of Forge.\n\n\n\nYou can download the full AlphaPack mod pack here: http://www.dreamspand.com/mods/AlphaPack.zip\n\n\n\n[b]Part One - Mod Files[/b]\n\n1.) Extract the zip file\n\n2.) Take all of the mods out of the \"mods\" folder in the zip file\n\n3.) Put them inside your mods folder in %appdata% -> .minecraft -> mods\n\n4.) Done!\n\n\n\n** Install these mods in your \"mods\" folder in your .minecraft folder under AppData. \n\n\n\nAlso, download this one as well:\n\nhttp://www.dreamspand.com/config.zip\n\n\n\nDue to compatibility issues, some IDs were changed to allow them to work together. This means that you need to replace the config files with the newly changed IDs.\n\n\n\n[b]Part Two - Config Files[/b]\n\n1.) Extract the zip file\n\n2.) Copy the \"config\" folder to %appdata% -> .minecraft\n\n3.) This should replace the necessary files\n\n4.) Done!\n\n\n\n** Replace your \"config\" folder with this after unzipping it or you may have ID errors.\n\n\n\nIf you need further assistance, please, don\'t hesitate to post about it or message a staff member. We\'ll get back to you as soon as we can, either way, and we\'ll be happy to help. Once all of the mods are installed, you can join the server.\n\n\n\nThe IP for the AlphaPack Server is: 192.227.248.110:47407\n\n\n\nPaste that in the Server IP portion when you click on Add Server. \n\n\n\nAlso, the Tekkit worlds are not \"gone\", they\'ve just been decommissioned temporarily. However, we did purchase a new server host today, or rather Mike did. We have twice the gigs and half the price. We\'re still setting it up, but that\'s where our Tekkit worlds went. We\'re working very diligently. While we get this setup, please feel free to check out the AlphaPack Server. There are a lot of mods, and a lot of things to do. We hope to see you around!","2014-01-18 19:18:30","1");
INSERT INTO `updates` VALUES("92","New Mod For AlphaPack Server","Hey guys! My Four Swords of Triumph mod is finished, so I added it to the list. You can get it from the mods section to the right, or redownload the AlphaPack.zip file itself, totally up to you. Let me know if you have any questions or comments. :)","2014-02-12 12:21:41","1");
INSERT INTO `updates` VALUES("93","1.7.4 Portals Back In Service","Hey guys! The portals in the back of the spawn point on the regular server (DreamCraft New) are back in service. They each go to different biomes that are [i]way[/i] out there, to guarantee you a large area that has not been mined yet. Spawn points like the main spawn will eventually be built, maybe not quite as ostentatious as the original, but still with shops and other things. We hope you enjoy these portals, please use them to your advantage at your leisure.\n\nThank you! :)\n\n- Alpha","2014-02-14 18:54:47","1");
INSERT INTO `updates` VALUES("94","Mod Updates","Hello everyone! I\'ve updated two of my mods: Angry Mobs and Mega Biomes. Angry Mobs has been updated to 2.2, and Mega Biomes has been updated to 2.6. You can download the most recent updates on the Browse Mods page. The changes are below:\n\n[b]Angry Mobs[/b]\n[list]\n[*]New monster mob - Scorpion. Causes poison on contact. Has a chance to spawn with a Shadow Skeleton on top, called a Scorpion Jockey. Shares all traits and qualities of spiders, and for now, drops the same things.[/*]\n[*]New passive/aggressive mob - Zombie Hogman. Hogs transform into this when struck by lightning. Slightly faster than Zombie Pigman, and hit a little bit harder. Spawn naturally in the Nether. Shares all traits and qualities of its cousin.[/*]\n[*]Ghost Changes - Slightly more health and damage. Plays a sound when invisible. Stays invisible for longer periods of time. AI slightly improved and more efficient.[/*]\n[*]Shark Changes - Now spin around instead of being constantly still.[/*]\n[*]Fixed issue with rare spawn - now all new mobs have a higher chance of spawning.[/*]\n[/list]\n\n[b]Mega Biomes[/b]\n[list]\n[*]New Biome - Magma Slime Lands. Very similar to Slime Lands. Made up of magma slime blocks. Causes vertical bouncing and inflames any entity that walks on it. Magma Slimes spawn wildly in this biome. Magma Slimes can be crafted into 9 magma creams, and then back again.[/*]\n[*]Redrock Furnace - No different than a regular furnace, other than aesthetics. Created from Redrock Stone.[/*]\n[*]Slime Block Changes - No longer deals fall damage as long as you land on a slime block.[/*]\n[*]Removed Lilac from creative tab list.[/*]\n[/list]\n\nBe sure to get these updates so that you can play on the Alpha server. Enjoy!","2014-02-21 15:54:41","1");
INSERT INTO `updates` VALUES("95","Mod Updates! [3/6/2014]","Hello everyone! Sorry if you tried to get on the server while it was down for all of about 45 seconds, but I\'ve been updating our mod pack. You\'ll need to redownload and replace the following mods:\n\n[url=http://dreamspand.com/mods/AlphaWolfSweetTooth1.2.zip]Sweet Tooth[/url]\n[url=http://dreamspand.com/mods/AlphaWolfAngryMobs2.4.zip]Angry Mobs[/url]\n[url=http://dreamspand.com/mods/AlphaWolfExtraTools2.1.zip]Extra Tools[/url]\n[url=http://dreamspand.com/mods/AlphaWolfMegaBiomes2.6.zip]Mega Biomes[/url]\n[url=http://dreamspand.com/mods/AlphasExtras1.2.zip]Alpha\'s Extras[/url]\n[url=http://dreamspand.com/mods/AlphaWolfFourSwords.zip]Four Swords of Triumph[/url]\n\n...and be sure that you [b]add[/b] this one:\n\n[url=http://dreamspand.com/mods/AlphaWolfLostDesert.zip]Lost Desert 1.0[/url]\n\nSorry for all of the changes, guys! But I promise you the updates are worth it. Hey, at least I update my mods and fix the issues I find. You don\'t have to worry about finding the mod author or any of that mess. :p Anyway, see you guys on there. Game on!","2014-03-06 14:54:27","1");
INSERT INTO `updates` VALUES("96","Mod Updates (pt.2)","** Please see the PREVIOUS update first!!\n\n\n\nAlternatively, if you don\'t want to go through and change each mod individually, you can redownload the Alpha Pack by clicking the link below:\n\n\n\n[url=http://www.dreamspand.com/mods/AlphaPack.zip]Alpha Pack[/url]\n\n\n\nExtract the mods, and then take the long list of mods INSIDE the Alpha Pack folder, and put them in your \"mods\" folder under Appdata -> Roaming -> .minecraft -> mods. If you need help with this process, please post about it or message one of us and we will be more than happy to assist you. :)\n\n\n\n** Also, if you haven\'t yet, be sure to replace the [url=http://www.dreamspand.com/config.zip]config folder[/url] (click). Unless we say otherwise, you only had to do this once when you first prepared for the server. We will advise if it needs to be done again, but I highly doubt it. Enjoy the mods, everyone.","2014-03-06 14:58:54","1");
INSERT INTO `updates` VALUES("97","Update On Lost Desert","You don\'t have to add this one. You can add it in single player if you would like to, but it\'s not on our server yet. It still has some issues. It works fine in single player, but on the server it gives the same error as always. I\'m sorry about that. I don\'t understand why it works on my computer but not on another, when I try servers with it. I\'ll work on it. Just leave that one out for now if you want.","2014-03-06 15:23:15","1");
INSERT INTO `updates` VALUES("98","Last Update For The Night","Hey guys, got one more thing you can do. I\'m sure some of you have been experiencing the crashing on the Alpha Pack server, well that\'s because it kept running out of memory. We decided to take out the Ender Storage, Crafting Suite, MFFS, and Big Reactors mods. This frees up a lot of space and prevents the majority of crashing. So just be sure you do that at some point. :)","2014-03-06 20:09:13","1");
INSERT INTO `updates` VALUES("99","tekkit server","hey everyone tekkit server is going down for now i am backing it up and gonna either do updates on current world or start over with the updated version ","2014-03-11 15:44:00","2");
INSERT INTO `updates` VALUES("100","MAJOR Update","Hey guys! The Alpha Pack has gone through another major update. The best way for you to get all of the updates and mod removals is to just redownload the AlphaPack.zip file (again). After this, the mods won\'t be updated as often, maybe once a month or so. Lost Desert is now on the server, and it works! It\'s a brand new dimension: a purple desert with a green sky. Lots of special features. I\'ll make a wiki for it some time. Anyway, be sure that you update. And, again, if you have problems, please let me know. :)\n\n-- Alpha","2014-03-12 18:32:10","1");
INSERT INTO `updates` VALUES("101","Minor Update to Lost Desert Mod","Hey guys, sorry about this. There was a major bug that I had to fix in the Lost Desert mod, so just be sure you update it. The mod link for it on the Browse Mods page has been updated with the appropriate link. I\'ve also added something in for the trouble. Thanks for understanding, guys.\n\nNote: The AlphaPack.zip file is [u]not[/u] updated yet, I haven\'t had a chance to do that big of an upload yet. So be sure you only update that one file.","2014-03-14 18:35:57","1");
INSERT INTO `updates` VALUES("102","Updates","There are more updates to be...updated, on the AlphaPack server. Lost Desert has gone through a MAJOR update, and we have added the Portal Guns mod. Lost Desert\'s download link is already updated if you wish to update that, and the AlphaPack.zip file itself will be up to date shortly. Please let us know if you have any questions or concerns.\n\nAlso, we\'re not giving away many details yet, but we now have a DireWolf20 server, 1.6.4 version. We\'ll discuss that more in depth later. :)","2014-03-20 14:12:54","1");
INSERT INTO `updates` VALUES("103","Angry Mobs Issue: entity.mob.name, Fixed!","Hey all! So anyone who plays on the AlphaPack server will know that if you get killed by a custom mob, it would say something like \"so-and-so was killed by entity.megacreeper.name,\" well, that\'s been fixed. For Angry Mobs, at least. I have yet to do it to the Lost Desert but I will update when I do. It will now say \"so-and-so was killed by Mega Creeper,\" like it\'s supposed to. It was a surprisingly easy fix, actually. It\'s already updated on the server and the best part is that you don\'t have to do anything! It\'s entirely a server-side fix, so no downloading or updating is required. :)","2014-03-22 19:44:18","1");
INSERT INTO `updates` VALUES("104","Fix applied to Lost Desert","Alright guys, Lost Desert has the fix too now. :)","2014-03-22 19:51:04","1");
INSERT INTO `updates` VALUES("105","DreamCraft 2.0","Hey guys! Just thought I\'d let everyone know that we\'ve been working hard on the regular (1.7.9) Minecraft server. We\'re renovating the Spawn Point, and doing other things to the server too. You\'ll be happy to know that the Portals in the back of Spawn are fully functional now, and we plan to add more, as the Portal section has an upstairs now. New things are constantly being added. Come say hi to us some time! If you\'re not white-listed, feel free to ask us! :)","2014-04-29 15:18:59","1");
INSERT INTO `updates` VALUES("106","Multifood Mod","A new mod has been added to the server, developed by yours truly. It\'s called Multifood (due to my lack of creativity and laziness when it comes to names), and it adds (as its name suggests) multiple foods to the game, which includes cherries, oranges, grapefruits, lemons, limes, a special fruit called limons (lemons mixed with limes), bananas, strawberries and grapes. Most grow on trees, but some grow as crops, which can be planted on tilled land. It also adds eight new colors of wooden planks to the game. This is only the Alpha version (please pardon the pun). In the future, more things will be implemented, as well as more food. It won\'t be just fruit; it will be vegetables, fruit, nuts, herbs and spices. One type of juice has already been added to the game called Lemon Aid, because (when drank), it will add [i]strong[/i] regeneration for 15 seconds (I couldn\'t get it to go longer, sadly; that particular potion effect has a max time limit). I will be adding more different types of juices and such in the next version. :)\n\n** The [url=http://www.dreamspand.com/mods/AlphaPack.zip]AlphaPack.zip[/url] archive has been updated with all of the current mods from the server. You should also delete OpenPeripheral from your mods list if you intend on adding the MF (MultiFood) mod, as they have ID conflicts otherwise, thanks. :)","2014-05-01 16:07:03","1");
INSERT INTO `updates` VALUES("107","Tekkit Updates","Hey guys. Per user and OP request, we have made some mod changes:\n\n\n\n[b]Removed[/b]\n\nMFFS\n\nQCraft\n\nLogisticsPipes\n\n\n\nSo if you don\'t want to mess around with those in single player, you can delete them from your mods list, if you know how. If not, contact one of us and we\'ll help you. Also, removing them will substantially improve loading time and reduce a good amount of in-game lag. It\'s not a requirement to remove them, but definitely a recommendation.\n\n\n\n[b]Added[/b]\n\n[url=http://www.dreamspand.com/mods/AlphaItems1.4.zip]Alpha\'s Extras 1.4[/url]\n\n\n\n\n\nClick on the mods to download them. For assistance, talk to any staff member or OP. These days, adding and/or removing mods could not be easier. It\'s really easy once you learn how, and this will probably be one of the last mod updates. I could be wrong about that though, it all depends on who asks to add what. We\'ll check with the users first, though, to see what they think. The Tekkit server has grown substantially well, and we\'re looking to expand it further, not shrink it more! So feel free to tell your friends and we\'ll try to make things work. There may be maintenance on the server this week, but we\'ll try our best to do it when either not a lot of people are on, or more than likely, no one at all. But don\'t let it hinder your game-play! We have two other servers as well, although one is very glitchy (a hand-modded server with a manual modpack, called the Alpha Pack server, more of a \'testing\' area than anything else for mods / plugins).\n\n\n\nI\'ve also removed all bans from the regular server, I think enough time has passed and things have calmed down enough. Well, I\'ve cleared it except for one user, but nobody I\'ve talked to in the past few months knows him but me. Someone I\'ve had problems with for years, on sites and servers. He\'s been very destructive and ill-mannered, arguing with users constantly and consistently breaking things built by other players with this pathetic little posse. But that\'s it, everyone else is off. I figured I\'d let everyone know.\n\n\n\nAlso! For those of you that are new, check the site regularly for updates. And I guess it\'s time to release some news, seeing as how I\'ve made some progress on this. In the not-too-distant future, your MC inventories will be synced with the web site. You will be able to buy things in-game with your tokens from here. You will be able to store and retrieve your inventory, and have different sets. Consider it as a sort of virtual storage for your things, especially with the mass amount of stuff on our servers. Tokens / in-game money will be the same thing, and will be connected through here, as well as the server. It\'s a project I\'ve been working on and thinking about for some time, and although I hit a dead-end with it the other night, I think I may have another path to go down with the Java coding I\'m having to work with. \n\n\n\nAlso, yes, I update my mods, and the Alpha\'s Items is (so far) the only one of my actual mods on the server, though I\'ll eventually add my plugin too (that\'s where the warps come from on the regular DreamCraft server, yours truly). Someone requested a turtle and wolf mod, and I\'ve already got the model for the turtle made, the best I can with square designs...lol. It looks like the things from Spyro, it\'s hilarious. But I think it looks okay. But I\'ll only update my mods maybe once a month or so, unless I get asked to update them earlier. Also, if you have any ideas for mods (or a specific request in general), please feel free to ask. I really don\'t mind, as long as I can do it, and if I can\'t, I\'ll tell you straight up. But that\'s everything that\'s going on right now. Have a good day everyone.\n\n\n\nThanks. :)","2014-05-06 15:29:08","1");
INSERT INTO `updates` VALUES("108","Mod Updates","Please update the Alpha\'s Extras mod and add the Multifood mod to your Tekkit client. Thank you. :)","2014-05-15 17:47:54","1");
INSERT INTO `updates` VALUES("109","Warps Added","Hey guys, I wanted to let you know that you can use my warp system on the Tekkit server now, it works the same way as it has on the other servers. :)\n\n-- Alpha","2014-05-18 10:48:44","1");
INSERT INTO `updates` VALUES("110","ComputerCraft / OpenCC Updates","Hey guys, sorry for the confusion, but I thought you might want to know that I\'ve updated ComputerCraft and OpenCCSensors to their latest 1.6.4 versions. They add some new cool stuff, like Pocket Computers and the ability to dye your CC Turtles.\n\n** **\n1. Delete / move your ComputerCraft 1.5.8 and OpenCCSensors 1.6.4.1B from your mods list.\n\n2. Install [url=http://www.curseforge.com/media/files/785/780/ComputerCraft1.63.jar]ComputerCraft[/url] and [url=https://www.dropbox.com/s/awccbt3ebuporvh/OpenCCSensors-1.6.4.3.jar?dl=1]OpenCCSensors[/url] into your mods list.\n\nI wasn\'t going to update anything for a while, but this adds some really cool stuff that I think everybody can use. So I hope yall like it, and if there are any problems then please let me know.","2014-05-24 10:02:15","1");
INSERT INTO `updates` VALUES("111","Obligatory Update","Hey everybody. So I realize that the web site hasn\'t been too appealing in a while...and this week, I\'m working on fixing that. It may be done by the end of the week, and it may not be, but I\'m overhauling the homepage like crazy. I have completely scrapped the original and restarted from scratch, and so far I think it\'s coming along pretty decent. I would post screenshots, but I kinda want it to be a surprise. This will be v3 of the site, its last major update being in December of 2012. There are other things on the site I intend to work on as well in the near future, but for now I\'m focusing all of my attention to the remodel. If there are any changes or improvements you would like to see, then please let me know and I will be happy to help you.","2014-06-03 14:51:22","1");
INSERT INTO `updates` VALUES("112","Site Overhaul - Part One","Hey everybody, what do you think of Part One of the site overhaul? The next few parts are going to be even greater than this. The site homepage should be far more navigable now, and much less cluttered. A new skin will also soon be coming up, to match the site\'s new look. Currently, the mods, schematics, plugins and skins all function flawlessly, so they may be downloaded, edited, deleted (staff only), and added. They should be much easier to handle now, and everything is done on the same page, rather than having to load several new ones. I hope you enjoy these improvements, and there are more to come.","2014-06-06 09:27:58","1");
INSERT INTO `updates` VALUES("113","Unfortunate News...","This domain name is going to expire in five days, unless the money to renew it miraculously comes through. My family and I are incredibly tight on money right now, we can barely afford to put food on the table and we\'re very close to losing the house. It\'s over a hundred dollars to renew this place and unfortunately it\'s just not in the bank right now. I\'m terribly sorry about this, and I will have the site backed up before this occurs. Thank you for your understanding.","2014-06-07 10:47:13","1");
INSERT INTO `updates` VALUES("114","Well, Nevermind","Turns out I have the money in my account and that renewing it is actually very affordable. Sorry for the misunderstanding, everybody.","2014-06-07 10:55:59","1");
INSERT INTO `updates` VALUES("115","Minecraft: EULA Changes and DDoS Attacks","Hey everyone, I\'ve got some interesting news for everybody. A few days ago, Mojang announced their new [url=http://www.minecraftforum.net/news/1355-mojang-announcement-eula-and-servers/]EULA Rules[/url] for servers, announcing that you can now charge people for access to them, however you can no longer accept donations or buy anything special that affects gameplay. Whatever your opinion on this, read this next part first before you make any rash decisions.\n\nSome [url=https://twitter.com/lelddos]stupid *bleep*hole[/url] decided it would be a good idea to DDoS attack Minecraft because he did not approve of the new rules. He\'s a stupid kid and he\'s attacking a company thinking he can get away with it. Regardless, the multiplayer sessions and even the site have been down for days, and there\'s no word yet on when they will be back up. Surprisingly, this moron is still posting things to his Twitter; maybe he doesn\'t know that what he\'s doing is a federal offense? Something to think about, I guess.\n\nIn any case, I just wanted to assure everyone that the servers themselves are fine and so are your clients. It\'s not us or you, it\'s that damn kid. How lonely do you have to be to dedicate all your time and effort into something like this? Seriously, we here at DreamSpand Gaming are shocked that anybody could be that stupid.\n\nRest assured that as soon as the services return, we will update about it. Until then, we\'re here to answer any questions you may have, and your single player worlds should still work. If there\'s any way we can help you out, then please don\'t hesitate to ask us. We would love to be able to bring it back for you, but unfortunately there\'s nothing we can do, so we\'re just going to have to wait this one out.\n\nSorry for the inconvenience.\n\n-- Alpha","2014-06-13 19:11:58","1");
INSERT INTO `updates` VALUES("116","Servers Should Be Working Again","The Minecraft servers are now, at least temporarily, up and working properly again.","2014-06-13 19:38:33","1");
INSERT INTO `updates` VALUES("118","Tekkit Mods","You may download the latest mod updates by clicking [url=http://www.dreamspand.com/mods/TekkitMods.zip]here[/url]. The instructions are in the archive, but if you have any problems, then please contact us.","2014-06-14 19:23:05","1");
INSERT INTO `updates` VALUES("119","Site Overhaul - Part Two","So, what do you think of Part Two? For me, I think it\'s a bit more promising; definitely looks a lot sleeker, and more...modern? Anywho, I\'m still not done. There are going to be at least 4 parts to the overhaul, maybe 5, depending. To see the changes, look at the changelog below. I also updated the Terms of Service and Privacy Policy pages, so they work now. Now let\'s try getting the word out about this place!\n\nChangelog:\n\n* Updated forum settings options.\n* Each option is now explained.\n* Separated settings by section.\n* Can now toggle whether categories are split.\n* Can now toggle whether text on boards is centered or not.\n* Can now set the default skin for the site.\n* Can now change the name of the forums.\n* Can now change the amount of topics per page in a board.\n* Can now change the amount of posts per topic in a board.\n* Remodeled V2 skin, now called V3.\n","2014-06-26 19:00:04","1");
INSERT INTO `updates` VALUES("120","Mod Update: Alpha\'s Extras!","The Alpha\'s Extras mod on the Tekkit server has been updated. Please get and install the latest version by clicking the link below:\n\nhttp://www.dreamspand.com/mods/Alpha\'sExtras.zip","2014-06-28 13:55:42","1");
INSERT INTO `updates` VALUES("121","Upcoming Alpha\'s Extras Update","So today I found out how to add recipes for pulverizers, sawmills, magma crucibles, fluid transposers, etc, and I don\'t even need the mod APIs because it\'s all done with NBT. So I\'m going to implement that in my Alpha\'s Extras mod, and of course my others, as well. This opens up a lot of other possibilities for me, so I\'m quite excited. Also, for those who are wondering: mod updates will now be at either the start or the end of the month, depending on things. This way things aren\'t getting updated weekly and making everybody not want to play.\n\nIf anyone has any modding ideas or requests they would like, then please ask me and I will be happy to oblige. :)","2014-07-01 20:49:17","1");
INSERT INTO `updates` VALUES("122","Happy 4th!","Just updating to tell our American users to have a happy (and safe) Independence Day. Have fun, but don\'t be an idiot. Safety first. Explosions are fun, but all it takes is one boom too many and bad things happen. A girl I knew once actually blew up her mom\'s car from being one of these idiots. This is DreamSpand Gaming, reminding you that arson is NOT a good thing!","2014-07-04 16:21:08","1");
INSERT INTO `updates` VALUES("123","Mod Updates: Alpha\'s Extras & Multifood","These two mods have been updated on the server, please download them from below and install them into your tekkitmain modpack:\n\n[url=http://www.dreamspand.com/mods/Alpha\'sExtras.zip]Alpha\'s Extras[/url]\n\n[url=http://www.dreamspand.com/mods/Multifood.zip]Multifood[/url]","2014-07-12 13:03:01","1");
INSERT INTO `updates` VALUES("124","Mod Update: Alpha\'s Extras!","Please update this mod to access the Tekkit Server:\n\nhttp://www.dreamspand.com/mods/Alpha\'sExtras.zip","2014-07-25 18:10:28","1");
INSERT INTO `updates` VALUES("125","Mod Update: Crayfish Furniture","Sorry for the double mod update everyone, but please add this to access our servers:\n\nhttp://www.dreamspand.com/mods/MrCrayfishFurnitureModv3.3.4(1.6.4).jar\n\nI promise it\'s worth it, the mod is very cool and a lot of fun, we\'ve been planning on adding it for a while. :)","2014-07-26 17:55:04","1");
INSERT INTO `updates` VALUES("126","Checking In","Hey, how\'s everybody doing? Just thought I\'d check in and mention that I haven\'t forgotten about the site. I\'ve just been very busy, what with the servers, family stuff, work (I have 2 jobs), MC modding, college and other miscellaneous stuff. I do intend to work on the site a bit this week; I\'ve developed a lot of ideas of things I can implement here. I would also love to see some new faces. :)\n\nIn other news, I\'m developing a C.M.S for DreamSpand - a Content Management System. This will allow the staff and admins to create and edit pages, modules, components, scripts, upload and use images, manage files, work VERY RESTRICTIVELY with the database, etc. We need staff to help out with this, too. I plan on having a bunch of pages related to Minecraft, from how to do certain things to how to use said things. Erm... it\'ll make more sense once it\'s implemented. xD\n\nAnyway, we hope to see you around!\n\n-- Alpha","2014-07-28 18:24:06","1");
INSERT INTO `updates` VALUES("127","Alpha\'s Extras","Hey guys, just letting you know I\'ve updated my Extras mod on the Tekkit server again. You can get it by downloading it from the link below:\n\n[url=http://www.dreamspand.com/mods/Alpha\'sExtras.zip]Alpha\'s Extras[/url].\n\nThis particular update is (probably) going to be in two parts, so that means that around the end of August / beginning of September (although it could be much sooner), it will be updated again. This is the Exploration Update. It adds one new mob: the Jellyfish. Sharks now spawn properly as well. I have also added in 16 new biomes, to give the server a more exploratory aspect. There are also now acacia trees and planks. I\'ve added in at least 5 new flowers, too. There are new blocks, as well. \n\nGo explore and find the new stuff. Just remember to find new chunks that haven\'t generated yet. Anyway, be seeing you. Later.\n\n-- Alpha","2014-08-09 10:17:54","1");
INSERT INTO `updates` VALUES("128","Mod Updates","Please download the below mods and add them to your list. :)\n\n\n\n[url=http://www.dreamspand.com/mods/SecurityCraft-Mod-1.6.4.zip]Security Craft[/url]\n\n\n\nhttp://www.dreamspand.com/mods/BiblioCraft[v1.5.5].zip\n\n\n\n[url=http://www.dreamspand.com/mods/Alpha\'sExtras.zip]Alpha\'s Extras[/url]\n\n\n\nIn addition, please ensure that Logistics Pipes, Dimensional Doors and Modular Force Field System (MFFS) are not in your mods list as they will have conflicts; play on!","2014-08-23 16:36:48","1");
INSERT INTO `updates` VALUES("129","Mod Updates & CMS Progress","Hey everyone, don\'t forget to update your [url=http://www.dreamspand.com/mods/Alpha\'sExtras.zip]Alpha\'sExtras[/url] mods in your Tekkit Main mods folder, if you\'re part of our server.\n\nAlso, I\'ve started work on the site\'s CMS again, so soon enough it will go through another revamp, and hopefully this one will matter. :)","2014-09-05 12:37:47","1");
INSERT INTO `updates` VALUES("130","Hey, everyone.","Just wanted to drop in and say hi. I don\'t know who does or doesn\'t still come here, but I do still have plans for this place. I just have been so busy working on an intranet web site at work that by the time I come home I really just don\'t feel like web stuff. But I\'m hoping that\'ll change shortly.\n\nI\'ve dedicated so much time and even money to this place and it\'s still nothing yet... one day though I hope it will be.","2014-11-11 12:58:44","1");
INSERT INTO `updates` VALUES("131","New Mod and Upcoming Features","Hey guys! Just letting you all know (those of you that are still here) that I have really big plans for this place. I\'ve already gotten quite far with a complete redesign of the homepage and it doesn\'t look like crap this time, I promise. It\'s gonna be a little while, but I\'m very committed to working on it now. Things are about to get a lot better here, you can count on that.\n\nAlso, about the server, please add this mod to your mods list: http://www.dreamspand.com/mods/Alpha\'sAlarms.zip\n\nIt\'s something Mike asked me to make a couple days ago, and I whipped it up in basically 4.3 hours today. Sorry for the slowness everybody, I do have high hopes though.\n","2014-11-29 18:39:56","1");
INSERT INTO `updates` VALUES("132","DreamSpand NG: Part One","So, what do you think of the new look? Is it better or worse? Either way, it\'s definitely different, and I\'ve tried to make some things a bit easier to manage. As the title suggests, this is only part one. I spent all this time working 98% of the time on the homepage, so I did very little to the forums themselves. The forums come next -- a massive overhaul of the mechanics. Don\'t worry, it won\'t interfere with your posts or with how you\'ve been using the forums so far. The changes will be mostly underneath the hood, as well as noticeable changes for staff. I apologize for taking so long to do anything to this place; I promise though, I\'m committed to working on the site again, and this time I mean it. I\'m going to get this place out there and get it running. We have potential, I can see it, and even if I\'m the [i]only[/i] one that sees it, I\'m still going to try. But I\'m willing to bet I\'m not the only one.\n\nStay tuned for part two. It won\'t be that far from now.","2014-12-19 15:56:57","1");
INSERT INTO `updates` VALUES("133","It\'s cold.","Hey everybody, is everyone keeping warm? I\'m not, but that\'s because I\'m too lazy to get up and turn off my fan, it\'s a Saturday, man. Anyway, another new change that\'s been made is that once you get to 100 posts, you may advertise your own site or forum. Of course, we want posts to be made after that too, but it\'s just a bit of an incentive. More incentives will be added soon, once I figure out how I\'m gonna go about them. Feel free to mention any suggestions.","2014-12-20 09:48:18","1");
INSERT INTO `updates` VALUES("134","Site Maintenance","Just thought I\'d let everyone know, yes I am aware that the forums are being funky right now. I\'m doing maintenance on them at the moment, it will be resolved shortly. :)","2014-12-20 17:25:33","1");
INSERT INTO `updates` VALUES("135","Fixed the posting glitch.","For those of you that tried to start a new topic and were confused as to why it said \"you have not specified a board to put this in\", it should be fixed now. Sorry about that, everybody.","2014-12-21 15:32:41","1");
INSERT INTO `updates` VALUES("136","Forum Updates.","Just thought I\'d let everyone know that I\'ve updated the forums a bit. I\'m not done yet though. Also, I plan to be adding more content to the site very soon. If you believe you can help with this endeavor, then please be my guest as I will need help. Thank you.","2014-12-23 09:16:35","1");
INSERT INTO `updates` VALUES("137","New rich text editors.","As of today, DreamSpand now has rich text editors for posts. This means that you can say goodbye to all of the UBBC crap (though it does still work, in order to preserve older posts). You can format it as if using Microsoft Word, or you can use basic HTML in the source. Note though that script elements are disabled for security reasons. Let me know what you think of this new posting system.","2014-12-23 15:12:09","1");
INSERT INTO `updates` VALUES("138","Post-Christmas Update","Hey guys! Did you have an awesome Christmas? I hope it was filled with family and food. A belated Merry Christmas to all of you.","2014-12-26 09:22:47","1");
INSERT INTO `updates` VALUES("139","Avenging Rebels","https://www.youtube.com/channel/UCl-u6cPQ1lpD_RvzA_SsN7A/playlists\n\nCheck out our new YouTube channel! We know it\'s a silly name, and as soon as we come up with a better one, we\'ll change it. Anyway, we have two full-length playlists up. Right now, they\'re both Destiny, but the first is 6 videos and the second is 9, with each video being ~15 minutes. Keep in mind that we\'re not professionals - we\'re only doing this for fun. But you should come check us out, and maybe even check out or Twitch channel while you\'re at it (the link to it is in every video on our YouTube channel).","2014-12-30 22:46:11","1");
INSERT INTO `updates` VALUES("140","Posting Problems","I just discovered that there are issues with posting - it can\'t be done at the moment. I am aware of this issue but am unsure as to when it will be fixed. The best I can do is take a look at it tomorrow as I have to get going now. It worked flawlessly on my computer, but something in the src of one of the images is being screwed up by FatCow\'s interference and there it is not working. I will soon begin searching for an alternative, more capable web host as I have had far too many problems with them (FatCow). In the mean time, I do apologize. I\'ll make another update when everything is back online.","2015-01-01 13:25:19","1");
INSERT INTO `updates` VALUES("141","Posting Issue Is Fixed","Thank God. I was going crazy trying to figure out why in the heck the stupid thing wouldn\'t work. Turns out it was an issue with the editor itself, wherein it was attempting to grab the \"server directory\" for uploads using variables. This is set differently in a configuration file on my localhost than it is on FatCow\'s, so I do apologize for making that mistake, I was wrong and it was my fault for not thinking of that sooner. But anyways, everything is working now. If you find anymore issues, however, then please speak to me about it and I will be more than happy to look into it, it won\'t bother or trouble me. I\'d rather know about the issues going on than have them continue to happen without my knowledge. Anyways, thank you for your patience and I hope you can try to enjoy the site and forums, now. The rich text editor is actually quite cool.\n\nP.S.: I had to dig through hundreds of files to find the fix to this.. The Windows indexer is your friend.","2015-01-02 09:28:37","1");
INSERT INTO `updates` VALUES("142","Avenging Revenants"," https://www.youtube.com/channel/UCl-u6cPQ1lpD_RvzA_SsN7A/playlists\n\nCheck out our new YouTube channel! We know it\'s a silly name, and as soon as we come up with a better one, we\'ll change it. Anyway, we have two full-length playlists up. Right now, they\'re both Destiny, but the first is 6 videos and the second is 9, with each video being ~15 minutes. Keep in mind that we\'re not professionals - we\'re only doing this for fun. But you should come check us out, and maybe even check out or Twitch channel while you\'re at it (the link to it is in every video on our YouTube channel).","2015-01-02 10:10:32","1");
INSERT INTO `updates` VALUES("143","License Expired","I am fully aware of the \"license expired\" pop-up box glitch. I don\'t know why it\'s screwing up all of a sudden like that and unfortunately right now there\'s nothing I can do to fix it due to my computer situation. However, I did order a laptop yesterday and it\'s supposedly going to be ready tomorrow. As soon as I can I\'m going to see what I can do about this weirdo error. I\'ve had nothing but trouble out of this rich text crap and I\'m sick of it so for now I may just go back to default UBBC posting until I can find a suitable RTE replacement.\n\nSorry for the trouble, everyone.","2015-02-10 14:05:09","1");
INSERT INTO `updates` VALUES("144","Tomorrow Is Fixing Day!","Tomorrow I am going to (attempt to) fix the issue with posting. Again I am deeply sorry for this inconvenience as I did not know this had happened until yesterday. You have my word though that I will do my best to get it sorted out. Until then, please hang in there. I have plans to get this place some activity shortly.\n\n- Alpha","2015-02-11 23:07:06","1");
INSERT INTO `updates` VALUES("145","Security Upgrades","Some of you may have gotten an error about \"attempted exploitation\" or something to that effect. This is due to me changing the web site\'s security algorithms and routines to make them better and harder to crack. During working on the site and doing my checkups on it that I do, I found several security holes and set out to fix them. Your passwords are now far more secure, and the site\'s cookies are even more unique so as to prevent impersonation. SQL injections have also been protected against more thoroughly, and passwords have been encrypted with the finest encrypting technology out there. Also, you no longer log in using your username - instead, you use your e-mail. It occurred to me that anyone can see anyone\'s username, but only you and [i]staff[/i] can see your e-mail. This makes it much harder for those that would cause harm, as they must first find out what the e-mail actually is. Please note, however, that in order for this new system to properly function, you need to modify your profile and change your password. It is also recommended (optional, but highly recommended) that you change your security questions as well. I will soon be implementing Two-Factor-Authentication as well for those who wish to use it. In today\'s day in age, nothing is truly safe anymore. It\'s up to all of us to make the web a safer place, and to grow with the ever-changing web and cyberverse.\n\nIf you need help making a strong password, don\'t fret - I\'ve created a password generator for those who wish to use it. It is completely free and stores none of your information:\n\nhttp://www.dreamspand.com/xcrypt/index.php","2015-02-17 12:04:21","1");
INSERT INTO `updates` VALUES("146","Post Forms - Finally Fixed!","Another change that has literally just been implemented is that the post forms work now. Yay! I am truly sorry that I did not get to this sooner; I know I said I would do it the other day, but I honestly lost track of time and some other stuff came up that demanded my attention (like me being sick with the flu and being busy at work). In any case, posting is now possible again, and I again apologize sincerely for the large amount of down-time that was experienced. Hopefully soon we can start adding content to the site and bring in more people.\n\n\n\nLet me know of any questions or comments you may have.\n\n\n\n[b]Note: [/b] The two-factor authentication has been implemented into editing your profile, but it does not actually work yet - this will be coming soon as well.","2015-02-17 15:36:03","1");
INSERT INTO `updates` VALUES("147","Security Upgrades - Part II","2FA (Two-Factor Authentication) is now a working option in your profiles. Once enabled, every time you log on, you\'ll be required to enter a 4-digit PIN that you\'ve entered in your profile. I\'m gonna implement an [b]optional[/b] \"password complexivity\" monitor soon, to make sure your passwords are strong. I say optional because it\'s a huge debate in the IT world right now, regarding password complexity and password aging. If I enable these things then it will likely be required only for administrators, but I\'ll make it optional for the members that wish to use it as well. This way it\'s sort of a compromise to make everyone happy.\n\nAnyway, some of you are probably wondering, why all the paranoia and needless protection? #1, because I\'m paranoid. And #2, 11 million+ passwords were released to the public a week or so ago, and a couple of mine (that I have since changed) were in it, thereby inadvertendly fueling my ever-persistent paranoia. I don\'t wanna be \"caught-with-my-pants-down\" like that again, as it\'s never a pleasant experience to see your privacy compromised like that. I want to ensure that everyone that uses this site is safe, and so is their information. The site was hacked a few years ago by a user called GameDezyner (who was indefinitely suspended, by the way), and while what he did was illegal and gravely pissed me off, it also helped me realize that it was time for an upgrade, so upgrade I did. I\'m beefing it up again now because of Moore\'s Law - every two years, anything technological will double in output and productivity. This means that, as hacking gets stronger, my systems get weaker, and therefore must be updated.\n\nPasswords are honestly not even the biggest threat these days. What the real threat is, is word-of-mouth, or someone looking over your shoulder. Transmission of data over unsecured channels, information being passed from browser-to-server (B2S), instead of server-to-server (S2S). I\'m looking into site certificates and SSL now, but it\'s a little hard for me to understand at the moment, so it may take a while. In the mean-time, I can make the site as secure as possible using coding and strong passwords.\n\nI\'m also going to link to the XCrypt Password Generator in your profiles as well; also, I\'m thinking of moving the \"change password\" thing to its own separate page and form, so it stays separate and is a bit more secure. It will have the Change Password link, a link to XCrypt, tips for a strong password, a built-in generator (which may or may not replace the aforementioned link), maybe password expiration, etc.\n\nAnyway, hope to see you guys around. More updates are coming.","2015-02-18 13:05:34","1");
INSERT INTO `updates` VALUES("148","Progress Update","Alright, so the \"Change Password\" form has now been moved, and it contains a link to the XCrypt Generator that I made. Use this to change your passwords now. Soon I plan to implement some form of complexity meter to help out with generating strong passwords, and possibly other (optional) security measures. I\'ve also redesigned the boards a bit on the forums -- they\'re more of a \"general gaming\" category now, instead of just Minecraft (although that board is still there). Logic and I have been working on the main skin for the site, and I am continuing to work on the code. As soon as I get some ideas, I will begin adding content to the Web site as well.\n\nSee you guys around.","2015-02-20 10:59:37","1");
INSERT INTO `updates` VALUES("150","Host Migration","Just thought it fair to inform everyone that we will soon be switching Web hosts to a more capable company. I\'m sorry, but I\'m tired of the constant crap I have to deal with only to get no support. These people (FatCow) are money-grubbing bulls. Some of you may remember a couple of years ago when we were taken offline for no reason. The cause? Because we had too many people on at once. Seriously? What the hell kinda server am I paying for if it can\'t handle Web traffic? Time to go. Not to mention the fact that I\'ve changed the \"auto-renewal\" to MANUAL multiple times only for it to continuously be changed back [i]completely[/i] WITHOUT my knowledge. Then, the next year, my account gets canceled AFTER I renew it myself, manually. The only payment mentioned on the page was the \"$15/year\" charge, and it mentions nothing else. A few minutes later my dad gets an e-mail (as he was the one graciously paying for it at that time) for a $108 charge that was not mentioned anywhere on the page or on the receipt. Come to find out, \"the domain renewal and actual web services are two separate bills!\" No one told us that, and it was not mentioned anywhere. They have done nothing but take advantage of me since day one. That\'s not gonna happen anymore. When the site was down before, what they suggested was that I \"only update who\'s online once a day.\" You have GOT to be kidding me. A few thousand I can get, but 4 or 5 people? No way. That\'s not a Web server; that\'s a toaster. I\'m learning more and more about the Web world and its languages, design, functionality, behaviors and limitations, and I\'ve discovered that I just can\'t stick with FatCow anymore. If I\'m gonna spread my wings and fly, I need fresh, open space, and that is just not something that I have here. Now today, out of the blue, I suddenly couldn\'t update or delete any of my files anymore. I finally found something on it but come to find out it\'s because their server cached my files wrong or something. I had to hit Ctrl+Shift+R to get everything to finally display. I did finally make a ticket, but that was three hours ago and I still have received no reply. I dont pay people for nothing; I pay them to do their job, and if they can\'t do that, then the payments [i]will[/i] stop. \n\nAll data will be carried over; nothing will be left behind or forgotten as it will all be on my PC and my flash drive. Members, posts, etc will all carry over as well, so you don\'t have to sign up again, or worry about what you may have posted or what-have-you. The site is database-driven and therefore it can be exported and re-imported anytime anywhere. I wish I had some help to do this, but I\'ll manage on my own. [b]Please note, also, that I will likely be changing the URL to something a bit catchier.[/b] I\'m thinking something like zollerngaming.org, or zollerntech.com, etc. I hear that .org sites have advantages over .com sites though, and \"dreamspand\" clearly isn\'t going anywhere. So everything will likely be the same, just under a different name.\n\nUntil the move is official, updates will still be coming, if I\'m able to upload them, that is. I apologize for all the trouble and mistakes that have been caused and endured. Hopefully this rebirth will help more than it will hurt.\n\nSee yall on the flip side; game on!\n\n- Zollern","2015-02-24 15:15:28","1");
INSERT INTO `updates` VALUES("151","Successfully migrated.","Welcome to our new host: Dreamhost. Expect things to get even cooler from here on out.","2015-02-24 16:16:38","1");
INSERT INTO `updates` VALUES("152","Site Rebranding / Welcome to Zollernverse","Alrighty, so I\'m sure multiple users (and people in general, for that matter) are going to have some questions. First, I know I said I would carry over the topics, and I still may. But one drawback of this host is that they use an older version of database software and I can\'t do large queries, and I had to do a few rows at a time. Which, to be fair, I couldn\'t do on FatCow, either. We are currently hosted with Dreamhost, and so far I am very impressed. I expect issues eventually, as nothing is perfect. I just can\'t say enough good things about our new host right now.\n\nAnyway, the whole \"Minecraft theme\" thing wasn\'t going anywhere, so I\'ve opted to completely abandon Minecraft altogether. All mods and updates to the servers will still be hosted here and news about them will still be posted, so you don\'t have to worry about being in the dark. Zollernverse was originally DreamSpand, but as I said that site was just not going anywhere. Think of this site as DreamSpand\'s love-child. Content is currently being added bit by bit, and if you wish to help with that endeavor, then please contact me personally and we\'ll talk about it, because I could definitely use the help.\n\nAlso, the site\'s Two-Factor Authentication is acting a bit strange right now, so I would recommend not using it until I can fix the problem. You may still use it if you wish, but there\'s an issue with entering the PIN where it asks for it more than once, and on the second time it sometimes won\'t submit properly. I plan to look into it soon, there\'s just other things that occupy my time right now obviously, given the move and the rebranding of the site for the umpteenth time. Hopefully it gets squared away soon, though.\n\nAnywhosits, the site is now a gaming [i]and[/i] tech Web site, to bring in those that play games as well as those that develop them. My plan is to mix these two worlds together seamlessly and have one affect the other in a positive, inspiring way. Speaking of bringing worlds together, if you\'re interested in parternering (site-to-site linking/affiliating) with us, please contact me at [url=mailto:admin@zollernverse.org]admin@zollernverse.org[/url], and I\'ll be more than happy to talk about it.\n\nPlease let me know in the comments if you have any questions or suggestions. Thanks!","2015-02-25 07:36:03","1");
INSERT INTO `updates` VALUES("153","A Legend Died Today","I don\'t know if you\'ve heard (probably so), but Leonard Nimoy, the actor who played the very loved Spock in Star Trek, passed away today at 83. I don\'t normally post about news stuff on here, but this guy was a huge hero to me in a big way. He was that to a lot of people, actually. I was very saddened to learn this news as I\'m sure many people were as well. R.I.P Leonard/Spock.","2015-02-27 16:30:47","1");
INSERT INTO `updates` VALUES("154","Avenging Revenants","Just a casual reminder for everyone - we are running a YouTube Let\'s Play channel and would love for you to check it out. We\'re called the [url=https://www.youtube.com/channel/UCl-u6cPQ1lpD_RvzA_SsN7A]Avenging Revenants[/url] - it sounds silly, but we get it done.","2015-03-02 13:02:52","1");
INSERT INTO `updates` VALUES("155","New Review!","Hey everyone! Check out our new Destiny review, courtesy of [user=58]! He\'s also one of the people from Avenging Revenants, along with me and Mike. Give it a read. :)\n\n\n\nhttp://www.zollernverse.org/p/destiny","2015-03-10 08:03:53","1");
INSERT INTO `updates` VALUES("156","Easier to Sign Up","Hey everybody! Signing up just got a lot easier for everybody. No more confusing letters and numbers that you have to type in from hard-to-read images. Utilizing the Google API for reCAPTCHA, users can now sign up with ease by simply ticking a checkbox that simply says \"I\'m not a robot\" and the site does the rest. If any issues are found with this, please report them to me immediately via support@zollernverse.org, and I will get right on working on it. Hopefully this will cease deterrence of previously-interested guests. The other CAPTCHA images were hand-made by yours truly, and for a while it definitely worked, but it was just not practical. Now things should be easier. Happy gaming!","2015-03-16 15:10:30","1");



DROP TABLE `userlogs`;

CREATE TABLE `userlogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `action` text NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12495 DEFAULT CHARSET=latin1;

INSERT INTO `userlogs` VALUES("12487","1","was granted $0 interest in his bank account.","2016-04-08 09:38:16","::1");
INSERT INTO `userlogs` VALUES("12488","3","Field \\\'likedBy\\\' doesn\\\'t have a default value","2016-04-08 09:38:41","::1");
INSERT INTO `userlogs` VALUES("12489","1","updated his status to: Test","2016-04-08 09:39:59","::1");
INSERT INTO `userlogs` VALUES("12490","1","posted a commment on [user=1]\\\'s profile.","2016-04-08 09:40:10","::1");
INSERT INTO `userlogs` VALUES("12491","1","received a notification.","2016-04-08 09:40:10","::1");
INSERT INTO `userlogs` VALUES("12492","1","deleted one of his notifications.","2016-04-08 09:40:22","::1");
INSERT INTO `userlogs` VALUES("12493","1","likes [user=3]\\\'s status.","2016-04-08 09:41:09","::1");
INSERT INTO `userlogs` VALUES("12494","1","received a notification.","2016-04-08 09:41:09","::1");



DROP TABLE `viewing`;

CREATE TABLE `viewing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boardid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `viewing` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;

INSERT INTO `viewing` VALUES("136","28","67","2015-02-25 09:36:29");
INSERT INTO `viewing` VALUES("137","28","0","2015-03-11 09:29:55");
INSERT INTO `viewing` VALUES("138","28","69","2015-03-03 18:23:04");
INSERT INTO `viewing` VALUES("139","28","64","2015-02-27 21:09:57");
INSERT INTO `viewing` VALUES("140","76","1","2015-02-28 20:58:25");



DROP TABLE `voters`;

CREATE TABLE `voters` (
  `poll_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE `warn`;

CREATE TABLE `warn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` text NOT NULL,
  `details` text NOT NULL,
  `userid` int(11) NOT NULL,
  `warner_id` int(11) NOT NULL,
  `warned_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;




