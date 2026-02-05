<?php

namespace App\Enums;

enum UserRole
{
    const int Admin = 1;
    const int Teacher = 2;
    const int Student = 3;

    public function isAdmin(): bool
    {
        return self::Admin == $this;
    }


    public static function lists(): array
    {
        return [
            self::Admin,
            self::Teacher,
            self::Student,
        ];
    }


    public static function person(): array
    {
        return [
            "student" => self::Student,
            "teacher" => self::Teacher,
        ];
    }
}
