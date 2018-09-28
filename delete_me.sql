CREATE OR REPLACE FUNCTION insert_calls_from_ps_cel()
  RETURNS TRIGGER AS $emp_stamp$
BEGIN
  IF NEW.eventtype = 'APP_START'
  THEN
    DECLARE
      var RECORD;
      varCheckIfExists RECORD;
      varIdBridgeNumber RECORD;
      varIdCampaign RECORD;
    BEGIN

      SELECT COUNT(*) AS counter FROM ctn_calls call WHERE call.uniqueid = NEW.uniqueid INTO varCheckIfExists;

      IF varCheckIfExists.counter > 0
        THEN

          SELECT id_bridge_number INTO varIdBridgeNumber FROM ctn_bridges_numbers bridges INNER JOIN ctn_dids_temp3 dids ON dids.id_did = bridges.id_did WHERE dids.did = NEW.exten;
          SELECT id_campaign INTO varIdCampaign FROM ctn_campaigns campaign INNER JOIN ctn_dids_temp3 dids ON dids.id_did = campaign.id_did WHERE dids.did = NEW.exten;

          UPDATE ctn_calls calls SET
            source = NEW.cid_num,
            destination = NEW.exten,
            channel = substring(NEW.appdata from 7 for (position('@' in NEW.appdata))-7),
            id_bridge_number = varIdBridgeNumber.id_bridge_number,
            id_campaign = varIdCampaign.id_campaign
          WHERE uniqueid = NEW.uniqueid;
        ELSE
          SELECT add_call(NEW.cid_num, NEW.exten, NEW.exten, NEW.appdata, NEW.cid_name, NEW.uniqueid) INTO var;
      END IF;
      RETURN NEW;
    END;
  END IF;
  RETURN NEW;
END;
$emp_stamp$
LANGUAGE plpgsql;

CREATE TRIGGER insert_call_from_ps_cel
  AFTER INSERT
  ON ps_cel
  FOR EACH ROW EXECUTE PROCEDURE insert_calls_from_ps_cel();


----------


CREATE OR REPLACE FUNCTION update_call()
  RETURNS TRIGGER AS $emp_stamp$

BEGIN
  IF NEW.eventtype = 'CHAN_END'
  THEN
    DECLARE
      varEventStart RECORD;
      varDuration RECORD;

    BEGIN

      SELECT eventtime FROM ps_cel cel WHERE cel.eventtype = 'CHAN_START' AND cel.uniqueid = NEW.uniqueid INTO varEventStart;

      SELECT CAST(EXTRACT(SECOND FROM age(NEW.eventtime, varEventStart.eventtime)) AS INTEGER) AS duration INTO varDuration;

      UPDATE ctn_calls call SET duration = varDuration.duration WHERE call.uniqueid = NEW.uniqueid;

      RETURN NEW;
    END;
  END IF;
  RETURN NEW;
END;

$emp_stamp$
LANGUAGE plpgsql;

CREATE TRIGGER update_call
  AFTER INSERT
  ON ps_cel
  FOR EACH ROW EXECUTE PROCEDURE update_call();


----------

/*insert_call (ps_cdr TRIGGER)


DECLARE
var RECORD;
BEGIN
SELECT add_call(NEW.src, NEW.dst, NEW.lastdata, CAST(NEW.duration AS varchar), substring(NEW.clid FROM 2 FOR (position('<' IN NEW.clid) - 4)),NEW.uniqueid) INTO var;
RETURN NEW;
END;*/

