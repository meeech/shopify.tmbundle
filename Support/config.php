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

        $this->ini_path = $path;
        
        if(file_exists($path)) {
            $this->load($path);
        }
        else {
            //fallback
            $this->api_key  = getenv('SHOPIFY_API_KEY');
            $this->password = getenv('SHOPIFY_PASSWORD');
            $this->store    = getenv('SHOPIFY_STORE');

            if( (!$this->api_key) || (!$this->password) || (!$this->store) ) {
                echo "No config file found here: {$path} ?";
                echo "I can't seem to find your API Key, Password or Store.";
                exit();
            }
        }
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

        foreach ($settings as $key => $value) {
            $this->{$key} = $value;
        }
    }

}
