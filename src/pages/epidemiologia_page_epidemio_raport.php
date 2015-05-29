<?php
use Hospitalplugin\Entities\InfectionsCRUD;


$id = (! empty ( $_POST ['id'] ) ? $_POST ['id'] : null);
$weryfikacja = (! empty ( $_POST ['weryfikacja'] ) ? $_POST ['weryfikacja'] : null);
InfectionsCRUD::updateVerification ( $id, $weryfikacja );

Epidemio\utils\EpidemioRaport::raport ( 'Infections' );

