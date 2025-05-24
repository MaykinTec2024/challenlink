<?php

namespace App;

class GildedRose
{
    public $name;
    public $quality;
    public $sellIn;

    public function __construct($name, $quality, $sellIn)
    {
        $this->name = $name;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public static function of($name, $quality, $sellIn)
    {
        return new static($name, $quality, $sellIn);
    }

    public function tick()
    {
        switch ($this->name) {
            case 'Aged Brie':
                $this->updateAgedBrie();
                break;

            case 'Sulfuras, Hand of Ragnaros':
                break;

            case 'Backstage passes to a TAFKAL80ETC concert':
                $this->updateBackstagePass();
                break;

            default:
                if (str_starts_with($this->name, 'Conjured')) {
                    $this->updateConjured();
                } else {
                    $this->updateNormalItem();
                }
                break;
        }
    }

    private function updateNormalItem()
    {
        $this->decreaseQuality(1);

        $this->sellIn--;

        if ($this->sellIn < 0) {
            $this->decreaseQuality(1);
        }
    }

    private function updateAgedBrie()
    {
        $this->increaseQuality(1);

        $this->sellIn--;

        if ($this->sellIn < 0) {
            $this->increaseQuality(1);
        }
    }

    private function updateBackstagePass()
    {
        if ($this->sellIn > 10) {
            $this->increaseQuality(1);
        } elseif ($this->sellIn > 5) {
            $this->increaseQuality(2);
        } elseif ($this->sellIn > 0) {
            $this->increaseQuality(3);
        } else {
            $this->quality = 0;
        }

        $this->sellIn--;
    }

    private function updateConjured()
    {
        $this->decreaseQuality(2);

        $this->sellIn--;

        if ($this->sellIn < 0) {
            $this->decreaseQuality(2);
        }
    }

    private function decreaseQuality($amount)
    {
        $this->quality -= $amount;

        if ($this->quality < 0) {
            $this->quality = 0;
        }
    }

    private function increaseQuality($amount)
    {
        $this->quality += $amount;

        if ($this->quality > 50) {
            $this->quality = 50;
        }
    }
}
