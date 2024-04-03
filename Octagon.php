<?php

require_once('npc.php');

class Octagon
{

    /**
     * Executes a monsters attack against crew of paladins.
     *
     * @param npc $monster
     * @param array $fighters
     *
     * @return array
     */
    function monsterAttack(npc $monster, array $fighters): array
    {
        if ($monster->getHealth() >= 1) {

            $target = mt_rand(0, 1);

            if ($fighters[$target]->getHealth() < 1) {

                switch (true) {

                    case $fighters[0]->getHealth() > 0:

                        $this->printAttackResult($monster->getName(), $fighters[0]->getName(), $monster->getStrength());

                        $fighters[0]->setHealth($fighters[0]->getHealth() - $monster->getStrength());

                        break;

                    case $fighters[1]->getHealth() > 0:

                        $this->printAttackResult($monster->getName(), $fighters[1]->getName(), $monster->getStrength());

                        $fighters[1]->setHealth($fighters[1]->getHealth() - $monster->getStrength());

                        break;

                    default:
                        print "<h4 style=\"color:purple\">Monster Victory! - **{$monster->getName()} -> throws up the west side!</h4>";
                        break;
                }

            } else {

                $this->printAttackResult($monster->getName(), $fighters[$target]->getName(), $monster->getStrength());

                $fighters[$target]->setHealth($fighters[$target]->getHealth() - $monster->getStrength());
            }
        }

        return [
            'monster'  => $monster,
            'fighters' => $fighters,
        ];
    }

    /**
     * Executes a fighters attack against a bitch ass monster.
     *
     * @param npc $monster
     * @param npc $fighter
     *
     * @return void
     */
    function fighterAttack(npc $monster, npc $fighter): array
    {
        if ($fighter->getHealth() >= 1) {

            if ($monster->getHealth() < 1) {

                print "<h4 style=\"color:green\">Oh snap! {$fighter->getName()} just SLAYED {$monster->getName()} Monster</h4>";
            }

            $monster->setHealth($monster->getHealth() - $fighter->getStrength());

            $this->printAttackResult($fighter->getName(), $monster->getName(), $fighter->getStrength());
        }

        return [
            'monster' => $monster,
            'fighter' => $fighter,
        ];
    }


    /**
     * Prints out the results of a deadly confrontation.
     *
     * @param string $attackerName
     * @param string $defenderName
     * @param int $damage
     *
     * @return void
     */
    private function printAttackResult(string $attackerName, string $defenderName, int $damage): void
    {
        print "<p>{$attackerName} attacks {$defenderName} for <span style=\"color:red\">{$damage} damage</span>.</p>";
    }
}
