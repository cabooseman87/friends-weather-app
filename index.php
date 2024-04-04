<?php

require_once('vendor/autoload.php');
require_once('BeastBuilder.php');
require_once('npc.php');
require_once('Octagon.php');

$teamSize = 5;
$participants = 2;
$teams = 10;
$fighters = [];
$rounds = 10;
$teamName = '';


$teamsProcessed = 0;

while ($teamsProcessed < $teams) {

    $membersProcessed = 0;
    $teamName         = "The " . (new BeastBuilder)->makeName() . " Team";
    if (str_starts_with($teamName, 'The The ')) {
        $teamName = substr($teamName, 4);
    }

    while ($membersProcessed < $teamSize) {

        try {
            $fighters[$teamName][] = (new BeastBuilder)->makeBeast('fighter');
        } catch (Exception $e) {
            print $e->getMessage();
        }

        $membersProcessed++;
    }

    $teamsProcessed++;
}


try {
    $monster = (new BeastBuilder)->makeBeast('monster');
} catch (Exception $e) {
    print $e->getMessage();
}
$battlingTeam     = array_rand($fighters, 1);
$battlingMembers  = array_rand($fighters[$battlingTeam], $participants);
$battlingFighters = [];

foreach ($battlingMembers as $battlingMember){
    $battlingFighters[] = $fighters[$battlingTeam][$battlingMember];
}

print "<h1>The Epic battle between <span style=\"color:green\">good</span> and <span style=\"color:red\">not so good</span></h1>";
print "<h3><span style=\"color:#bada55\">{$teamName}</span> VS <span style=\"color:red\">{$monster->getName()}</span></h3>";

$roundsFought = 0;


$monsterDead = FALSE;
$fightersDead = FALSE;

while ($roundsFought < $rounds && $monsterDead == FALSE && $fightersDead == FALSE) {

    $speeds = [];

    $roundsFought++;

    print "<h2>Round {$roundsFought} Fight!</h2>";

    //First round surprise attack!!!
    if ($roundsFought === 1) {
        $roundSpeedA = 100;
        $roundSpeedB = 100;
    } else {
        $roundSpeedA = $battlingFighters[0]->getSpeed();
        $roundSpeedB = $battlingFighters[1]->getSpeed();
    }

    $turnOrder = [
        'fighter 1' => [
            'fighter' => $battlingFighters[0],
            'speed' => $roundSpeedA,
        ],
        'fighter 2' => [
            'fighter' => $battlingFighters[1],
            'speed' => $roundSpeedB,
        ],
        'monster' => [
            'fighter' => $monster,
            'speed' => $monster->getSpeed(),
        ],
    ];

    foreach ($turnOrder as $key => $value) {

        $speeds[$key] = $value['speed'];
    }

    array_multisort($speeds, SORT_DESC, $turnOrder);


    foreach ($turnOrder as $key => $value) {

        if ($key === 'monster') {

            $results          = (new Octagon)->monsterAttack($monster, $battlingFighters);
            $monster          = $results['monster'];
            $battlingFighters = $results['fighters'];
            $fightersDead = $results['fighters are dead'];

        } else {
            if (!$monsterDead) {
                $results = (new Octagon)->fighterAttack($monster, $value['fighter']);
                $monster = $results['monster'];
                $monsterDead = $results['monster is dead'];
            }
        }
    }
}
