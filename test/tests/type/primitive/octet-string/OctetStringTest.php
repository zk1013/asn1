<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Sop\ASN1\Element;
use Sop\ASN1\Type\Primitive\NullType;
use Sop\ASN1\Type\Primitive\OctetString;
use Sop\ASN1\Type\UnspecifiedType;

/**
 * @group type
 * @group octet-string
 *
 * @internal
 */
class OctetStringTest extends TestCase
{
    public function testCreate()
    {
        $el = new OctetString('');
        $this->assertInstanceOf(OctetString::class, $el);
        return $el;
    }

    /**
     * @depends testCreate
     *
     * @param Element $el
     */
    public function testTag(Element $el)
    {
        $this->assertEquals(Element::TYPE_OCTET_STRING, $el->tag());
    }

    /**
     * @depends testCreate
     *
     * @param Element $el
     *
     * @return string
     */
    public function testEncode(Element $el): string
    {
        $der = $el->toDER();
        $this->assertIsString($der);
        return $der;
    }

    /**
     * @depends testEncode
     *
     * @param string $data
     *
     * @return OctetString
     */
    public function testDecode(string $data): OctetString
    {
        $el = OctetString::fromDER($data);
        $this->assertInstanceOf(OctetString::class, $el);
        return $el;
    }

    /**
     * @depends testCreate
     * @depends testDecode
     *
     * @param Element $ref
     * @param Element $el
     */
    public function testRecoded(Element $ref, Element $el)
    {
        $this->assertEquals($ref, $el);
    }

    /**
     * @depends testCreate
     *
     * @param Element $el
     */
    public function testWrapped(Element $el)
    {
        $wrap = new UnspecifiedType($el);
        $this->assertInstanceOf(OctetString::class, $wrap->asOctetString());
    }

    public function testWrappedFail()
    {
        $wrap = new UnspecifiedType(new NullType());
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(
            'OCTET STRING expected, got primitive NULL');
        $wrap->asOctetString();
    }
}
