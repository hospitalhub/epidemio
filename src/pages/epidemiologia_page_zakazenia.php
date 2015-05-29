<?php
use Hospitalplugin\Entities\HospitalForm;

HospitalForm::load ( __DIR__ . '/../../resources/infectionsRE.yml', 'Hospitalplugin\Entities\Infections', __DIR__ . '/../views/' );
