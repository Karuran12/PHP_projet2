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
    ('photos/jojo.jpeg', 'JoJo\'s Bizarre Adventure', 'Hirohiko Araki', 'Une série unique couvrant plusieurs générations de la famille Joestar face à des menaces surnaturelles.', 10.99, 'Action', 35);




CREATE TABLE IF NOT EXISTS panier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    livre_id INT NOT NULL,
    quantite INT NOT NULL DEFAULT 1,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (livre_id) REFERENCES livres(id) ON DELETE CASCADE
);