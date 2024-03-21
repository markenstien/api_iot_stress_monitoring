drop table if exists users;
create table users(
    id int(10) not null primary key auto_increment,
    email varchar(100) not null unique,
    password varchar(250) not null,
    firstname varchar(50) not null,
    lastname varchar(50) not null,

    gender enum('male','female','not set') default 'not set',
    age tinyint,
    created_at datetime,
    updated_at datetime
);


create table user_logs(
    id int(10) not null primary key auto_increment,
    user_id int(10) not null,
    is_online boolean default false,
    last_update datetime
);