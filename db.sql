--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.3
-- Dumped by pg_dump version 9.6.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE public IS 'Database for cs313 assignments';


--
-- Name: CaptionWar; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA "CaptionWar";


ALTER SCHEMA "CaptionWar" OWNER TO postgres;

--
-- Name: SCHEMA "CaptionWar"; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA "CaptionWar" IS 'Schema for Caption War Game';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = "CaptionWar", pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: Captions; Type: TABLE; Schema: CaptionWar; Owner: postgres
--

CREATE TABLE "Captions" (
    id integer NOT NULL,
    caption character varying(500) NOT NULL,
    "playerID" integer NOT NULL,
    "gameID" integer NOT NULL,
    "drawingID" integer NOT NULL
);


ALTER TABLE "Captions" OWNER TO postgres;

--
-- Name: Captions_id_seq; Type: SEQUENCE; Schema: CaptionWar; Owner: postgres
--

CREATE SEQUENCE "Captions_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Captions_id_seq" OWNER TO postgres;

--
-- Name: Captions_id_seq; Type: SEQUENCE OWNED BY; Schema: CaptionWar; Owner: postgres
--

ALTER SEQUENCE "Captions_id_seq" OWNED BY "Captions".id;


--
-- Name: Combos; Type: TABLE; Schema: CaptionWar; Owner: postgres
--

CREATE TABLE "Combos" (
    id integer NOT NULL,
    "gameID" integer NOT NULL,
    "drawingID" integer NOT NULL,
    "captionID" integer NOT NULL,
    "playerID" integer NOT NULL,
    defeated boolean NOT NULL
);


ALTER TABLE "Combos" OWNER TO postgres;

--
-- Name: Combos_id_seq; Type: SEQUENCE; Schema: CaptionWar; Owner: postgres
--

CREATE SEQUENCE "Combos_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Combos_id_seq" OWNER TO postgres;

--
-- Name: Combos_id_seq; Type: SEQUENCE OWNED BY; Schema: CaptionWar; Owner: postgres
--

ALTER SEQUENCE "Combos_id_seq" OWNED BY "Combos".id;


--
-- Name: Drawings; Type: TABLE; Schema: CaptionWar; Owner: postgres
--

CREATE TABLE "Drawings" (
    id integer NOT NULL,
    location text NOT NULL,
    "playerID" integer NOT NULL,
    "gameID" integer NOT NULL
);


ALTER TABLE "Drawings" OWNER TO postgres;

--
-- Name: Drawings_id_seq; Type: SEQUENCE; Schema: CaptionWar; Owner: postgres
--

CREATE SEQUENCE "Drawings_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Drawings_id_seq" OWNER TO postgres;

--
-- Name: Drawings_id_seq; Type: SEQUENCE OWNED BY; Schema: CaptionWar; Owner: postgres
--

ALTER SEQUENCE "Drawings_id_seq" OWNED BY "Drawings".id;


--
-- Name: Games; Type: TABLE; Schema: CaptionWar; Owner: postgres
--

CREATE TABLE "Games" (
    id integer NOT NULL,
    "playerNumber" integer NOT NULL,
    "startTimestamp" timestamp without time zone,
    "endTimestamp" timestamp without time zone
);


ALTER TABLE "Games" OWNER TO postgres;

--
-- Name: Games_id_seq; Type: SEQUENCE; Schema: CaptionWar; Owner: postgres
--

CREATE SEQUENCE "Games_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Games_id_seq" OWNER TO postgres;

--
-- Name: Games_id_seq; Type: SEQUENCE OWNED BY; Schema: CaptionWar; Owner: postgres
--

ALTER SEQUENCE "Games_id_seq" OWNED BY "Games".id;


--
-- Name: Players; Type: TABLE; Schema: CaptionWar; Owner: postgres
--

CREATE TABLE "Players" (
    id integer NOT NULL,
    name character varying(24) NOT NULL,
    "gameID" integer NOT NULL
);


ALTER TABLE "Players" OWNER TO postgres;

