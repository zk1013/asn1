<?php

namespace ASN1\Type\Primitive;

use ASN1\Type\PrimitiveString;
use ASN1\Type\UniversalClass;

/**
 * Implements <i>UniversalString</i> type.
 *
 * Universal string is an Unicode string with UCS-4 encoding.
 */
class UniversalString extends PrimitiveString
{
    use UniversalClass;
    
    /**
     * Constructor.
     *
     * @param string $string
     */
    public function __construct($string)
    {
        $this->_typeTag = self::TYPE_UNIVERSAL_STRING;
        parent::__construct($string);
    }
    
    /**
     *
     * {@inheritdoc}
     */
    protected function _validateString($string)
    {
        // UCS-4 has fixed with of 4 octets (32 bits)
        if (strlen($string) % 4 != 0) {
            return false;
        }
        return true;
    }
}
