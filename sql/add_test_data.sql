-- Lisätään käyttäjä
insert into users (name, email, password) values ('Pekka', 'pekka@testi.com', '$2a$15$blmz1ppOAucUErWIgMYyJeIjQ1pefxD/WeENWoaFk11YlEGLYPq2C');
-- Lisätään lasku ja laskun liput a' 2€/kpl
insert into invoice (reference_number, amount) values (1234561, 10);
insert into ticket (id, user_id, invoice_id) values (1001000001, 1,1);
insert into ticket (id, user_id, invoice_id) values (1001000002, 1,1);
insert into ticket (id, user_id, invoice_id) values (1001000003, 1,1);
insert into ticket (id, user_id, invoice_id) values (1001000004, 1,1);
insert into ticket (id, user_id, invoice_id) values (1001000005, 1,1);
-- Lisätään maksuja
insert into payment (archiving_code, reference_number, amount, recording_date) values ('123456789qwertyuiopasdfghjklzxcvbnm', 1234561, 2, '2015-04-15');
insert into payment (archiving_code, reference_number, amount, recording_date) values ('123456789qwertyuiopasdfghjklzxcvbnn', 1234561, 2, '2015-04-16');
insert into payment (archiving_code, reference_number, amount, recording_date) values ('123456789qwertyuiopasdfghjklzxcvbmm', 1234561, 2, '2015-04-17');
insert into payment (archiving_code, reference_number, amount, recording_date) values ('123456789qwertyuiopasdfghjklzxcvbxx', 1234561, 2, '2015-04-18');
insert into payment (archiving_code, reference_number, amount, recording_date) values ('123456789qwertyuiopasdfghjklzxcvbaa', 1234561, 2, '2015-04-19');
