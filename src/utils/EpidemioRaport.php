<?php

namespace Epidemio\utils;

use Hospitalplugin\Entities\Infections;
use Doctrine\DBAL\Types\VarDateTimeType;
use Hospitalplugin\Entities\WardCRUD;
use Hospitalplugin\DB\DoctrineBootstrap;
use Hospitalplugin\Twig\PLTwig;
use Hospitalplugin\Entities\InfectionsCRUD;

class EpidemioRaport {
	
	// todo move to utils
	static function firstDayOfTheMonthDate($date) {
		return new \DateTime ( $date . '-01' );
	}
	public static function raport($raportEntity) {
		try {
			
			$wardId = (! empty ( $_POST ['wardId'] ) ? $_POST ['wardId'] : 0);
			
			if ($raportEntity == 'Infections') {
				// single month (no from-to)
				$date = (! empty ( $_POST ['date'] ) ? $_POST ['date'] : (new \DateTime ())->format ( "Y-m" ));
				$from = new \DateTime ( $date . '-01' );
				$fromStr = $from->format ( 'Y-m-01' );
				$toStr = $from->format ( 'Y-m-t' );
			} else {
				// from-to dates
				$defaultMonth = (new \DateTime ())->format ( "Y-m" );
				$dateFrom = (! empty ( $_POST ['dateFrom'] ) ? $_POST ['dateFrom'] : $defaultMonth);
				$dateTo = (! empty ( $_POST ['dateTo'] ) ? $_POST ['dateTo'] : $defaultMonth);
				
				$fromMonth = EpidemioRaport::firstDayOfTheMonthDate ( $dateFrom );
				$toMonth = EpidemioRaport::firstDayOfTheMonthDate ( $dateTo );
				
				$fromStr = $fromMonth->format ( 'Y-m-01' );
				$toStr = $toMonth->format ( 'Y-m-t' );
			}
			
			$infections = InfectionsCRUD::getInfections ( $fromStr, $toStr, $wardId, $raportEntity );
			
			$params = array (
					'infections' => $infections,
					'wards' => WardCRUD::getWardsArray (),
					'wardId' => $wardId,
					'dateFrom' => $fromStr,
					'dateTo' => $toStr 
			);
			
			if (isset ( $date )) {
				$params = array_merge ( $params, array (
						'date' => $date 
				) );
			}
			
			echo PLTwig::load ( __DIR__ . '/../views/' )->render ( current_filter () . '.twig', $params );
		} catch ( Exception $e ) {
			echo "ERR: " . $e;
		}
	}
}