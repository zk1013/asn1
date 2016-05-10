<?php

use ASN1\Element;
use ASN1\Type\Primitive\NullType;
use ASN1\Type\Tagged\ContextSpecificTaggedType;
use ASN1\Type\Tagged\ExplicitlyTaggedType;
use ASN1\Type\Tagged\ExplicitTagging;
use ASN1\Type\TaggedType;


/**
 * @group tagging
 * @group explicit-tag
 */
class ExplicitlyTaggedtypeTest extends PHPUnit_Framework_TestCase
{
	public function testCreate() {
		$el = new ExplicitlyTaggedType(1, new NullType());
		$this->assertInstanceOf(ExplicitTagging::class, $el);
		return $el;
	}
	
	/**
	 * @depends testCreate
	 *
	 * @param ContextSpecificTaggedType $el
	 */
	public function testGetElement(ContextSpecificTaggedType $el) {
		$this->assertEquals(Element::TYPE_NULL, $el->element()
			->tag());
	}
	
	/**
	 * @depends testCreate
	 *
	 * @param ExplicitTagging $el
	 */
	public function testGetExplicit(ExplicitTagging $el) {
		$this->assertEquals(Element::TYPE_NULL, $el->explicit()
			->tag());
	}
	
	/**
	 * @depends testCreate
	 * @expectedException UnexpectedValueException
	 *
	 * @param ExplicitTagging $el
	 */
	public function testExpectationFail(ExplicitTagging $el) {
		$el->explicit(Element::TYPE_BOOLEAN);
	}
	
	/**
	 * @depends testCreate
	 *
	 * @param ExplicitlyTaggedType $el
	 */
	public function testExpectTagged(ExplicitlyTaggedType $el) {
		$this->assertInstanceOf(TaggedType::class, $el->expectTagged());
	}
	
	/**
	 * @depends testCreate
	 *
	 * @param ExplicitlyTaggedType $el
	 */
	public function testExpectTag(ExplicitlyTaggedType $el) {
		$this->assertInstanceOf(TaggedType::class, $el->expectTagged(1));
	}
	
	/**
	 * @depends testCreate
	 * @expectedException UnexpectedValueException
	 *
	 * @param ExplicitlyTaggedType $el
	 */
	public function testExpectTagFail(ExplicitlyTaggedType $el) {
		$el->expectTagged(2);
	}
}