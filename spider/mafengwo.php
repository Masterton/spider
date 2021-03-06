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
    'name' => '快马加盟网——资讯',
    'tasknum' => 1,
    //'save_running_state' => true,
    'log_show' => false,
    //'log_file' => 'data.log',
    //'log_type' => 'info',
    'domains' => array(
        'www.kmway.com',
    ),
    'scan_urls' => array(
        // 随便定义一个入口，要不然会报没有入口url错误，但是这里其实没用
        // "http://www.mafengwo.cn/travel-scenic-spot/mafengwo/10198.html",
        // "https://www.qidian.com/rank",
        // "https://book.qidian.com/info/1009533893",
        "https://www.kmway.com/case/",
    ),
    'list_url_regexes' => array(
        // 城市列表页
        // "http://www.mafengwo.cn/mdd/base/list/pagedata_citylist\?page=\d+",
        // 文章列表页
        // "http://www.mafengwo.cn/gonglve/ajax.php\?act=get_travellist\&mddid=\d+",
        // 小说章节列表
        // "book.qidian.com/info/\d+",
        "https://www.kmway.com/case/index_\d+.shtml",
        "https://www.kmway.com/library/index_\d+.shtml",
        "https://www.kmway.com/zt/index_\d+.shtml",
        "https://www.kmway.com/news/index_\d+.shtml",
    ),
    'content_url_regexes' => array(
        // "http://www.mafengwo.cn/i/\d+.html",
        // "read.qidian.com/chapter/[a-zA-Z0-9-_/]*",
        "https://www.kmway.com/case/\d+.shtml",
        "https://www.kmway.com/library/\d+.shtml",
        "https://www.kmway.com/zt/\d+.shtml",
        "https://www.kmway.com/news/\d+.shtml",
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
            'name' => "title",
            'selector' => "//div[contains(@id,'tab')]//div[contains(@class,'title')]",
            'required' => true,
        ),
        array(
            'name' => "content",
            'selector' => "//div[contains(@id,'tab')]//div[contains(@class,'artical')]",
            'required' => true,
        ),
        array(
            'name' => "author",
            'selector' => "/html/body/div[@class='container clearfix']/div[@class='left-ctn l clearfix Common']/div[@id='tab']/div[@class='detail-ctn']/div[@class='publish clearfix']/ul[@class='publish-time l']/li[@class='l'][2]",
            'required' => true,
        ),
        array(
            'name' => "time",
            'selector' => "//div[contains(@id,'tab')]//ul[contains(@class,'publish-time')]//span",
            'required' => true,
        ),
        array(
            'name' => "source",
            'selector' => "/html/body/div[@class='container clearfix']/div[@class='left-ctn l clearfix Common']/div[@id='tab']/div[@class='detail-ctn']/div[@class='publish clearfix']/ul[@class='publish-time l']/li[@class='l'][3]",
            'required' => true,
        ),
    ),
);
db::set_connect('default', $configs['db_config']);
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
    for ($i = 2; $i <= 12; $i++) {
        // 全国热点城市
        $url = "https://www.kmway.com/case/index_{$i}.shtml";
        $phpspider->add_url($url);
    }
    for ($i = 2; $i <= 49; $i++) {
        // 全国热点城市
        $url = "https://www.kmway.com/library/index_{$i}.shtml";
        $phpspider->add_url($url);
    }
    for ($i = 2; $i <= 18; $i++) {
        // 全国热点城市
        $url = "https://www.kmway.com/zt/index_{$i}.shtml";
        $phpspider->add_url($url);
    }
    for ($i = 2; $i <= 30; $i++) {
        // 全国热点城市
        $url = "https://www.kmway.com/news/index_{$i}.shtml";
        $phpspider->add_url($url);
    }
};

$spider->on_extract_field = function($fieldname, $data, $page) {
    if ($fieldname == 'author' || $fieldname == 'source') {
        $data = mb_substr($data, 4);
    }
    if ($fieldname == 'time') {
        trim($data);
    }
    return $data;
};

$spider->on_extract_page = function($page, $data) {
    // echo $data['city'] . '22222222222222222222222222222222222';
    $row = db::get_one("Select Count(*) As `count` From `news` Where `title`='{$data['title']}'");
    if (!$row['count']) {
        db::insert('news', $data);
    }
    return $data;
};
$spider->start();
/*$url = "https://www.kmway.com/case/776600.shtml";
$html = requests::get($url);

$selector = "//div[contains(@id,'tab')]//div[contains(@class,'title')]";

$result = selector::select($html, $selector);
print_r($result);
$result = mb_substr($result, 4); 来源
$result = mb_substr($result, 4); 作者
$result = trim($result); 时间
print_r("<br>");
print_r($result);*/