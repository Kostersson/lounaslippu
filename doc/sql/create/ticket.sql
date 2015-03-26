CREATE TABLE "ticket"
(
   id bigint UNIQUE, 
   user_id integer, 
   invoice_id integer, 
   used boolean DEFAULT false, 
   void boolean DEFAULT false, 
   CONSTRAINT ticketpk PRIMARY KEY (id), 
   CONSTRAINT ticket_to_user FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE, 
   CONSTRAINT ticket_to_invoice FOREIGN KEY (invoice_id) REFERENCES invoice (id) ON UPDATE CASCADE ON DELETE CASCADE
) ;