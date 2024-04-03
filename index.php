<?php

require_once('vendor/autoload.php');
require_once('npc.php');
use ProbablyRational\RandomNameGenerator\All;

$nameGenerator = All::create();

$teamSize = 5;
$participants = 2;
$teams = 10;
$fighters = [];
$rounds = 10;
$teamName = '';

$teamsProcessed = 0;
while ($teamsProcessed < $teams) {
$membersProcessed = 0;

$name = ucwords(str_replace("-", " ",$nameGenerator->getName()));
$teamName = 'The ' . $name . ' Team';
    while ($membersProcessed < $teamSize) {
        $name = ucwords(str_replace("-", " ",$nameGenerator->getName()));

        $fighter = new npc();
        $fighter->setName($name);
        $fighter->setHealth(mt_rand(50, 100));
        $fighter->setSpeed(mt_rand(5,10));
        $fighter->setStrength(mt_rand(5,20));

        $fighters[$teamName][] = $fighter;

        $membersProcessed++;
    }
    $teamsProcessed++;
}

$name = ucwords(str_replace("-", " ",$nameGenerator->getName()));

$monster = new npc();
$monster->setName($name);
$monster->setStrength(mt_rand(15,30));
$monster->setSpeed(mt_rand(5,15));
$monster->setHealth(mt_rand(100,200));


$battlingTeam = array_rand($fighters, 1);
$battlingMembers = array_rand($fighters[$battlingTeam], $participants);
$battlingFighters = [];
foreach ($battlingMembers as $battlingMember){
$battlingFighters[] = $fighters[$battlingTeam][$battlingMember];
}

print 'The Epic battle between good and not so good';
print '<br>';
print $teamName . ' VS ' . $monster->getName();
print '<br>';
$roundsFought = 0;

//print '<pre>';
//print_r($battlingFighters);
//print_r($monster);
//print '</pre>';

while ($roundsFought < $rounds) {
    $roundsFought++;

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

    $speeds = [];
    foreach ($turnOrder as $key => $value) {
        $speeds[$key] = $value['speed'];
    }
    array_multisort($speeds, SORT_DESC, $turnOrder);

    $monsterLife = $monster->getHealth();
    print 'Round ' . $roundsFought . ' Fight!';
    print '<br>';
    foreach ($turnOrder as $key => $value) {
        if ($key === 'monster') {
            if ($monster->getHealth() < 1) {
                break;
            }
            $target = mt_rand(0, 1);
            if ($battlingFighters[$target]->getHealth() < 1) {
                if ($battlingFighters[0]->getHealth() > 0) {
                    print $monster->getName() . ' attacks ' . $battlingFighters[0]->getName() . ' for ' . $monster->getStrength() . ' damage.';
                    $battlingFighters[0]->setHealth($battlingFighters[0]->getHealth() - $monster->getStrength());
                    print '<br>';
                }
                elseif ($battlingFighters[1]->getHealth() > 0) {
                    print $monster->getName() . ' attacks ' . $battlingFighters[1]->getName() . ' for ' . $monster->getStrength() . ' damage.';
                    $battlingFighters[1]->setHealth($battlingFighters[1]->getHealth() - $monster->getStrength());
                    print '<br>';
                }
                else {
                    print 'VICTORY FOR ' . $monster->getName();
                    print '<br>';
                }
            }
            else {
                print $monster->getName() . ' attacks ' . $battlingFighters[$target]->getName() . ' for ' . $monster->getStrength() . ' damage.';
                $battlingFighters[$target]->setHealth($battlingFighters[$target]->getHealth() - $monster->getStrength());
                print '<br>';
            }
        } else {
            if ($value['fighter']->getHealth() < 1) {
                break;
            }
            elseif ($monster->getHealth() < 1) {
                print 'SLAYED ' . $monster->getName();
            }
            print $value['fighter']->getName() . ' attacks ' . $monster->getName() . ' for ' . $value['fighter']->getStrength() . ' damage.';
            $monster->setHealth($monster->getHealth() - $value['fighter']->getStrength());
            print '<br>';
        }
    }
}



















//
//print '<pre>';
//print_r($battlingFighters);
//print_r($monster);
//print '</pre>';
