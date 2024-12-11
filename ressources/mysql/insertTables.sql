-- Peuplement de la table Client
INSERT INTO Client (nom, email, telephone, adresse) VALUES
                                                        ('Jean Dupont', 'jean.dupont@example.com', '0612345678', '10 rue de Paris, Paris'),
                                                        ('Marie Curie', 'marie.curie@example.com', '0623456789', '20 avenue des Champs, Lyon'),
                                                        ('Alice Martin', 'alice.martin@example.com', '0634567890', '30 boulevard Saint-Michel, Toulouse'),
                                                        ('Paul Durand', 'paul.durand@example.com', '0645678901', '40 rue des Lilas, Marseille'),
                                                        ('Julie Robert', 'julie.robert@example.com', '0656789012', '50 avenue des Fleurs, Nice'),
                                                        ('Martin Leroy', 'martin.leroy@example.com', '0667890123', '60 rue de la République, Bordeaux'),
                                                        ('Emma Petit', 'emma.petit@example.com', '0678901234', '70 avenue Jean Jaurès, Nantes'),
                                                        ('Lucas Fontaine', 'lucas.fontaine@example.com', '0689012345', '80 rue Saint-Honoré, Strasbourg'),
                                                        ('Sophie Lambert', 'sophie.lambert@example.com', '0690123456', '90 boulevard Haussmann, Lille'),
                                                        ('Victor Hugo', 'victor.hugo@example.com', '0611122233', '100 avenue Victor Hugo, Rennes');

-- Peuplement de la table Photographe
INSERT INTO Photographe (nom, specialite, email, telephone) VALUES
                                                                ('Camille Legrand', 'Mariage', 'camille.legrand@example.com', '0712345678'),
                                                                ('Lucas Morel', 'Portrait', 'lucas.morel@example.com', '0723456789'),
                                                                ('Emma Lefebvre', 'Mode', 'emma.lefebvre@example.com', '0734567890'),
                                                                ('Sophie Bernard', 'Paysage', 'sophie.bernard@example.com', '0745678901'),
                                                                ('Victor Garnier', 'Événementiel', 'victor.garnier@example.com', '0756789012'),
                                                                ('Julie Martin', 'Culinaire', 'julie.martin@example.com', '0767890123'),
                                                                ('Paul Richard', 'Studio', 'paul.richard@example.com', '0778901234'),
                                                                ('Alice Durand', 'Animaux', 'alice.durand@example.com', '0789012345'),
                                                                ('Marie Faure', 'Sport', 'marie.faure@example.com', '0790123456'),
                                                                ('Jean Blanc', 'Corporate', 'jean.blanc@example.com', '0711122233');

-- Peuplement de la table Seance
INSERT INTO Seance (date_seance, heure, lieu, id_client, id_photographe) VALUES
                                                                             ('2024-12-01', '10:00:00', 'Studio Paris', 1, 1),
                                                                             ('2024-12-02', '14:00:00', 'Parc de Lyon', 2, 2),
                                                                             ('2024-12-03', '09:00:00', 'Plage de Nice', 3, 3),
                                                                             ('2024-12-04', '16:00:00', 'Montagne de Grenoble', 4, 4),
                                                                             ('2024-12-05', '11:00:00', 'Salle de réception Marseille', 5, 5),
                                                                             ('2024-12-06', '13:00:00', 'Restaurant Bordeaux', 6, 6),
                                                                             ('2024-12-07', '08:00:00', 'Jardin Botanique Nantes', 7, 7),
                                                                             ('2024-12-08', '15:30:00', 'Quartier Historique Strasbourg', 8, 8),
                                                                             ('2024-12-09', '12:00:00', 'Parc de Lille', 9, 9),
                                                                             ('2024-12-10', '18:00:00', 'Théâtre de Rennes', 10, 10);

