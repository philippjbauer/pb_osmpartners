<?php
namespace PhilippBauer\PbOsmpartners\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Philipp Bauer <hello@philippbauer.org>
 */
class MapTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \PhilippBauer\PbOsmpartners\Domain\Model\Map
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new \PhilippBauer\PbOsmpartners\Domain\Model\Map();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );

    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getLatitudeReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getLatitude()
        );

    }

    /**
     * @test
     */
    public function setLatitudeForFloatSetsLatitude()
    {
        $this->subject->setLatitude(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'latitude',
            $this->subject,
            '',
            0.000000001
        );

    }

    /**
     * @test
     */
    public function getLongitudeReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getLongitude()
        );

    }

    /**
     * @test
     */
    public function setLongitudeForFloatSetsLongitude()
    {
        $this->subject->setLongitude(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'longitude',
            $this->subject,
            '',
            0.000000001
        );

    }

    /**
     * @test
     */
    public function getStylesReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getStyles()
        );

    }

    /**
     * @test
     */
    public function setStylesForStringSetsStyles()
    {
        $this->subject->setStyles('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'styles',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getPartnersReturnsInitialValueForPartner()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getPartners()
        );

    }

    /**
     * @test
     */
    public function setPartnersForObjectStorageContainingPartnerSetsPartners()
    {
        $partner = new \PhilippBauer\PbOsmpartners\Domain\Model\Partner();
        $objectStorageHoldingExactlyOnePartners = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOnePartners->attach($partner);
        $this->subject->setPartners($objectStorageHoldingExactlyOnePartners);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOnePartners,
            'partners',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function addPartnerToObjectStorageHoldingPartners()
    {
        $partner = new \PhilippBauer\PbOsmpartners\Domain\Model\Partner();
        $partnersObjectStorageMock = $this->getMock(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class, ['attach'], [], '', false);
        $partnersObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($partner));
        $this->inject($this->subject, 'partners', $partnersObjectStorageMock);

        $this->subject->addPartner($partner);
    }

    /**
     * @test
     */
    public function removePartnerFromObjectStorageHoldingPartners()
    {
        $partner = new \PhilippBauer\PbOsmpartners\Domain\Model\Partner();
        $partnersObjectStorageMock = $this->getMock(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class, ['detach'], [], '', false);
        $partnersObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($partner));
        $this->inject($this->subject, 'partners', $partnersObjectStorageMock);

        $this->subject->removePartner($partner);

    }
}
