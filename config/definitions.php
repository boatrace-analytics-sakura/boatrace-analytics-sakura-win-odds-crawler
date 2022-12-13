<?php

return [
    'Crawler' => \DI\create('\Boatrace\Analytics\Sakura\Win\Odds\Crawler')->constructor(
        \DI\get('MainCrawler')
    ),
    'MainCrawler' => function ($container) {
        return $container->get('\Boatrace\Analytics\Sakura\Win\Odds\MainCrawler');
    },
    'OddsCrawler' => \DI\create('\Boatrace\Analytics\Sakura\Win\Odds\Crawlers\OddsCrawler')->constructor(
        \DI\get('Goutte')
    ),
    'StadiumCrawler' => \DI\create('\Boatrace\Analytics\Sakura\Win\Odds\Crawlers\StadiumCrawler')->constructor(
        \DI\get('Goutte')
    ),
    'Goutte' => function ($container) {
        return $container->get('\Goutte\Client');
    },
];
