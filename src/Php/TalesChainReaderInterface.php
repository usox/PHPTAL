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

namespace PhpTal\Php;

/**
 * @package PHPTAL
 */
interface TalesChainReaderInterface
{
    public function talesChainNothingKeyword(TalesChainExecutor $executor);
    public function talesChainDefaultKeyword(TalesChainExecutor $executor);
    public function talesChainPart(TalesChainExecutor $executor, $expression, $islast);
}
