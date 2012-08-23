<?php

namespace Ob\WeatherBundle;

/**
 * This class is part of the Ob/WeatherBundle
 *
 * Documentation:
 *      - Yahoo Weather API: http://developer.yahoo.com/weather/
 *      - Working with an RSS feed: http://ditio.net/2008/06/19/using-php-curl-to-read-rss-feed-xml/
 *
 * @author  Marc Aubé
 * @date    2012-08-23
 */
class Weather
{

    /**
     * Get the current weather for a location identified by a where-on-earth ID
     *
     * @param int    $woeid
     * @param string $unit
     *
     * @return array
     */
    public function getWeather($woeid = 1611, $unit = 'c')
    {
        // Get the RSS feed from Yahoo
        $url = 'http://weather.yahooapis.com/forecastrss?w=' . $woeid . '&u=' . $unit;
        $feed = curl_init($url);
        curl_setopt($feed, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($feed, CURLOPT_HEADER, 0);
        $data = curl_exec($feed);
        curl_close($feed);

        // "Parse" the XML
        $doc = new \Symfony\Component\DependencyInjection\SimpleXMLElement($data, LIBXML_NOCDATA);

        // Scrape interesting values
        preg_match('/([0-9]+)\s[CF]/', $doc->channel->item->description, $temp);
        preg_match('/Low:\s([0-9]+)/', $doc->channel->item->description, $min);
        preg_match('/High:\s([0-9]+)/', $doc->channel->item->description, $max);
        preg_match('/src\="(.+)"/', $doc->channel->item->description, $img);

        return array(
            "tmp"   => $temp[1] ? : 0,
            "min"   => $min[1] ? : 0,
            "max"   => $max[1] ? : 0,
            "img"   => $img[1] ? : 0
        );
    }

    /**
     * Retrieve the woeid for a plaintext location
     */
    public function getLocationWEOID()
    {
        // Check: http://woeid.rosselliot.co.nz/lookup/saint-sauveur%20des%20monts
    }
}