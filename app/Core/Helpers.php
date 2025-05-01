<?php
/* Đây là file chứa các hàm lặp đi lặp lại, khi cần thì gọi ở đây chứ không cần viết lại */

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key     The name of the environment variable.
     * @param  mixed   $default The default value to return if the variable is not set.
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = $_ENV[$key] ?? null;;

        if ($value === null) {
            return $default;
        }

        return $value;
    }
}