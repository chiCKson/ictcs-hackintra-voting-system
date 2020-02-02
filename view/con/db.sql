create table proposal(
    team varchar(30) primary key,
    university varchar(30),
    leader varchar(30),
    email varchar(50),
    mobile varchar(12),
    problem text,
    solution text,
    technology text,
    business text,
    url text
);

create table participant(
    id int auto_increment primary key,
    name varchar(30),
    food varchar(10),
    team varchar(30),
    foreign key (team) references proposal(team)
);