<?php
/**
 * 日志文件驱动
 * Created by PhpStorm.
 * User: Print2
 * Date: 2021/7/22
 * Time: 15:34
 */
namespace log\driver;
class File
{

    /**
     * 默认地址
     * @var string
     */
    protected $defaultPath  = "./data/logs";

    /**
     * 地址
     * @var
     */
    protected $dir;

    /**
     * 配置参数
     * @var array
     */
    protected $options = [
        'time_format'  => 'c',
        'single'       => false,
        'file_size'    => 2097152,
        'path'         => '',
        'apart_level'  => [],
        'max_files'    => 0,
        'json'         => false,
        'json_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
        'format'       => '[%s][%s] %s',
    ];

    /**
     * File constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {

        $date = date("Ymd",time());

        if (!empty($options)) {
            $this->options = array_merge($this->options, $options);
        }

        //设置默认地址
        if (empty($options['path'])) {
            $this->options['path'] = $this->getDefaultPath();
        } else {
            $this->options['path'] = $options['path'].'/'.$date;
            $this->createDir($this->options['path']);
        }

        if (substr( $this->options['path'],-1) != DIRECTORY_SEPARATOR) $this->options['path'] .= DIRECTORY_SEPARATOR;

    }


    /**
     * 写入日志
     * @param $msg 消息
     * @param string $type 类型
     * @param array $context 替换的内容
     * @return bool
     */
    public function write($msg, string $type = 'info', array $context = [])
    {

        $rand = $this->getRand();
        //检测文件大小 大于的设为备份 filesize
        $fileName   = date("Ymd",time()).".log";
        $renameName = date("YmdHis",time())."_$rand.log";
        $path = $this->options['path'];
        $file = $path.'/'.$fileName;
        if (file_exists($file)) {
            if (filesize($file) > $this->options['file_size']) {
                //如果大于设为备份
                rename($file,$this->options['path'].'/'.$renameName);
            }
        }

        //数据组合
        //当 microtime 返回整数时，创建对象，因为它取决于数字是浮点数，包括小数点！使用sprintf格式化微妙时间输出以强制其始终为浮点数
        $utime = sprintf('%.4f', microtime(TRUE));
        $raw_time = \DateTime::createFromFormat('U.u', $utime)->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        $today = $raw_time->format('Y-m-d H:i:s.u');
        $strContext = [];
        foreach ($context as $key => $val) {
            $strContext['{'.$key.'}'] = $val;
        }
        $msg = str_replace(array_keys($strContext),array_values($strContext),$msg);

        if ($this->options['json']) {

            $msg = json_encode([$msg],$this->options['json_options']);

        }
        $data = sprintf( $this->options['format'],$today,$type,$msg);
        return error_log( $data.PHP_EOL,3,$file);
    }

    /**
     * 获取随机数
     */
    protected function getRand()
    {
        return  rand(1,getrandmax());
    }

    /**
     * 获取默认地址
     */
    protected function getDefaultPath()
    {
        //创建目录
        $date = date("Ymd",time());
        return $this->defaultPath = $this->createDir($this->defaultPath.'/'.$date);

    }

    /**
     * 创建目录
     * @param string $dir
     * @return string
     */
    protected function createDir(string $dir)
    {

        if (!is_dir($dir)){
            try {
                mkdir($dir, 0755, true);

            } catch (\Exception $e) {
                // 创建失败
            }
        }
        return $dir;
    }


}