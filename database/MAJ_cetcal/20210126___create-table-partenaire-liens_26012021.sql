CREATE TABLE cetcal_partenaires_liens (
	partenaire_lien_id INT NOT NULL AUTO_INCREMENT,
	denomination VARCHAR(124) DEFAULT NULL,
	description VARCHAR(512) NOT NULL,
	url VARCHAR(512) DEFAULT NULL,
	tel VARCHAR(64) DEFAULT NULL,
	type VARCHAR(32) NOT NULL,
	PRIMARY KEY (partenaire_lien_id)
);

INSERT INTO cetcal_partenaires_liens (denomination, description, type, tel, url) 
	VALUES 
 ('DRAAF', 'Direction régionale de l\'agriculture et de la forêt 33', 'gouv', '0556004200', 'http://draaf.nouvelle-aquitaine.agriculture.gouv.fr'),
 ('ENITA', 'ÉCOLE NATIONALE SUPÉRIEURE DES SCIENCES AGRONOMIQUES', 'formation', '+33(0)5 57350707', 'https://www.agro-bordeaux.fr/'),
 ('CFA/CFPPA La Réole', 'Centre de formation. 1 Place Saint-Michel, 33190 La Réole.', 'formation', '0556610295', ''),
 ('MFR de l\'Entre-Deux-Mers, CFA Métiers du Paysage et de l\'Horticulture', 'La Maison Familiale Rurale de la Sauve Majeure forte d’une expérience de 50 ans propose un parcours de formation original en Alternance qui associe étroitement le vécu en entreprise et les apports théoriques.', 'formation', '0556230132', 'https://www.mfr-entredeuxmers.fr/'),
 ('Service agriculture Conseil régional NA', 'Guide des aides en Nouvelle-Aquitaine, Région Nouvelle-Aquitaine, Service Relation à l’Usager', 'institution', '0549384938', 'https://les-aides.nouvelle-aquitaine.fr/agriculture'),
 ('Service agriculture Conseil départemental 33', 'L\'agriculture, la viticulture et la sylviculture jouent un rôle déterminant dans l\'économie et le dynamisme des territoires du département. Fort de ce constat, le Département mène une politique solidaire en direction de ces secteurs qui demeurent inévitablement soumis aux aléas.', 'institution', '0556993333', 'https://www.gironde.fr/economie-locale/agriculture'),
 ('Confédération paysanne 33', 'La Confédération paysanne de Gironde, syndicat pour une agriculture paysanne et la défense de ses travailleurs.', 'syndicat', '0556610295', 'https://gironde.confederationpaysanne.fr/'),
 ('AGAP Association girondine pour l\'agriculture paysanne', 'Favoriser l\'installation et le maintien d\'exploitations en agriculture paysanne.', 'association', '0556522679', 'https://www.agriculturepaysanne.org/agap33'),
 ('AFOCG 33 Association de Formation Collective à la Gestion', 'L’AFOCG 33 (Association de FOrmation Collective à la Gestion de Gironde) est une association Loi 1901 et un organisme de formation.', 'association', '0140091018', 'https://www.interafocg.org/qui-sommes-nous_76.php'),
 ('ASSOCIATION SOLIDARITÉ PAYSANS', 'Pour accompagner et défendre les familles, préserver l\'emploi, des agriculteurs ont créé Solidarité Paysans.', 'association', ' 0143638383', 'https://solidaritepaysans.org/'),
 ('Agrobio 33', 'FÉDÉRATION RÉGIONALE D’AGRICULTURE BIOLOGIQUE DE NOUVELLE-AQUITAINE', 'federation', '0556409202', 'https://www.bionouvelleaquitaine.com/adherents/agrobio-gironde/'),
 ('InterBIO Nouvelle-Aquitaine', 'Association interprofessionnelle bio régionale. Elle rassemble plus de 250 organisations et opérateurs membres représentant plus de 1,3 milliard d’euros de chiffre d’affaires en 2018.', 'association', '0556792852', 'https://www.interbionouvelleaquitaine.com/fr/'),
 ('L\'Atelier paysan', 'L’Atelier Paysan - une coopérative d’intérêt collectif à majorité paysanne.', 'reseau', 'https://www.latelierpaysan.org/Contact#', 'https://www.latelierpaysan.org/'),
 ('Biotope Festival', 'Biotope Festival est une association qui a pour but, en France comme à l’étranger, de sensibiliser et éduquer, aux niveaux scolaires, professionnels, privés et/ou public, à la préservation et la protection de l’environnement et du patrimoine, notamment sur les territoires viticoles et agricoles, fluviaux, maritimes.', 'association', '', 'http://www.biotopefestival.org/'),
 ('<img src="./res/content/icons/bonpour1tour/bp1t.jpg" > bonpour1tour', 'Association bonpour1tour à Castillon-la-Bataille', 'partenaire', '', 'http://www.bonpour1tour.com/');

INSERT INTO cetcal_partenaires_liens (denomination, description, type, tel, url)
	VALUES
('<img src="./res/content/icons/viaterroirs.png" height="42"> Via Terroirs', 'A la croisée du numérique, de l’agriculture et du développement territorial, Via Terroirs a construit son projet autour de trois piliers forts et ambitieux : le territoire, les circuits courts et le sens du service. Réunis, ces trois piliers donnent à Via Terroirs sa mission singulière dans ce domaine complexe qu’est l’alimentation.', 'partenaire', '', 'https://www.viaterroirs.com/'),
('CHAMBRE D\'AGRICULTURE GIRONDE', '', 'institution', '0556796400', 'https://gironde.chambre-agriculture.fr/');