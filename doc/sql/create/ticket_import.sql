CREATE TABLE "ticket_import"
(
   ticket_id integer, 
   import_date date, 
   used_date date, 
   recorded_by integer, 
   CONSTRAINT ticket_importpk PRIMARY KEY (ticket_id), 
   CONSTRAINT ticket_import_to_ticket FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON UPDATE NO ACTION ON DELETE NO ACTION, 
   CONSTRAINT ticket_import_to_users FOREIGN KEY (recorded_by) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION
) ;