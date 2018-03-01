<?php
ini_set("memory_limit", "1024M");
include __DIR__ . '/../vendor/autoload.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    'name' => '马蜂窝',
    'tasknum' => 1,
    //'save_running_state' => true,
    'log_show' => true,
    //'log_file' => 'data.log',
    //'log_type' => 'info',
    'domains' => array(
        'www.qidian.com',
        'book.qidian.com',
        'read.qidian.com',
    ),
    'scan_urls' => array(
        // 随便定义一个入口，要不然会报没有入口url错误，但是这里其实没用
        // "http://www.mafengwo.cn/travel-scenic-spot/mafengwo/10198.html",
        // "https://www.qidian.com/rank",
        "https://book.qidian.com/info/1009533893",
    ),
    'list_url_regexes' => array(
        // 城市列表页
        // "http://www.mafengwo.cn/mdd/base/list/pagedata_citylist\?page=\d+",
        // 文章列表页
        // "http://www.mafengwo.cn/gonglve/ajax.php\?act=get_travellist\&mddid=\d+",
        // 小说章节列表
        // "book.qidian.com/info/\d+",
    ),
    'content_url_regexes' => array(
        // "http://www.mafengwo.cn/i/\d+.html",
        "read.qidian.com/chapter/\.+",
    ),
    //'export' => array(
        //'type' => 'db', 
        //'table' => 'mafengwo_content',
    //),
    /*'db_config' => array(
        'host'  => '127.0.0.1',
        'port'  => 3306,
        'user'  => 'root',
        'pass'  => 'wuyanfeng1688',
        'name'  => 'mafengwo',
    ),*/
    'fields' => array(
        // 标题
        array(
            'name' => "title",
            'selector' => "//h3[contains(@class,'j_chapterName')]",
            //'selector' => "//div[@id='Article']//h1",
            'required' => true,
        ),
        // 分类
        /*array(
            'name' => "city",
            'selector' => "//div[contains(@class,'relation_mdd')]//a",
            'required' => true,
        ),
        // 出发时间
        array(
            'name' => "date",
            'selector' => "//li[contains(@class,'time')]",
            'required' => true,
        ),*/
    ),
);
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
$spider->on_extract_field = function($fieldname, $data, $page) {
    echo $data;
    return $data;
};

$spider->on_extract_page = function($page, $data) {
    echo $data;
    return $data;
};
$spider->start();
/*$url = "https://read.qidian.com/chapter/b6zMT2eUjPRwKI0S3HHgow2/h0tz8Ze0guLM5j8_3RRvhw2";
$html = requests::get($url);

$selector = "//h3[contains(@class,'j_chapterName')]";

$result = selector::select($html, $selector);

echo $result;*/