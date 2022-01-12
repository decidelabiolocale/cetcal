create table cetcal_referentiel_question (
  id INT NOT NULL AUTO_INCREMENT,
  clef_question varchar(4) NOT NULL,
  question varchar(256) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO cetcal_referentiel_question (clef_question, question) VALUES 
('s002','Vous êtes'),
('s003', 'Vous êtes installé'),
('s024','Vous êtes'),
('s004','Avez vous bénéficié'),
('s021','Vous avez recours à'),
('s022','Faîtes vous appel à'),
('s005','Selon vous les produits avec label Bio sont ils vendus'),
('s023','Vos produits sont ils vendus'),
('s017','Quels critères utilisez-vous pour fixer vos prix ?'),
('s006','Votre clientèle est selon vos observations plutôt'),
('s007','Êtes vous en mesure de vous verser un salaire ?'),
('s009','Pensez vous travailler'),
('s001','Quels sont vos besoins et difficultés ?'),
('s012','Quelle est l’activité qui peut parfois vous peser ?'),
('s013','Selon vous, estimez vous être suffisamment Équipé en outillage / mécanisation'),
('s014','Selon vous, estimez vous être suffisamment conseillé techniquement ?'),
('s015','Épaulé en cas d’imprévu, d’urgence, de catastrophe météorologique'),
('s010','Considérez vous que votre travail est'),
('s016','Selon vous, vous pensez que si certains domaines de votre activité (commercialisation, livraisons, travail administratif...) pouvaient être géré différemment vous pourriez produire'),
('s025','vous aimeriez produire plus ?'),
('s026','vous aimeriez être plus proche de vos valeurs ?'),
('s027','votre organisation est-elle optimum?'),
('sl02','Si oui, lesquelles vous semblent répondre à un de vos besoins ? (plusieurs choix possibles)'),
('sl01','Participez vous à un réseau de solidarité entre producteurs ?'),
('sc01',''),
('sr01','Seriez vous prêt à rejoindre un groupe de réflexion sur la résilience alimentaire ?');