-- Peuplement de la table Photo
INSERT INTO Photo (chemin_fichier, resolution, format, id_seance) VALUES
                                                                      ('/photos/seance1/photo1.jpg', '1920x1080', 'JPEG', 1),
                                                                      ('/photos/seance1/photo2.jpg', '3840x2160', 'PNG', 1),
                                                                      ('/photos/seance2/photo1.jpg', '1280x720', 'JPEG', 2),
                                                                      ('/photos/seance2/photo2.jpg', '1920x1080', 'PNG', 2),
                                                                      ('/photos/seance3/photo1.jpg', '3840x2160', 'JPEG', 3),
                                                                      ('/photos/seance3/photo2.jpg', '1920x1080', 'JPEG', 3),
                                                                      ('/photos/seance4/photo1.jpg', '1280x720', 'PNG', 4),
                                                                      ('/photos/seance5/photo1.jpg', '3840x2160', 'JPEG', 5),
                                                                      ('/photos/seance6/photo1.jpg', '1920x1080', 'PNG', 6),
                                                                      ('/photos/seance7/photo1.jpg', '1280x720', 'JPEG', 7),
                                                                      ('/photos/seance8/photo1.jpg', '1920x1080', 'JPEG', 8),
                                                                      ('/photos/seance9/photo1.jpg', '3840x2160', 'PNG', 9),
                                                                      ('/photos/seance10/photo1.jpg', '1920x1080', 'JPEG', 10);

-- Peuplement de la table Transaction
INSERT INTO Transaction (montant, date_transaction, type_transaction, id_seance) VALUES
                                                                                     (200.50, '2024-12-01', 'facture', 1),
                                                                                     (200.50, '2024-12-02', 'paiement', 1),
                                                                                     (150.75, '2024-12-02', 'facture', 2),
                                                                                     (150.75, '2024-12-03', 'paiement', 2),
                                                                                     (300.00, '2024-12-03', 'facture', 3),
                                                                                     (300.00, '2024-12-04', 'paiement', 3),
                                                                                     (250.00, '2024-12-05', 'facture', 4),
                                                                                     (250.00, '2024-12-06', 'paiement', 4),
                                                                                     (180.00, '2024-12-07', 'facture', 5),
                                                                                     (180.00, '2024-12-08', 'paiement', 5),
                                                                                     (220.00, '2024-12-08', 'facture', 6),
                                                                                     (220.00, '2024-12-09', 'paiement', 6),
                                                                                     (350.00, '2024-12-09', 'facture', 7),
                                                                                     (350.00, '2024-12-10', 'paiement', 7),
                                                                                     (275.00, '2024-12-10', 'facture', 8),
                                                                                     (275.00, '2024-12-11', 'paiement', 8);

