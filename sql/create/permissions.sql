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
) ;