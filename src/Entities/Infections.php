<?php

/**
 * Patient
 *
 * THIS MATERIAL IS PROVIDED AS IS, WITH ABSOLUTELY NO WARRANTY EXPRESSED
 * OR IMPLIED. ANY USE IS AT YOUR OWN RISK.
 *
 * Permission is hereby granted to use or copy this program
 * for any purpose, provided the above notices are retained on all copies.
 * Permission to modify the code and to distribute modified code is granted,
 * provided the above notices are retained, and a notice that the code was
 * modified is included with the above copyright notice.
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0 $Id: 5e3d6d9fad27385cb557282c244e0767bf6c41e0 $ $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */
namespace Epidemio\Entities;

/**
 * Infections
 *
 * @category Wp
 * @package Epidemio
 * @author Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license MIT http://opensource.org/licenses/MIT
 * @version 1.0 $Id: 5e3d6d9fad27385cb557282c244e0767bf6c41e0 $ $Format:%H$
 * @link http://
 * @since File available since Release 1.0.0
 *       
 *        @Entity
 *        @Table(name="epidemio_infections",
 *        options={"collate"="utf8_polish_ci", "charset"="utf8", "engine"="MyISAM"},
 *        indexes={
 *        @index(name="dataRaportu_idx", columns={"dataRaportu"}),
 *        @index(name="oddzialId_idx", columns={"oddzialId"}),
 *        @index(name="userId_idx", columns={"userId"})})
 */
class Infections {
	
	/**
	 * id
	 * @Id @Column(type="integer") @GeneratedValue
	 */
	public $id;
	
	/**
	 * $dataRaportu datetime
	 * @Column(type="datetime") *
	 */
	public $dataRaportu;
	
	/**
	 * $dataPrzeslania datetime
	 * @Column(type="datetime") *
	 */
	public $dataPrzeslania;
	
	/**
	 * @ManyToOne(targetEntity="Hospitalplugin\Entities\Ward")
	 * @JoinColumn(name="oddzialId", referencedColumnName="id")
	 */
	protected $ward;
	
	/**
	 * @ManyToOne(targetEntity="Hospitalplugin\Entities\User")
	 * @JoinColumn(name="userId", referencedColumnName="id")
	 */
	protected $user;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $G;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $A;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $B;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $Bzak;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $ZMO;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $ZUM;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $PNEUVAP;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $ZODC;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $ZKR;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $ROZIII;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $ROZII;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $OIOM;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $BM;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $IZOL;
	
	/**
	 * @Column(columnDefinition="SMALLINT NOT NULL DEFAULT 0") *
	 */
	public $ZAK;
	
	/**
	 * @Column(type="string", length=1000)
	 */
	public $Uwagi;
	
	/**
	 * @Column(type="string", length=1000)
	 */
	public $Weryfikacja = "";
	
	function __construct($args) {
		foreach ( $args as $key => $value ) {
			if ($key == 'dataRaportu') {
				$value = new \DateTime ( $value );
			} 
			call_user_func ( array (
					$this,
					'set' . $key 
			), $value );
		}
		$this->dataPrzeslania = new \DateTime ();
		echo '<h3><div class="alert alert-primary">Dziękuję za przesłanie raportu!</div></h3>';
	}
	
	/**
	 * getId
	 *
	 * @return id
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * sets id
	 *
	 * @param int $id
	 *        	ID
	 *        	
	 * @return \Punction\Entities\Patient
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	/**
	 * toString
	 *
	 * @return string
	 */
	public function toString() {
		$txt = $this->getId ();
		$data = $this->getDataRaportu ();
		if ($data instanceof \DateTime) {
			$txt .= $this->getDataRaportu ()->format ( "Y-m-d" );
		} else {
			$txt .= $this->getDataRaportu ();
		}
		return $txt;
	}
	public function getDataRaportu() {
		return $this->dataRaportu;
	}
	public function setDataRaportu($dataRaportu) {
		$this->dataRaportu = $dataRaportu;
		return $this;
	}
	
	public function getG() {
		return $this->G;
	}
	public function setG($G) {
		$this->G = $G;
		return $this;
	}
	public function getA() {
		return $this->A;
	}
	public function setA($A) {
		$this->A = $A;
		return $this;
	}
	public function getB() {
		return $this->B;
	}
	public function setB($B) {
		$this->B = $B;
		return $this;
	}
	public function getBzak() {
		return $this->Bzak;
	}
	public function setBzak($Bzak) {
		$this->Bzak = $Bzak;
		return $this;
	}
	public function getZMO() {
		return $this->ZMO;
	}
	public function setZMO($ZMO) {
		$this->ZMO = $ZMO;
		return $this;
	}
	public function getZUM() {
		return $this->ZUM;
	}
	public function setZUM($ZUM) {
		$this->ZUM = $ZUM;
		return $this;
	}
	public function getPNEUVAP() {
		return $this->PNEUVAP;
	}
	public function setPNEUVAP($PNEUVAP) {
		$this->PNEUVAP = $PNEUVAP;
		return $this;
	}
	public function getZODC() {
		return $this->ZODC;
	}
	public function setZODC($ZODC) {
		$this->ZODC = $ZODC;
		return $this;
	}
	public function getZKR() {
		return $this->ZKR;
	}
	public function setZKR($ZKR) {
		$this->ZKR = $ZKR;
		return $this;
	}
	public function getOIOM() {
		return $this->OIOM;
	}
	public function setOIOM($OIOM) {
		$this->OIOM = $OIOM;
		return $this;
	}
	public function getBM() {
		return $this->BM;
	}
	public function setBM($BM) {
		$this->BM = $BM;
		return $this;
	}
	public function getIZOL() {
		return $this->IZOL;
	}
	public function setIZOL($IZOL) {
		$this->IZOL = $IZOL;
		return $this;
	}
	public function getZAK() {
		return $this->ZAK;
	}
	public function setZAK($ZAK) {
		$this->ZAK = $ZAK;
		return $this;
	}
	public function getROZIII() {
		return $this->ROZIII;
	}
	public function setROZIII($ROZIII) {
		$this->ROZIII = $ROZIII;
		return $this;
	}
	public function getROZII() {
		return $this->ROZII;
	}
	public function setROZII($ROZII) {
		$this->ROZII = $ROZII;
		return $this;
	}
	public function getUwagi() {
		return $this->Uwagi;
	}
	public function setUwagi($Uwagi) {
		$this->Uwagi = $Uwagi;
		return $this;
	}
	public function getDataPrzeslania() {
		return $this->dataPrzeslania;
	}
	public function setDataPrzeslania($dataPrzeslania) {
		$this->dataPrzeslania = $dataPrzeslania;
		return $this;
	}
	public function getWard() {
		return $this->ward;
	}
	public function setWard($ward) {
		$this->ward = $ward;
		return $this;
	}
	public function getUser() {
		return $this->user;
	}
	public function setUser($user) {
		$this->user = $user;
		return $this;
	}
	public function getWeryfikacja() {
		return $this->Weryfikacja;
	}
	public function setWeryfikacja($Weryfikacja) {
		$this->Weryfikacja = $Weryfikacja;
		return $this;
	}
	
	
	
}
