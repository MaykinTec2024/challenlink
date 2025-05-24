<?php

use App\GildedRose;

describe('GildedRose', function () {
    it('degrada calidad de un ítem normal', function () {
        $item = GildedRose::of('foo', 20, 10); 
        $item->tick();

        expect($item->quality)->toBe(19);     
        expect($item->sellIn)->toBe(9);       
    });

    it('incrementa calidad de Aged Brie', function () {
        $item = GildedRose::of('Aged Brie', 0, 2);
        $item->tick();

        expect($item->quality)->toBe(1);
        expect($item->sellIn)->toBe(1);
    });

    it('la calidad nunca es mayor a 50', function () {
        $item = GildedRose::of('Aged Brie', 50, 2);
        $item->tick();

        expect($item->quality)->toBe(50);
    });

    it('los Backstage suben su valor mientras sellIn baja', function () {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 20, 10);
        $item->tick();

        expect($item->quality)->toBe(22); 
        expect($item->sellIn)->toBe(9);
    });

    it('los Backstage se vuelven 0 cuando pasa el concierto', function () {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 20, 0);
        $item->tick();

        expect($item->quality)->toBe(0);
    });

    it('Sulfuras no se degrada ni cambia sellIn', function () {
        $item = GildedRose::of('Sulfuras, Hand of Ragnaros', 80, 0);
        $item->tick();

        expect($item->quality)->toBe(80);
        expect($item->sellIn)->toBe(0);
    });
});
