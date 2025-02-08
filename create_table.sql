create table if not exists users(
    id int primary key auto_increment,
    username varchar(255) not null unique,
    password varchar(255) not null,
    email varchar(50) not null,
    created_at timestamp default current_timestamp
);