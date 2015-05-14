<?php
use Epidemio\Entities\Infections;
use Doctrine\DBAL\Types\VarDateTimeType;
use Hospitalplugin\Entities\WardCRUD;
use Hospitalplugin\DB\DoctrineBootstrap;
use Hospitalplugin\Twig\PLTwig;
use Epidemio\Entities\InfectionsCRUD;

try {
	
	// todo move to utils
	function firstDayOfTheMonthDate($date) {
		return new \DateTime ( $date . '-01' );
	}
	
	$wardId = (! empty ( $_POST ['wardId'] ) ? $_POST ['wardId'] : 0);
	
	$defaultMonth = (new \DateTime ())->format ( "Y-m" );
	$dateFrom = (! empty ( $_POST ['dateFrom'] ) ? $_POST ['dateFrom'] : $defaultMonth);
	$dateTo = (! empty ( $_POST ['dateTo'] ) ? $_POST ['dateTo'] : $defaultMonth);
	
	$fromMonth = firstDayOfTheMonthDate ( $dateFrom );
	$toMonth = firstDayOfTheMonthDate ( $dateTo );
	
	$fromStr = $fromMonth->format ( 'Y-m-01' );
	$toStr = $toMonth->format ( 'Y-m-t' );
	
	$infections = InfectionsCRUD::getInfections ( $fromStr, $toStr, $wardId, 'InfectionsZUM' );
	
	echo PLTwig::load ( __DIR__ . '/../views/' )->render ( current_filter () . '.twig', array (
			'infections' => $infections,
			'wards' => WardCRUD::getWardsArray (),
			'wardId' => $wardId,
			'dateFrom' => $fromStr,
			'dateTo' => $toStr 
	) );
} catch ( Exception $e ) {
	echo "ERR: " . $e;
}