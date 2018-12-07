<?php
/**
  * RoutesInterfaceTest
  * All controller test classes should inherit this class
  *
  * @package    CapitalsObi
  * @subpackage benevsAPI
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */
namespace CapitalsObi\benevsAPI\Helpers;

interface RoutesInterfaceTest {
    function test_GetAll();
    function test_GetOne();
    function test_Add();
    function test_Update();
    function test_Delete();
}