--
-- Name: Players_id_seq; Type: SEQUENCE; Schema: CaptionWar; Owner: postgres
--

CREATE SEQUENCE "Players_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Players_id_seq" OWNER TO postgres;

--
-- Name: Players_id_seq; Type: SEQUENCE OWNED BY; Schema: CaptionWar; Owner: postgres
--

ALTER SEQUENCE "Players_id_seq" OWNED BY "Players".id;


--
-- Name: RoomCodes; Type: TABLE; Schema: CaptionWar; Owner: postgres
--

CREATE TABLE "RoomCodes" (
    id integer NOT NULL,
    "roomCode" character varying(4) NOT NULL,
    "gameID" integer NOT NULL
);


ALTER TABLE "RoomCodes" OWNER TO postgres;

--
-- Name: RoomCodes_id_seq; Type: SEQUENCE; Schema: CaptionWar; Owner: postgres
--

CREATE SEQUENCE "RoomCodes_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "RoomCodes_id_seq" OWNER TO postgres;

--
-- Name: RoomCodes_id_seq; Type: SEQUENCE OWNED BY; Schema: CaptionWar; Owner: postgres
--

ALTER SEQUENCE "RoomCodes_id_seq" OWNED BY "RoomCodes".id;


--
-- Name: Captions id; Type: DEFAULT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Captions" ALTER COLUMN id SET DEFAULT nextval('"Captions_id_seq"'::regclass);


--
-- Name: Combos id; Type: DEFAULT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Combos" ALTER COLUMN id SET DEFAULT nextval('"Combos_id_seq"'::regclass);


--
-- Name: Drawings id; Type: DEFAULT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Drawings" ALTER COLUMN id SET DEFAULT nextval('"Drawings_id_seq"'::regclass);


--
-- Name: Games id; Type: DEFAULT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Games" ALTER COLUMN id SET DEFAULT nextval('"Games_id_seq"'::regclass);


--
-- Name: Players id; Type: DEFAULT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Players" ALTER COLUMN id SET DEFAULT nextval('"Players_id_seq"'::regclass);


--
-- Name: RoomCodes id; Type: DEFAULT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "RoomCodes" ALTER COLUMN id SET DEFAULT nextval('"RoomCodes_id_seq"'::regclass);


--
-- Data for Name: Captions; Type: TABLE DATA; Schema: CaptionWar; Owner: postgres
--

COPY "Captions" (id, caption, "playerID", "gameID", "drawingID") FROM stdin;
\.


--
-- Name: Captions_id_seq; Type: SEQUENCE SET; Schema: CaptionWar; Owner: postgres
--

SELECT pg_catalog.setval('"Captions_id_seq"', 1, false);


--
-- Data for Name: Combos; Type: TABLE DATA; Schema: CaptionWar; Owner: postgres
--

COPY "Combos" (id, "gameID", "drawingID", "captionID", "playerID", defeated) FROM stdin;
\.


--
-- Name: Combos_id_seq; Type: SEQUENCE SET; Schema: CaptionWar; Owner: postgres
--

SELECT pg_catalog.setval('"Combos_id_seq"', 1, false);


--
-- Data for Name: Drawings; Type: TABLE DATA; Schema: CaptionWar; Owner: postgres
--

COPY "Drawings" (id, location, "playerID", "gameID") FROM stdin;
\.


--
-- Name: Drawings_id_seq; Type: SEQUENCE SET; Schema: CaptionWar; Owner: postgres
--

SELECT pg_catalog.setval('"Drawings_id_seq"', 1, false);


--
-- Data for Name: Games; Type: TABLE DATA; Schema: CaptionWar; Owner: postgres
--

COPY "Games" (id, "playerNumber", "startTimestamp", "endTimestamp") FROM stdin;
\.


--
-- Name: Games_id_seq; Type: SEQUENCE SET; Schema: CaptionWar; Owner: postgres
--

SELECT pg_catalog.setval('"Games_id_seq"', 1, false);


--
-- Data for Name: Players; Type: TABLE DATA; Schema: CaptionWar; Owner: postgres
--

