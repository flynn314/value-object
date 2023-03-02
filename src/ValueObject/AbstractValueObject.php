<?php
declare(strict_types=1);

namespace Flynn314\ValueObject;

use Flynn314\Exception\ValueObjectValidationException;

abstract class AbstractValueObject implements ValueObjectInterface
{
    /**
     * @var string|int
     */
    protected $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $this->getValidValue($value);
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return (string) $this->value;
    }

    /**
     * @inheritDoc
     */
    public static function instance(string $value)
    {
        return new static($value);
    }

    /**
     * @inheritDoc
     */
    public static function instanceOrNull(string $value)
    {
        try {
            return new static($value);
        } catch (ValueObjectValidationException $e) {
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function equals(ValueObjectInterface $object): bool
    {
        return $object instanceof static && $object->getValue() === $this->getValue();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->value;
    }

    protected function getValidationException($value): ValueObjectValidationException
    {
        return new ValueObjectValidationException($this, is_null($value) ? 'NULL' : $value);
    }

    protected function isValidValue($value): bool
    {
        return true;
    }

    /**
     * @param $value
     * @return string|int
     */
    protected function getValidValue($value)
    {
        if ($this->isValidValue($value)) {
            return $value;
        }

        throw $this->getValidationException($value);
    }
}
