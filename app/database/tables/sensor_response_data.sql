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

drop table if exists musics;
create table musics(
    id int(10) not null primary key auto_increment,
    user_id int(10) not null,
    music_link text,
    genre varchar(50),
    is_public boolean default true
);

drop table if exists devices;
create table devices(
    id int(10) not null primary key auto_increment,
    wifi_ssid varchar(150),
    wifi_passwrd varchar(150),
    device_code char(50),
    created_at timestamp default now()
);