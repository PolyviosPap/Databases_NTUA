CREATE database spring_project;

USE spring_project;

CREATE TABLE HOTEL_GROUP (
	hot_gr_id INT NOT NULL AUTO_INCREMENT,
	hot_gr_name varchar(30) NOT NULL,
	str varchar(40) NOT NULL,
	str_num INT NOT NULL,
	post_cod INT NOT NULL,
	city varchar(15) NOT NULL,
	num_of_hot INT NOT NULL,
	UNIQUE(hot_gr_name),
	PRIMARY KEY(hot_gr_id)
);

CREATE TABLE H_G_PH (
	id INT NOT NULL AUTO_INCREMENT,
	hot_gr_id INT NOT NULL,
	phone INT NOT NULL,
	PRIMARY KEY(id),
	
	FOREIGN KEY(hot_gr_id) REFERENCES HOTEL_GROUP(hot_gr_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE H_G_EM (
	id INT NOT NULL AUTO_INCREMENT,
	hot_gr_id INT NOT NULL,
	email varchar(50) NOT NULL,
	PRIMARY KEY(id),
	
	FOREIGN KEY(hot_gr_id) REFERENCES HOTEL_GROUP(hot_gr_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE HOTEL (
	hot_id INT NOT NULL AUTO_INCREMENT,
	hot_name varchar(30) NOT NULL,
	hot_gr_id INT NOT NULL,
	str varchar(40) NOT NULL,
	str_num INT NOT NULL,
	post_code INT NOT NULL,
	city varchar(15) NOT NULL,
	num_of_rooms INT NOT NULL,
	stars INT NOT NULL,
	PRIMARY KEY(hot_id),
	UNIQUE(hot_name),
	
	FOREIGN KEY(hot_gr_id) REFERENCES HOTEL_GROUP(hot_gr_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE H_PH (
	id INT NOT NULL AUTO_INCREMENT,
	hot_id INT,
	phone INT NOT NULL,
	PRIMARY KEY(id),
	
	FOREIGN KEY(hot_id) REFERENCES HOTEL(hot_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE H_EM (
	id INT NOT NULL AUTO_INCREMENT,
	hot_id INT,
	email varchar(50) NOT NULL,
	PRIMARY KEY(id),
	
	FOREIGN KEY(hot_id) REFERENCES HOTEL(hot_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE ROOM (
	room_id INT NOT NULL,
	hot_id INT NOT NULL,
	price INT NOT NULL,
	repairs_need varchar(255),
	expandable INT,
	room_view varchar(10),
	capacity INT NOT NULL,
	PRIMARY KEY(room_id),
	
	FOREIGN KEY(hot_id) REFERENCES HOTEL(hot_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE AMENITIES (
	id INT NOT NULL AUTO_INCREMENT,
	room_id INT NOT NULL,
	amenities varchar(50) NOT NULL,
	PRIMARY KEY(id),
	
	FOREIGN KEY(room_id) REFERENCES ROOM(room_id) ON UPDATE CASCADE ON DELETE CASCADE
);
	
CREATE TABLE EMPLOYEE (
	irs_num INT NOT NULL,
	hot_id INT NOT NULL,
	soc_sec_num INT NOT NULL,
	f_name varchar(30) NOT NULL,
	l_name varchar(30) NOT NULL,
	str varchar(40) NOT NULL,
	str_num INT NOT NULL,
	post_code INT NOT NULL,
	city varchar(15) NOT NULL,
	PRIMARY KEY(irs_num),
	
	FOREIGN KEY(hot_id) REFERENCES HOTEL(hot_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE CUSTOMER (
	irs_num INT NOT NULL,
	soc_sec_num INT NOT NULL,
	f_name varchar(30) NOT NULL,
	l_name varchar(30) NOT NULL,
	str varchar(40) NOT NULL,
	str_num INT NOT NULL,
	post_code INT NOT NULL,
	city varchar(15) NOT NULL,
	first_reg DATE NOT NULL,
	PRIMARY KEY(irs_num)
);

CREATE TABLE WORKS (
	irs_num INT NOT NULL,
	hot_id INT,
	start_date DATE NOT NULL,
	position varchar(20) NOT NULL,
	finish_date DATE NOT NULL,
	UNIQUE(irs_num, hot_id),
	
	CONSTRAINT CHK_dates CHECK (finish_date > start_date),
	FOREIGN KEY(irs_num) REFERENCES EMPLOYEE(irs_num) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(hot_id) REFERENCES HOTEL(hot_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE RESERVES (
	res_id INT NOT NULL AUTO_INCREMENT,
	irs_num INT NOT NULL,
	room_id INT NOT NULL,
	start_date DATE NOT NULL,
	paid varchar(255),
	finish_date DATE NOT NULL,
	
	PRIMARY KEY(res_id),
	CONSTRAINT CHK_dates CHECK (finish_date > start_date),
	FOREIGN KEY(irs_num) REFERENCES CUSTOMER(irs_num) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(room_id) REFERENCES ROOM(room_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE PAYMENT_TR (
	payment_id INT NOT NULL AUTO_INCREMENT,
	amount INT NOT NULL,
	method varchar(255) NOT NULL,
	
	PRIMARY KEY(payment_id)
);

CREATE TABLE RENTS (
	rent_id INT NOT NULL AUTO_INCREMENT,
	irs_num_emp INT,
	irs_num_cus INT NOT NULL,
	payment_id INT NOT NULL,
	room_id INT,
	start_date DATE NOT NULL,
	finish_date DATE NOT NULL,
	
	PRIMARY KEY(rent_id),
	CONSTRAINT CHK_dates CHECK (finish_date > start_date),
	FOREIGN KEY(irs_num_emp) REFERENCES EMPLOYEE(irs_num) ON UPDATE CASCADE ON DELETE SET NULL,
	FOREIGN KEY(irs_num_cus) REFERENCES CUSTOMER(irs_num) ON UPDATE CASCADE ON DELETE RESTRICT,
	FOREIGN KEY(payment_id) REFERENCES PAYMENT_TR(payment_id) ON UPDATE CASCADE ON DELETE RESTRICT,
	FOREIGN KEY(room_id) REFERENCES ROOM(room_id) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE INDEX room_index
ON ROOM (room_id, hot_id, price, repairs_need, room_view, expandable, capacity);

CREATE INDEX res_index
ON RESERVES (res_id, irs_num, room_id, start_date, finish_date, paid);

CREATE INDEX hot_index
ON HOTEL (hot_name, str, str_num, post_code, city, num_of_rooms, stars);

CREATE TRIGGER delete_employee
AFTER DELETE ON WORKS
FOR EACH ROW
DELETE FROM EMPLOYEE WHERE irs_num = OLD.irs_num;