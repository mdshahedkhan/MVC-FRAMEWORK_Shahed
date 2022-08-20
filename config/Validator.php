<?php

namespace App\Config;

class Validator
{
    private static array $data;
    private const REQUIRED = 'required', EMAIL = 'email', MIN = "min", MAX = 'max';
    public static array $errors = [];

    /**
     * @param $rules
     * @param $data
     * @return void
     */
    private static function CheckValidation($rules, $data): void
    {
        foreach ($rules as $key => $ValidationRuleArrs) {
            foreach ($ValidationRuleArrs as $_ => $attribute) {
                if (self::REQUIRED === $attribute) {
                    foreach ($data as $requestAttribute => $__) {
                        if (isset(Request::all()[$requestAttribute]) && Request::all()[$requestAttribute] === '') {
                            self::addError($requestAttribute, "The $requestAttribute field is required.");
                        }
                    }
                }
                if (self::EMAIL === $attribute) {
                    foreach ($data as $requiredField => $__) {
                        if (!filter_var(Request::all()[$requiredField], FILTER_VALIDATE_EMAIL)) {
                            self::addError($requiredField, "The $requiredField field is must be valid email address.");
                        }
                    }
                }
            }
        }
    }

    public function validate(array $data, array $rules): void
    {
        self::$data = $data;
        array_map(function ($key) use ($data) {
            return $data[$key];
        }, array_keys($rules));
        foreach ($rules as $key => $rule) {
            self::CheckValidation($rules, $data);
        }
    }


    private static function addError($key, $message): void
    {
        self::$errors[$key] = $message;
        dd(self::$errors);
    }


}