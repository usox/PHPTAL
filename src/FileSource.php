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

namespace PhpTal;

/**
 * Reads template from the filesystem
 *
 * @package PHPTAL
 */
class FileSource implements SourceInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * FileSource constructor.
     * @param string $path
     * @throws Exception\IOException
     */
    public function __construct($path)
    {
        $this->path = realpath($path);
        if ($this->path === false) {
            throw new Exception\IOException("Unable to find real path of file '$path' (in " . getcwd() . ')');
        }
    }

    /**
     * @return string
     */
    public function getRealPath()
    {
        return $this->path;
    }

    /**
     * @return bool|int
     */
    public function getLastModifiedTime()
    {
        return filemtime($this->path);
    }

    /**
     * @return string
     * @throws Exception\IOException
     */
    public function getData()
    {
        $content = file_get_contents($this->path);

        // file_get_contents returns "" when loading directory!?
        if (false === $content || ('' === $content && is_dir($this->path))) {
            throw new Exception\IOException('Unable to load file ' . $this->path);
        }
        return $content;
    }
}
