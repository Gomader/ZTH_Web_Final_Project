use WebProject;
drop table user;
drop table product;
drop table action;
drop table conect;
drop table cart;
create table user(
	id int(11) auto_increment primary key,
    username varchar(20) not null,
    password varchar(32) not null,
    email varchar(30),
    type int(1) not null
)engine MyISAM;

create table product(
	id int(11) auto_increment primary key,
    name varchar(20) not null,
    pic varchar(50),
    sellerid int(11) not null,
    buyerid int(11) default -1,
    price int(11) default 0,
    endprice int(11) default 0,
    type tinyint(1),
    sellerphone varchar(20),
    sellername varchar(20),
    address varchar(50),
    addtime timestamp default current_timestamp,
    endtime timestamp,
    foreign key(sellerid) references WebProject.user(id),
    foreign key(buyerid) references WebProject.user(id)
)engine MyISAM;

create table action(
	id int(11) auto_increment primary key,
    productid int(11) not null,
    bidderid int(11) not null,
    addprice int(11) default 0,
    time timestamp default current_timestamp,
    foreign key(productid) references WebProject.product(id),
    foreign key(bidderid) references WebProject.user(id)
)engine MyISAM;

create table conect(
	id int(11) auto_increment primary key,
    name varchar(11),
    email varchar(30),
    usertype int(1),
    message varchar(100)
)engine MyISAM;

create table cart(
	id int(11) auto_increment primary key,
    userid int(11) not null,
    productid int(11) not null,
    addtime timestamp default current_timestamp,
    foreign key(userid) references WebProject.user(id),
    foreign key(productid) references WebProject.product(id)
)engine MyISAM;

insert into user(username,password,type) values("admin","admin",0),("test1","abc123",1),("test2","abc123",2);
