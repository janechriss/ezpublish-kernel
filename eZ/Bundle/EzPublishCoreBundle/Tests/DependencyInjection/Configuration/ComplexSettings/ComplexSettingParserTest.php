<?php

/**
 * This file is part of the eZ Publish Kernel package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributd with this source code.
 */
namespace eZ\Bundle\EzPublishCoreBundle\Tests\DependencyInjection\Configuration\ComplexSettings;

use PHPUnit\Framework\TestCase;
use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\ComplexSettings\ComplexSettingParser;

class ComplexSettingParserTest extends TestCase
{
    /** @var ComplexSettingParser */
    private $parser;

    public function setUp()
    {
        $this->parser = new ComplexSettingParser();
    }

    /**
     * @dataProvider provideSettings
     */
    public function testContainsDynamicSettings($setting, $expected)
    {
        self::assertEquals($expected[0], $this->parser->containsDynamicSettings($setting), 'string');
    }

    /**
     * @dataProvider provideSettings
     */
    public function testParseComplexSetting($setting, $expected)
    {
        self::assertEquals($expected[1], $this->parser->parseComplexSetting($setting), 'string');
    }

    public function provideSettings()
    {
        // array( setting, array( isDynamicSetting, containsDynamicSettings ) )
        return array(
            array(
                '%container_var%',
                array(false, array()),
            ),
            array(
                '$somestring',
                array(false, array()),
            ),
            array(
                '$setting$',
                array(true, array('$setting$')),
            ),
            array(
                '$setting;scope$',
                array(true, array('$setting;scope$')),
            ),
            array(
                '$setting;namespace;scope$',
                array(true, array('$setting;namespace;scope$')),
            ),
            array(
                'a_string_before$setting;namespace;scope$',
                array(true, array('$setting;namespace;scope$')),
            ),
            array(
                '$setting;namespace;scope$a_string_after',
                array(true, array('$setting;namespace;scope$')),
            ),
            array(
                'a_string_before$setting;namespace;scope$a_string_after',
                array(true, array('$setting;namespace;scope$')),
            ),
            array(
                '$setting;one$somethingelse$setting;two$',
                array(true, array('$setting;one$', '$setting;two$')),
            ),
        );
    }
}
