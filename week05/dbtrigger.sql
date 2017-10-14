CREATE OR REPLACE FUNCTION player_insert_notify()
    RETURNS trigger AS
$$
DECLARE
id bigint;
BEGIN
IF TG_OP = 'INSERT' OR TG_OP = 'UPDATE' THEN
    id = NEW.id;
ELSE
    id = OLD.id;
END IF;
-- PERFORM pg_notify('player_insert', 'TEST');
PERFORM pg_notify('player_insert', json_build_object('id', NEW.id,'name', NEW.name, 'gameID', NEW."gameID")::text);
RETURN NEW;
END;
$$ LANGUAGE plpgsql;
DROP TRIGGER player_notify_insert ON public."Players";
CREATE TRIGGER player_notify_insert AFTER INSERT ON public."Players" FOR EACH ROW EXECUTE PROCEDURE player_insert_notify();

