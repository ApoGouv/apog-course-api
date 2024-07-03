<?php

namespace App\Enums;

enum CourseStatusEnum: string
{
    case PUBLISHED = 'Published';
    case PENDING = 'Pending';

    /**
     * cases() static method returns an array like this: 
     * [
     *     0 => CourseStatusEnum { +name: "PUBLISHED", +value: "Published" },
     *     1 => CourseStatusEnum { +name: "PENDING", +value: "Pending" }
     * ]
     */

    public static function getArrayNames(): array
    {
        return array_column(self::cases(), 'name');
    }
    
    public static function getArrayValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function toAssocArray(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }
}