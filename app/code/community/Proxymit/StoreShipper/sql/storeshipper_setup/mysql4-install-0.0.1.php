<?php

$installer = $this;

$installer->startSetup ();

$installer->run ( "
	CREATE TABLE IF NOT EXISTS {$this->getTable('storeshipper_order_store')} (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) DEFAULT NULL,
  `id_store` int(11) DEFAULT NULL,
  `pickup_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS {$this->getTable('storeshipper_store')} (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `shipping_price` double DEFAULT '0',
  `adress` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `zipcode` VARCHAR (11) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `description` text,
  `website` text,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `manager_name` varchar(45) DEFAULT NULL,
  `manager_email` varchar(45) DEFAULT NULL,
  `manager_show_frontend` int(11) DEFAULT NULL,
  `manager_fax` varchar(45) DEFAULT NULL,
  `manager_phone` varchar(45) DEFAULT NULL,
  `id_schedule` int(11) DEFAULT NULL,
  `available_at_storeview` int(11) NOT NULL,
  `available_after` int(11) NOT NULL,
  `monday_open` varchar(10) NOT NULL,
  `monday_close` varchar(10) NOT NULL,
  `tuesday_open` varchar(10) NOT NULL,
  `tuesday_close` varchar(10) NOT NULL,
  `wednesday_open` varchar(10) NOT NULL,
  `wednesday_close` varchar(10) NOT NULL,
  `thursday_open` varchar(10) NOT NULL,
  `thursday_close` varchar(10) NOT NULL,
  `friday_open` varchar(10) NOT NULL,
  `friday_close` varchar(10) NOT NULL,
  `saturday_open` varchar(10) NOT NULL,
  `saturday_close` varchar(10) NOT NULL,
  `sunday_open` varchar(10) NOT NULL,
  `sunday_close` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
" );

$installer->endSetup (); 
