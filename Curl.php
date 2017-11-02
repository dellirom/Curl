<?php

/**
 * Created by PhpStorm.
 * User: dellirom
 * Date: 01.11.2017
 * Time: 16:19
 * Version: 1.1
 */

namespace dellirom;

class Curl
{
    private $user_agent = 'Client/1.0';

    private $url;
    private $ch;
    private $code;

    /**
     * Curl constructor. Curl init.
     * @param bool $display
     */
    public function __construct($display = false)
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_USERAGENT, $this->user_agent);
        if (!$display){
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        }
    }

    /**
     * Set CURL options
     * @param $option
     * @param $value
     * @return $this
     */
    public function set($option, $value)
    {
        curl_setopt($this->ch, $option, $value);
        return $this;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function header(array $headers)
    {
        $this->set(CURLOPT_HTTPHEADER, $headers);
        return $this;
    }

    /**
     * @param $data
     * @param $cookie_file
     * @return $this
     */
    public function auth($data, $cookie_file)
    {
        $this->post($data);
        $this->set(CURLOPT_COOKIEJAR, $cookie_file);
        $this->set(CURLOPT_COOKIEFILE, $cookie_file);
        return $this;
    }

    public function auth_http($login_pass)
    {
        $this->set(CURLOPT_RETURNTRANSFER, 1);
        $this->set(CURLOPT_USERPWD, $login_pass);
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function post($data)
    {
        $this->set(CURLOPT_POST,true);
        $this->set(CURLOPT_POSTFIELDS, http_build_query($data));
        return $this;
    }

    /**
     * @param $url
     * @return mixed
     */
    public function execute($url)
    {
        $this->set(CURLOPT_URL, $url);
        $out = curl_exec($this->ch);
        $this->code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        return $out;
    }

    /**
     * Return HTTP code
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * CURL close
     */
    public function __destruct()
    {
        curl_close($this->ch);
    }
}