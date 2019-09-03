<?php
/**
 * PHPTAL templating engine
 *
 * @category HTML
 * @package  PHPTAL
 * @author   Laurent Bedubourg <lbedubourg@motion-twin.com>
 * @author   Kornel Lesiński <kornel@aardvarkmedia.co.uk>
 * @license  http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @version  SVN: $Id: $
 * @link     http://phptal.org/
 */

namespace Tests;

use PhpTal\Exception\IOException;

class TemplateRepositoryTest extends \Tests\Testcase\PhpTal
{
    public function testLooksInRepo()
    {
        $tpl = $this->newPHPTAL();
        $tpl->setTemplateRepository(__DIR__ .'/input');
        $tpl->setTemplate('phptal.01.html');
        $tpl->execute();
    }

    public function testSkipsNotFound()
    {
        $tpl = $this->newPHPTAL();
        $tpl->setTemplateRepository(__DIR__ .'/invalid');
        $tpl->setTemplateRepository(__DIR__ .'/input');
        $tpl->setTemplateRepository(__DIR__ .'/bogus');
        $tpl->setTemplate('phptal.02.html');
        $tpl->execute();
    }

    public function testFailsIfNoneMatch()
    {
        $this->expectException(IOException::class);
        $tpl = $this->newPHPTAL();
        $tpl->setTemplateRepository(__DIR__ .'/invalid');
        $tpl->setTemplateRepository(__DIR__ .'/error');
        $tpl->setTemplateRepository(__DIR__ .'/bogus');
        $tpl->setTemplate('phptal.01.html');
        $tpl->execute();
    }

    public function testRepositoriesAreStrings()
    {
        $tpl = $this->newPHPTAL();
        $tpl->setTemplateRepository('/footest');
        $tpl->setTemplateRepository('bartest');
        $tpl->setTemplateRepository('testbaz/');

        $repos = $tpl->getTemplateRepositories();
        $this->assertIsArray($repos);
        $this->assertCount(3, $repos);

        foreach($repos as $repo)
        {
            $this->assertIsString($repo);
            $this->assertStringContainsString('test', $repo);
        }
    }

    public function testRepositoryClear()
    {
        $tpl = $this->newPHPTAL();
        $this->assertEquals(0, count($tpl->getTemplateRepositories()));

        $tpl->setTemplateRepository(array('foo', 'bar'));
        $this->assertEquals(2, count($tpl->getTemplateRepositories()));

        $tpl->clearTemplateRepositories();
        $this->assertEquals(0, count($tpl->getTemplateRepositories()));
    }
}
