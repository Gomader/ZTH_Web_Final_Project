use WebProject;
create table user(
	id int(11) auto_increment primary key,
    username varchar(20) not null,
    password varchar(32) not null,
    email varchar(30),
    type int(1) not null
)engine MyISAM;

create table product(
	id int(11) auto_increment primary key,
    sellerid int(11) not null,
    buyerid int(11) default -1,
    price int(11) default 0,
    endprice int(11) default 0,
    state tinyint(1) default 0,
    type tinyint(1),
    addtime timestamp default current_timestamp,
    endtime timestamp not null,
    foreign key(sellerid) references WebProject.user(id),
    foreign key(buyerid) references WebProject.user(id)
)engine MyISAM;

create table action(
	id int(11) auto_increment primary key,
    productid int(11) not null,
    bidderid int(11) not null,
    price int(11) default 0,
    time timestamp default current_timestamp,
    foreign key(productid) references WebProject.product(id),
    foreign key(bidderid) references WebProject.user(id)
)engine MyISAM;

