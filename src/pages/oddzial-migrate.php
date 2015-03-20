<?php
$oddzialy = new Pods('oddzial', array(
    'limit' => - 1,
    'where' => "t.id > 0"
));
$oddzialy_arr = [];
$wardSQL = 'insert into hospital_ward (name,id,infomedica,komorkaOrg,adres,kondygnacja,odcinek,opis,kierownik,typOddzialu,pododdzial) values ';
$userSQL = 'insert into hospital_user (id,name,ward_id) values ';
while ($oddzialy->fetch()) {
    $konta_arr = [];
    $konta = new Pods('user', array(
        'where' => 'oddzial.ID = ' . $oddzialy->field('ID')
    ));
    while ($konta->fetch()) {
        $konto = array(
            $konta->field('ID') => $konta->field('user_login')
        );
        $userSQL .= "<br/> (" . $konta->field('ID') . ",'" . $konta->field('user_login') . "', " . $oddzialy->field('ID') . " ), ";
    }
    if ($konta_arr == null || count($konta_arr) == 0) {
        array_push($konta_arr, array(
            1024 => 'brak'
        ));
    }
    $od = array(
        'name' => $oddzialy->field('name'),
        'id' => $oddzialy->field('ID'),
        'konta' => $konta_arr,
        'infomedica' => $oddzialy->field('infomedica'),
        'komorka_org' => explode(' ', $oddzialy->field('komorka_org')),
        'lokalizacje' => array(
            array(
                'adres' => $oddzialy->field('lokalizacja'),
                'kondygnacja' => $oddzialy->field('kondygnacja'),
                'odcinek' => $oddzialy->field('odcinek')
            )
        ),
        'opis' => $oddzialy->field('opis'),
        'kierownik' => $oddzialy->field('kierownik'),
        'typ_oddzialu' => $oddzialy->field('typ_oddzialu'),
        'pododdzial' => $oddzialy->field('pododdzial')
    );
    
    $wardSQL .= "  <br/>('";
    
    $wardSQL .= $oddzialy->field('name');
    $wardSQL .= "', ";
    
    $wardSQL .= $oddzialy->field('ID');
    $wardSQL .= ", '";
    
    $wardSQL .= $oddzialy->field('infomedica');
    $wardSQL .= "', '";
    
    $wardSQL .= $oddzialy->field('komorka_org');
    $wardSQL .= "', '";
    
    $wardSQL .= $oddzialy->field('lokalizacja');
    $wardSQL .= "', '";
    
    $wardSQL .= implode(' ', $oddzialy->field('kondygnacja'));
    $wardSQL .= "', '";
    
    $wardSQL .= $oddzialy->field('odcinek');
    $wardSQL .= "', '";
    
    $wardSQL .= $oddzialy->field('opis');
    $wardSQL .= "', '";
    
    $wardSQL .= $oddzialy->field('kierownik');
    $wardSQL .= "', '";
    
    $wardSQL .= $oddzialy->field('typ_oddzialu');
    $wardSQL .= "', '";
    
    $wardSQL .= implode(' ', $oddzialy->field('pododdzial'));
    $wardSQL .= "'),";
    
}

echo $wardSQL;
echo "<hr/>";
echo $userSQL;
