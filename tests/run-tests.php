<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//  
//  Copyright (c) 2004 Laurent Bedubourg
//  
//  This library is free software; you can redistribute it and/or
//  modify it under the terms of the GNU Lesser General Public
//  License as published by the Free Software Foundation; either
//  version 2.1 of the License, or (at your option) any later version.
//  
//  This library is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
//  Lesser General Public License for more details.
//  
//  You should have received a copy of the GNU Lesser General Public
//  License along with this library; if not, write to the Free Software
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
//  
//  Authors: Laurent Bedubourg <lbedubourg@motion-twin.com>
//  

require_once 'PHPUnit2/Framework/TestResult.php';
require_once 'PHPUnit2/Framework/Test.php';
require_once 'PHPUnit2/Framework/TestCase.php';
require_once 'PHPUnit2/Framework/TestSuite.php';
require_once 'PHPUnit2/TextUI/ResultPrinter.php';

$old_error_report_value = error_reporting( E_ALL | E_STRICT );

$printer = new PHPUnit2_TextUI_ResultPrinter();
$result = new PHPUnit2_Framework_TestResult();
$result->addListener( $printer );

$d = dir( dirname(__FILE__) );
while ($entry = $d->read()) {
    if (preg_match('/(.*?Test).php$/', $entry, $m)) {
        require_once $entry;
        $testclass = new ReflectionClass( $m[1] );
        $suite = new PHPUnit2_Framework_TestSuite($testclass);
        $suite->run($result);
    }
}
$printer->printResult( $result, 0 );


error_reporting( $old_error_report_value );
?>