<?php
/**
 * Created by PhpStorm.
 * User: Print2
 * Date: 2021/7/22
 * Time: 15:14
 */

namespace log;

use Psr\Log\LoggerInterface;
use config\Config;

class Log extends Manager implements LoggerInterface
{
    const EMERGENCY = 'emergency';
    const ALERT     = 'alert';
    const CRITICAL  = 'critical';
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const INFO      = 'info';
    const DEBUG     = 'debug';
    const SQL       = 'sql';

    protected $namespace = '\\log\\driver\\';

    /**
     * 默认驱动
     * @return string|null
     */
    public function getDefaultDriver()
    {
        return $this->getConfig('default.type');
    }

    /**
     * 获取缓存配置
     * @access public
     * @param null|string $name    名称
     * @param mixed       $default 默认值
     * @return mixed
     */
    public function getConfig(string $name = null, $default = null)
    {
        return (new Config())->get($name);
    }

    protected function resolveType(string $name)
    {
        return (new Config())->get($name.'.type');
    }

    protected function resolveConfig(string $name)
    {
        return (new Config())->get($name);
    }

    /**
     * 连接或者切换缓存
     * @access public
     * @param string $name 连接配置名
     * @return Driver
     */
    public function store(string $name = null)
    {

        return $this->driver($name);
    }


    /**
     * 写入
     * @param $msg 消息
     * @param string $type 类型
     * @param array $context 内容
     * @return
     */
    public function write($msg, string $type = 'info', array $context = [])
    {


       return $this->store()->write($msg, $type, $context);
    }


    /**
     * System is unusable.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function emergency($message, array $context = array())
    {
        $this->store()->write($message,__FUNCTION__,$context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function alert($message, array $context = array())
    {
        $this->store()->write($message,__FUNCTION__,$context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function critical($message, array $context = array())
    {
        $this->store()->write($message,__FUNCTION__,$context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function error($message, array $context = array())
    {

        $this->store()->write($message,__FUNCTION__,$context);


    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function warning($message, array $context = array())
    {
        $this->store()->write($message,__FUNCTION__,$context);
    }

    /**
     * Normal but significant events.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function notice($message, array $context = array())
    {
        $this->store()->write($message,__FUNCTION__,$context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function info($message, array $context = array())
    {
        $this->store()->write($message,__FUNCTION__,$context);
    }

    /**
     * Detailed debug information.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function debug($message, array $context = array())
    {
        $this->store()->write($message,__FUNCTION__,$context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed   $level
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function log($level, $message, array $context = array())
    {
        $this->store()->write($message,__FUNCTION__,$context);
    }


}