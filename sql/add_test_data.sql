-- Lisätään käyttäjä
insert into users (name, email, password) values ('Pekka', 'pekka@testi.com', '$2a$15$blmz1ppOAucUErWIgMYyJeIjQ1pefxD/WeENWoaFk11YlEGLYPq2C');
-- Lisätään laskuja ja laskun liput a' 2€/kpl
insert into invoice (reference_number, amount, user_id, created) values (1234561, 10, 1, '2015-04-01');
insert into ticket (id, user_id, invoice_id) values (1001000001, 1,1);
insert into ticket (id, user_id, invoice_id) values (1001000002, 1,1);
insert into ticket (id, user_id, invoice_id) values (1001000003, 1,1);
insert into ticket (id, user_id, invoice_id) values (1001000004, 1,1);
insert into ticket (id, user_id, invoice_id) values (1001000005, 1,1);

insert into invoice (reference_number, amount, user_id, created) values (1234574, 20, 1, '2015-04-15');
insert into ticket (id, user_id, invoice_id) values (1001000006, 1,2);
insert into ticket (id, user_id, invoice_id) values (1001000007, 1,2);
insert into ticket (id, user_id, invoice_id) values (1001000008, 1,2);
insert into ticket (id, user_id, invoice_id) values (1001000009, 1,2);
insert into ticket (id, user_id, invoice_id) values (1001000010, 1,2);
insert into ticket (id, user_id, invoice_id) values (1001000011, 1,2);
insert into ticket (id, user_id, invoice_id) values (1001000012, 1,2);
insert into ticket (id, user_id, invoice_id) values (1001000013, 1,2);
insert into ticket (id, user_id, invoice_id) values (1001000014, 1,2);
insert into ticket (id, user_id, invoice_id) values (1001000015, 1,2);

insert into invoice (reference_number, amount, user_id, created) values (10184, 40, 1, '2015-04-20');
insert into ticket (id, user_id, invoice_id) values (1001000017, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000016, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000019, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000021, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000022, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000023, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000018, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000024, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000025, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000026, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000027, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000028, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000029, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000030, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000031, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000032, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000033, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000034, 1,3);
insert into ticket (id, user_id, invoice_id) values (1001000035, 1,3);
-- Lisätään maksuja
insert into payment (reference_number, amount, date_of_payment, amount_left) values (1234561, 2, '2015-04-15', 8);
insert into payment (reference_number, amount, date_of_payment, amount_left) values (1234561, 2, '2015-04-16', 6);
insert into payment (reference_number, amount, date_of_payment, amount_left) values (1234561, 2, '2015-04-17', 4);
insert into payment (reference_number, amount, date_of_payment, amount_left) values (1234561, 2, '2015-04-18', 2);
insert into payment (reference_number, amount, date_of_payment, amount_left) values (1234561, 2, '2015-04-19', 0);
