<?php
namespace PhilippBauer\PbOsmpartners\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Philipp Bauer <hello@philippbauer.org>
 */
class PartnerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \PhilippBauer\PbOsmpartners\Domain\Model\Partner
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new \PhilippBauer\PbOsmpartners\Domain\Model\Partner();
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
    public function getStreetReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getStreet()
        );

    }

    /**
     * @test
     */
    public function setStreetForStringSetsStreet()
    {
        $this->subject->setStreet('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'street',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getHousenoReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getHouseno()
        );

    }

    /**
     * @test
     */
    public function setHousenoForStringSetsHouseno()
    {
        $this->subject->setHouseno('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'houseno',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getZipReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getZip()
        );

    }

    /**
     * @test
     */
    public function setZipForStringSetsZip()
    {
        $this->subject->setZip('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'zip',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getCityReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCity()
        );

    }

    /**
     * @test
     */
    public function setCityForStringSetsCity()
    {
        $this->subject->setCity('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'city',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getStateReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getState()
        );

    }

    /**
     * @test
     */
    public function setStateForStringSetsState()
    {
        $this->subject->setState('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'state',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getUrlReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getUrl()
        );

    }

    /**
     * @test
     */
    public function setUrlForStringSetsUrl()
    {
        $this->subject->setUrl('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'url',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getSummaryReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSummary()
        );

    }

    /**
     * @test
     */
    public function setSummaryForStringSetsSummary()
    {
        $this->subject->setSummary('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'summary',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getDescriptionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDescription()
        );

    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription()
    {
        $this->subject->setDescription('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'description',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getExtraReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getExtra()
        );

    }

    /**
     * @test
     */
    public function setExtraForStringSetsExtra()
    {
        $this->subject->setExtra('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'extra',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getLogoReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getLogo()
        );

    }

    /**
     * @test
     */
    public function setLogoForFileReferenceSetsLogo()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setLogo($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'logo',
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
    public function getCountryReturnsInitialValueForCountry()
    {
    }

    /**
     * @test
     */
    public function setCountryForCountrySetsCountry()
    {
    }
}
