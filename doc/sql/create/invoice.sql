CREATE TABLE "invoice"
(
   id serial, 
   reference_number bigint UNIQUE, 
   amount integer, 
   CONSTRAINT invoicepk PRIMARY KEY (id)
) ;