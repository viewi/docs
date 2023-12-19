# Watching mode

Watching mode allows you to monitor your code changes and build the application automatically.

To use it simply set up this in your config:

`viewi-app/config.php`

```php
<?php

return (new AppConfig())
    ->watchWithNPM();
```

After that just go into your JavaScript project at `viewi-app/js` and run the NPM watch command:

```
cd viewi-app/js
npm run watch
```

You should see output logs from the build process.

After that, you can run your server in parallel and you should get your pages faster since the build process will not be triggered on each request.

**Important**

If you are using a NPM watch mode please pay attention to the files you are generating with your custom JavaScript. 
It may happen that these changes will cause an infinite build loop therefore making it impossible to use it.

There is an ignore mechanism that you can use for certain files, but it requires you to customize the `viewi-app/js/build.mjs` file.
Please make sure you have a backup of this file before proceeding.

Find a `runWatch` function and modify it to fit your expectations.

Further improvement on this part of Viewi is planned, but not a priority.