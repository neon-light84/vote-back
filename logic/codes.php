<?php
namespace app\logic;

/*
 * коды и прочих действий и событий
 */
class codes {

    /**
     * @var array[] коды ошибок при рест запросах
     */
    public static $restError = [
        'BAD_JSON' => ['code' => 100, 'mess' => 'Не удалось распарсить JSON'],
        'NO_DATA' => ['code' => 101, 'mess' => 'Нет data в пост данных'],
        'NOT_FULL_DATA' => ['code' => 102, 'mess' => 'Поле data в пост данных не полностью заполнено'],
    ];

}
