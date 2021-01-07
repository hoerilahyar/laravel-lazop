# PHP Library for the Lazada Open API #
Usage of this library is also available at [Lazada Open API](https://open.lazada.com)

Requirements
-----

PHP SDK requires PHP 5 or newer version

Composer Installation
-----

Run the following command:
```bash
composer require hoeril/lazop
```

Usage
-----
you need seller authorization.

[Lazada Open API](https://open.lazada.com/doc/doc.htm?spm=a2o9m.11193531.0.0.1d796bbeGt9UoA#?nodeId=10777&docId=108260)

1. Concatenate authorization URL
Sample link for authorization:

[Lazada Open API]('https://auth.lazada.com/oauth/authorize?response_type=code&force_auth=true&redirect_uri=${app call back url}&client_id=${appkey}')

2. Guide sellers to authorize
following window with the login panel is displayed.

3. Retrieve authorization code
After the seller completes the authorization, Lazada Open Platform will return the authorization code to the callback URL address. Your application can retrieve the code and use it to get the Access Token. The sample authorization code is shown below.
![alt text](https://gw.alipayobjects.com/zos/skylark/a8931057-4dec-4737-9f0d-5b5ca1cd1952/2018/png/83941b14-f1be-420c-9896-bb5108a96bd8.png)
<b>Note</b>: This authorization code will expire within 30 minutes. You need to use this code to get the access token before it expires.

4. Get the access_token
Use the /auth/token/create API to get the Access Token (access_token).

Code sample:

```php
use hoeril\Lazop\LazopClient;
use Hoeril\Lazop\LazopRequest;

...
$client = new LazopClient('https://api.lazada.test/rest', appKey, appSecret);
$request = new LazopRequest('/auth/token/create');
$request->addApiParam('code',1);
    
var_dump($client->execute($request));
...
```
5. Save the token
The access token will expire in a specific period (expires_in). Before it expires, the seller does not need to authorize the application again. You need to save the latest token properly.

6. Sample of the token
<b>Notes</b>:
1. The “access_token” and “refresh_token” in this sample are for reference only.
2. For cross border sellers, the returned access token can be used for multiple sites. Therefore, the “country_user_info” section contains multiple country values.
```json 
{
	"access_token": "50000601c30atpedfgu3LVvik87Ixlsvle3mSoB7701ceb156fPunYZ43GBg",
	"refresh_token": "500016000300bwa2WteaQyfwBMnPxurcA0mXGhQdTt18356663CfcDTYpWoi",
	"country": "cb",
	"refresh_expires_in": 259200,
	"account_platform": "seller_center",
	"expires_in": 259200,
	"account": "xxx@126.com"
    "country_user_info":
    [
    	{
    	 	"country":"sg",
          	"seller_id": "1001",
          	"user_id": 10101
    	},
    	{
    	 	"country":"my",
          	"seller_id": "2001",
          	"user_id": 20101
    	}
    ]
}
```

Sample usage:
```php
use hoeril\Lazop\LazopClient;
use Hoeril\Lazop\LazopRequest;

...
$c = new LazopClient(url,appkey,appSecret);
$request = new LazopRequest('/orders/get','GET');
$request->addApiParam('update_before','2018-02-10T16:00:00+08:00');
$request->addApiParam('sort_direction','DESC');
$request->addApiParam('offset','0');
$request->addApiParam('limit','10');
$request->addApiParam('update_after','2017-02-10T09:00:00+08:00');
$request->addApiParam('sort_by','updated_at');
$request->addApiParam('created_before','2018-02-10T16:00:00+08:00');
$request->addApiParam('created_after','2017-02-10T09:00:00+08:00');
$request->addApiParam('status','shipped');
var_dump($c->execute($request, $accessToken));
    
var_dump($c->execute($request));
...

```