<?php

namespace Epidemio\utils;

use Hospitalplugin\Entities\WardCRUD;

class PostVarsLoader {
	public $get;
	public function load() {
		$this->get ['wardId'] = (! empty ( $_POST ['wardId'] ) ? $_POST ['wardId'] : 0);
		$this->get ['date'] = (! empty ( $_POST ['date'] ) ? $_POST ['date'] : (new \DateTime ())->format ( "Y-m" ));
		$this->get ['from'] = new \DateTime ( $this->get['date'] . '-01' );
		$this->get ['fromStr'] = $this->get['from']->format ( 'Y-m-01' );
		$this->get ['toStr'] = $this->get['from']->format ( 'Y-m-t' );
		
		$this->get ['id'] = (! empty ( $_POST ['id'] ) ? $_POST ['id'] : null);
		$this->get ['weryfikacja'] = (! empty ( $_POST ['weryfikacja'] ) ? $_POST ['weryfikacja'] : null);
	}
}

?>