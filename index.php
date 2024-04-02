<?php

print '<link rel="stylesheet" href="style.css" type="text/css">';

$curl = curl_init();
$unixTime = time();
$weatherApiKey = 'a38f063760126127e37cc8c421261d73';
$compiledData = [];
$zipCodes = [
    "Carroll's" => [
        'zip' => '85739',
        'city' => 'Tucson',
        'timezone' => 'America/Phoenix',
        'color' => 'teal'
    ],
    "Bluff's" => [
        'zip' => '78418',
        'city' => 'Corpus Christi',
        'timezone' => 'America/Chicago',
        'color' => '#bada55'
    ],
    "Vail's" => [
        'zip' => '32444',
        'city' => 'Lynn Haven',
        'timezone' => 'America/New_York',
        'color' => 'orange'
    ],
    "Bluff" => [
        'zip' => '83616',
        'city' => 'Eagle',
        'timezone' => 'America/Boise',
        'color' => 'gold'
    ],
];

print "<h1>Friends Weather</h1>";
print "<br>";

foreach ($zipCodes as $key => $value) {
    //getting date and time based on friends location
    $timeZone = new DateTime('@' . $unixTime);
    $timeZone->setTimeZone(new DateTimeZone($value['timezone']));
    $localTime = $timeZone->format('F j, Y, g:i a');
    $sortTime = (int) $timeZone->format('His');

    //weather based on each friend's zip code
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.openweathermap.org/data/2.5/weather?zip=' . $value['zip'] . '%2Cus&appid=' . $weatherApiKey . '&units=imperial',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $weather = json_decode(curl_exec($curl));

    curl_close($curl);
    $compiledData[$sortTime] = [
        'time' => $localTime,
        'weather description' => $weather->weather[0]->description,
        'local temp' => $weather->main->temp,
        'peep peep' => $key,
        'color' => $value['color'],
    ];

}

sort($compiledData);
//var_dump($compiledData);
foreach ($compiledData as $compiledDatum) {
    print "<div class=" . $compiledDatum['color'] . ">At the " . $compiledDatum['peep peep'] . '</div>';
    print "<br>";
    print "It is " . $compiledDatum['time'];
    print "<br>";
print 'Weather is ' . $compiledDatum['weather description'];
print '<br>';

print 'Current Temp is ' . $compiledDatum['local temp'] . ' degrees';

    print '<br><br>';
}
