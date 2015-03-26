-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE "users" (
	"id" SERIAL NOT NULL,
	"name" TEXT NOT NULL,
	"email" TEXT NOT NULL UNIQUE,
	"password" TEXT NOT NULL,
	"created" TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	"modified" TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY ("id")
);

CREATE TABLE "roles"
(
   id serial, 
   name text, 
   CONSTRAINT pk PRIMARY KEY (id)
);

CREATE TABLE "permissions"
(
   role_id integer, 
   update_self_data boolean DEFAULT false, 
   update_tickets boolean DEFAULT false, 
   update_payments boolean DEFAULT false, 
   read_log boolean DEFAULT false, 
   update_users boolean DEFAULT false, 
   CONSTRAINT permissionspk PRIMARY KEY (role_id), 
   CONSTRAINT permissionsfk FOREIGN KEY (role_id) REFERENCES roles (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE "user_roles"
(
   user_id integer, 
   role_id integer, 
   CONSTRAINT user_rolespk PRIMARY KEY (user_id, role_id), 
   CONSTRAINT user_roles_to_users FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE, 
   CONSTRAINT user_roles_to_roles FOREIGN KEY (role_id) REFERENCES roles (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE "invoice"
(
   id serial, 
   reference_number bigint UNIQUE, 
   amount integer, 
   CONSTRAINT invoicepk PRIMARY KEY (id)
);

CREATE TABLE "payment"
(
   archiving_code text UNIQUE, 
   reference_number bigint UNIQUE, 
   amount integer, 
   recording_date date, 
   CONSTRAINT paymentpk PRIMARY KEY (archiving_code), 
   CONSTRAINT paymentfk FOREIGN KEY (reference_number) REFERENCES invoice (reference_number) ON UPDATE NO ACTION ON DELETE NO ACTION
);

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
);

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

CREATE TABLE "log"
(
   id bigserial, 
   user_id integer, 
   datetime timestamp without time zone, 
   action text, 
   CONSTRAINT id PRIMARY KEY (id), 
   CONSTRAINT "user" FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION
) ;