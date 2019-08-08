CREATE TABLE IF NOT EXISTS `products` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

INSERT INTO `products` (`id_product`, `name`, `description`, `price`) VALUES
(1, 'Yamaha', 'dron con helice', '1115.00'),
(2, 'DJI', 'Dron grande', '1120.00'),
(3, 'eBee', 'Dron pequeno', '90.00'),
(4, 'EJANG', 'Dron mediano', '95.00'),
(5, 'Parrot', 'description', '54.00'),
(6, 'NincoAir', 'description', '59.00');
