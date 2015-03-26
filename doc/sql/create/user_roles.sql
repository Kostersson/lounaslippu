CREATE TABLE "user_roles"
(
   user_id integer, 
   role_id integer, 
   CONSTRAINT user_rolespk PRIMARY KEY (user_id, role_id), 
   CONSTRAINT user_roles_to_users FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE, 
   CONSTRAINT user_roles_to_roles FOREIGN KEY (role_id) REFERENCES roles (id) ON UPDATE CASCADE ON DELETE CASCADE
);