COPY "Players" (id, name, "gameID") FROM stdin;
\.


--
-- Name: Players_id_seq; Type: SEQUENCE SET; Schema: CaptionWar; Owner: postgres
--

SELECT pg_catalog.setval('"Players_id_seq"', 1, false);


--
-- Data for Name: RoomCodes; Type: TABLE DATA; Schema: CaptionWar; Owner: postgres
--

COPY "RoomCodes" (id, "roomCode", "gameID") FROM stdin;
\.


--
-- Name: RoomCodes_id_seq; Type: SEQUENCE SET; Schema: CaptionWar; Owner: postgres
--

SELECT pg_catalog.setval('"RoomCodes_id_seq"', 1, false);


--
-- Name: Captions Captions_pkey; Type: CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Captions"
    ADD CONSTRAINT "Captions_pkey" PRIMARY KEY (id);


--
-- Name: Combos Combos_pkey; Type: CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Combos"
    ADD CONSTRAINT "Combos_pkey" PRIMARY KEY (id);


--
-- Name: Drawings Drawings_pkey; Type: CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Drawings"
    ADD CONSTRAINT "Drawings_pkey" PRIMARY KEY (id);


--
-- Name: Games Games_pkey; Type: CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Games"
    ADD CONSTRAINT "Games_pkey" PRIMARY KEY (id);


--
-- Name: Players Players_pkey; Type: CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Players"
    ADD CONSTRAINT "Players_pkey" PRIMARY KEY (id);


--
-- Name: RoomCodes RoomCodes_pkey; Type: CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "RoomCodes"
    ADD CONSTRAINT "RoomCodes_pkey" PRIMARY KEY (id);


--
-- Name: Combos Caption; Type: FK CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Combos"
    ADD CONSTRAINT "Caption" FOREIGN KEY ("captionID") REFERENCES "Captions"(id) ON DELETE CASCADE;


--
-- Name: Combos Drawing; Type: FK CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Combos"
    ADD CONSTRAINT "Drawing" FOREIGN KEY ("drawingID") REFERENCES "Drawings"(id) ON DELETE CASCADE;


--
-- Name: Captions Drawing; Type: FK CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Captions"
    ADD CONSTRAINT "Drawing" FOREIGN KEY ("drawingID") REFERENCES "Drawings"(id) ON DELETE CASCADE;


--
-- Name: Players Game; Type: FK CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Players"
    ADD CONSTRAINT "Game" FOREIGN KEY ("gameID") REFERENCES "Games"(id) ON DELETE CASCADE;


--
-- Name: Drawings Game; Type: FK CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Drawings"
    ADD CONSTRAINT "Game" FOREIGN KEY ("gameID") REFERENCES "Games"(id) ON DELETE CASCADE;


--
-- Name: Combos Game; Type: FK CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Combos"
    ADD CONSTRAINT "Game" FOREIGN KEY ("gameID") REFERENCES "Games"(id) ON DELETE CASCADE;


--
-- Name: Captions Game; Type: FK CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Captions"
    ADD CONSTRAINT "Game" FOREIGN KEY ("gameID") REFERENCES "Games"(id) ON DELETE CASCADE;


--
-- Name: RoomCodes Game; Type: FK CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "RoomCodes"
    ADD CONSTRAINT "Game" FOREIGN KEY ("gameID") REFERENCES "Games"(id) ON DELETE CASCADE;


--
-- Name: Drawings Player; Type: FK CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Drawings"
    ADD CONSTRAINT "Player" FOREIGN KEY ("playerID") REFERENCES "Players"(id) ON DELETE CASCADE;


--
-- Name: Combos Player; Type: FK CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Combos"
    ADD CONSTRAINT "Player" FOREIGN KEY ("playerID") REFERENCES "Players"(id) ON DELETE CASCADE;


--
-- Name: Captions Player; Type: FK CONSTRAINT; Schema: CaptionWar; Owner: postgres
--

ALTER TABLE ONLY "Captions"
    ADD CONSTRAINT "Player" FOREIGN KEY ("playerID") REFERENCES "Players"(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

