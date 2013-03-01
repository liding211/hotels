<?php

/*
 * Convert from money item to cents
 * 
 * @param float $money
 * @return int
 */
function convertToCents($money){
    return MoneyConvertor::toCents($money);
}

/*
 * Convert cents to money item
 * 
 * @param int $cents
 * @return float
 */
function convertFromCents($cents){
    return MoneyConvertor::fromCents($cents);
}
?>
