**错误日志**
`error($message, array $context = array())`
**说明**
运行时错误不需要马上处理，  但通常应该被记录和监控。
**参数**
```
$message 消息  {user}::lrange() expects {exactly} 3 parameters, 1 given".microtime(true)
$context 内容  ["user"=>"test","exactly" => "test"] 替换{user}  {exactly}
```
**示例**
```
define('CONFIG_PATH',__DIR__.'/config/');
(newConfig())->load(CONFIG_PATH,'log');

$log = (newLog())->error("{user}::lrange() expects {exactly} 3 parameters, 1 given".microtime(true),["user"=>"test","exactly" => "ji"]);

print_r($log);
```
