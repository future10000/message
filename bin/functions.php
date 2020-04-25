<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/25
 * Time: 14:07
 */

if (!function_exists('config')) {
    function config(string $key = null)
    {
        $ret = include __DIR__ . '/../config/main.php';
        if (file_exists(__DIR__ . '/../config/main-local.php')) {
            $local = include __DIR__ . '/../config/main-local.php';
            $ret = array_merge($ret, $local);
        }
        if ($key) {
            $keyPath = explode('.', $key);
            foreach ($keyPath as $p) {
                $ret = $ret[$p] ?? null;
                if (!is_array($ret)) {
                    return $ret;
                }
            }
        }

        return $ret;
    }
}