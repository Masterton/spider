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
    'name' => '快马加盟网——项目',
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
        // 项目库列表第一页
        "https://www.kmway.com/project/search/1_0_0.shtml",
    ),
    'list_url_regexes' => array(
        // 项目库列表
        "https://www.kmway.com/project/search/\d+_0_0.shtml",
    ),
    'content_url_regexes' => array(
        // 项目海报/详情页
        "https://www.kmway.com/project/[a-zA-Z0-9]*/[a-zA-Z0-9]*/\d+.shtml",
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
            'name' => "brand", // 项目品牌
            'selector' => "/html/body/div[@class='Poster']/div[@class='shop-name-w']/div[@class='shop-name']/div[@class='container clearfix']/div[@class='shop-name-left f-l clearfix']/div[@class='name-left-referral f-l']/h3",
            'required' => true,
        ),
        array(
            'name' => "company_name", // 公司名称
            'selector' => "/html/body/div[@class='Poster']/div[@class='shop-name-w']/div[@class='shop-name']/div[@class='container clearfix']/div[@class='shop-name-left f-l clearfix']/div[@class='name-left-referral f-l']/p",
            'required' => true,
        ),
        array(
            'name' => "quota", // 投资金额
            'selector' => "/html/body/div[@class='Poster']/div[@class='shop-name-w']/div[@class='shop-name']/div[@class='container clearfix']/div[@class='shop-name-left f-l clearfix']/div[@class='name-left-referral f-l']/div[@class='ref-star clearfix']/span[@class='f-l ref-star-span2']/i",
            'required' => true,
        ),
        array(
            'name' => "item_logo", // 项目logo
            'selector' => "/html/body/div[@class='Poster']/div[@class='shop-name-w']/div[@class='shop-name']/div[@class='container clearfix']/div[@class='shop-name-left f-l clearfix']/div[@class='name-left-img f-l']/a/img/@src",
            'required' => true,
        ),
        array(
            'name' => "poster", // 项目PC海报源码
            'selector' => "//div[@class='shop-Poster']",
            'required' => true,
        ),
        array(
            'name' => "industry", // 行业
            'selector' => "//div[@class='name-left-guild f-l']/p/span[2]",
            'required' => true,
        ),
        array(
            'name' => "industry", // 公司logo
            'selector' => "//div[@class='comp_logo']/img/@src",
            'required' => true,
        ),
        array(
            'name' => "register_capital", // 注册资金
            'selector' => "//div[@class='comp_info_con']/ul/li[2]/em",
            'required' => true,
        ),
        array(
            'name' => "address", // 注册地址
            'selector' => "//div[@class='comp_info_con']/ul/li[3]/em",
            'required' => true,
        ),
        array(
            'name' => "content", // 项目详情
            'selector' => "//div[@id='con']",
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
/*$url = "https://www.kmway.com/project/cyyl/dg/751507.shtml";
$html = requests::get($url);

$selector = "//div[@id='con']";

$result = selector::select($html, $selector);
// print_r($html);

print_r("<br>");
print_r($result);*/