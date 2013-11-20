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
    
    var $theme_id = null;
    
    //Used to output to user what shop they are pushing to. Reads better than full shop name.
    var $current = 'default';
    
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
            $this->theme_id = getenv('SHOPIFY_THEME_ID');

            if( (!$this->api_key) || (!$this->password) || (!$this->store) ) {
                echo "No config file found here: {$path} ?";
                echo "I can't seem to find your API Key, Password or Store.";
                exit();
            }
        }
    }

    /**
     * Write the .ini back
     * @param array $data array to turn into .ini
     * @return void
     **/
    public function save($data) {
        $output = '';
        foreach ($data as $key => $value) {
            if(is_string($value)) {
                $output .= $this->_ini_line($key, $value, true);
            }
            //Assume section
            else {
                $output .= "\n[$key]\n";
                foreach ($value as $shopkey => $shopvalue) {
                    $output .= $this->_ini_line($shopkey, $shopvalue, true);
                }
            }
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
     * Read and return the .ini 
     *
     * @return array
     **/
    function read($path) {
        return parse_ini_file($path, true);
    }
    
    /**
     * Load the config file
     *
     * @return void
     **/
    public function load($path) {
        $config = $this->read($path);

        $this->current = $config['use'];

        $settings = $config[$config['use']];

        foreach ($settings as $key => $value) {
            $this->{$key} = $value;
        }
    }

}
