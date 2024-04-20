# php-cmd-output
PHP命令行输出

##安装
```sh
composer require iphper/cmd-output
```

## 使用示例
### 字符串输出
```php
use CmdOutput\CmdOutput;
use CmdOutput\Color;

// 输出示例
$output = new CmdOutput();

// 输出
$output->output('第一行第一行第一行第一行第一行第一行第一行', Color::BLUE)
    ->output('第二行第二行第二行第二行第二行第二行第二行')
    ->setY(-1) // < 0 向上移一行； > 0 向下移一行 
    ->setX(4) // < 0 向左移一个字符； > 0 向右移一个字符
    ->setColor(Color::RED) // 设置颜色
    ->output('这是一个测试');
```

### 助手函数
```php
$output = cmd_output('第一行function测试', Color::RED)
    ->output('第二行function测试');
```

### 复杂数据输出
```php

use CmdOutput\CmdOutput;
use CmdOutput\Color;

// 输出示例
$output = new CmdOutput();
$output->output(['这是一个数组', 'color' => Color::RED])
    ->output($output);

$output->output(['这是一个数组'], Color::RED)
    ->output($output, Color::BLUE);
```

## 输出位置控制及光标操作
```php
use CmdOutput\CmdOutput;
use CmdOutput\Color;

// 输出示例
$output = new CmdOutput();

$output->clearScreen() // 清屏
    ->setColor(Color::BLACK)->output('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa')->output("\n")
    ->setColor(Color::RED)->output('bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb')->output("\n")
    ->setColor(Color::GREEN)->output('cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc')->output("\n")
    ->setColor(Color::YELLOW)->output('dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd')->output("\n")
    ->setColor(Color::BLUE)->output('eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee')->output("\n")
    ->setColor(Color::PURPLE)->output('ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff')->output("\n")
    ->setColor(Color::CYAN)->output('gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg')->output("\n")
    ->setColor(Color::GRAY)->output('hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh')->output("\n")
    ->underline() // 下划线
    ->up(8)->setColor(Color::GRAY)->output('*****') // 向上走八行，设置颜色，也就是第一行开始新输出
    ->flashing() // 闪烁
    ->down(1)->setColor(Color::CYAN)->output('-----') // 向下一行，设置颜色，接着上行行尾输出
    ->blanking() // 消隐
    ->down(1)->setColor(Color::PURPLE)->output('+++++') // 向下一行，设置颜色，接着上行行尾输出
    ->reverse() // 反显
    ->down(1)->setColor(Color::RED)->output('=====') // 向下一行，设置颜色，接着上行行尾输出
    ->clearToEnd() // 清除光标至行尾
    ->down(1)->left(20)->setColor(Color::GREEN)->output('#####') // 向下走一行，向左走20个字符位，设置颜色 输出
    ->top() // 清屏并置顶
    ->down(1)->setColor(Color::YELLOW)->output('@@@@@') // 向下一行，设置颜色，接着上行行尾输出
    ->hide() // 隐藏光标
    ->down(1)->setColor(Color::RED)->output('$$$$$') // 向下一行，设置颜色，接着上行行尾输出
    ->show() // 显示光标
    ->down(1)->right(55)->setColor(Color::GREEN)->output('[[[[[')// 向下走一行，向右走55个字符位，设置颜色 输出
    ->position(-20, -1)->setColor(Color::GREEN)->output('?????') // 向右走-20穿上字符位，向下走-1行，设置颜色，输出
    ->output("\n");
```