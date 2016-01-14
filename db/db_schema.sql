create table goods(
    id int not null auto_increment primary key,
    name varchar(20) not null default 'item',
    description varchar(200),
    weight int(11) not null,
    price float not null,
    dateAdded TIMESTAMP not null default CURRENT_TIMESTAMP,
    dateModified date,
    dateSold date
);