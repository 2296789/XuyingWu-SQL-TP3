CREATE TABLE IF NOT EXISTS `auteur` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO auteur(nom, email) VALUES
('AAA', 'a@a.a'),
('BBB', 'b@b.b'),
('CCC', 'c@c.c'),
('DDD', 'd@d.d'),
('EEE', 'e@e.e');

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `categorie` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO categorie (categorie) VALUES
('Art'), 
('Culture'), 
('Science'), 
('Histoire'), 
('Loisirs');

CREATE TABLE IF NOT EXISTS `article` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(200) NOT NULL,
  `texte` TEXT(1000) NOT NULL,
  `auteur_id` INT NOT NULL,
  `categorie_id` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`auteur_id`)
    REFERENCES `auteur` (`id`),
    FOREIGN KEY (`categorie_id`)
    REFERENCES `categorie` (`id`)
);

INSERT INTO article (titre, texte, auteur_id, categorie_id) VALUES
("Léonard de Vinci", "Léonard de Vinci né le 14 avril 1452 du calendrier actuel à Vinci et mort le 2 mai 1519 à Amboise, est un peintre polymathe, simultanément artiste, organisateur de spectacles et de fêtes, scientifique, ingénieur, inventeur, anatomiste, sculpteur, peintre, architecte, urbaniste, botaniste, musicien, philosophe et écrivain. Enfant naturel d'une paysanne, Caterina di Meo Lippi, et d'un notaire, Pierre de Vinci, il est élevé auprès de ses grands-parents paternels dans la maison familiale de Vinci jusqu’à l’âge de dix ans. À Florence, son père l'inscrit pour deux ans d’apprentissage dans une scuola d’abaco et ensuite à l'atelier d'Andrea del Verrocchio où il côtoie Botticelli, Le Pérugin et Domenico Ghirlandaio.",'1','1'),
("Les Mille et Une Nuits", "Les Mille et Une Nuits est un recueil anonyme de contes populaires d'origine persane, indienne et arabe. Il est constitué de nombreux contes enchâssés et de personnages mis en miroir les uns par rapport aux autres.", '2', '2'),
("Diamant synthétique", "Un diamant synthétique est produit en utilisant différentes techniques physiques et chimiques, visant à reproduire la structure des diamants naturels. Ces diamants de synthèse sont utilisés dans l'industrie et peuvent être de qualité variable. Selon plusieurs sources, le marché des diamants synthétiques est en expansion notamment dans les domaines de la joaillerie, de l'électronique et des hautes technologies, qui exigent une qualité et une pureté élevées. Le marché des diamants de laboratoire est passé de 1 % du marché des diamants bruts de 14 milliards de dollars en 2016 à environ 2 à 3 % en 2019.",'3','3'),
("Conflit israélo-palestinien", "Le conflit israélo-palestinien désigne le conflit qui oppose Palestiniens et Israéliens au Proche-Orient. Il oppose deux mouvements nationaux. Le conflit inclut une forte dimension religieuse, en raison de l'importance des territoires disputés, notamment Jérusalem, pour les trois religions monothéistes, et du fait de la caractérisation d'Israël comme État juif, à majorité juive et face à des Palestiniens majoritairement musulmans.", '4', '4'),
("Yoga","Le yoga est l'une des six écoles orthodoxes de la philosophie indienne āstika dont le but est la libération. C'est une discipline ou pratique commune à plusieurs époques et courants, visant, par la méditation, l'ascèse et les exercices corporels, à réaliser l'unification de l'être humain dans ses aspects physique, psychique et spirituel.",'5','5');

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `contenu` TEXT(500) NULL,
  `article_id` INT NOT NULL,
  `auteur_id` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`article_id`)
    REFERENCES `article` (`id`),
    FOREIGN KEY (`auteur_id`)
    REFERENCES `auteur` (`id`)
);

INSERT INTO commentaire (contenu, article_id, auteur_id) VALUES 
("très bon !", 1, 1),
("Très intéressant.", 2, 2),
("C'est bon à savoir.", 3, 3),
("C'est un peu difficile à comprendre.", 4, 4),
("Je l'aime bien.", 5, 5);

CREATE TABLE IF NOT EXISTS `privilege` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `privilege` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`));

INSERT INTO `privilege` (`id`, `privilege`) VALUES
(1, 'admin'),
(2, 'employee');

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `privilege_id` INT NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`privilege_id`)
    REFERENCES `privilege` (`id`));

INSERT INTO `user` (`id`, `username`, `password`, `privilege_id`) VALUES
(1, '1@1.com', '$2y$10$Q1PDWQEt8vpMsTmGnKHqYO0oQtFkc4aKZDNmrr6JTmppV5DFbg3FO', 1),
(2, '2@2.com', '$2y$10$LVWh2qli9YmwcBuhNCbawukhJGYh0lrO1FIELIL3rCWdX9mmxWf1W', 1),
(3, '3@3.com', '$2y$10$dagvEN/W.S3kLQIupCvADeaqjWckeHa0e7Jtx2HxQ6jgoobxpk2r2', 1),
(4, 'a@a.com', '$2y$10$11WfUeY.8JhVGY3oLdNj3uXDe6HuLKj/MqSuePxoNYbLB1fP0rYYq', 2),
(5, 'b@b.com', '$2y$10$PXCN9sSM45VsHjLgRPsRJuJNMmApTcH018wbcWLP4cZngThfoc1h.', 2),
(6, 'c@c.com', '$2y$10$9fft38FKP3B9ysgRg.gN8eZ.pxNfXpsIIT6UPyxj8RDY3vzVLCXjC', 2);

CREATE TABLE IF NOT EXISTS `log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ip` VARCHAR(45) NOT NULL,
  `user` VARCHAR(45) NOT NULL,
  `date` DATETIME NOT NULL,
  `page` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
);

