<?php
/**
 * File containing a Io Handler test
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace eZ\Publish\Core\IO\Tests;
use eZ\Publish\Core\IO\LegacyHandler as Legacy,
    eZ\Publish\SPI\IO\BinaryFile,
    eZ\Publish\SPI\IO\BinaryFileCreateStruct,
    eZ\Publish\SPI\IO\BinaryFileUpdateStruct,
    eZ\Publish\Core\IO\Tests\Base as BaseHandlerTest,
    eZClusterFileHandler,
    ezcBaseFile;

/**
 * Handler test
 */
class LegacyTest extends BaseHandlerTest
{
    /**
     * @return \eZ\Publish\SPI\IO\Handler
     */
    protected function getIoHandler()
    {
        return new Legacy();
    }

    protected function tearDown()
    {
        if ( file_exists( 'var/test' ) )
        {
            ezcBaseFile::removeRecursive( 'var/test' );
        }
        parent::tearDown();
    }

    /**
     * Updating mtime isn't supported by the Legacy handler
     */
    public function testUpdateMtime()
    {
        self::markTestIncomplete( "Not supported by Legacy io handler, aka incomplete" );
    }

    /**
     * Updating ctime isn't supported by the Legacy handler
     */
    public function testUpdateCtime()
    {
        self::markTestIncomplete( "Not supported by Legacy io handler, aka incomplete" );
    }
}
