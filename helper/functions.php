<?php

// +----------------------------------------------------
// | 助手函数
// +----------------------------------------------------

use CmdOutput\Output;

if (! function_exists('cmd_output')) {
    /**
     * @function cmd_output
     * @param mixed $text
     * @param ?int $color
     * @return Output
     */
    function cmd_output($text, ?int $color = null) : Output {
        return (new Output())->output(...func_get_args());
    }
}


