INSERT INTO seance_type(serie, num, aa, semaine) SELECT 1, 1, code, num FROM ues_aas, semaines WHERE ues_aas.code LIKE 'I1010' AND semaines.num = 1;
INSERT INTO seance_type(serie, num, aa, semaine) SELECT 1, 2, code, num FROM ues_aas, semaines WHERE ues_aas.code LIKE 'I1010' AND semaines.num = 1;
INSERT INTO seance_type(serie, num, aa, semaine) SELECT 2, 1, code, num FROM ues_aas, semaines WHERE ues_aas.code LIKE 'I1010' AND semaines.num = 1;
INSERT INTO seance_type(serie, num, aa, semaine) SELECT 2, 2, code, num FROM ues_aas, semaines WHERE ues_aas.code LIKE 'I1010' AND semaines.num = 1;

INSERT INTO seance_type(serie, num, aa, semaine) SELECT 1, 1, code, num FROM ues_aas, semaines WHERE ues_aas.code LIKE 'I1010' AND semaines.num = 2;
INSERT INTO seance_type(serie, num, aa, semaine) SELECT 1, 2, code, num FROM ues_aas, semaines WHERE ues_aas.code LIKE 'I1010' AND semaines.num = 2;
INSERT INTO seance_type(serie, num, aa, semaine) SELECT 2, 1, code, num FROM ues_aas, semaines WHERE ues_aas.code LIKE 'I1010' AND semaines.num = 2;
INSERT INTO seance_type(serie, num, aa, semaine) SELECT 2, 2, code, num FROM ues_aas, semaines WHERE ues_aas.code LIKE 'I1010' AND semaines.num = 2;


