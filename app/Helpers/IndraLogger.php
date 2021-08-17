<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class IndraLogger {

    /**
     * @var array|string
     */
    protected static $default_context = [];
    protected string $curlCommand = '';


    /**
     * @param array $context
     * @param \App\Helpers\string $type
     *
     * @param \App\Helpers\string $message
     *
     * @return array|null
     */
    private static function context(array $context = [], string $type, string $message) {
        $referer = request()->headers->get('referer');
        self::$default_context['project'] = 'Laravel';
        self::$default_context['application_name'] = 'Indra-cms';
        self::$default_context['type'] = $type;
        self::$default_context['debug'] = json_encode(debug_backtrace());
        self::$default_context['source'] = $type;
        self::$default_context['url'] = isset($referer) ? $referer :'Indra';
        self::$default_context['brand'] = isset($context['brand']) ? $context['brand'] :'Indra';
        self::$default_context['full_message'] = $message;
        self::$default_context['curl'] =self::processCurlCommand() ;
        return array_merge(self::$default_context, $context);
    }

    /**
     * Log an emergency message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public static function emergency($message, array $context = []) {
        $context = self::context($context, 'emergency', $message);
        return Log::emergency($message, $context);
    }

    /**
     * Log an alert message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public static function alert($message, array $context = []) {
        $context = self::context($context, 'alert', $message);
        return Log::alert($message, $context);
    }

    /**
     * Log a critical message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public static function critical($message, array $context = []) {
        $context = self::context($context, 'critical', $message);
        return Log::critical($message, $context);
    }

    /**
     * Log an error message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public static function error($message, array $context = []) {
        $context = self::context($context, 'error', $message);
        return Log::error($message, $context);
    }

    /**
     * Log a warning message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public static function warning($message, array $context = []) {
        $context = self::context($context, 'warning', $message);
        return Log::warning($message, $context);
    }

    /**
     * Log a notice to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public static function notice($message, array $context = []) {
        $context = self::context($context, 'notice', $message);
        return Log::notice($message, $context);
    }

    /**
     * Log an informational message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public static function info($message, array $context = []) {
        $context = self::context($context, 'info', $message);
        return Log::info($message, $context);
    }

    /**
     * Log a debug message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public static function debug($message, array $context = []) {
        $context = self::context($context, 'debug', $message);
        return Log::debug($message, $context);
    }

    /**
     * Log a message to the logs.
     *
     * @param string $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public static function log($level, $message, array $context = []) {
        $context = self::context($context, 'log', $message);
        return Log::log($message, $context);
    }

    public static function processCurlCommand() {
        $curlCommand = "curl '" . request()->headers->get('referer');
        $phpInput = file_get_contents('php://input');
        if ($phpInput && strlen($phpInput)) {
            $curlCommand .= " -XPOST '" . $phpInput . "'";
        } elseif (isset($post) && count($post) > 0) {
            $curlCommand .= " -XPOST '" . http_build_query($post) . "'";
        }
        if (is_array(getallheaders())) {
            foreach (getallheaders() as $header => $value) {
                $curlCommand .= " -H '" . $header . ": " . $value . "'";
            }
        }
        return $curlCommand;
    }

}
