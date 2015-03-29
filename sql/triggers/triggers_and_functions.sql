CREATE OR REPLACE FUNCTION update_user_modified_column()
RETURNS TRIGGER AS $$
BEGIN
   NEW.modified = now(); 
   RETURN NEW;
END;
$$ language 'plpgsql';


CREATE TRIGGER update_user BEFORE UPDATE
   ON users FOR EACH ROW
   EXECUTE PROCEDURE public.update_user_modified_column();