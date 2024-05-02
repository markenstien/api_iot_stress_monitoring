create table devices(
    id int(10) not null primary key auto_increment,
    device_name varchar(50),
    device_code char(12),
    device_type varchar(50),
    device_status enum('HIGH','LOW') default 'LOW',
    last_update datetime,
    remarks text,
    pin char(3)
);

/*
*import devices
*/

INSERT INTO devices(
    device_name, 
    device_code,
    device_type
) VALUES(
    'HUMID - SCENT A',
    'HUMIDA',
    'HUMIDIFIER'
),
(
    'HUMID - SCENT B',
    'HUMIDB',
    'HUMIDIFIER'
),
(
    'HUMID - SCENT C',
    'HUMIDC',
    'HUMIDIFIER'
);