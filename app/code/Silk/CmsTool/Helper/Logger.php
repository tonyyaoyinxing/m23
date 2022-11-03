<?php

namespace Silk\CmsTool\Helper;

class Logger
{
    /**
     * Locale Date/Timezone
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $_timezone;
    
    /**
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        array $data = []
    ) {
        $this->_timezone = $timezone;
    }
    
    public function writeInfo($fileName, $code, $message)
    {
        $this->writeLog($fileName, $code, $message, 'Info');
    }
    
    public function writeErr($fileName, $code, $message)
    {
        $this->writeLog($fileName, $code, $message, 'Error');
    }
    
    protected function writeLog($fileName, $code, $message, $type='Info')
    {
        $logDir  = BP . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'log';
        $logFile = $logDir . DIRECTORY_SEPARATOR . strtolower($fileName) . '_' . $this->_timezone->date()->format('Ymd') . '.log';
        
        $msg = $this->improvedVarExport($message);
        
        if (!empty($code))
        {
            $msg = '['.$code.']'."\n".$msg;
        }
        
        if (!empty($type))
        {
            $msg = '['.$type.']'.$msg;
        }
        
        $msg = $this->_timezone->date()->format('[Y-m-d H:i:s]').$msg."\n";
        file_put_contents($logFile, $msg, FILE_APPEND);
    }
    
    /**
     * An implementation of var_export() that is compatible with instances
     * of object.
     * @param mixed $variable The variable you want to export
     * @param bool $return If used and set to true, improved_var_export()
     *     will return the variable representation instead of outputting it.
     * @return mixed|null Returns the variable representation when the
     *     return parameter is used and evaluates to TRUE. Otherwise, this
     *     function will return NULL.
     */
    protected function improvedVarExport($variable) {
        if (is_object($variable)) {
            $result = '(object) '.get_class($variable).$this->improvedVarExport(get_object_vars($variable), true);
        } else if (is_array($variable)) {
            $array = array ();
            foreach ($variable as $key => $value) {
                $array[] = var_export($key, true).' => '.$this->improvedVarExport($value, true);
            }
            $result = !empty($array)?'array ('.implode(', ', $array).')':'';
        } else {
            $result = var_export($variable, true);
        }
        
        return $result;
    }
    
    public function logInfo($msg, $logFile='api_integration.log')
    {
        $logDirectory = BP . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR .'log';
        
        $msg = $this->improvedVarExport($msg);

        $msg = $this->_timezone->date()->format('[Y-m-d H:i:s]').': '.$msg."\n";
        
        file_put_contents($logDirectory.DIRECTORY_SEPARATOR.strtolower($logFile), $msg, FILE_APPEND);
    }
    
    public function getRandomCode()
    {
        return time().'_'.rand(1000000, 9999999);
    }
}
