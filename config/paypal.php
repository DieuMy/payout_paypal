<?php
    return [
        'client_id' => 'Aa_BpOYtyqiNTX7D3AR_1fUzUHQT7sc2eNhd2_bdP8h7IbhJmNtLaKAG_y8hRmGyoKDs0sBrONu95dAz',
        'secret' => 'ELV2D2Fej2TpyU2J1rzFBmexDNZbXFckK23sFpL-mRP7YZ-jvHV2n0aVC6ghGbQJsJPJoM2eFyECJ6J-',
        'settings' => [
            'http.CURLOPT_CONNECTTIMEOUT' => 1200,
            'mode' => 'sandbox',//live
            'log.LogEnabled' => true,
            'log.FileName' => storage_path().'/logs/paypal.php',
            'log.LogLevel' => 'FINE',
        ]
    ]

?>