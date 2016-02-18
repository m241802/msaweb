<?php namespace App\LibraryClasses;

class PriceProcessing {
    public function currency_rate($products)
    {
        if(file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp?date_req='.date('d/m/Y'))){
            $arr_cbk = (array)simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req='.date('d/m/Y'));
            foreach ($arr_cbk['Valute'] as $key => $value)
            {
                $charCode = (array)$value->CharCode;
                if($charCode[0]=='USD')
                {
                    $cbk = (array)$value->Value;
                }
            }
            for ($i=0; $i < count($products) ; $i++)
            {
                if(isset($products[$i]->price_currency)&&($products[$i]->price_currency=="y.e."))
                {
                    $products[$i]->price = $products[$i]->price * $cbk[0];
                    $products[$i]->price_currency = "руб.";
                    $products[$i]->unit_of_measure = $products[$i]->unit_of_measure . '<span class="price-info"> * В связи с плавающим курсом рубля уточняйте точную цену</span>';
                }
            }
        }
        return $products;
    }

}