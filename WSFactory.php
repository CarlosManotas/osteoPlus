<?php
class WSFactory {

	const WS_GENERIC = 'NO';
	const WS_EMAIL = 'SI';
	
	public static function createWS($type, $url) {

		$type = strtoupper($type);
		switch($type) {
			case self::WS_GENERIC:
				return new CsWebServicePUC($url);
				break;
			case self::WS_EMAIL:
				return new ClWebServicePUC_Mailer($url);
				break;
		}
	}
}