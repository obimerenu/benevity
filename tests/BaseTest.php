<?php
/**
  * BaseTest
  *
  *
  * @package    CapitalsObi
  * @subpackage benevsTest
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */

namespace CapitalsObi\benevsTest;

use CapitalsObi\benevsAPI\App;

class BaseTest extends \PHPUnit\Framework\TestCase
{
    protected $app;

    public function setUp()
    {
        $this->app = (new App())->get()  ;
    }

    /**
     * A single example test.
     */
    public function test_sample()
    {
        // stays here as a check that phpunit works as expected
        $this->assertTrue(true);
    }

}
