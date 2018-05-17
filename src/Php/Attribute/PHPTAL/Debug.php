<?php
/**
 * PHPTAL templating engine
 *
 * PHP Version 5
 *
 * @category HTML
 * @package  PHPTAL
 * @author   Laurent Bedubourg <lbedubourg@motion-twin.com>
 * @author   Kornel Lesiński <kornel@aardvarkmedia.co.uk>
 * @license  http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @link     http://phptal.org/
 */

namespace PhpTal\Php\Attribute\PHPTAL;

/**
 * @package PHPTAL
 * @author Laurent Bedubourg <lbedubourg@motion-twin.com>
 */
class Debug extends \PhpTal\Php\Attribute
{

    private $_oldMode;

    public function before(\PhpTal\Php\CodeWriter $codewriter)
    {
        $this->_oldMode = $codewriter->setDebug(true);
    }

    public function after(\PhpTal\Php\CodeWriter $codewriter)
    {
        $codewriter->setDebug($this->_oldMode);
    }
}
