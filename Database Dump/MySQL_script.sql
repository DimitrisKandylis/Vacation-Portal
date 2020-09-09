create schema vacation_portal_db;
create user 'portal_admin' identified by 'Aq3#Y4#C';
grant all on vacation_portal_db.* to 'portal_admin';
use vacation_portal_db;
create table users(
   id INT NOT NULL AUTO_INCREMENT,
   firstname VARCHAR(100) NOT NULL,
   lastname VARCHAR(100) NOT NULL,
   email VARCHAR(40) NOT NULL,
   password VARCHAR(40) NOT NULL,
   type VARCHAR(40) NOT NULL CHECK (type IN ('Employee','Admin')),
   PRIMARY KEY ( id )
);
insert into users(firstname, lastname, email, password, type) value("Dan", "Brown", "admin@mail.com", "1234", "Admin");
insert into users(firstname, lastname, email, password, type) value("John", "Doe", "john@mail.com", "asdf", "Employee");
create table applications(
   id INT NOT NULL AUTO_INCREMENT,
   user_id INT NOT NULL,
   date_submitted DATE NOT NULL,
   date_from DATE NOT NULL,
   date_to DATE NOT NULL,
   reason TEXT NOT NULL,
   req_status VARCHAR(40) NOT NULL CHECK (req_status IN ('pending','approved','rejected')),
   PRIMARY KEY ( id ),
   FOREIGN KEY (user_id) REFERENCES users(id)
);
insert into applications(user_id, date_submitted, date_from, date_to, reason, req_status) value(2, '2020-09-07', '2020-09-22', '2020-09-28', "Vacation", "approved");
insert into applications(user_id, date_submitted, date_from, date_to, reason, req_status) value(2, '2020-09-07', '2020-10-22', '2020-10-28', "Medical Reasons", "rejected");
insert into applications(user_id, date_submitted, date_from, date_to, reason, req_status) value(2, '2020-09-07', '2020-11-22', '2020-11-28', "Vacation", "pending");
