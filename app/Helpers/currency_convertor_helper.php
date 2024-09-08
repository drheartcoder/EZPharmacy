<?php 

use \App\Common\Services\CurrencyService;

/*function currency_convert($amt = 0,$from = "CLP",$to = "USD",$attached_symbol = FALSE)
{
	$arr_symbol = ['USD'=>'$;','CLP'=>'$'];

	$converted_price = $amt;
	$obj_currency = new CurrencyService();
	$symbol = "$";

	if(session()->has('force_currency_conversion') && 
	   session()->get('currency')!="CLP")
	{
		$converted_price = $obj_currency->convert("CLP",session()->get('currency'),$amt);	
		$symbol = $arr_symbol[session()->get('currency')];
	}
	else
	{
		$converted_price = $obj_currency->convert($from,$to,$amt);	
		$symbol = $arr_symbol[$to];		
	}

	if($attached_symbol)
	{
		return $symbol." ".$converted_price;
	}
	else
	{
		return $converted_price;
	}
}*/

/*function currency_symbol()
{
	return "﷼";
}*/

function format_price($price, $attach_currency_symbol=false)
{
	$symbol = "";
	$formatted_price = number_format($price,2,".",",");
	if($attach_currency_symbol != true)
	{
		$symbol = currency_code();
		$formatted_price = $symbol.' '.$formatted_price;
	}
	return $formatted_price;
}

function currency_code()
{
	return "SAR";
}