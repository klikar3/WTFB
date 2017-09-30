<?php
namespace common\components;
class MyHelpers
{
    public static function hello($name) {
        return "Hello $name";
    }
    
		public static function datetimeconv($datetime, $from, $to)
		{
		    try {
		        if ($from['localeFormat'] != 'Y-m-d H:i:s') {
		            $datetime = DateTime::createFromFormat($from['localeFormat'], $datetime)->format('Y-m-d H:i:s');
		        }
		        $datetime = new \DateTime($datetime, new \DateTimeZone($from['olsonZone']));
		        $datetime->setTimeZone(new \DateTimeZone($to['olsonZone']));
		        return $datetime->format($to['localeFormat']);
		    } catch (\Exception $e) {
		        return null;
		    }
		}

}