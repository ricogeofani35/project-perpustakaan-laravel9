<?php

function money_format($price) 
{
    return number_format($price,2,".",",");
}

?>