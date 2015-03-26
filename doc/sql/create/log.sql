CREATE TABLE "log"
(
   id bigserial, 
   user_id integer, 
   datetime timestamp without time zone, 
   action text, 
   CONSTRAINT id PRIMARY KEY (id), 
   CONSTRAINT "user" FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION
) ;