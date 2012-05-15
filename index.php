<?php

// Copyright (C) 2012 hush2 <hushywushy@gmail.com>

include 'vendor/geoip.inc';
include 'vendor/geoipcity.inc';
include 'vendor/geoipregionvars.php';

define('GEO_DIR', './data/');

$gi     = geoip_open(GEO_DIR . 'GeoIP.dat',     GEOIP_STANDARD);
$gicity = geoip_open(GEO_DIR . 'GeoIPCity.dat', GEOIP_STANDARD);
$giorg  = geoip_open(GEO_DIR . 'GeoIPOrg.dat',  GEOIP_STANDARD);
$giisp  = geoip_open(GEO_DIR . 'GeoIPISP.dat',  GEOIP_STANDARD);

if (isset($_GET['host']) && !empty($_GET['host'])) {

    $host = trim($_GET['host']);
    if (filter_var($host, FILTER_VALIDATE_IP) === false) {
        $ip = gethostbyname($host);
        if ($ip == $host) {
            $ip = 'N/A';
        }
    } else {
        $ip = $host;
    }

} else {
    $host = $_SERVER['REMOTE_ADDR'];
    $ip   = $host;
}

$na = "<span class='na'>N/A</span>";

$country_code = geoip_country_code_by_addr($gi, $ip);
$country_name = geoip_country_name_by_addr($gi, $ip);
$org          = geoip_org_by_addr($giorg, $ip);
$isp          = geoip_org_by_addr($giisp, $ip);

$country_code = empty($country_code) ? $na : $country_code;
$country_name = empty($country_name) ? $na : $country_name;
$org          = empty($org) ? $na : $org;

$record = geoip_record_by_addr($gicity, $ip);

$region    = @$GEOIP_REGION_NAME[$record->country_code][$record->region];
$region    = empty($region) ? $na : $region;
$city      = empty($record->city) ? $na : $record->city;
$area_code = empty($record->area_code) ? $na : $record->area_code;
$cont_code = empty($record->continent_code) ? $na : $record->continent_code;
$lat       = empty($record->latitude) ? $na : $record->latitude;
$long      = empty($record->longitude) ? $na : $record->longitude;

geoip_close($gi);
geoip_close($giorg);
geoip_close($giisp);
geoip_close($gicity);

if(!function_exists('apache_request_headers')) {
    include 'lib/apache_request_headers.php';
}

$headers = apache_request_headers();

include 'index_view.php';
