<?php
declare(strict_types=1);

/**
 * @param object $object
 *
 * @return string
 */
function get_class_name(object $object): string
{
    $reflect = new ReflectionClass($object);

    return $reflect->getShortName();
}
