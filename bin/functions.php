<?php
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 2020/4/25
 * Time: 14:07
 */
class UnsetArrayValue
{
    /**
     * Restores class state after using `var_export()`.
     *
     * @param array $state
     * @return UnsetArrayValue
     * @see var_export()
     * @since 2.0.16
     */
    public static function __set_state($state)
    {
        return new self();
    }
}

class ReplaceArrayValue
{
    /**
     * @var mixed value used as replacement.
     */
    public $value;


    /**
     * Constructor.
     * @param mixed $value value used as replacement.
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Restores class state after using `var_export()`.
     *
     * @param array $state
     * @return ReplaceArrayValue
     * @throws Exception when $state property does not contain `value` parameter
     * @see var_export()
     * @since 2.0.16
     */
    public static function __set_state($state)
    {
        if (!isset($state['value'])) {
            throw new Exception('Failed to instantiate class "ReplaceArrayValue". Required parameter "value" is missing');
        }

        return new self($state['value']);
    }
}

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

if (!function_exists('mergeArray')) {
    function mergeArray($a, $b)
    {
        $args = func_get_args();
        $res = array_shift($args);
        while (!empty($args)) {
            foreach (array_shift($args) as $k => $v) {
                if ($v instanceof UnsetArrayValue) {
                    unset($res[$k]);
                } elseif ($v instanceof ReplaceArrayValue) {
                    $res[$k] = $v->value;
                } elseif (is_int($k)) {
                    if (in_array($v, $res)) {
                        continue;
                    }
                    if (array_key_exists($k, $res)) {
                        $res[] = $v;
                    } else {
                        $res[$k] = $v;
                    }
                } elseif (is_array($v) && isset($res[$k]) && is_array($res[$k])) {
                    $res[$k] = mergeArray($res[$k], $v);
                } else {
                    $res[$k] = $v;
                }
            }
        }

        return $res;
    }
}