<?php
	mysql_query("CREATE TABLE IF NOT EXISTS galaxies (
		id INT NOT NULL AUTO_INCREMENT,
		name VARCHAR(30) NOT NULL,
		distance_from_center INT NOT NULL,
		primary key (id)
	)") OR exit(mysql_error());

	mysql_query("CREATE TABLE IF NOT EXISTS stars (
		id INT NOT NULL AUTO_INCREMENT,
		name VARCHAR(50) NOT NULL UNIQUE,
		temperature TEXT NOT NULL,
		distance_from_center TEXT NOT NULL,
		mass TEXT NOT NULL,
		mass_scale INT NOT NULL,
		age INT NOT NULL,
		galaxy_id INT NOT NULL,
		primary key (id)
	)") OR exit(mysql_error());
	
	mysql_query("CREATE TABLE IF NOT EXISTS planets (
		id INT NOT NULL AUTO_INCREMENT,
		name VARCHAR(50) NOT NULL UNIQUE,
		temperature TEXT NOT NULL,
		distance_from_star TEXT NOT NULL,
		mass TEXT NOT NULL,
		mass_scale INT NOT NULL,
		gasses TEXT NOT NULL,
		star_id INT NOT NULL,
		rad INT NOT NULL,
		tox INT NOT NULL,
		primary key (id)
	)") OR exit(mysql_error());
	
	mysql_query("CREATE TABLE IF NOT EXISTS moons (
		id INT NOT NULL AUTO_INCREMENT,
		name VARCHAR(40) NOT NULL UNIQUE,
		temperature TEXT NOT NULL,
		distance_from_planet TEXT NOT NULL,
		mass TEXT NOT NULL,
		mass_scale INT NOT NULL,
		gasses TEXT NOT NULL,
		planet_id INT NOT NULL,
		rad INT NOT NULL,
		tox INT NOT NULL,
		primary key (id)
	)") OR exit(mysql_error());
?>