CREATE TABLE Client (
client_id INT PRIMARY KEY AUTO_INCREMENT,
client_name VARCHAR(40),
city VARCHAR(40),
client_cellphone VARCHAR(15)
);

CREATE TABLE Driver (
driver_id INT PRIMARY KEY AUTO_INCREMENT,
driver_name VARCHAR(40) NOT NULL,
driver_license VARCHAR(20)  NOT NULL,
driver_cellphone VARCHAR(15) NOT NULL
);

CREATE TABLE Delivery (
delivery_id INT PRIMARY KEY AUTO_INCREMENT,
client_id INT NOT NULL,
driver_id INT NOT NULL,
CONSTRAINT fk_client_id_Client FOREIGN KEY
(client_id) REFERENCES Client(client_id),
CONSTRAINT fk_driver_id_Driver FOREIGN KEY
(driver_id) REFERENCES Driver(driver_id),
date DATE NOT NULL,
status ENUM('PENDING', 'IN_TRANSIT', 'DELIVERED', 'CANCELLED', 'FAILED','RETURNED') DEFAULT 'PENDING',
);

INSERT INTO Client( client_name,city, client_cellphone) VALUES ( 'Mariele', 'Porto Alegre', '5551999999999');
INSERT INTO Client( client_name,city, client_cellphone) VALUES ( 'João', 'Santa Maria', '555199998888');
INSERT INTO Client( client_name,city, client_cellphone) VALUES ( 'Leonardo', 'Porto Alegre', '555199997777');

INSERT INTO Driver( driver_name,driver_license, driver_cellphone) VALUES ( 'Douglas', 'ss9s97a', '5551999996666');
INSERT INTO Driver( driver_name,driver_license, driver_cellphone) VALUES ('Maria', 'ds7sad90', '5551999995555');
INSERT INTO Driver( driver_name,driver_license, driver_cellphone) VALUES ( 'José', '8s7dds5', '5551999994444');

INSERT INTO Delivery( client_id, driver_id) VALUES ( 2, 3, TO_DATE('2025-10-24' 'YYY-MM-DD'), 'PENDING');
INSERT INTO Delivery( client_id, driver_id) VALUES ( 3, 1, TO_DATE('2025-10-25' 'YYY-MM-DD'), 'IN_TRANSIT');
INSERT INTO Delivery( client_id, driver_id) VALUES ( 2, 2, TO_DATE('2025-10-26' 'YYY-MM-DD'), 'DELIVERED');
