<?php

namespace App\Helpers;

class Country
{
    public static function resolveByPhone(string|int $phone): ?string
    {
        $codes = [
            '376' => 'AD',
            '971' => 'AE',
            '355' => 'AL',
            '374' => 'AM',
            '599' => 'AN',
            '244' => 'AO',
            '297' => 'AW',
            '994' => 'AZ',
            '387' => 'BA',
            '880' => 'BD',
            '226' => 'BF',
            '359' => 'BG',
            '973' => 'BH',
            '257' => 'BI',
            '229' => 'BJ',
            '673' => 'BN',
            '591' => 'BO',
            '975' => 'BT',
            '267' => 'BW',
            '375' => 'BY',
            '501' => 'BZ',
            '243' => 'CD',
            '236' => 'CF',
            '242' => 'CG',
            '225' => 'CI',
            '682' => 'CK',
            '237' => 'CM',
            '506' => 'CR',
            '238' => 'CV',
            '357' => 'CY',
            '420' => 'CZ',
            '253' => 'DJ',
            '213' => 'DZ',
            '593' => 'EC',
            '372' => 'EE',
            '291' => 'ER',
            '251' => 'ET',
            '358' => 'FI',
            '679' => 'FJ',
            '500' => 'FK',
            '691' => 'FM',
            '298' => 'FO',
            '508' => 'FR',
            '590' => 'FR',
            '241' => 'GA',
            '995' => 'GE',
            '594' => 'GF',
            '233' => 'GH',
            '350' => 'GI',
            '299' => 'GL',
            '220' => 'GM',
            '224' => 'GN',
            '240' => 'GQ',
            '502' => 'GT',
            '245' => 'GW',
            '592' => 'GY',
            '852' => 'HK',
            '504' => 'HN',
            '385' => 'HR',
            '509' => 'HT',
            '628' => 'ID',
            '353' => 'IE',
            '972' => 'IL',
            '246' => 'IO',
            '964' => 'IQ',
            '354' => 'IS',
            '962' => 'JO',
            '254' => 'KE',
            '996' => 'KG',
            '855' => 'KH',
            '686' => 'KI',
            '269' => 'KM',
            '850' => 'KP',
            '965' => 'KW',
            '856' => 'LA',
            '961' => 'LB',
            '423' => 'LI',
            '231' => 'LR',
            '266' => 'LS',
            '370' => 'LT',
            '352' => 'LU',
            '371' => 'LV',
            '218' => 'LY',
            '212' => 'MA',
            '377' => 'MC',
            '373' => 'MD',
            '382' => 'ME',
            '261' => 'MG',
            '692' => 'MH',
            '389' => 'MK',
            '223' => 'ML',
            '976' => 'MN',
            '853' => 'MO',
            '596' => 'MQ',
            '222' => 'MR',
            '356' => 'MT',
            '230' => 'MU',
            '960' => 'MV',
            '265' => 'MW',
            '258' => 'MZ',
            '264' => 'NA',
            '687' => 'NC',
            '227' => 'NE',
            '234' => 'NG',
            '505' => 'NI',
            '977' => 'NP',
            '674' => 'NR',
            '683' => 'NU',
            '968' => 'OM',
            '507' => 'PA',
            '689' => 'PF',
            '675' => 'PG',
            '970' => 'PS',
            '351' => 'PT',
            '680' => 'PW',
            '595' => 'PY',
            '974' => 'QA',
            '262' => 'RE',
            '381' => 'RS',
            '250' => 'RW',
            '966' => 'SA',
            '677' => 'SB',
            '248' => 'SC',
            '249' => 'SD',
            '290' => 'SH',
            '386' => 'SI',
            '421' => 'SK',
            '232' => 'SL',
            '378' => 'SM',
            '221' => 'SN',
            '252' => 'SO',
            '597' => 'SR',
            '211' => 'SS',
            '239' => 'ST',
            '503' => 'SV',
            '963' => 'SY',
            '268' => 'SZ',
            '235' => 'TD',
            '228' => 'TG',
            '992' => 'TJ',
            '690' => 'TK',
            '670' => 'TL',
            '993' => 'TM',
            '216' => 'TN',
            '676' => 'TO',
            '886' => 'TW',
            '255' => 'TZ',
            '380' => 'UA',
            '256' => 'UG',
            '598' => 'UY',
            '998' => 'UZ',
            '678' => 'VU',
            '681' => 'WF',
            '685' => 'WS',
            '967' => 'YE',
            '260' => 'ZM',
            '263' => 'ZW',
            '93' => 'AF',
            '54' => 'AR',
            '43' => 'AT',
            '61' => 'AU',
            '32' => 'BE',
            '55' => 'BR',
            '41' => 'CH',
            '56' => 'CL',
            '86' => 'CN',
            '57' => 'CO',
            '53' => 'CU',
            '49' => 'DE',
            '45' => 'DK',
            '20' => 'EG',
            '34' => 'ES',
            '33' => 'FR',
            '30' => 'GR',
            '36' => 'HU',
            '62' => 'ID',
            '91' => 'IN',
            '98' => 'IR',
            '39' => 'IT',
            '81' => 'JP',
            '82' => 'KR',
            '76' => 'KZ',
            '77' => 'KZ',
            '94' => 'LK',
            '95' => 'MM',
            '52' => 'MX',
            '60' => 'MY',
            '31' => 'NL',
            '47' => 'NO',
            '64' => 'NZ',
            '51' => 'PE',
            '63' => 'PH',
            '92' => 'PK',
            '48' => 'PL',
            '40' => 'RO',
            '46' => 'SE',
            '65' => 'SG',
            '66' => 'TH',
            '90' => 'TR',
            '44' => 'UK',
            '58' => 'VE',
            '84' => 'VN',
            '27' => 'ZA',
            '7' => 'RU'
        ];

        $phoneString = (string) $phone;

        foreach ($codes as $prefix => $countryCode) {
            if (str_starts_with($phoneString, $prefix)) {
                return $countryCode;
            }
        }

        return null;
    }
}