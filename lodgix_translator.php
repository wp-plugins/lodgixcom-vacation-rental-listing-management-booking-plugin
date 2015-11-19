<?php

if (!class_exists('LodgixTranslator'))
{

	class LodgixTranslator
	{
	
		var $key = NULL;

		public function __construct($key)
        {
            $this->$key = $key;
        }		

		function translate($from,$to,$text) {
			$data = 'https://api.datamarket.azure.com/Bing/MicrosoftTranslator/v1/Translate?Text=%27'.$text.'%27&From=%27'.$from.'%27&To=%27'.$to.'%27';
			$ch = curl_init($data);
			curl_setopt($ch, CURLOPT_USERPWD, $this->key.':'.$this->key);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			// Parse the XML response
			$result = curl_exec($ch);					
			$result = explode('<d:Text m:type="Edm.String">', $result);
			$result = explode('</d:Text>', $result[1]);
			$result = $result[0];
				
			
			return $result;
		}
	}
}


?>