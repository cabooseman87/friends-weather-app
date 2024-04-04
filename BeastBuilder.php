<?php

require_once('npc.php');
use ProbablyRational\RandomNameGenerator\All as NameMaker;

class BeastBuilder
{
    public $beast;
    public $nameMaker;

    public function __construct(){
        $this->beast     = null;
        $this->nameMaker = NameMaker::create();
    }

    /**
     * Makes a beast to enter into war.
     *
     * @param string $type
     *
     * @return npc
     */
    public function makeBeast(string $type): npc
    {
        switch ($type) {

            case 'monster':

                $this->makeMonster();
                break;

            case 'fighter':

                $this->makeFighter();
                break;

            default:
                throw "Hey guy, we only make fighter or monster beasts here. {$type} beasts are not on the menu";
        }

        return $this->beast;
    }

    /**
     * Creates and formats a random beast name.
     *
     * @return string
     */
    public function makeName(): string
    {
        return ucwords(str_replace("-", " ", $this->nameMaker->getName()));
    }

    /**
     * Loads a new npc with random attributes for a "monster" type beast.
     *
     * @return void
     */
    private function makeMonster(): void
    {
        $this->beast = new npc;
        $this->beast->setName(ucwords(str_replace("-", " ", $this->makeName())));
        $this->beast->setSpeed(mt_rand(5,15));
        $this->beast->setHealth(mt_rand(100,200));
        $this->beast->setStrength(mt_rand(15,30));
    }

    /**
     * Loads a new npc with random attributes for a "fighter" type beast.
     *
     * @return void
     */
    private function makeFighter(): void
    {
        $this->beast = new npc;
        $this->beast->setName(ucwords(str_replace("-", " ", $this->makeName())));
        $this->beast->setSpeed(mt_rand(5,10));
        $this->beast->setHealth(mt_rand(50, 100));
        $this->beast->setStrength(mt_rand(5,20));
    }
}
