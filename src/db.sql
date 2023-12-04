--
-- Base de données : `prendsTaGoDb`
--

DROP TABLE IF EXISTS `Pilote`;
DROP TABLE IF EXISTS `Opinion`;
DROP TABLE IF EXISTS `Favori`;
DROP TABLE IF EXISTS `UnvailableDate`;
DROP TABLE IF EXISTS `Reservation`;
DROP TABLE IF EXISTS `User`;
DROP TABLE IF EXISTS `Car`;
DROP TABLE IF EXISTS `Address`;
DROP TABLE IF EXISTS `Brand`;
DROP TABLE IF EXISTS `Color`;
DROP TABLE IF EXISTS `Passenger`;

-- --------------------------------------------------------

--
-- Structure de la table `Adress`
--

CREATE TABLE IF NOT EXISTS `Address` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `address` VARCHAR(255) NOT NULL,
    `city` VARCHAR(255) NOT NULL,
    `code` VARCHAR(20) NOT NULL,
    `country` VARCHAR(255) NOT NULL,
    `status` TINYINT NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `firstName` VARCHAR(20) NOT NULL,
    `lastName` VARCHAR(20) NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `age` INT NOT NULL,
    `gender` VARCHAR(10) NOT NULL,
    `addressId` INT,
    `creationDate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `newsLetter` TINYINT NOT NULL,
    `verified` TINYINT NOT NULL,
    `isAdmin` TINYINT NOT NULL,
    `status` TINYINT NOT NULL,
    FOREIGN KEY (`addressId`) REFERENCES `Address`(`id`)
);

-- --------------------------------------------------------

--
-- Structure de la table `Brand`
--

CREATE TABLE IF NOT EXISTS `Brand` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `brandName` VARCHAR(50) NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Color`
--

CREATE TABLE IF NOT EXISTS `Color` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `colorName` VARCHAR(50) NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Passenger`
--

CREATE TABLE IF NOT EXISTS `Passenger` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `number` INT NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Car`
--

CREATE TABLE IF NOT EXISTS `Car` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `brandId` INT NOT NULL,
    `colorId` INT NOT NULL,
    `passengerId` INT NOT NULL,
    `picture` VARCHAR(255) NOT NULL,
    `price` FLOAT NOT NULL,
    `manual` TINYINT NOT NULL,
    `type` VARCHAR(20) NOT NULL,
    `minAge` INT,
    `nbDoor` INT NOT NULL,
    `location` VARCHAR(50),
    `status` TINYINT NOT NULL,
    FOREIGN KEY (`brandId`) REFERENCES `Brand`(`id`),
    FOREIGN KEY (`colorId`) REFERENCES `Color`(`id`),
    FOREIGN KEY (`passengerId`) REFERENCES `Passenger`(`id`)
);

-- --------------------------------------------------------

--
-- Structure de la table `UnvailableDate`
--

CREATE TABLE IF NOT EXISTS `UnvailableDate` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `carId` INT NOT NULL,
    `beginning` DATE NOT NULL,
    `ending` DATE NOT NULL,
    FOREIGN KEY (`carId`) REFERENCES `Car`(`id`)
);

-- --------------------------------------------------------

--
-- Structure de la table `Favori`
--

CREATE TABLE IF NOT EXISTS `Favori` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `carId` INT NOT NULL,
    `userId` INT NOT NULL,
    `status` TINYINT NOT NULL,
    FOREIGN KEY (`carId`) REFERENCES `Car`(`id`),
    FOREIGN KEY (`userId`) REFERENCES `User`(`id`)
);

-- --------------------------------------------------------

--
-- Structure de la table `Reservation`
--

CREATE TABLE IF NOT EXISTS `Reservation` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `carId` INT NOT NULL,
    `userId` INT NOT NULL,
    `hash` VARCHAR(255) NOT NULL,
    `protection` TINYINT NOT NULL,
    `price` FLOAT NOT NULL,
    `beginning` DATE NOT NULL,
    `ending` DATE NOT NULL,
    `finish` TINYINT NOT NULL,
    `beginningState` VARCHAR(255),
    `endingState` VARCHAR(255),
    `addFees` FLOAT,
    `status` TINYINT NOT NULL,
    FOREIGN KEY (`carId`) REFERENCES `Car`(`id`),
    FOREIGN KEY (`userId`) REFERENCES `User`(`id`)
);

-- --------------------------------------------------------

--
-- Structure de la table `Opinion`
--

CREATE TABLE IF NOT EXISTS `Opinion` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `carId` INT NOT NULL,
    `userId` INT NOT NULL,
    `reservationId` INT NOT NULL,
    `commentary` TEXT NOT NULL,
    `rank` INT NOT NULL,
    `creationDate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `status` TINYINT NOT NULL,
    FOREIGN KEY (`carId`) REFERENCES `Car`(`id`),
    FOREIGN KEY (`userId`) REFERENCES `User`(`id`),
    FOREIGN KEY (`reservationId`) REFERENCES `Reservation`(`id`)
);

-- --------------------------------------------------------

--
-- Structure de la table `Pilote`
--

CREATE TABLE IF NOT EXISTS `Pilote` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `reservationId` INT NOT NULL,
    `firstName` VARCHAR(20) NOT NULL,
    `lastName` VARCHAR(20) NOT NULL,
    `age` INT NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(25) NOT NULL,
    `status` TINYINT NOT NULL,
    FOREIGN KEY (`reservationId`) REFERENCES `Reservation`(`id`)
);