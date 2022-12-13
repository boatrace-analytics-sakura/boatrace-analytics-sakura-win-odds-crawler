# Boatrace Analytics Sakura Win Odds Crawler

[![Build Status](https://github.com/boatrace-analytics-sakura/boatrace-analytics-sakura-win-odds-crawler/workflows/tests/badge.svg)](https://github.com/boatrace-analytics-sakura/boatrace-analytics-sakura-win-odds-crawler/actions?query=workflow%3Atests)
[![Coverage Status](https://coveralls.io/repos/github/boatrace-analytics-sakura/boatrace-analytics-sakura-win-odds-crawler/badge.svg?branch=master)](https://coveralls.io/github/boatrace-analytics-sakura/boatrace-analytics-sakura-win-odds-crawler?branch=master)
[![Latest Stable Version](https://poser.pugx.org/boatrace-analytics-sakura/boatrace-analytics-sakura-win-odds-crawler/v/stable)](https://packagist.org/packages/boatrace-analytics-sakura/boatrace-analytics-sakura-win-odds-crawler)
[![Latest Unstable Version](https://poser.pugx.org/boatrace-analytics-sakura/boatrace-analytics-sakura-win-odds-crawler/v/unstable)](https://packagist.org/packages/boatrace-analytics-sakura/boatrace-analytics-sakura-win-odds-crawler)
[![License](https://poser.pugx.org/boatrace-analytics-sakura/boatrace-analytics-sakura-win-odds-crawler/license)](https://packagist.org/packages/boatrace-analytics-sakura/boatrace-analytics-sakura-win-odds-crawler)

## Installation
```
$ composer require boatrace-analytics-sakura/boatrace-analytics-sakura-win-odds-crawler
```

## Usage
```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Boatrace\Analytics\Sakura\Win\Odds\Crawler;

var_dump(Crawler::crawlOdds('2017-03-31')); // 2017年03月31日, 単勝オッズ
var_dump(Crawler::crawlOdds('2017-03-31', 24)); // 2017年03月31日, 大村, 単勝オッズ
var_dump(Crawler::crawlOdds('2017-03-31', 24, 1)); // 2017年03月31日, 大村, 1R, 単勝オッズ
```

## License
The Boatrace Analytics Sakura Win Odds Crawler is open source software licensed under the [MIT license](LICENSE).
