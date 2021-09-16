**记录日志**
`log($level, $message, array$context = array())`
**说明**
`详细的调试信息。`
**参数**
```
$message 消息  {user}::lrange() expects {exactly} 3 parameters, 1 given".microtime(true)
$context 内容  ["user"=>"test","exactly" => "test"] 替换{user}  {exactly}
```
**示例**
```
define('CONFIG_PATH',__DIR__.'/config/');
(newConfig())->load(CONFIG_PATH,'log');

$log = (newLog())->debug("{user}::lrange() expects {exactly} 3 parameters, 1 given".microtime(true),["user"=>"test","exactly" => "ji"]);

print_r($log);
```