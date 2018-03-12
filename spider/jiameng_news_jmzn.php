<?php
ini_set("memory_limit", "1024M");
include __DIR__ . '/../vendor/autoload.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
use phpspider\core\selector;
use phpspider\core\db;

/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    'name' => '全球加盟网——资讯——节能环保',
    'tasknum' => 1,
    //'save_running_state' => true,
    'log_show' => false,
    //'log_file' => 'data.log',
    //'log_type' => 'info',
    'domains' => array(
        'www.jiameng.com',
    ),
    'scan_urls' => array(
        // 随便定义一个入口，要不然会报没有入口url错误，但是这里其实没用
        // 节能环保咨询列表第一页
        "http://www.jiameng.com/zixun/newslist/261_1.htm",
    ),
    'list_url_regexes' => array(
        // 节能环保咨询列表
        "http://www.jiameng.com/zixun/newslist/261_\d+.htm",
        "http://www.jiameng.com/zixun/newslist/262_\d+.htm",
        "http://www.jiameng.com/zixun/newslist/263_\d+.htm",
        "http://www.jiameng.com/zixun/newslist/264_\d+.htm",
        "http://www.jiameng.com/zixun/newslist/259_\d+.htm",
        "http://www.jiameng.com/zixun/newslist/280_\d+.htm",
    ),
    'content_url_regexes' => array(
        // 节能环保咨询详情页
        "http://news.959.cn/\d+/\d+/\d+.shtml",
        "http://www.jiameng.com/zixun/news/[a-zA-Z0-9]*.htm",
    ),
    //'export' => array(
        //'type' => 'db', 
        //'table' => 'mafengwo_content',
    //),
    'db_config' => array(
        'host'  => '127.0.0.1',
        'port'  => 3306,
        'user'  => 'root',
        'pass'  => 'wuyanfeng1688',
        'name'  => 'mafengwo',
    ),
    'fields' => array(
        array(
            'name' => "title", // 资讯标题
            'selector' => "//h1[@class='title']",
            'required' => true,
        ),
        array(
            'name' => "content", // 资讯内容
            'selector' => "//div[@id='endText']",
            'required' => true,
        ),
        array(
            'name' => "time", // 发布时间
            'selector' => "//div[@class='s_title']/span[1]",
            'required' => true,
        ),
        array(
            'name' => "source", // 文章来源
            'selector' => "//div[@class='s_title']/span[2]/a",
            'required' => true,
        ),
    ),
);
/*db::set_connect('default', $configs['db_config']);
db::init_mysql();
$spider = new phpspider($configs);
$spider->on_start = function($phpspider) {
    requests::set_header('Referer','http://www.mafengwo.cn/mdd/citylist/21536.html');
    requests::set_useragent(array(
        "Mozilla/4.0 (compatible; MSIE 6.0; ) Opera/UCWEB7.0.2.37/28/",
        "Opera/9.80 (Android 3.2.1; Linux; Opera Tablet/ADR-1109081720; U; ja) Presto/2.8.149 Version/11.10",
        "Mozilla/5.0 (Android; Linux armv7l; rv:9.0) Gecko/20111216 Firefox/9.0 Fennec/9.0"
    ));
    $ips = array(
        "123.145.19.189",
        "112.65.193.15",
        "49.119.164.169",
        "106.11.226.94",
        "106.11.242.157",
        "123.145.8.77",
        "106.11.227.108",
        "106.11.225.191",
        "58.16.42.78",
        "106.11.226.124",
        "106.11.225.138",
        "106.11.226.163",
        "106.11.227.8",
        "106.11.226.143"
    );
    requests::set_client_ip($ips);
};

$spider->on_scan_page = function($page, $content, $phpspider) 
{
    for ($i = 2; $i <= 259; $i++) {
        // 加盟指南文章列表
        $url = "http://www.jiameng.com/zixun/newslist/261_{$i}.htm";
        $phpspider->add_url($url);
    }
    for ($j = 1; $j <= 191; $j++) {
        // 加盟指南文章列表
        $url = "http://www.jiameng.com/zixun/newslist/262_{$j}.htm";
        $phpspider->add_url($url);
    }
    for ($m = 1; $m <= 78; $m++) {
        // 加盟指南文章列表
        $url = "http://www.jiameng.com/zixun/newslist/263_{$m}.htm";
        $phpspider->add_url($url);
    }
    for ($n = 1; $n <= 67; $n++) {
        // 加盟指南文章列表
        $url = "http://www.jiameng.com/zixun/newslist/280_{$n}.htm";
        $phpspider->add_url($url);
    }
    for ($k = 1; $k <= 18; $k++) {
        // 加盟指南文章列表
        $url = "http://www.jiameng.com/zixun/newslist/264_{$k}.htm";
        $phpspider->add_url($url);
    }
    for ($a = 1; $a <= 15; $a++) {
        // 加盟指南文章列表
        $url = "http://www.jiameng.com/zixun/newslist/259_{$a}.htm";
        $phpspider->add_url($url);
    }
};

$spider->on_extract_field = function($fieldname, $data, $page) {
    return $data;
};

$spider->on_extract_page = function($page, $data) {
    $row = db::get_one("Select Count(*) As `count` From `jiameng_news_jmzn` Where `title`='{$data['title']}'");
    if (!$row['count']) {
        db::insert('jiameng_news_jmzn', $data);
    }
    return $data;
};
$spider->start();*/
$url = "http://www.jiameng.com/zixun/news/8714j7970217.htm";
$html = requests::get($url);

$selector = "//div[@id='endText']";

$result = selector::select($html, $selector);
print_r($html);

print_r("<br>");
print_r($result);