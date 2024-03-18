create table sensor_response_data(
    id int(10) not null primary key auto_increment,
    user_id int(10) not null primary key auto_increment,
    response_data BLOB not null,
    entry_date datetime
);

drop table if exists sensor_response_process_data;
create table sensor_response_process_data(
    id int(10) not null primary key auto_increment,
    sensor_response_data_id int(10) not null,
    response_data_processed BLOB not null,
    export_date datetime,
    import_date datetime,
    remarks varchar(100)
);

create table users(
    id int(10) not null primary key auto_increment,
    fullname varchar(100) not null,
    email varchar(50) not null,
    age tinyint,
    gender enum('male','female'),
    password varchar(255),
    last_login datetime
);

create table musics(
    id int(10) not null primary key auto_increment,
    user_id int(10) not null,
    music_link text,
    genre varchar(50),
    is_public boolean default true
);


create table devices(
    id int(10) not null primary key auto_increment,
    wifi_ssid varchar(150),
    wifi_passwrd varchar(150),
    device_code char(50),
    created_at timestamp default now()
);