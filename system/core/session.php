<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Session
{

	function __construct()
	{
		$samesite = 'strict';
		if (PHP_VERSION_ID < 70300)
		{
			session_set_cookie_params('samesite=' . $samesite);
		}
		else
		{
			session_set_cookie_params(['samesite' => $samesite]);
		}
		if (isset($_COOKIE['PHPSESSID'])) session_start();
	}

	public function userdata($data)
	{
		if (session_status() == PHP_SESSION_NONE) return false;
		if (isset($_SESSION[$data]))
		{
			return $_SESSION[$data];
		}
		else
		{
			return false;
		}
	}

	public function set_userdata($data, $value = '')
	{
		if (session_status() == PHP_SESSION_NONE) session_start();
		if (is_array($data))
		{
			foreach ($data as $key => & $value)
			{
				$_SESSION[$key] = $value;
			}

			return;
		}
		$_SESSION[$data] = $value;
	}

	public function unset_userdata($key)
	{
		if (is_array($key))
		{
			foreach ($key as $k)
			{
				unset($_SESSION[$k]);
			}

			return;
		}

		unset($_SESSION[$key]);
	}

	public function has_userdata($key)
	{
		return isset($_SESSION[$key]);
	}

	public function sess_destroy()
	{
		session_destroy();
	}

}

