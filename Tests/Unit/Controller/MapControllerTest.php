<?php
namespace PhilippBauer\PbOsmpartners\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Philipp Bauer <hello@philippbauer.org>
 */
class MapControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \PhilippBauer\PbOsmpartners\Controller\MapController
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = $this->getMock(\PhilippBauer\PbOsmpartners\Controller\MapController::class, ['redirect', 'forward', 'addFlashMessage'], [], '', false);
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenMapToView()
    {
        $map = new \PhilippBauer\PbOsmpartners\Domain\Model\Map();

        $view = $this->getMock(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class);
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('map', $map);

        $this->subject->showAction($map);
    }
}
