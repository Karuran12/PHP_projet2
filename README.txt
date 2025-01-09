Karuran GAJAROOBAN B2-IN


-----------SQL----------------------
-- Création de la base de données
CREATE DATABASE IF NOT EXISTS manga;
USE manga;

-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    cree TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE IF NOT EXISTS livres (
    id INT AUTO_INCREMENT PRIMARY KEY,   
    photo VARCHAR(255) NOT NULL,   
    titre VARCHAR(255) NOT NULL,     
    auteur VARCHAR(255) NOT NULL,   
    description TEXT,       
    prix DECIMAL(10, 2) NOT NULL,           
    categorie VARCHAR(100) NOT NULL,        
    stock INT NOT NULL DEFAULT 0,            
);



INSERT INTO livres (photo, titre, auteur, description, prix, categorie, stock)
VALUES
    ('photos/onepiece.jpeg', 'One Piece', 'Eiichiro Oda', 'Un manga d\'aventure suivant les exploits de Luffy et son équipage pour trouver le trésor légendaire, le One Piece.', 9.99, 'Aventure', 50),
    ('photos/naruto.jpg', 'Naruto', 'Masashi Kishimoto', 'L\'histoire d\'un jeune ninja qui rêve de devenir Hokage tout en affrontant des ennemis redoutables.', 8.99, 'Action', 40),
    ('photos/dragonball.webp', 'Dragon Ball', 'Akira Toriyama', 'Un manga légendaire suivant les aventures de Son Goku, de son enfance à ses combats épiques.', 10.50, 'Action', 30),
    ('photos/bleach.jpeg', 'Bleach', 'Tite Kubo', 'Ichigo Kurosaki, un lycéen, devient un shinigami et protège les âmes perdues contre les Hollows.', 9.50, 'Fantastique', 25),
    ('photos/berserk.jpeg', 'Berserk', 'Kentaro Miura', 'Une histoire sombre et épique suivant Guts, un guerrier solitaire, dans un monde brutal.', 12.99, 'Dark Fantasy', 15),
    ('photos/vinland.jpeg', 'Vinland Saga', 'Makoto Yukimura', 'Une saga viking où Thorfinn cherche à se venger tout en explorant les thèmes de guerre et de rédemption.', 11.99, 'Historique', 20),
    ('photos/vagabond.jpeg', 'Vagabond', 'Takehiko Inoue', 'Une réinterprétation dramatique de la vie de Miyamoto Musashi, le légendaire épéiste japonais.', 14.50, 'Historique', 10),
    ('photos/jojo.jpeg', 'JoJo\'s Bizarre Adventure', 'Hirohiko Araki', 'Une série unique couvrant plusieurs générations de la famille Joestar face à des menaces surnaturelles.', 10.99, 'Action', 35),
    ('photos/hxh.jpeg', 'Hunter × Hunter', 'Yoshihiro Togashi', 'Un manga d\'aventure suivant les exploits de Gon Freecss et ses amis dans leur quête pour devenir des Hunters professionnels.', 9.99, 'Aventure', 50), 
    ('photos/snk.jpeg', 'Shingeki no Kyojin', 'Hajime Isayama', 'Dans un monde où l\'humanité vit à l\'intérieur de murs immenses pour se protéger des Titans, Eren et ses amis luttent pour survivre et découvrir la vérité.', 10.99, 'Action', 40),
    ('photos/death.jpeg', 'Death Note', 'Tsugumi Ohba', 'Un étudiant brillant découvre un carnet qui lui permet de tuer quiconque dont il écrit le nom. Un jeu mortel de stratégie s\'engage entre lui et un détective mystérieux.', 8.99, 'Thriller', 35),
    ('photos/monster.jpeg', 'Monster', 'Naoki Urasawa', 'Un médecin sauve la vie d\'un enfant qui se révèle être un tueur en série. Une poursuite psychologique intense s\'ensuit pour arrêter ce monstre.', 12.50, 'Psychologique', 25),
    ('photos/fma.jpeg', 'Fullmetal Alchemist', 'Hiromu Arakawa', 'Les frères Elric tentent de restaurer leurs corps après un rituel d\'alchimie raté tout en affrontant des conspirations dans un monde alchimique.', 11.99, 'Aventure', 30),
    ('photos/20th.jpeg', '20th Century Boys', 'Naoki Urasawa', 'Un groupe d\'amis d\'enfance se retrouve impliqué dans une lutte contre une organisation mystérieuse menée par un chef surnommé "Ami", qui cherche à détruire le monde.', 13.50, 'Mystère', 20),
    ('photos/kingdom.jpeg', 'Kingdom', 'Yasuhisa Hara', 'Dans la Chine ancienne, deux jeunes amis rêvent de devenir des généraux légendaires et se retrouvent plongés dans une guerre pour unifier le royaume.', 14.99, 'Historique', 30);





CREATE TABLE IF NOT EXISTS panier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    livre_id INT NOT NULL,
    quantite INT NOT NULL DEFAULT 1,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (livre_id) REFERENCES livres(id) ON DELETE CASCADE
);