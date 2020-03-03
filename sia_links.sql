SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `sia_links` (
  `id` varchar(12) COLLATE utf8_bin NOT NULL,
  `skylink` varchar(46) COLLATE utf8_bin NOT NULL,
  `expire` datetime DEFAULT NULL,
  `downloadable` smallint(11) UNSIGNED DEFAULT NULL,
  `password` varchar(63) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `sia_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);
COMMIT;
