<?php
declare(strict_types=1);

namespace Flynn314\ValueObject;

interface ValueObjectInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param string $value
     * @return static
     */
    public static function instance(string $value);

    /**
     * @param string $value
     * @return static
     */
    public static function instanceOrNull(string $value);

    public function equals(self $object): bool;

    public function __toString(): string;
}
