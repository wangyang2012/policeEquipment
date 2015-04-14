CREATE DATABASE policeequipment;
/*
User {
	id
	type
	name
	password
}
*/
CREATE TABLE `policeequipment`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` INT NULL,
  `name` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));

/*
EquipmentType {
	id
	name
}
*/
CREATE TABLE `policeequipment`.`equipmenttype` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));
  
/*
Equipment {
	id
	type
	name
	price
	quantity
	expirationDate
}
*/
CREATE TABLE `policeequipment`.`equipment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` INT NULL,
  `name` VARCHAR(45) NULL,
  `price` INT NULL,
  `stock` INT NULL,
  `expirationDate` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_equipment_type_idx` (`type` ASC),
  CONSTRAINT `fk_equipment_type`
    FOREIGN KEY (`type`)
    REFERENCES `policeequipment`.`equipmenttype` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
	
	
/*
Request {
	id
	user
	equipement
	type (+/-/new)
	quantity
	date
}
*/
CREATE TABLE `policeequipment`.`request` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user` INT NULL,
  `equipement` INT NULL,
  `action` INT NULL,
  `quantity` INT NULL,
  `date` DATETIME NULL,
  `notice` VARCHAR(45) NULL,
  `newName` VARCHAR(45) NULL,
  `newType` INT NULL,
  `newPrice` INT NULL,
  `newQuantity` VARCHAR(45) NULL,
  `newExpirationDate` DATETIME NULL,
  `newResponsible` VARCHAR(45) NULL,
  `newNotice` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `idUser_idx` (`user` ASC),
  INDEX `idEquipment_idx` (`equipement` ASC),
  INDEX `idNewTypeEquipment_idx` (`newType` ASC),
  CONSTRAINT `idUser`
    FOREIGN KEY (`user`)
    REFERENCES `policeequipment`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idEquipment`
    FOREIGN KEY (`equipement`)
    REFERENCES `policeequipment`.`equipment` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idNewTypeEquipment`
    FOREIGN KEY (`newType`)
    REFERENCES `policeequipment`.`equipmenttype` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

  
/*
Response {
	id
	user
	request
	response (1/0)
	date
}
*/


	/*
	new user request {
		login
		password
		type
	}
	*/
CREATE TABLE `policeequipment`.`newuserrequest` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `type` INT NULL,
  PRIMARY KEY (`id`));

  
/*
History {
	Request
	Response
	Date
}
*/
