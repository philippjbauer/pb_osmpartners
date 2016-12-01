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
    public function listActionFetchesAllMapsFromRepositoryAndAssignsThemToView()
    {

        $allMaps = $this->getMock(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class, [], [], '', false);

        $mapRepository = $this->getMock(\PhilippBauer\PbOsmpartners\Domain\Repository\MapRepository::class, ['findAll'], [], '', false);
        $mapRepository->expects(self::once())->method('findAll')->will(self::returnValue($allMaps));
        $this->inject($this->subject, 'mapRepository', $mapRepository);

        $view = $this->getMock(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class);
        $view->expects(self::once())->method('assign')->with('maps', $allMaps);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
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
