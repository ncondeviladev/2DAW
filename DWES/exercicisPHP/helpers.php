
<?php

function comptarLeadsNous(array $llistat): int {
    // TODO 1: Recorre $llistat amb foreach i compta quants leads
    // tenen $lead['estat'] === 'nou'. Retorna eixe nombre.
    $cuantitatNous = 0;
    foreach($llistat as $lead) {
        if($lead['estat'] === 'nou') {
            $cuantitatNous++;
        }
    }
    return $cuantitatNous;
}