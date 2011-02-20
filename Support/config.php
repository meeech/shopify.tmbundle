<?php

define('CONFIG_FILE_PATH', getenv('TM_PROJECT_DIRECTORY').DIRECTORY_SEPARATOR.'.shopify-tmbundle');

/**
* Config
*
* ummm... for loading up any needed configs
* 
*/
class mConfig {
    
    var $ini_path = null;
    
    var $api_key = null;
    
    var $password = null;
    
    var $store = null;
    
    function __construct($path) {
        
        if(!file_exists($path)) {
            echo "Did you set up your config file here: {$path}?";
            exit();
        }
        
        $this->ini_path = $path;
        $this->load($path);
    }
    
    
    /**
     * Write the .ini back
     *
     * @return void
     **/
    public function save() {
        $to_write = array('api_key', 'campaign_id');
        $output = '';
        foreach ($to_write as $key) {
            $output.= $this->_ini_line($key, $this->{$key}, true);
        }
        
        file_put_contents($this->ini_path, $output);
        
    }
    
	/**
	 * undocumented function
	 *
	 * @return string
	 **/
	function _ini_line($key, $value, $newline = false) {

		$line = trim($key).'="'. str_replace('"', '&quot;', $value) .'"';

		if($newline) {
			$line .= "\n";
		}

		return $line;
	}
    
    
    /**
     * Load the config file
     *
     * @return void
     **/
    public function load($path) {
        $config = parse_ini_file($path, true);
        $settings = $config[$config['use']];
        var_dump($settings);

        foreach ($settings as $key => $value) {
            $this->{$key} = $value;
        }
    }

}
