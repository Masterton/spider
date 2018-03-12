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
    'name' => '中国加盟网——资讯',
    'tasknum' => 1,
    //'save_running_state' => true,
    'log_show' => false,
    //'log_file' => 'data.log',
    //'log_type' => 'info',
    'domains' => array(
        'vc.jmw.com.cn',
    ),
    'scan_urls' => array(
        // 随便定义一个入口，要不然会报没有入口url错误，但是这里其实没用
        // 节能环保咨询列表第一页
        "http://vc.jmw.com.cn/cyrd/page/1.shtml",
    ),
    'list_url_regexes' => array(
        // 节能环保咨询列表
        "http://vc.jmw.com.cn/cyrd/page/\d+.shtml",
        "http://vc.jmw.com.cn/cygs/page/\d+.shtml",
        "http://vc.jmw.com.cn/cyjj/page/\d+.shtml",
        "http://vc.jmw.com.cn/tzzt/page/\d+.shtml",
        "http://vc.jmw.com.cn/xmtj/page/\d+.shtml",
        "http://vc.jmw.com.cn/sckb/page/\d+.shtml",
    ),
    'content_url_regexes' => array(
        // 新闻详情页
        "http://vc.jmw.com.cn/cyrd/[0-9_]*.shtml",
        "http://vc.jmw.com.cn/cygs/[0-9_]*.shtml",
        "http://vc.jmw.com.cn/cyjj/[0-9_]*.shtml",
        "http://vc.jmw.com.cn/tzzt/[0-9_]*.shtml",
        "http://vc.jmw.com.cn/xmtj/[0-9_]*.shtml",
        "http://vc.jmw.com.cn/sckb/[0-9_]*.shtml",
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
            'selector' => "//div[@class='article_content_box']/h1",
            'required' => true,
        ),
        array(
            'name' => "content", // 资讯内容
            'selector' => "//div[@class='article_content']",
            'required' => true,
        ),
        array(
            'name' => "time", // 发布时间
            'selector' => "//div[@class='source_date']/span[1]",
            'required' => true,
        ),
        /*array(
            'name' => "source", // 文章来源
            'selector' => "div[@class='source_date']/span[1]",
            'required' => true,
        ),*/
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
    for ($i = 1; $i <= 86; $i++) {
        $url = "http://vc.jmw.com.cn/cyrd/page/{$i}.shtml";
        $phpspider->add_url($url);
    }
    for ($i = 1; $i <= 35; $i++) {
        $url = "http://vc.jmw.com.cn/cygs/page/{$i}.shtml";
        $phpspider->add_url($url);
    }
    for ($i = 1; $i <= 59; $i++) {
        $url = "http://vc.jmw.com.cn/cyjj/page/{$i}.shtml";
        $phpspider->add_url($url);
    }
    for ($i = 1; $i <= 64; $i++) {
        $url = "http://vc.jmw.com.cn/tzzt/page/{$i}.shtml";
        $phpspider->add_url($url);
    }
    for ($i = 1; $i <= 137; $i++) {
        $url = "http://vc.jmw.com.cn/xmtj/page/{$i}.shtml";
        $phpspider->add_url($url);
    }
    for ($i = 1; $i <= 35; $i++) {
        $url = "http://vc.jmw.com.cn/sckb/page/{$i}.shtml";
        $phpspider->add_url($url);
    }
};

$spider->on_extract_field = function($fieldname, $data, $page) {
    return $data;
};

$spider->on_extract_page = function($page, $data) {
    $row = db::get_one("Select Count(*) As `count` From `jmw_news` Where `title`='{$data['title']}'");
    if (!$row['count']) {
        db::insert('jmw_news', $data);
    }
    return $data;
};
$spider->start();
/*$url = "http://vc.jmw.com.cn/cyjj/17576914_6725246.shtml";
$html = requests::get($url);

$selector = "//div[@class='source_date']/span[1]";

$result = selector::select($html, $selector);
// print_r($html);

print_r("<br>");
print_r($result);*/