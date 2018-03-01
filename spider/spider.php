<?php

include __DIR__ . '/../vendor/autoload.php';
use phpspider\core\phpspider;
use phpspider\core\requests;

/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    /**
     * 定义当前爬虫名称
     *
     */
    'name' => '糗事百科',

    /**
     * 是否显示日志 为true时显示调试信息 为false时显示爬取面板
     *
     */
    'log_show' => false,

    /**
     * 日志文件路径
     *
     */
    'log_file' => 'data.log',

    /**
     * 显示和记录的日志类型
     * 普通类型: info
     * 警告类型: warn
     * 调试类型: debug
     * 错误类型: error
     *
     */
    'log_type' => 'info',

    /**
     * 输入编码
     * 明确指定输入的页面编码格式(UTF-8,GB2312,…..)，防止出现乱码,如果设置null则自动识别
     *
     */
    // 'input_encoding' => 'UTF-8',

    /**
     * 输出编码
     * 明确指定输出的编码格式(UTF-8,GB2312,…..)，防止出现乱码,如果设置null则为utf-8
     *
     */
    // 'output_encoding' => 'UTF-8',

    /**
     * 同时工作的爬虫任务数
     * 需要配合redis保存采集任务数据，供进程间共享使用
     *
     */
    // 'tasknum' => 5,

    /**
     * 多服务器处理
     * 需要配合redis来保存采集任务数据，供多服务器共享数据使用
     *
     */
    // 'multiserver' => true,

    /**
     * 服务器ID
     * serverid默认值为1
     * 启用第二台服务器
     *
     */
    // 'serverid' => 2,

    /**
     * 保存爬虫运行状态
     * 需要配合redis来保存采集任务数据，供程序下次执行使用
     * 注意：多任务处理和多服务器处理都会默认采用redis，可以不设置这个参数
     * save_running_state默认值为false，即不保存爬虫运行状态
     *
     */
    // 'save_running_state' => true,

    /**
     * redis配置
     * 保存爬虫运行状态、多任务处理 和 多服务器处理 都需要redis来保存采集任务数据
     *
     */
    /*'queue_config' => array(
        'host'      => '127.0.0.1',
        'port'      => 6379,
        'pass'      => '',
        'db'        => 5,
        'prefix'    => 'phpspider',
        'timeout'   => 30,
    ),*/

    /**
     * 代理服务器
     * 如果爬取的网站根据IP做了反爬虫, 可以设置此项
     *
     */
    // 普通代理
    // 'proxy' => array('http://host:port'),
    // 验证代理
    // 'proxy' => array('http://user:pass@host:port'),

    /**
     * 爬虫爬取每个网页的时间间隔
     * 单位：毫秒
     *
     */
    // 'interval' => 1000,

    /**
     * 爬虫爬取每个网页的超时时间
     * 单位：秒
     *
     */
    // 'timeout' => 5,

    /**
     * 爬虫爬取每个网页失败后尝试次数
     * 网络不好可能导致爬虫在超时时间内抓取失败, 可以设置此项允许爬虫重复爬取
     * max_try默认值为0，即不重复爬取
     * 重复爬取5次
     *
     */
    // 'max_try' => 5,

    /**
     * 爬虫爬取网页深度，超过深度的页面不再采集
     * 对于抓取最新内容的增量更新，抓取好友的好友的好友这类型特别有用
     * max_depth默认值为0，即不限制
     *
     */
    // 'max_depth' => 5

    /**
     * 爬虫爬取内容网页最大条数
     * 抓取到一定的字段后退出
     * max_fields默认值为0，即不限制
     *
     */
    // 'max_fields' => 100

    /**
     * 爬虫爬取网页所使用的浏览器类型
     * phpspider::AGENT_ANDROID
     * phpspider::AGENT_IOS
     * phpspider::AGENT_PC
     * phpspider::AGENT_MOBILE
     * phpspider::AGENT_ANDROID, 表示爬虫爬取网页时, 使用安卓手机浏览器
     * phpspider::AGENT_IOS, 表示爬虫爬取网页时, 使用苹果手机浏览器
     * phpspider::AGENT_PC, 表示爬虫爬取网页时, 使用PC浏览器
     * phpspider::AGENT_MOBILE, 表示爬虫爬取网页时, 使用移动设备浏览器
     *
     */
    // 使用内置的枚举类型
    // 'user_agent' => phpspider::AGENT_ANDROID
    // 使用自定义类型
    // 'user_agent' => "Mozilla/5.0"
    // 随机浏览器类型，用于破解防采集
    /*'user_agent' => array(
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36",
        "Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_3 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13G34 Safari/601.1",
        "Mozilla/5.0 (Linux; U; Android 6.0.1;zh_cn; Le X820 Build/FEXCNFN5801507014S) AppleWebKit/537.36 (KHTML, like Gecko)Version/4.0 Chrome/49.0.0.0 Mobile Safari/537.36 EUI Browser/5.8.015S",
    )*/

    /**
     * 爬虫爬取网页所使用的伪IP，用于破解防采集
     *
     */
    // 'client_ip' => '192.168.0.2'

    /**
     * 随机伪造IP，用于破解防采集
     *
     */
    /*'client_ip' => array(
        '192.168.0.2', 
        '192.168.0.3',
        '192.168.0.4',
    )*/

    /**
     * 爬虫爬取数据导出
     * type：导出类型 csv、sql、db
     * file：导出 csv、sql 文件地址
     * table：导出db、sql数据表名
     * 注意导出到数据库的表和字段要和上面的fields对应
     *
     */
    // 导出CSV结构数据到文件
    /*'export' => array(
        'type' => 'csv', 
        'file' => './data/qiushibaike.csv', // data目录下
    )*/
    // 导出SQL语句到文件
    /*'export' => array(
        'type'  => 'sql',
        'file'  => './data/qiushibaike.sql',
        'table' => '数据表',
    )*/
    // 导出数据到Mysql
    /*'export' => array(
        'type' => 'db',
        'table' => '数据表',  // 如果数据表没有数据新增请检查表结构和字段名是否匹配
    )*/

    /**
     * 数据库配置
     *
     */
    /*'db_config' => array(
        'host'  => '127.0.0.1',
        'port'  => 3306,
        'user'  => 'root',
        'pass'  => 'root',
        'name'  => 'demo',
    )*/

    /**
     * 定义爬虫爬取哪些域名下的网页, 非域名下的url会被忽略以提高爬取速度
     *
     */
    'domains' => array(
        'qiushibaike.com',
        'www.qiushibaike.com'
    ),

    /**
     * 定义爬虫的入口链接, 爬虫从这些链接开始爬取,同时这些链接也是监控爬虫所要监控的链接
     *
     */
    'scan_urls' => array(
        'http://www.qiushibaike.com/'
    ),

    /**
     * 定义内容页url的规则
     * 内容页是指包含要爬取内容的网页 比如http://www.qiushibaike.com/article/115878724
     * 就是糗事百科的一个内容页
     *
     */
    'content_url_regexes' => array(
        "http://www.qiushibaike.com/article/\d+"
    ),

    /**
     * 定义列表页url的规则
     * 对于有列表页的网站, 使用此配置可以大幅提高爬虫的爬取速率
     * 列表页是指包含内容页列表的网页 比如http://www.qiushibaike.com/8hr/page/2/?s=4867046
     * 就是糗事百科的一个列表页
     *
     */
    'list_url_regexes' => array(
        "http://www.qiushibaike.com/8hr/page/\d+\?s=\d+"
    ),

    /**
     * 定义内容页的抽取规则
     * 规则由一个个field组成, 一个field代表一个数据抽取项
     * name 给此项数据起个变量名
     * selector 定义抽取规则, 默认使用xpath
     * selector_type 目前可用xpath, jsonpath, regex 默认xpath
     * required 定义该field的值是否必须, 默认false
     * repeated 定义该field抽取到的内容是否是有多项, 默认false
     *          赋值为true的话, 无论该field是否真的是有多项, 抽取到的结果都是数组结构
     * children 为此field定义子项
     *          子项的定义仍然是一个fields数组
     *          没错, 这是一个树形结构
     *
     */
    'fields' => array(
        array(
            // 抽取内容页的文章内容
            'name' => "article_content",
            'selector' => "//*[@id='single-next-link']",
            'required' => true
        ),
        array(
            // 抽取内容页的文章作者
            'name' => "article_author",
            'selector' => "//div[contains(@class,'author')]//h2",
            'required' => true
        ),
    ),
);
// $spider = new phpspider($configs);
// $spider->start();