<?php

require_once('npc.php');
use ProbablyRational\RandomNameGenerator\All as NameMaker;
//Thanks for this Kyle ^!!!

class BeastBuilder
{
    public npc|null $beast;
    public object $nameMaker;

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
     * @throws Exception
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
                throw new Exception( "Hey guy, we only make fighter or monster type beasts here. {$type} beasts are not on the menu");
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
        $this->beast->setName($this->makeName());
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
        $this->beast->setName($this->makeName());
        $this->beast->setSpeed(mt_rand(5,10));
        $this->beast->setHealth(mt_rand(50, 100));
        $this->beast->setStrength(mt_rand(5,20));
    }
}
