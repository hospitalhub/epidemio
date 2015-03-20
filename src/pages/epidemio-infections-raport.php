<?php
use Epidemio\Entities\Infections;
use Doctrine\DBAL\Types\VarDateTimeType;
use Hospitalplugin\DB\DoctrineBootstrap;
use Hospitalplugin\Entities\WardCRUD;
use Epidemio\Entities\InfectionsCRUD;
use Epidemio\WP\PLTwig;
use Epidemio\utils\PostVarsLoader;

try {
	$p = new PostVarsLoader ();
	$p->load ();
	$infections = InfectionsCRUD::getInfections ( $p->get ['fromStr'], $p->get ['toStr'], $p->get ['wardId'] );
	InfectionsCRUD::updateVerification ( $p->get ['id'], $p->get ['weryfikacja'] );
	
	echo PLTwig::load ()->render ( 'epidemio-infections-raport.twig', array (
			'infections' => $infections,
			'wardId' => $p->get ['wardId'],
			'wards' => WardCRUD::getWardsArray (),
			'date' => $p->get ['date'] 
	) );
} catch ( Exception $e ) {
	echo "ERR: " . $e;
}