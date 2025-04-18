<?php

namespace Handlers;

class FormValidator {
    public static function validateForm(int $minLength, int $maxLength, string $data): bool {
        $len = mb_strlen($data);
        return $len >= $minLength && $len <= $maxLength;
    }


    public static function requiredField($data) {
        return !empty($data);
    }

    public static function sanitizeData($data)
    {
        return htmlspecialchars($data);
    }
}
