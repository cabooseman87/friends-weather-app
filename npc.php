<?php

class npc
{
    public string $name;
    public int $strength;
    public int $health;
    public int $speed;

    /**
     * Set the npc's name.
     *
     * @param string $name
     * @return void
     */
    function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     *  Get the npc's name.
     *
     * @return string
     */
    function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the npc's strength.
     *
     * @param int $strength
     * @return void
     */
    function setStrength(int $strength): void
    {
        $this->strength = $strength;
    }

    /**
     *  Get the npc's strength.
     *
     * @return int
     */
    function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * Set npc's health.
     *
     * @param int $health
     * @return void
     */
    function setHealth(int $health): void
    {
        $this->health = $health;
    }

    /**
     * Get npc's health.
     *
     * @return int
     */
    function getHealth(): int
    {
        return $this->health;
    }

    /**
     *  Set npc's speed.
     *
     * @param int $speed
     * @return void
     */
    function setSpeed(int $speed): void
    {
        $this->speed = $speed;
    }

    /**
     *  Get npc's speed.
     *
     * @return int
     */
    function getSpeed(): int
    {
        return $this->speed;
    }
}