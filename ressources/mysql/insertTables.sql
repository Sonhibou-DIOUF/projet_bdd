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
                                                         ('jean.dupont@example.com', '$2b$12$WzNhZa8WfPQOTun9ccsOqOzybGfFYvn9gkn3sgCw6ER5rrjQ8y01m', 'client'),
                                                         ('marie.curie@example.com', '$2b$12$KjA9xuMPTQLxkF6Q4Hfi5UM6ijwphz1RJ2ihzK3O41pzXbKbs7mjC', 'client'),
                                                         ('alice.martin@example.com', '$2b$12$YxB66ZmGGGGH9u4ErpM6pCnbB5T0hXPUm9O0QWezbdM6XOBtFfpiK', 'client'),
                                                         ('paul.durand@example.com', '$2b$12$FpXh4HzfQzxwCwvVZmN80mXHoFbY4wZhrApHqG1dOHezAZySb53Ie', 'client'),
                                                         ('julie.robert@example.com', '$2b$12$knlDTX1VSOIgZ8rxHfggmQdd3DrrhzFyfemfsA1HEzfg2z7pfXKZm', 'client'),
                                                         ('martin.leroy@example.com', '$2b$12$SO4wdgTpCOT2h3Xvl1f8uOtf9g2p8eGrhlpvoU0jm5N6l7HY3YQWq', 'client'),
                                                         ('emma.petit@example.com', '$2b$12$NJWjP8rHG5DrKlHdeAu3ONhMv8y5JXbDTsBDgXH7qbVjtA0t/7w5y', 'client'),
                                                         ('lucas.fontaine@example.com', '$2b$12$ItFx5CZ3u2g8hCmTrjVGzmn1FE8m0FD3R.XgmYOQmnkqqLgxbjR6C', 'client'),
                                                         ('sophie.lambert@example.com', '$2b$12$TuUrU7XAsNl/ba5A26EmImf/Njs1x1kgSjyF3KOXv9f38bCNFADaW', 'client'),
                                                         ('victor.hugo@example.com', '$2b$12$WxMwD.eJ6erXpaSlVeDccMnMLmEoZ5ShAMGJ25NzVf9.svqTiyT/C', 'client'),
                                                         ('camille.legrand@example.com', '$2b$12$YW9US5wz6mQCNjjSAAFGjYOK7UtT9d66IE.tq70eFhH2RY82ybEGC', 'photographe'),
                                                         ('lucas.morel@example.com', '$2b$12$S5nN0q8yytrXv0kDgDKV9YkAYvS32ShnOtjcmFfpu.Wtv.t7nSlfu', 'photographe'),
                                                         ('emma.lefebvre@example.com', '$2b$12$RgFWkpMLFz8S1yVwwgYlNiikYxeVSoZP4RR.Nq9cC0rbX3z6msm9u', 'photographe'),
                                                         ('sophie.bernard@example.com', '$2b$12$Q6B7J1FjfiQDE8ZFs6M2fQX37JRs16F9KvQT9wnwYg1zz79J9BqZq', 'photographe'),
                                                         ('victor.garnier@example.com', '$2b$12$neqa0V.vrZzgs3ntJY4kmmMTq56qZXx7q0pOWMNMP8U8mrX7om.sq', 'photographe'),
                                                         ('julie.martin@example.com', '$2b$12$zU7xyvTxT1t9pA9eQThyn7pxfwXsmpOOvQHaA9z9HhfaIhvXg4Fvq', 'photographe'),
                                                         ('paul.richard@example.com', '$2b$12$8O9xFT7fVfDdyxMwb5pLgSyPOhbbNE9H9ALfgYhWp6yIVF/ZlYx5u', 'photographe'),
                                                         ('alice.durand@example.com', '$2b$12$OOVHk5ppOSItu/M5djk6xu9B8T2HfVrFz0Xz1K6X2O51qUM8fubf6', 'photographe'),
                                                         ('marie.faure@example.com', '$2b$12$z9z7HZbmYhVJddpXBGUacHt0QlUwVj89Jkpi64z3V2n0nmfGb30.m', 'photographe'),
                                                         ('jean.blanc@example.com', '$2b$12$ZMyhVeCK3uFeL9osDtTZ2D9vZPfgQjz1imIaXI4hzA9k3yy9fZynG', 'photographe'),
                                                         ('admin@example.com', '$2b$12$06Sz.P9kDP4nsq9B0GT2PeDLpeAX9B7DkY6rD9v8b0BoVlmOU6YvO', 'admin');

-- Peuplement de la table Effectué sera fera directement grace au clés des table de références