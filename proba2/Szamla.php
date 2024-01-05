<?php

class Szamla
{
    private int $id;
    private String $nev;
    private float $egyenleg;

    public function __construct(int $id, String $nev)
    {
        $this->id = $id;
        $this->nev = $nev;
        $this->egyenleg = rand(0, 1000);
    }


    public function __set($name, $value)
    {
        if($name == "egyenleg")
            $this->egyenleg = $value;
        else
            echo "Unkown property";
    }

    public function betesz(float $osszeg)
    {
        $this->egyenleg += $osszeg;
    }

    public function kivesz(float $osszeg): bool
    {
        if($this->egyenleg < $osszeg)
        {
            echo "<p style='color: red'>$this->nev: Nincs elegendő összeg a számlán!
                (egyenleg: $this->egyenleg, kísérelt összeg: $osszeg) </p>";
            return false;
        }

        $this->egyenleg -= $osszeg;
        return true;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNev(): string
    {
        return $this->nev;
    }

    public function getEgyenleg(): float
    {
        return $this->egyenleg;
    }


    public function __toString()
    {
        return " <ul>
                    <li>ID: $this->id </li>
                    <li> Nev: $this->nev </li>
                    <li> Egyenleg: $this->egyenleg Euro</li> 
                </ul>";
    }

}