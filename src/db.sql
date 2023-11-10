--
-- Base de données : `prendsTaGoDb`
--

-- --------------------------------------------------------

--
-- Structure de la table `Adress`
--

DROP TABLE IF EXISTS `Address`;
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

DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `firstName` VARCHAR(255) NOT NULL,
    `lastName` VARCHAR(255) NOT NULL,
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

DROP TABLE IF EXISTS `Brand`;
CREATE TABLE IF NOT EXISTS `Brand` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Color`
--

DROP TABLE IF EXISTS `Color`;
CREATE TABLE IF NOT EXISTS `Color` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Passenger`
--

DROP TABLE IF EXISTS `Passenger`;
CREATE TABLE IF NOT EXISTS `Passenger` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `number` INT NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Car`
--

DROP TABLE IF EXISTS `Car`;
CREATE TABLE IF NOT EXISTS `Car` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `brandId` INT NOT NULL,
    `colorId` INT NOT NULL,
    `passengerId` INT NOT NULL,
    `price` INT NOT NULL,
    `manual` TINYINT NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `minAge` INT,
    `nbDoor` INT NOT NULL,
    `location` VARCHAR(255),
    `status` TINYINT NOT NULL,
    FOREIGN KEY (`brandId`) REFERENCES `Brand`(`id`),
    FOREIGN KEY (`colorId`) REFERENCES `Color`(`id`),
    FOREIGN KEY (`passengerId`) REFERENCES `Passenger`(`id`)
);

-- --------------------------------------------------------

--
-- Structure de la table `UnvailableDate`
--

DROP TABLE IF EXISTS `UnvailableDate`;
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

DROP TABLE IF EXISTS `Favori`;
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
-- Structure de la table `Opinion`
--

DROP TABLE IF EXISTS `Opinion`;
CREATE TABLE IF NOT EXISTS `Opinion` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `carId` INT NOT NULL,
    `userId` INT NOT NULL,
    `commentary` TEXT NOT NULL,
    `rank` INT NOT NULL,
    `creationDate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `status` TINYINT NOT NULL,
    FOREIGN KEY (`carId`) REFERENCES `Car`(`id`),
    FOREIGN KEY (`userId`) REFERENCES `User`(`id`)
);

-- --------------------------------------------------------

--
-- Structure de la table `Reservation`
--

DROP TABLE IF EXISTS `Reservation`;
CREATE TABLE IF NOT EXISTS `Reservation` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `carId` INT NOT NULL,
    `userId` INT NOT NULL,
    `protection` TINYINT NOT NULL,
    `price` INT NOT NULL,
    `beginning` DATE NOT NULL,
    `ending` DATE NOT NULL,
    `finish` TINYINT NOT NULL,
    `beginningState` VARCHAR(255) NOT NULL,
    `endingState` VARCHAR(255) NOT NULL,
    `addFees` FLOAT,
    `status` TINYINT NOT NULL,
    FOREIGN KEY (`carId`) REFERENCES `Car`(`id`),
    FOREIGN KEY (`userId`) REFERENCES `User`(`id`)
);

-- --------------------------------------------------------

--
-- Structure de la table `Pilote`
--

DROP TABLE IF EXISTS `Pilote`;
CREATE TABLE IF NOT EXISTS `Pilote` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `reservationId` INT NOT NULL,
    `firstName` VARCHAR(255) NOT NULL,
    `lastName` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    FOREIGN KEY (`reservationId`) REFERENCES `Reservation`(`id`)
);