<?php
namespace cache;
use config\Config;
use log\Log;

require __DIR__ . '/vendor/autoload.php';

//目录配置文件路径
define('CONFIG_PATH',__DIR__ . '/config/');

(new Config())->load(CONFIG_PATH,'log');
(new Log())->error("{user}::lrange() expects {exactly} 3 parameters, 1 given".microtime(true),["user"=>"test","exactly" => "ji"]);

//EXISTS
//(new Cache())->lpush("tutorial-list", "Redis");
//(new Cache())->lpush("tutorial-list", "Mongodb");
//(new Cache())->lpush("tutorial-list", "Mysql");
//$arList = (new Cache())->lrange("tutorial-list", 0 ,5);
