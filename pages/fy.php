<?php if (date('m') >= 4) {//Upto June 2014-2015
    $financial_year = date('Y') . '-' . (date('Y') + 1);

} else {//After June 2015-2016
    $financial_year = (date('Y')-1) . '-' . date('Y');
}
//echo $financial_year;

$startyear=substr($financial_year,0,4);
//echo $startyear;

$endyear=substr($financial_year,5,10);

//echo $endyear;

?>