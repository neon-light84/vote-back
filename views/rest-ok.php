<?php
if (!is_array($restData ?? null)) $restData = [$restData];
$strAjax = json_encode(['status' => 'success', 'data' => $restData]);
if (!$strAjax) {
    $strAjax = json_encode([
        'status' => 'error',
        'message' => 'Не удалось привести днные к формату JSON',
        'extendMessage' => 'Во вьюхе, которая из уже готовых данных конструирует json, не отработала функция json_encode.',
    ]);
}
echo $strAjax;
