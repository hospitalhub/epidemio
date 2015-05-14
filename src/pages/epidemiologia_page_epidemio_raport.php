<?php
use Epidemio\Entities\Infections;
use Doctrine\DBAL\Types\VarDateTimeType;
use Hospitalplugin\DB\DoctrineBootstrap;
use Hospitalplugin\Entities\WardCRUD;
use Epidemio\Entities\InfectionsCRUD;
use Hospitalplugin\Twig\PLTwig;

try {
	
	$wardId = (! empty ( $_POST ['wardId'] ) ? $_POST ['wardId'] : 0);
	$date = (! empty ( $_POST ['date'] ) ? $_POST ['date'] : (new \DateTime ())->format ( "Y-m" ));
	$from = new \DateTime ( $date . '-01' );
	$fromStr = $from->format ( 'Y-m-01' );
	$toStr = $from->format ( 'Y-m-t' );
	
	$id = (! empty ( $_POST ['id'] ) ? $_POST ['id'] : null);
	$weryfikacja = (! empty ( $_POST ['weryfikacja'] ) ? $_POST ['weryfikacja'] : null);
	
	$infections = InfectionsCRUD::getInfections ( $fromStr, $toStr, $wardId, 'Infections' );
	InfectionsCRUD::updateVerification ( $id, $weryfikacja );
	
	echo PLTwig::load ( __DIR__ . '/../views/' )->render ( current_filter () . '.twig', array (
			'infections' => $infections,
			'wardId' => $wardId,
			'wards' => WardCRUD::getWardsArray (),
			'date' => $date 
	) );
} catch ( Exception $e ) {
	echo "ERR: " . $e;
}