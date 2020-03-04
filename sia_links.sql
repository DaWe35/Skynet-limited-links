SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `ip_ban` (
  `id` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `sia_links` (
  `id` varchar(12) COLLATE utf8_bin NOT NULL,
  `skylink` varchar(46) COLLATE utf8_bin NOT NULL,
  `expire` datetime DEFAULT NULL,
  `downloadable` smallint(11) UNSIGNED DEFAULT NULL,
  `password` varchar(63) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `ip_ban`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sia_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);


ALTER TABLE `ip_ban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;