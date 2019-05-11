create table tasks(
	id int not null auto_increment primary key,
	title varchar(50),
	content text,
	uid int,
	up_date datetime
);



