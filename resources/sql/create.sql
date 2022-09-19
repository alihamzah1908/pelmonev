DROP DATABASE IF EXISTS kemaslahatan;
DROP USER IF EXISTS kemaslahatan;

CREATE USER kemaslahatan WITH PASSWORD 'kemaslahatan';
CREATE DATABASE kemaslahatan;
ALTER DATABASE kemaslahatan OWNER TO kemaslahatan;
\c kemaslahatan;
ALTER schema public OWNER TO kemaslahatan;
GRANT ALL PRIVILEGES ON DATABASE kemaslahatan TO kemaslahatan;

/* please use super user to run this script */
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

ALTER database "kemaslahatan" SET search_path TO public;
