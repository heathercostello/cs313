CREATE TABLE IF NOT EXISTS `tblproduct` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_code` (`code`)
)

INSERT INTO `tblproduct` (`id`, `name`, `image`, `price`) VALUES
(1, 'Instant Pot', 'assignment-img/instantpot.png', 100.00),
(2, 'Kitchen Aid', 'assignment-img/kitchenaid.png', 600.00),
(3, 'Blend Tec', 'assignment-img/blendtec.png', 200.00);