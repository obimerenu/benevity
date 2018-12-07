<?php
/**
  * HomeController
  * handles homepage route display
  *
  * @package    CapitalsObi
  * @subpackage benevsAPI
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */
namespace CapitalsObi\benevsAPI\Controller;

class HomeController extends BaseController
{
    public function home() {
        return 'Welcome ';
    }
}
