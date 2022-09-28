<?php

namespace Boatrace\Analytics\Cherry\Blossom\Win\Odds\Tests\Crawlers;

use Goutte\Client as Goutte;
use Boatrace\Analytics\Cherry\Blossom\Win\Odds\Crawlers\OddsCrawler;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * @author shimomo
 */
class OddsCrawlerTest extends PHPUnitTestCase
{
    /**
     * @var \Boatrace\Analytics\Cherry\Blossom\OddsCrawler
     */
    protected $crawler;

    /**
     * @var int
     */
    protected $seconds = 1;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->crawler = new OddsCrawler(new Goutte);
    }

    /**
     * @return void
     */
    public function testCrawl(): void
    {
        $response = $this->crawler->crawl([], '2017-03-31', 24, 1, $this->seconds);
        $this->assertSame('2017-03-31', $response['stadiums'][24]['races'][1]['date']);
        $this->assertSame(24, $response['stadiums'][24]['races'][1]['stadium_id']);
        $this->assertSame(1, $response['stadiums'][24]['races'][1]['race_number']);
        $this->assertSame(1.0, $response['stadiums'][24]['races'][1]['oddses']['win'][1]);
        $this->assertSame(25.6, $response['stadiums'][24]['races'][1]['oddses']['win'][2]);
        $this->assertSame(33.5, $response['stadiums'][24]['races'][1]['oddses']['win'][3]);
        $this->assertSame(31.1, $response['stadiums'][24]['races'][1]['oddses']['win'][4]);
        $this->assertSame(31.1, $response['stadiums'][24]['races'][1]['oddses']['win'][5]);
        $this->assertSame(218.2, $response['stadiums'][24]['races'][1]['oddses']['win'][6]);
    }

    /**
     * @return void
     */
    public function testCrawlInCaseOfCancellation(): void
    {
        $response = $this->crawler->crawl([], '2019-10-14', 2, 1, $this->seconds);
        $this->assertSame('2019-10-14', $response['stadiums'][2]['races'][1]['date']);
        $this->assertSame(2, $response['stadiums'][2]['races'][1]['stadium_id']);
        $this->assertSame(1, $response['stadiums'][2]['races'][1]['race_number']);
        $this->assertNull($response['stadiums'][2]['races'][1]['oddses']['win'][1]);
        $this->assertNull($response['stadiums'][2]['races'][1]['oddses']['win'][2]);
        $this->assertNull($response['stadiums'][2]['races'][1]['oddses']['win'][3]);
        $this->assertNull($response['stadiums'][2]['races'][1]['oddses']['win'][4]);
        $this->assertNull($response['stadiums'][2]['races'][1]['oddses']['win'][5]);
        $this->assertNull($response['stadiums'][2]['races'][1]['oddses']['win'][6]);
    }
}
