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

// METAL Specification 1.0
//
//      argument ::= expression
//
// Example:
// 
//      <hr />
//      <p metal:use-macro="here/master_page/macros/copyright">
//      <hr />
//
// PHPTAL: (here not supported)
//
//      <?= phptal_macro( $tpl, 'master_page.html/macros/copyright'); ? >
//

/**
 * @author Laurent Bedubourg <lbedubourg@motion-twin.com>
 * @package PHPTAL
 */
class PHPTAL_Attribute_METAL_UseMacro extends PHPTAL_Attribute
{
    public function start()
    {
        // reset template slots on each macro call ?
        $this->tag->generator->pushCode('$tpl->pushSlots()');
        
        foreach ($this->tag->children as $child){
            $this->generateFillSlots($child);
        }

        if (preg_match('/^[a-z0-9_]+$/', $this->expression)){
            $code = sprintf('%s%s($tpl)', 
                            $this->tag->generator->getFunctionPrefix(),
                            $this->expression);
            $this->tag->generator->pushCode($code);
        }
        else {
            $code = phptal_tales_string($this->expression);
            $code = sprintf('<?php $tpl->executeMacro(%s); ?>', $code);
            $this->tag->generator->pushHtml($code);
        }
        $this->tag->generator->pushCode('$tpl->popSlots()');
    }
    
    public function end()
    {
    }

    private function generateFillSlots($tag)
    {
        if (! $tag instanceOf PHPTAL_NodeTree ) return;
        if (array_key_exists('metal:fill-slot', $tag->attributes)){
            $tag->generate();
            return;
        }
        if (array_key_exists('tal:define', $tag->attributes)){
            $tag->generate();
            return;
        }
        
        foreach ($tag->children as $child){
            $this->generateFillSlots($child);
        }
    }
}

?>