<?php

namespace CmdOutput;

use CmdOutput\Color;

/**
 * @class Output
 * @desciption 命令行输出类
 */
class Output
{
    /** @var Cursor $cursor 光标对象 */
    protected Cursor $cursor;

    /** @var Color $color 颜色对象 */
    protected Color $color;

    /**
     * @method __construct
     * @desciption 构造方法
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * @method initialize
     * @desciption 初始化方法
     */
    protected function initialize()
    {
        // 字体颜色
        $this->color = new Color();
        $this->cursor = new Cursor();
    }

    /**
     * @method outputs
     * @desciption 多个输出
     * @param mixed $texts 数据
     * @param ?int $color 颜色
     * @return self
     */
    public function outputs($texts, ?int $color = null) : self
    {
        if (is_array($texts)) {
            // 一维转二维
            count($texts) === count($texts, 1) && ($texts = [$texts]);
            // 遍历数组
            foreach($texts as $item) {
                $this->output($item, $color ?? $item['color'] ?? null);
            }
        } else {
            $this->output($texts, $color);
        }
        return $this;
    }

    /**
     * @method output
     * @desciption 输出方法
     * @return int
     */
    public function output($text, ?int $color = null) : self
    {
        is_null($color) or $this->setColor($color);
        $text = var_export($text, true);
        foreach(['"','`',"'", ' '] as $c) {
            $text = trim($text, $c);
        }
        $this->color->render($text);
        return $this;
    }

    // ====== setter and getter ======
    /**
     * @method setColor
     * @desciption 设置颜色对象
     * @return self
     */
    public function setColorAttr(Color $color) : self
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @method getColor
     * @desciption 获取颜色对象
     * @return Color
     */
    public function getColorAttr() : Color
    {
        return $this->color();
    }

    /**
     * @method setCursor
     * @desciption 设置光标对象
     * @return self
     */
    public function setCursor(Cursor $cursor) : self
    {
        $this->cursor = $cursor;
        return $this;
    }

    /**
     * @method getCursor
     * @desciption 获取光标对象
     * @return Cursor
     */
    public function getCursor() : Cursor
    {
        return $this->cursor;
    }
    

    // ====== auto methods ======
    /**
     * @method __call
     * @desciption 魔术回调
     * @param string $name
     * @param array $argv
     * @return self
     */
    public function __call(string $name, array $argv) : self
    {
        // 本类如果存在方法则调用本类方法
        if (method_exists($this, $name)) {
            call_user_func([$this, $name], ...$argv);
            return $this;
        }
        
        // 没有就尝试关联类
        foreach(get_object_vars($this) as $attr) {
            if (is_object($attr) && method_exists($attr, $name)) {
                call_user_func([$attr, $name], ...$argv);
                return $this;
            }
        }

        // 光标指令操作
        if (! empty(Cursor::COMMANDS[$name])) {
            $this->cursor->render(Cursor::COMMANDS[$name]);
            return $this;
        }
        
        return $this;
    }

}
