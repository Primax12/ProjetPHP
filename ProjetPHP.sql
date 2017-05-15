# Drop tables
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS professeurs;
DROP TABLE IF EXISTS blocs;
DROP TABLE IF EXISTS series;
DROP TABLE IF EXISTS etudiants;
DROP TABLE IF EXISTS ues_aas;
DROP TABLE IF EXISTS ue_aa_prof;
DROP TABLE IF EXISTS seance_type;
DROP TABLE IF EXISTS semaines;
SET FOREIGN_KEY_CHECKS = 1;

# Create tables
CREATE TABLE IF NOT EXISTS professeurs
(
    adr_mail VARCHAR(32) NOT NULL,
    nom VARCHAR(80),
    prenom VARCHAR(32),
    rights VARCHAR(16),
    PRIMARY KEY(adr_mail)
);

CREATE TABLE IF NOT EXISTS blocs
(
    num INT NOT NULL,
    nom VARCHAR(32),
    dep VARCHAR(16),
    resp VARCHAR(32),
    CONSTRAINT fk_blocs_resp FOREIGN KEY (resp) REFERENCES professeurs(adr_mail),
    PRIMARY KEY(num)
);

CREATE TABLE IF NOT EXISTS series
(
    num INT NOT NULL,
    bloc INT,
    CONSTRAINT fk_series_bloc FOREIGN KEY (bloc) REFERENCES blocs(num),
    PRIMARY KEY(num,bloc)
);

CREATE TABLE IF NOT EXISTS etudiants
(
    adr_mail VARCHAR(32) NOT NULL,
    nom VARCHAR(32),
    prenom VARCHAR(32),
    num_serie INT,
    num_bloc INT,
    CONSTRAINT fk_etudiants_num_serie FOREIGN KEY (num_serie) REFERENCES series(num),
    CONSTRAINT fk_etudiants_num_bloc FOREIGN KEY (num_bloc) REFERENCES series(bloc),
    PRIMARY KEY(adr_mail)
);

CREATE TABLE IF NOT EXISTS ues_aas
(
    code VARCHAR(5) NOT NULL,
    nom VARCHAR(80),
    ects INT,
    abv VARCHAR(16),
    quadri INT,
    bloc INT,
    CONSTRAINT fk_ues_aas_bloc FOREIGN KEY (bloc) REFERENCES blocs(num),
    PRIMARY KEY(code)
);

CREATE TABLE IF NOT EXISTS ue_aa_prof
(
    prof VARCHAR(32),
    ue_aa VARCHAR(5),
    CONSTRAINT fk_ue_aa_prof_prof FOREIGN KEY (prof) REFERENCES professeurs(adr_mail),
    CONSTRAINT fk_ue_aa_prof_ue_aa FOREIGN KEY (ue_aa) REFERENCES ues_aas(code),
    CONSTRAINT pk_prof_ue PRIMARY KEY(prof,ue_aa)
);

CREATE TABLE IF NOT EXISTS seance_type
(
    serie INT,
    bloc INT,
    aa VARCHAR(5),
    semaine INT,
    CONSTRAINT fk_seance_type_serie FOREIGN KEY (serie) REFERENCES series(num),
    CONSTRAINT fk_seance_type_bloc FOREIGN KEY (bloc) REFERENCES series(bloc),
    CONSTRAINT fk_seance_type_aa FOREIGN KEY (aa) REFERENCES ues_aas(code),
    CONSTRAINT fk_seance_type_semaine FOREIGN KEY (semaine) REFERENCES semaines(num),
    CONSTRAINT pk_seance PRIMARY KEY(bloc,serie,aa,semaine)
);

CREATE TABLE IF NOT EXISTS semaines
(
    num INT NOT NULL,
    lundi DATE,
    PRIMARY KEY(num)
);

INSERT INTO blocs (num) VALUES ('1');
INSERT INTO blocs (num) VALUES ('2');
INSERT INTO blocs (num) VALUES ('3');
