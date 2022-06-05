/*

Bu yazılım Eser Sarıyar tarafından geliştirilmiştir. Yazılımın çeşitli alanlarının düzenlenmesi serbesttir.

- Copyright metinlerinin silinmesi yasaktır. (Örneğin: Eser Sarıyar metni gibi)
- Yazılımın satılması kesinlikle yasaktır.
- Yazılım GitHub üzerinde paylaşılacaksa, Eser Sarıyar'ın paylaşmış olduğu repositorie üzerinden fork aracılığı ile paylaşılabilir.


Yazılımın geliştirilme tarihi: 04.06.2022
*/

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `meetweb_bot`;
CREATE TABLE `meetweb_bot` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mesaj` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `cevap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `eklenme_tarihi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
