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
        $damage = $this->damageDealt($monster->getStrength());
        $fightersDead = FALSE;
        if ($monster->getHealth() >= 1) {

            $target = mt_rand(0, 1);

            if ($fighters[$target]->getHealth() < 1) {

                switch (true) {

                    case $fighters[0]->getHealth() > 0:

                        $this->printAttackResult($monster->getName(), $fighters[0]->getName(), $damage);

                        $fighters[0]->setHealth($fighters[0]->getHealth() - $damage);

                        break;

                    case $fighters[1]->getHealth() > 0:

                        $this->printAttackResult($monster->getName(), $fighters[1]->getName(), $damage);

                        $fighters[1]->setHealth($fighters[1]->getHealth() - $damage);

                        break;

                    default:
                        $fightersDead = TRUE;
                        break;
                }

            } else {

                $this->printAttackResult($monster->getName(), $fighters[$target]->getName(), $damage);

                $fighters[$target]->setHealth($fighters[$target]->getHealth() - $damage);
            }
            if ($fighters[0]->getHealth() <= 0 && $fighters[1]->getHealth() <= 0) {
                $fightersDead = TRUE;
                print "<h4 style=\"color:purple\">Monster Victory! - **{$monster->getName()} -> throws up the west side!</h4>";

            }
        }

        return [
            'monster'  => $monster,
            'fighters' => $fighters,
            'fighters are dead' => $fightersDead,
        ];
    }

    /**
     * Executes a fighters attack against a bitch ass monster.
     *
     * @param npc $monster
     * @param npc $fighter
     *
     * @return array
     */
    function fighterAttack(npc $monster, npc $fighter): array
    {
        $monsterDead = FALSE;
        if ($fighter->getHealth() >= 1) {
            $damage = $this->damageDealt($fighter->getStrength());
            $monster->setHealth($monster->getHealth() - $damage);

            $this->printAttackResult($fighter->getName(), $monster->getName(), $damage);

            if ($monster->getHealth() < 1) {
                $monsterDead = TRUE;
                print "<h4 style=\"color:green\">Oh, snap! {$fighter->getName()} just SLAYED {$monster->getName()} Monster</h4>";
            }
        }

        return [
            'monster' => $monster,
            'fighter' => $fighter,
            'monster is dead' => $monsterDead,
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


    /**
     * Returns damage based on attacking strength.
     *
     * @param int $fullStrength
     * @return int
     */
    private function damageDealt(int $fullStrength): int
    {
        $halfStrength = round($fullStrength / 2);
        return mt_rand($halfStrength, $fullStrength);
    }

}
