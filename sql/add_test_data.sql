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

-- Lisätään maksuja
insert into payment (archiving_code, reference_number, amount, date_of_payment, amount_left) values ('123456789qwertyuiopasdfghjklzxcvbnm', 1234561, 2, '2015-04-15', 8);
insert into payment (archiving_code, reference_number, amount, date_of_payment, amount_left) values ('123456789qwertyuiopasdfghjklzxcvbnn', 1234561, 2, '2015-04-16', 6);
insert into payment (archiving_code, reference_number, amount, date_of_payment, amount_left) values ('123456789qwertyuiopasdfghjklzxcvbmm', 1234561, 2, '2015-04-17', 4);
insert into payment (archiving_code, reference_number, amount, date_of_payment, amount_left) values ('123456789qwertyuiopasdfghjklzxcvbxx', 1234561, 2, '2015-04-18', 2);
insert into payment (archiving_code, reference_number, amount, date_of_payment, amount_left) values ('123456789qwertyuiopasdfghjklzxcvbaa', 1234561, 2, '2015-04-19', 0);
