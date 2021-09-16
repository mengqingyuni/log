**警告日志**
`warning($message, array $context = array())`

**说明**
例如: 使用过时的API，API使用不当，不合理的东西不一定是错误

**参数**
```
$message 消息  {user}::lrange() expects {exactly} 3 parameters, 1 given".microtime(true)
$context 内容  ["user"=>"test","exactly" => "test"] 替换{user}  {exactly}
```
**示例**
```
define('CONFIG\_PATH',\_\_DIR\_\_.'/config/');
(newConfig())->load(CONFIG\_PATH,'log');

$log = (newLog())->warning("{user}::lrange() expects {exactly} 3 parameters, 1 given".microtime(true),["user"=>"test","exactly" => "ji"]);

print_r($log);
```