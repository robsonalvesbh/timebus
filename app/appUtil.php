<?php

class appUtil
{
	public static function criptografar($senha)
	{
		return sha1( md5( $senha ) . "*timeBusPassworld*" );
	}
}
