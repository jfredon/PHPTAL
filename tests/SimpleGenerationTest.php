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
require_once 'PHPTAL/Parser.php';
require_once 'PHPTAL/CodeGenerator.php';

class SimpleGenerationTest extends PHPUnit2_Framework_TestCase
{
    function testTreeGeneration()
    {
        $generator = new PHPTAL_CodeGenerator();
        $parser = new PHPTAL_Parser( $generator );
        $tree = $parser->parseFile('input/parser.01.xml');
        $generator->doFunction('test', '$tpl');
        $tree->generate();
        $generator->doEnd();
        $result = $generator->getResult();

        // WILL FAIL LATER because php will try to interpret <?xml...
        $expected = <<<EOS
<?php 
function test( \$tpl ) {
\$tpl->setDocType('<?xml version="1.0"?>') ;
?>
<html>
  <head>
    <title>test document</title>
  </head>
  <body>
    <h1>test document</h1>
    <a href="http://phptal.sf.net">phptal</a>
  </body>
</html><?php
}

 ?>
EOS;
        $result = $this->trimCode($result);
        $expected = $this->trimCode($expected);
        $this->assertEquals($result, $expected);
    }

    function testFunctionsGeneration()
    {
        $generator = new PHPTAL_CodeGenerator();
        $generator->doFunction('test1', '$tpl');
        $generator->pushString('test1');
        $generator->doFunction('test2', '$tpl');
        $generator->pushString('test2');
        $generator->doEnd();
        $generator->pushString('test1');
        $generator->doEnd();
        $res = $generator->getResult();
        $exp = <<<EOS
<?php function test2( \$tpl ) {?>test2<?php}?>
<?php function test1( \$tpl ) {?>test1test1<?php}?>
EOS;
        $res = $this->trimCode($res);
        $exp = $this->trimCode($exp);
        $this->assertEquals($exp, $res);
    }


    function trimCode( $code )
    {
        $lines = split("\n", $code);
        $code = "";
        foreach ($lines as $line){
            $code .= trim($line);
        }
        return $code;
    }
}

?>