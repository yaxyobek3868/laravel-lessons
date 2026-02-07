<?php

namespace App\Enums;

enum UserRole: int
{
    case Admin = 1;
    case Teacher = 2;
    case Student = 3;


    public function isAdmin(): bool
    {
        return self::Admin == $this;
    }

    public function isTeacher(): bool
    {
        return self::Teacher == $this;
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
