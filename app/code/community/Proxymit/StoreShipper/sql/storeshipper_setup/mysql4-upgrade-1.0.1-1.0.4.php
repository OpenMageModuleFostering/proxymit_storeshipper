<?php

$installer = $this;

$installer->startSetup ();
/* ZipCode will accept alphanumeric characters (CANADA) */
$installer->run ( "
ALTER TABLE {$this->getTable('storeshipper_store')} CHANGE zipcode zipcode VARCHAR(10);
" );

$installer->endSetup (); 
