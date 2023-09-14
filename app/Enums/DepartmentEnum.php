<?php

namespace App\Enums;

enum DepartmentEnum : string
{
    case HR = 'HR';
    case FINANCE = 'Finance';
    case ENGINEERING = 'Engineering';
    case MARKETING = 'Marketing';
    case SALES = 'Sales';
    case SUPPORT = 'Support';
    case OTHER = 'Other';

    public static function all()
    {
        return [
            self::HR,
            self::FINANCE,
            self::ENGINEERING,
            self::MARKETING,
            self::SALES,
            self::SUPPORT,
            self::OTHER,
        ];
    }
}
