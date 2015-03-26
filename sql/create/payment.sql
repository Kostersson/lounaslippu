CREATE TABLE "payment"
(
   archiving_code text UNIQUE, 
   reference_number bigint UNIQUE, 
   amount integer, 
   recording_date date, 
   CONSTRAINT paymentpk PRIMARY KEY (archiving_code), 
   CONSTRAINT paymentfk FOREIGN KEY (reference_number) REFERENCES invoice (reference_number) ON UPDATE NO ACTION ON DELETE NO ACTION
) ;