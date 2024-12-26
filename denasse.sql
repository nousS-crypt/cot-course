-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 26 déc. 2024 à 14:54
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `denasse`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `commande_id` int(11) NOT NULL,
  `date_commande` datetime DEFAULT current_timestamp(),
  `statut` enum('en attente','livré','non livré') DEFAULT 'en attente',
  `qrcode` varchar(255) NOT NULL,
  `produits` text NOT NULL,
  `total` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`commande_id`, `date_commande`, `statut`, `qrcode`, `produits`, `total`, `user_id`) VALUES
(3, '2024-11-09 00:43:43', 'en attente', 'qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(4, '2024-11-09 00:47:01', 'en attente', 'qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(5, '2024-11-09 00:48:01', 'en attente', 'qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(6, '2024-11-09 00:51:03', 'en attente', 'qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(7, '2024-11-09 00:52:33', 'en attente', 'qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(8, '2024-11-09 00:54:05', 'en attente', 'qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(9, '2024-11-09 00:55:40', 'en attente', 'qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(10, '2024-11-09 00:56:19', 'en attente', 'qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(11, '2024-11-09 00:56:57', 'en attente', 'qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(12, '2024-11-09 00:57:31', 'en attente', 'qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(13, '2024-11-09 00:58:02', 'en attente', 'qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(14, '2024-11-09 00:58:31', 'en attente', 'qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(15, '2024-11-09 08:05:05', 'en attente', 'qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(16, '2024-11-09 08:10:01', 'en attente', 'qr/qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(17, '2024-11-09 08:10:53', 'en attente', 'qr/qrcode_supermarket=Nouss_user_id_1.png', 'Flora*1', '1000', '1'),
(18, '2024-11-09 08:22:35', 'en attente', 'qr/qrcode_supermarket=Nouss_user_id_12024-11-09 08:22:35.png', 'Flora*2', '2000', '1'),
(19, '2024-11-09 08:24:35', 'en attente', '../../qr/qrcode_supermarket=Nouss_user_id_12024-11-09 08:24:35.png', 'Flora*1', '1000', '1'),
(20, '2024-11-09 08:25:46', 'en attente', 'qr/qrcode_supermarket=Nouss_user_id_12024-11-09 08:25:46.png', 'Flora*1', '1000', '1'),
(21, '2024-11-09 08:29:33', 'en attente', 'qrcode_supermarket=Nouss_user_id_12024-11-09 08:29:33.png', 'Flora*1', '1000', '1'),
(22, '2024-11-09 08:31:13', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 08:31:13.png', 'Flora*1', '1000', '1'),
(23, '2024-11-09 08:33:01', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 08-33-01.png', 'Flora*1', '1000', '1'),
(24, '2024-11-09 08:36:08', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 08-36-08.png', 'Flora*1', '1000', '1'),
(25, '2024-11-09 08:40:39', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 08-40-39.png', 'Flora*1', '1000', '1'),
(26, '2024-11-09 08:41:21', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 08-41-21.png', 'Flora*1', '1000', '1'),
(27, '2024-11-09 08:41:55', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 08-41-55.png', 'Flora*1', '1000', '1'),
(28, '2024-11-09 09:23:02', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 09-23-02.png', 'Croissant*1, Flora*3', '3300', '1'),
(29, '2024-11-09 09:24:55', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 09-24-55.png', 'Croissant*1', '300', '1'),
(30, '2024-11-09 09:39:36', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 09-39-36.png', 'Croissant*2', '600', '1'),
(31, '2024-11-09 09:42:49', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 09-42-49.png', 'Croissant*2', '600', '1'),
(32, '2024-11-09 09:47:44', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 09-47-44.png', 'Croissant*2', '600', '1'),
(33, '2024-11-09 10:06:27', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-06-27.png', 'Croissant*2', '600', '1'),
(34, '2024-11-09 10:07:48', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-07-48.png', 'Croissant*2', '600', '1'),
(35, '2024-11-09 10:07:52', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-07-52.png', 'Croissant*2', '600', '1'),
(36, '2024-11-09 10:09:34', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-09-34.png', 'Croissant*2', '600', '1'),
(37, '2024-11-09 10:10:19', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-10-19.png', 'Croissant*2', '600', '1'),
(38, '2024-11-09 10:10:25', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-10-25.png', 'Croissant*2', '600', '1'),
(39, '2024-11-09 10:15:02', 'en attente', 'qrcode_supermarket=_user_id_1_2024-11-09 10-15-02.png', 'Croissant*2', '600', '1'),
(40, '2024-11-09 10:15:45', 'en attente', 'qrcode_supermarket=_user_id_1_2024-11-09 10-15-45.png', 'Croissant*2', '600', '1'),
(41, '2024-11-09 10:15:50', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-15-50.png', 'Croissant*2', '600', '1'),
(42, '2024-11-09 10:19:09', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-19-09.png', 'Croissant*2', '600', '1'),
(43, '2024-11-09 10:21:25', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-21-25.png', 'Croissant*2', '1', '1'),
(44, '2024-11-09 10:21:26', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-21-26.png', 'Croissant*2', '1', '1'),
(45, '2024-11-09 10:21:26', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-21-26.png', 'Croissant*2', '1', '1'),
(46, '2024-11-09 10:21:26', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-21-26.png', 'Croissant*2', '1', '1'),
(47, '2024-11-09 10:21:26', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-21-26.png', 'Croissant*2', '1', '1'),
(48, '2024-11-09 10:21:27', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-21-27.png', 'Croissant*2', '1', '1'),
(49, '2024-11-09 10:21:29', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-21-29.png', 'Croissant*2', '1', '1'),
(50, '2024-11-09 10:21:42', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-21-42.png', 'Croissant*2', '1', '1'),
(51, '2024-11-09 10:25:20', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-25-19.png', 'Croissant*2', '600', '1'),
(52, '2024-11-09 10:32:15', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-32-15.png', 'Croissant*2, Flora*1', '1600', '1'),
(53, '2024-11-09 10:42:42', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 10-42-42.png', 'Croissant*3', '900', '1'),
(54, '2024-11-09 11:38:33', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 11-38-33.png', 'Croissant*1', '300', '1'),
(55, '2024-11-09 19:09:23', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-09 19-09-23.png', 'Croissant*1', '300', '1'),
(56, '2024-11-10 11:36:43', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 11-36-42.png', 'Croissant*2', '600', '1'),
(57, '2024-11-10 17:46:02', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 17-46-02.png', 'Croissant*1', '300', '1'),
(58, '2024-11-10 17:50:20', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 17-50-20.png', 'Croissant*1', '300', '1'),
(59, '2024-11-10 17:51:53', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 17-51-53.png', 'Croissant*1', '300', '1'),
(60, '2024-11-10 17:52:11', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 17-52-11.png', 'Croissant*1', '300', '1'),
(62, '2024-11-10 18:05:23', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 18-05-23.png', 'Croissant*1', '300', '1'),
(63, '2024-11-10 18:05:57', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 18-05-56.png', 'Croissant*1, Flora*1', '1300', '1'),
(64, '2024-11-10 18:11:35', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 18-11-35.png', 'Croissant*2', '600', '1'),
(65, '2024-11-10 18:19:15', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 18-19-15.png', 'Croissant*3', '900', '1'),
(66, '2024-11-10 18:23:20', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 18-23-20.png', 'Croissant*3', '900', '1'),
(67, '2024-11-10 18:25:33', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 18-25-33.png', 'Croissant*3', '900', '1'),
(68, '2024-11-10 18:25:58', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 18-25-58.png', 'Croissant*3', '900', '1'),
(69, '2024-11-10 18:29:24', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 18-29-23.png', 'Croissant*3', '900', '1'),
(70, '2024-11-10 18:33:14', 'en attente', 'qrcode_supermarket=Nouss_user_id_1_2024-11-10 18-33-13.png', 'Croissant*3', '900', '1');

-- --------------------------------------------------------

--
-- Structure de la table `historique_transactions`
--

CREATE TABLE `historique_transactions` (
  `transaction_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` enum('ajout','modification','suppression') NOT NULL,
  `date_action` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

CREATE TABLE `paniers` (
  `panier_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `supermarket_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `produit_id` int(11) NOT NULL,
  `supermarket_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `quantite_en_stock` int(11) DEFAULT 0,
  `prix_unitaire` decimal(10,2) NOT NULL,
  `date_expiration` date DEFAULT NULL,
  `poids_volume` varchar(255) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `date_ajout` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`produit_id`, `supermarket_id`, `nom`, `description`, `categorie`, `quantite_en_stock`, `prix_unitaire`, `date_expiration`, `poids_volume`, `photo`, `date_ajout`) VALUES
(1256, 1, 'Croissant', 'Petit four', 'boissons', 8, 300.00, '2024-11-23', '250mg', 'pain_241109_012000.jpg', '2024-11-09 01:20:00'),
(9727, 1, 'Flora', 'chicaaaaaaaa', 'boissons', 19, 1000.00, '2024-12-10', '250mg', 'lancement_club.png', '2024-11-05 02:31:35');

-- --------------------------------------------------------

--
-- Structure de la table `supermarches`
--

CREATE TABLE `supermarches` (
  `supermarket_id` int(11) NOT NULL,
  `current_users` varchar(255) NOT NULL,
  `ifu` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `supermarches`
--

INSERT INTO `supermarches` (`supermarket_id`, `current_users`, `ifu`, `password`, `nom`, `adresse`) VALUES
(1, 'Majengo', '1234567891234', '$2y$10$bcfDOgqGpiWRoADMm2inHux3dVZjtOnvi6rZ7AMNpV3FqzTuPiJWy', 'Nouss', 'Cotonou');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_inscription` datetime DEFAULT current_timestamp(),
  `role` enum('admin','supermarché','client') NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `date_inscription`, `role`, `reset_token`, `reset_token_expiration`) VALUES
(1, 'Nouss', '$2y$10$xuTt6sIehPrt5JcUdS81FuMQFvF8BRL9u9PYoQGQMUQz7H6Rfz6HC', 'nouss396@gmail.com', '2024-11-07 09:51:12', 'client', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`commande_id`);

--
-- Index pour la table `historique_transactions`
--
ALTER TABLE `historique_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `produit_id` (`produit_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD PRIMARY KEY (`panier_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `supermarket_id` (`supermarket_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`produit_id`),
  ADD KEY `fk_supermarket` (`supermarket_id`);

--
-- Index pour la table `supermarches`
--
ALTER TABLE `supermarches`
  ADD PRIMARY KEY (`supermarket_id`),
  ADD UNIQUE KEY `ifu` (`ifu`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `commande_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pour la table `historique_transactions`
--
ALTER TABLE `historique_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `panier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `supermarches`
--
ALTER TABLE `supermarches`
  MODIFY `supermarket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `historique_transactions`
--
ALTER TABLE `historique_transactions`
  ADD CONSTRAINT `historique_transactions_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`produit_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historique_transactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD CONSTRAINT `paniers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paniers_ibfk_2` FOREIGN KEY (`supermarket_id`) REFERENCES `supermarches` (`supermarket_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `fk_supermarket` FOREIGN KEY (`supermarket_id`) REFERENCES `supermarches` (`supermarket_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`supermarket_id`) REFERENCES `supermarches` (`supermarket_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
