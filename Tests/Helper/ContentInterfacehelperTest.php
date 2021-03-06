<?php
/**
 * This file is part of the Networking package.
 *
 * (c) net working AG <info@networking.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Networking\InitCmsBundle\Tests\Helper;

use Networking\InitCmsBundle\Helper\ContentInterfaceHelper;
use Networking\InitCmsBundle\Entity\Text;

class ContentInterfaceHelperTest extends \PHPUnit_Framework_TestCase
{
	public $object;
	public $text;

	public function setup()
	{
		$this->object = new ContentInterfaceHelper();
		$this->text = new Text();
		$this->text->setText('foo');
	}

	public function testCamelize()
	{
		$camel = $this->object->camelize('foo_bar');
		$this->assertEquals('FooBar', $camel);
		$camel = $this->object->camelize('foo');
		$this->assertEquals('Foo', $camel);
	}

	public function testSetFieldValueUnknown()
	{
		$x = $this->object->setFieldValue($this->text, 'other_field', 'bar');
		$this->assertInstanceOf('Networking\InitCmsBundle\Entity\Text', $x);
		$this->assertNotEquals('bar', $this->text->getText());
        $this->assertEquals('foo', $this->text->getText());
    }

	public function testSetFieldValue()
	{
        $this->object->setFieldValue($this->text, 'text', 'bar');
		$this->assertEquals('bar', $this->text->getText());
	}

	public function testGetFieldValue()
	{
		$x = $this->object->getFieldValue($this->text, 'text');
		$this->assertEquals('foo', $x);
	}

	/**
	 * @expectedException Sonata\AdminBundle\Exception\NoValueException
	 */
	public function testGetFieldValue_ShouldThrowException()
	{
		$this->object->getFieldValue($this->text, 'bar');
	}

}