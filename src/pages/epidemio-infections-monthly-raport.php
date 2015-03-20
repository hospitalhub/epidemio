<?php
use Epidemio\Entities\Infections;
use Doctrine\DBAL\Types\VarDateTimeType;
use Hospitalplugin\Entities\WardCRUD;
use Hospitalplugin\DB\DoctrineBootstrap;
use Epidemio\WP\PLTwig;
use Epidemio\utils\PostVarsLoader;
use Epidemio\Entities\InfectionsMonthlyCRUD;

try {
	
	$p = new PostVarsLoader ();
	$p->load ();
	
	$infections = InfectionsMonthlyCRUD::getInfections ( $p->get ['fromStr'], $p->get ['toStr'], $p->get ['wardId'] );
	
	echo PLTwig::load ()->render ( 'epidemio-infections-monthly-raport.twig', array (
			'infections' => $infections,
			'wards' => WardCRUD::getWardsArray (),
			'wardId' => $p->get ['wardId'],
			'date' => $p->get ['date'] 
	) );
} catch ( Exception $e ) {
	echo "ERR: " . $e;
}