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

error_reporting(E_ALL | E_STRICT);
$testDir = dirname(__FILE__);
chdir($testDir);

define('PHPTAL_FORCE_REPARSE', 1);
ini_set('include_path', $testDir .'/../classes:'. ini_get('include_path'));


function trim_file( $src ){
    return trim_string( join('', file($src) ) );
}

function trim_string( $src ){
    $src = trim($src);
    $src = preg_replace('/\s+/sm', ' ', $src);
    $src = str_replace('\n', ' ', $src);
    $src = str_replace('> ', '>', $src);
    $src = str_replace(' <', '<', $src);
    return $src;
}


?>