 
<?php
// connect();
	query("CREATE TABLE IF NOT EXISTS p_inv (
		id INT NOT NULL AUTO_INCREMENT,
		userid INT NOT NULL,
		contents TEXT NOT NULL,
		inv_access ENUM('public','private') DEFAULT 'private' NOT NULL,
		effects TEXT NOT NULL,
		max_inv INT DEFAULT '64' NOT NULL,
		primary key (id)
	);");
	query("CREATE TABLE IF NOT EXISTS p_items (
		id INT NOT NULL AUTO_INCREMENT,
		added TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
		name VARCHAR(20) DEFAULT 'unknown.item' NOT NULL,
		about TEXT NOT NULL,
		img TEXT NOT NULL,
		item_type VARCHAR(45) NOT NULL,
		bought INT NOT NULL,
		price INT NOT NULL,
		primary key (id)
	);");
	query("CREATE TABLE IF NOT EXISTS tasks (
		id INT NOT NULL AUTO_INCREMENT,
		name VARCHAR(50) NOT NULL,
		about TEXT NOT NULL,
		code LONGTEXT NOT NULL,
		userid INT NOT NULL,
		run_time TIME NOT NULL,
		primary key (id)
	);");
     	if(online()){
			$u = sql("SELECT name FROM members WHERE id = '".$_COOKIE["id"]."'");
			query("UPDATE members SET display = '".$u["name"]."' WHERE display = '' AND id = '".$_COOKIE["id"]."'");
			$x = sql("SELECT id FROM p_inv WHERE userid = '".$_COOKIE["id"]."'");
			if($x["id"] == ""){
				query("INSERT INTO p_inv(userid)VALUES('".$_COOKIE["id"]."');");
			}
		}
?>