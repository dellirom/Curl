# Curl
Simple universal class for using Curl library
## Usage
`use \dellirom\Curl;`

`$curl = new Curl();`


## Examples:

### Simple request
`$curl->execute('http://domain.com');`

### If you want use custom CURL option
`$curl->set('option', 'value')->execute('http://domen.com');`

`$curl->set('option', 'value')->set('option', 'value')->execute('http://domain.com');`

### If you want use POST request
`$curl->post(['name'=>'value'])->execute('http://domen.com');`

### If you want use HEADERS in request
`$curl->header(['Content-type: application/x-www-form-urlencoded'])->post(['name'=>'value'])->execute('http://domain.com');`

### If you want use HTTP Authetication
`$curl->auth_http('login:password')->execute('http://domain.com);`

### If you want use Authetication whith Cookie
`$curl->auth($auth_post_data, $cookie_file)->execute('http://domain.com');`