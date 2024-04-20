<?php

namespace CmdOutput;

class Color
{
    // 黑色
    const BLACK = 30;
    const BG_BLACK = 40;

    // 红色
    const RED = 31;
    const BG_RED = 41;

    // 绿色
    const GREEN = 32;
    const BG_GREEN = 42;

    // 黄色
    const YELLOW = 33;
    const BG_YELLOW = 43;

    // 蓝色
    const BLUE = 34;
    const BG_BLUE = 44;

    // 紫红色
    const PURPLE = 35;
    const BG_PURPLE = 45;

    // 青蓝色
    const CYAN = 36;
    const BG_CYAN = 46;

    // 灰色
    const GRAY = 37;
    const BG_GRAY = 47;

    /** @var int $color 字体颜色 */
    protected int $color = 30;

    /** @var int $backgroundColor 背景颜色 */
    protected int $backgroundColor = 0;

    public function setColor(int $color) : self
    {
        $this->color = $color;
        return $this;
    }

    public function template() : string
    {
        return "\033[{$this->color}m%s\033[0m";
    }

    public function render(string $text = '') : string
    {
       return printf($this->template(), $text);
    }
}
