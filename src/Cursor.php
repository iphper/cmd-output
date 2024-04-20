<?php

namespace CmdOutput;

/**
 * @class Cursor
 * @desciption 光标操作类
 */
class Cursor
{
    /**
     * @const CMDS
     * 指令列表
     * 名称 => 指令
     */
    const COMMANDS = [
        'close' => '0m',
        'highlight' => '1m',
        'underline' => '4m',
        'flashing' => '5m',
        'reverse' => '7m',
        'blanking' => '8m',
        'clearScreen' => '2J',
        'clear' => '2J',
        'cls' => '2J',
        'clearToEnd' => 'K',
        'clearEnd' => 'K',
        'end' => 'K',
        'hidden' => '?25l',
        'hide' => '?25l',
        'visible' => '?25h',
        'enable' => '?25h',
        'show' => '?25h',
        'display' => '?25h',
        'clearAndTop' => '0H',
        'clearTop' => '0H',
        'top' => '0H',
    ];

    // 向上
    const UP = 'A';
    // 向下
    const DOWN = 'B';
    // 向左
    const LEFT = 'D';
    // 向右
    const RIGHT = 'C';

    // ====== protected methods ======
    /**
     * @method renderPosition
     * @desciption 渲染输出
     * @return void
     */
    protected function renderPosition($x = 0, $y = 0) : void
    {
        if ($x != 0) {
            $mode = $x > 0 ? static::RIGHT : static::LEFT;
            $this->render(abs($x) . $mode);
        }
        if ($y != 0) {
            $mode = $y > 0 ? static::DOWN : static::UP;
            $this->render(abs($y) . $mode);
        }
    }

    // ====== actions methods ======

    /**
     * @method render
     * @desciption 渲染指令
     * @return void
     */
    public function render($cmd) : void
    {
        printf("\033[%s", $cmd);
    }

    /**
     * @method up
     * @desciption 向上移
     * @param int $n 行数
     * @return self
     */
    public function up(int $n = 1) : self
    {
        return $this->setY(-$n);
    }

    /**
     * @method left
     * @desciption 向左移
     * @param int $n 字符数
     * @return self
     */
    public function left(int $n = 1) : self
    {
        return $this->setX(-$n);
    }

    /**
     * @method down
     * @desciption 向下移
     * @param int $n 行数
     * @return self
     */
    public function down(int $n = 1) : self
    {
        return $this->setY($n);
    }

    /**
     * @method right
     * @desciption 向右移
     * @param int $n 字符数
     * @return self
     */
    public function right(int $n = 1) : self
    {
        return $this->setX($n);
    }

    // ====== setter and getter ======
    /**
     * @method setX
     * @desciption X轴光标移动
     * @param int $x
     * @return self
     */
    public function setX(int $x) : self
    {
        $this->renderPosition($x, 0);
        return $this;
    }

    /**
     * @method setY
     * @desciption Y轴光标移动
     * @param int $y
     * @return self
     */
    public function setY(int $y) : self {
        $this->renderPosition(0, $y);
        return $this;
    }

    /**
     * @method position
     * @desciption 设置或移动光标位置
     * @param ?int $x
     * @param ?int $y
     * @return self|array
     */
    public function position(?int $x = null, ?int $y = null)
    {
        if (is_null($x) && is_null($y)) {
            // 返回位置
            return [
                'x' => $this->getX(),
                'y' => $this->getY(),
            ];
        }
        is_null($x) or $this->setY($y);
        is_null($y) or $this->setX($x);
        return $this;
    }

    // ====== 魔术方法 ======

    /**
     * @method __call
     * @desciption 魔术调用
     * @return mixed
     */
    public function __call(string $method, array $argv)
    {
        if (method_exists($this, $method)) {
            return \call_user_func([$this, $method], ...$argv);
        }

        if (isset(static::COMMANDS[$method])) {
            return $this->render(static::COMMANDS[$method]);
        }
    }

}
