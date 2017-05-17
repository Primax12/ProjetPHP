INSERT INTO presences(etudiant, serie, aa, semaine, num) SELECT 
	etudiants.adr_mail, series.num, ues_aas.code, semaines.num, 1
	FROM etudiants, series, ues_aas, semaines
	WHERE etudiants.adr_mail LIKE 'alexandre.hardi@student.vinci.be'
	AND series.num=2 AND series.bloc=2
	AND ues_aas.code LIKE 'I1010'
	AND semaines.num = 1;

INSERT INTO presences(etudiant, serie, aa, semaine, num) SELECT 
	etudiants.adr_mail, series.num, ues_aas.code, semaines.num, 2
	FROM etudiants, series, ues_aas, semaines
	WHERE etudiants.adr_mail LIKE 'alexandre.hardi@student.vinci.be'
	AND series.num=2 AND series.bloc=2
	AND ues_aas.code LIKE 'I1010'
	AND semaines.num = 1;

INSERT INTO presences(etudiant, serie, aa, semaine, num) SELECT 
	etudiants.adr_mail, series.num, ues_aas.code, semaines.num, 3
	FROM etudiants, series, ues_aas, semaines
	WHERE etudiants.adr_mail LIKE 'alexandre.hardi@student.vinci.be'
	AND series.num=2 AND series.bloc=2
	AND ues_aas.code LIKE 'I1010'
	AND semaines.num = 1;
