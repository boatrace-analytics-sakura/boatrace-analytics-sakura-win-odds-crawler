<?php

namespace Boatrace\Analytics\Cherry\Blossom\Win\Odds\Crawlers;

use Goutte\Client as Goutte;
use Boatrace\Analytics\Cherry\Blossom\Converter;
use Carbon\CarbonImmutable as Carbon;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author shimomo
 */
class OddsCrawler extends BaseCrawler
{
    /**
     * @var int
     */
    protected $baseLevel = 0;

    /**
     * @var string
     */
    protected $baseXPath = 'descendant-or-self::body/main/div/div/div';

    /**
     * @param  \Goutte\Client  $goutte
     * @return void
     */
    public function __construct(Goutte $goutte)
    {
        parent::__construct($goutte);
    }

    /**
     * @param  array   $response
     * @param  string  $date
     * @param  int     $stadiumId
     * @param  int     $raceNumber
     * @param  int     $seconds
     * @return array
     */
    public function crawl(array $response, string $date, int $stadiumId, int $raceNumber, int $seconds): array
    {
        $date = Converter::convertToDate($date);
        $stadiumId = Converter::convertToInt($stadiumId);
        $raceNumber = Converter::convertToInt($raceNumber);

        $boatraceDate = Carbon::parse($date)->format('Ymd');

        $request1 = sprintf('%s/owpc/pc/race/oddstf?hd=%s&jcd=%02d&rno=%d', $this->baseUrl, $boatraceDate, $stadiumId, $raceNumber);
        $crawler1 = $this->goutte->request('GET', $request1);
        sleep($seconds);

        $this->baseLevel = 0;

        $levelFormat = '%s/div[2]/div[3]/ul/li';
        $levelXPath = sprintf($levelFormat, $this->baseXPath);
        if (! is_null($this->filterXPath($crawler1, $levelXPath))) {
            $this->baseLevel = 1;
        }

        $response['stadiums'][$stadiumId]['races'][$raceNumber]['date'] = $date;
        $response['stadiums'][$stadiumId]['races'][$raceNumber]['stadium_id'] = $stadiumId;
        $response['stadiums'][$stadiumId]['races'][$raceNumber]['race_number'] = $raceNumber;

        $response = $this->crawlWin($crawler1, $response, $date, $stadiumId, $raceNumber);

        return $response;
    }


    /**
     * @param  \Symfony\Component\DomCrawler\Crawler  $crawler
     * @param  array                                  $response
     * @param  string                                 $date
     * @param  int                                    $stadiumId
     * @param  int                                    $raceNumber
     * @return array
     */
    protected function crawlWin(Crawler $crawler, array $response, string $date, int $stadiumId, int $raceNumber): array
    {
        $win1XPath = sprintf('%s/div[2]/div[%s]/div[1]/div[2]/table/tbody[1]/tr/td[3]', $this->baseXPath, $this->baseLevel + 6);
        $win2XPath = sprintf('%s/div[2]/div[%s]/div[1]/div[2]/table/tbody[2]/tr/td[3]', $this->baseXPath, $this->baseLevel + 6);
        $win3XPath = sprintf('%s/div[2]/div[%s]/div[1]/div[2]/table/tbody[3]/tr/td[3]', $this->baseXPath, $this->baseLevel + 6);
        $win4XPath = sprintf('%s/div[2]/div[%s]/div[1]/div[2]/table/tbody[4]/tr/td[3]', $this->baseXPath, $this->baseLevel + 6);
        $win5XPath = sprintf('%s/div[2]/div[%s]/div[1]/div[2]/table/tbody[5]/tr/td[3]', $this->baseXPath, $this->baseLevel + 6);
        $win6XPath = sprintf('%s/div[2]/div[%s]/div[1]/div[2]/table/tbody[6]/tr/td[3]', $this->baseXPath, $this->baseLevel + 6);

        $response['stadiums'][$stadiumId]['races'][$raceNumber]['oddses']['win'][1] = $this->filterXPathForOdds($crawler, $win1XPath);
        $response['stadiums'][$stadiumId]['races'][$raceNumber]['oddses']['win'][2] = $this->filterXPathForOdds($crawler, $win2XPath);
        $response['stadiums'][$stadiumId]['races'][$raceNumber]['oddses']['win'][3] = $this->filterXPathForOdds($crawler, $win3XPath);
        $response['stadiums'][$stadiumId]['races'][$raceNumber]['oddses']['win'][4] = $this->filterXPathForOdds($crawler, $win4XPath);
        $response['stadiums'][$stadiumId]['races'][$raceNumber]['oddses']['win'][5] = $this->filterXPathForOdds($crawler, $win5XPath);
        $response['stadiums'][$stadiumId]['races'][$raceNumber]['oddses']['win'][6] = $this->filterXPathForOdds($crawler, $win6XPath);

        return $response;
    }
}
