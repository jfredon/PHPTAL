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

require_once 'config.php';
require_once 'PHPTAL.php';

if (!class_exists('DummyTag')) {
    class DummyTag {}
}

class TalAttributesTest extends PHPUnit2_Framework_TestCase 
{
    function testSimple()
    {
        $tpl = new PHPTAL('input/tal-attributes.01.html');
        $res = trim_string($tpl->execute());
        $exp = trim_file('output/tal-attributes.01.html');
        $this->assertEquals($exp, $res);
    }

    function testWithContent()
    {
        $tpl = new PHPTAL('input/tal-attributes.02.html');
        $tpl->spanClass = 'dummy';
        $res = trim_string($tpl->execute());
        $exp = trim_file('output/tal-attributes.02.html');
        $this->assertEquals($exp, $res);
    }

    function testMultiples()
    {
        $tpl = new PHPTAL('input/tal-attributes.03.html');
        $tpl->spanClass = 'dummy';
        $res = trim_string($tpl->execute());
        $exp = trim_file('output/tal-attributes.03.html');
        $this->assertEquals($exp, $res);
    }

    function testChain()
    {
        $tpl = new PHPTAL('input/tal-attributes.04.html');
        $tpl->spanClass = 'dummy';
        $res = trim_string($tpl->execute());
        $exp = trim_file('output/tal-attributes.04.html');
        $this->assertEquals($exp, $res);
    }

    function testMultipleChains()
    {
        $tpl = new PHPTAL('input/tal-attributes.05.html');
        $tpl->spanClass = 'dummy';
        $res = trim_string($tpl->execute());
        $exp = trim_file('output/tal-attributes.05.html');
        $this->assertEquals($exp, $res);
    }

    //TODO: test and implement xhtml boolean attributes
}
        
?>