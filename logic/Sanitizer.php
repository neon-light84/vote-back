<?php

namespace app\logic;


class Sanitizer
{
    /**
     * @var array $sanitizersMap : ['sanitise_name' => 'method_name', ]
     */
    private static array $sanitizersMap = [
        'space_around' => 'spaceAround',
    ];

    public static function spaceAround($value): string
    {
        return trim($value);
    }

    /**
     * Чистит целый массив данных по указанным правила.
     * @param array &$data Данные, ключ-значение ['field' => 'value', ...]
     * @param array $rules Правила имеют формат: ['field' => [sanitize_name1, sanitize_name2, ... ], ...]  . Санитайзеров на каждое поле может быть несколько.
     * Результат вернется в тот же параметр, он по ссылке!
     */
    public static function sanitise (array &$data, array $rules) {
        foreach ($data as $field => $value) {
            if (!array_key_exists($field, $rules)) continue;
            $currentSanitisers = $rules[$field] ?? [] ;
            if (!is_array($currentSanitisers)) $currentSanitisers = [$currentSanitisers];  // вдруг в правилах, для текущего поля, подали единственное правило санитайза, вне массива
            for ($i = 0; $i < count($currentSanitisers); $i++) {
                if (array_key_exists($currentSanitisers[$i], static::$sanitizersMap)) {
                    $currentMethod = static::$sanitizersMap[$currentSanitisers[$i]];
                    if (method_exists(Static::class, $currentMethod)) {
                        $data[$field] = static::$currentMethod($value);
                    }
                }
            }
        }
    }
}
