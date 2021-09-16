**通知日志**
`notice($message, array $context = array())`
**说明**
`正常但重要的事件.用于通知发布消息等`
**参数**
```
$message 消息  {user}::lrange() expects {exactly} 3 parameters, 1 given".microtime(true)
$context 内容  ["user"=>"test","exactly" => "test"] 替换{user}  {exactly}
```
**示例**
```
define('CONFIG_PATH',__DIR__.'/config/');
(newConfig())->load(CONFIG_PATH,'log');

$log = (newLog())->notice("{user}::lrange() expects {exactly} 3 parameters, 1 given".microtime(true),["user"=>"test","exactly" => "ji"]);

print_r($log);
```