# Viewi bridge

When it comes to using Viewi with other frameworks, it is crucial to provide a mechanism for communications between Viewi application and your framework.

Viewi offers you to implement that mechanism simply by defining a bridge class.

```php
interface IViewiBridge
{
    // file_exists - Checks whether a file or directory exists
    function file_exists(string $filename): bool;
    
    // is_dir - Tells whether the filename is a directory
    function is_dir(string $filename): bool;
    
    // file_get_contents - Reads entire file into a string
    function file_get_contents(string $filename): string | false;
    
    // request - Server-side internal request handler. Request that comes from Viewi component.
    function request(Request $request): mixed;
}
```

Viewi provides a default bridge as well and you can reuse some of its logic.

It uses `curl` extension to make external HTTP calls and you can override this logic.

```php
<?php

namespace Viewi\Bridge;

use Viewi\App;
use Viewi\Components\Http\Message\Request;

class DefaultBridge implements IViewiBridge
{
    public function __construct(private App $viewiApp)
    {
    }

    public function file_exists(string $filename): bool
    {
        return file_exists($filename);
    }

    public function is_dir(string $filename): bool
    {
        return is_dir($filename);
    }

    public function file_get_contents(string $filename): string|false
    {
        return file_get_contents($filename);
    }

    public function request(Request $request): mixed
    {
        if ($request->isExternal) {
            return $this->externalRequest($request);
        }
        return $this->viewiApp->run($request->url, $request->method);
    }

    private function externalRequest(Request $request)
    {
        $curl = curl_init();
        $params = array(
            CURLOPT_URL => $request->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => strtoupper($request->method),
            CURLOPT_HTTPHEADER => $request->headers
        );
        if ($request->body != null) {
            $params[CURLOPT_HTTPHEADER]['Content-Type'] = 'application/json';
            $params[CURLOPT_POSTFIELDS] = json_encode($request->body);
        }
        curl_setopt_array($curl, $params);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}
```