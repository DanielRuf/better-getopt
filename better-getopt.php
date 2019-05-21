<?php

$arguments = $GLOBALS["argv"];
array_shift($arguments);
$arguments_processed = [];
$arguments_processed_last = "";

$arguments_len = count($arguments);
for ($i = 0; $i < $arguments_len; $i++) {
    if (strpos($arguments[$i], "-") === 0) {
        if (strpos($arguments[$i], "=") > 0) {
            $argument_kv = explode("=", $arguments[$i]);
            $arguments_processed[$argument_kv[0]] = isset($argument_kv[1])
                ? $argument_kv[1]
                : "";
            $arguments_processed_last = $argument_kv[0];
        } else {
            $arguments_processed_last = $arguments[$i];
            $arguments_processed[$arguments[$i]] = "";
        }
    } else {
        if (!is_array($arguments_processed[$arguments_processed_last])) {
            if ($arguments_processed[$arguments_processed_last] !== "") {
                $arguments_processed[$arguments_processed_last] = [$arguments_processed[$arguments_processed_last]];
                $arguments_processed[$arguments_processed_last][] = $arguments[$i];
            } else {
                $arguments_processed[$arguments_processed_last] = $arguments[$i];
            }
        } else {
            $arguments_processed[$arguments_processed_last][] = $arguments[$i];
        }
    }
}