-- Peuplement de la table Utilisateurs avec des mots de passe hachés
INSERT INTO Utilisateurs (email, mot_de_passe, role) VALUES
    ( 'jean.dupont@example.com', '$2y$10$F1QmbT9M74jnL3nYU2fZF.Bl3TSsUVkrNBAlK46YK2.R2intAXpeG', 'client'),
    ( 'marie.curie@example.com', '$2y$10$c5CoU47pzp0DFlzoQB3XY.TLz0p.bbgU7xkm2btxqlyh9X3gI7Nnq', 'client'),
    ( 'alice.martin@example.com', '$2y$10$yRzRPK7AUlk.g34N0vG7EOEV8efKtp8uJyeRy0S6kSYMHBMV1GK/a', 'client'),
    ( 'paul.durand@example.com', '$2y$10$K8OPxDMBzDXMsf6WDfFf3uu/YXLNPq22JGje6UEq4kJLMikhgYdjK', 'client'),
    ( 'julie.robert@example.com', '$2y$10$Q0EFX.cRzfGmvPR/WTdwU.60gxYK7em5DUOW4vMl9ZnwMnPYMZ626', 'client'),
    ( 'martin.leroy@example.com', '$2y$10$krJGgflbXM95o6HaqXaKce/QuHjEryOdNiHHgTJ.OB6EEt5chXWva', 'client'),
    ( 'emma.petit@example.com', '$2y$10$ZBL5lGkasaQwjS5.IuWrAea0oqLgP0E3Mv/y5beMuJ4hcCa2vKRmu', 'client'),
    ( 'lucas.fontaine@example.com', '$2y$10$F5Gj2U61EJuT.xyIVFbzM.eMFpXA34xZtYt/xEbQxnEO0q2vSD6EO', 'client'),
    ( 'sophie.lambert@example.com', '$2y$10$K9hSMnCWoes5Z7ftOsUX1.7A2IovkL5.Pz1vLPPH8LFPSF1/W906m', 'client'),
    ( 'victor.hugo@example.com', '$2y$10$LYuxyuYP/gIm.sKOY0niDuBEqw5SgQRUZKM8BFPdm/0t2PSRufTpi', 'client'),
    ( 'camille.legrand@example.com', '$2y$10$ovSHicb4LP6MV7Fz6bLc7OttxuMlEdqqzmd/TbyIUE59VtozZo5KK', 'photographe'),
    ( 'Lucas Morel@example.com', '$2y$10$cd9aLmJKySLGlJg6dPc0/.DrN0tPIrjKZZekGwx3FSftc8fPKKDwu', 'photographe'),
    ( 'emma.lefebvre@example.com', '$2y$10$wZOsqgbOCortMFcdVA6C/OcpwJHWpUkKUy32sNFdhWbMybkfDVWi6', 'photographe'),
    ( 'sophie.bernard@example.com', '$2y$10$PBqioW4CCjm5AFgmzkSZDuP1cEXlnFaaF55r8W0uqHnFWcW.Q5HJi', 'photographe'),
    ( 'victor.garnier@example.com', '$2y$10$G9fBeEwNA9Vqp5ObeNsr3eBkp7suhislic9A3hCOz.VMlYP8xbQF6', 'photographe'),
    ( 'julie.martin@example.com', '$2y$10$BaKfHw.2TBB/4Tw/sUN47eQ8hd/b5t83DteonysGweHBkp78qRr/q', 'photographe'),
    ( 'paul.richard@example.com', '$2y$10$XMUpkd0qdhpPK9IuBD8FjulcpONKBRw7dyWarq.DW8f9gS28zrf2.', 'photographe'),
    ( 'alice.durand@example.com', '$2y$10$DMCwt6lboSUx.CB4nZ3S5OrtN8dKAhs.8H503lbFP1rOXCgRBBZa6', 'photographe'),
    ( 'marie.faure@example.com', '$2y$10$nvOmiBNAUP9VNVkillyv.OlsxaMI6ghg/.jCPSvLvz2HFjmj2eYWG', 'photographe'),
    ( 'jean.blanc@example.com', '$2y$10$26.bJDjYNa7uJLRfRRt2FebQO8Qnkf2sJWBHdv8aHUzwrwQvswICe', 'photographe'),
    ( 'admin@example.com', '$2y$10$WhCE.0yaZNkY0XSClsn3/e/4na3pKpveO/yUmIIIsbXtvU2WmcUyu', 'admin');


-- Peuplement de la table Effectue
INSERT INTO Effectue (id_photographe, id_seance) VALUES
                                                     (1, 1),  -- Photographe Camille Legrand, Séance 1
                                                     (2, 2),  -- Photographe Lucas Morel, Séance 2
                                                     (3, 3),  -- Photographe Emma Lefebvre, Séance 3
                                                     (4, 4),  -- Photographe Sophie Bernard, Séance 4
                                                     (5, 5),  -- Photographe Victor Garnier, Séance 5
                                                     (6, 6),  -- Photographe Julie Martin, Séance 6
                                                     (7, 7),  -- Photographe Paul Richard, Séance 7
                                                     (8, 8),  -- Photographe Alice Durand, Séance 8
                                                     (9, 9),  -- Photographe Marie Faure, Séance 9
                                                     (10, 10); -- Photographe Jean Blanc, Séance 10
