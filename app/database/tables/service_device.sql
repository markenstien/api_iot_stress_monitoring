create table sensor_device(
    id int(10) not null primary key auto_increment,
    is_on boolean default false,
    created_at datetime default now() comment 'automatically turnoff after an hour'
);


insert into sensor_device(
    is_on
) VALUES (true);