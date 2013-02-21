<?php

class MoneyConvertor {
    
    const PRECISION_OF_MONEY = 2;
    const CENTS_NUMBER_PER_MONEY_ITEM = 100;
    
    public static function toCents($money){
        if(!is_numeric($money) OR empty($money)){
            return 0;
        }
        return (int) round($money * self::CENTS_NUMBER_PER_MONEY_ITEM);
    }
    
    public static function fromCents($cents){
        if(!is_numeric($cents) OR empty($cents)){
            return 0;
        }
        return round($cents / self::CENTS_NUMBER_PER_MONEY_ITEM, self::PRECISION_OF_MONEY);
    }
}
