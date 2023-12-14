# Introduction

*Inspired by .Net Blazor, Angular, and Nuxt.*

The goal is to bring something similar to PHP without spinning Node.js on your server. There is a way to have both: reactive front-end and super efficient server-side rendering (SSR).

Viewi is a PHP-agnostic solution that allows you to create a front-end application for browsers by defining components in PHP. Then transform them into their JavaScript counterparts by a transpiler (or compiler, choose the word that you prefer the most) automatically so it can be used in the browser.
It has super intuitive template syntax and supports most of the features that modern JavaScript frameworks can offer, such as:

- Routing system
- Reactivity
- HTTP client for interacting with your server
- Server-side rendering without needing a Node.js 
- Client-side rendering and hydration 
- Portals
- Events and input bindings
- Lazy loading
- Custom JavaScript code and NPM packages
- And a lot more

Viewi supports most of the PHP syntax, like classes, operators, expressions, functions, class inheritance, and more.
It has a built-in library for the most widely used PHP functions such as `count`, `strlen`, etc. 

The full list is here: [functions.php](https://github.com/viewi/viewi/blob/v2/src/Viewi/JsTranspile/functions.php)

And if you need to add a new function there is a way to do it.
If something is not supported you will get a build error or console error in the browser.

Since not everything can be converted into JavaScript there are things that you should be aware of.

Viewi application should be isolated from the rest of your PHP application, which means that you can not use any functionality from your PHP framework and application. Using something outside will result in a build error. Use the HTTP client and API layer to get what you want, for example, data from a database or file content.

Component names should be unique across your Viewi application because there are no namespaces in JavaScript.

JavaScript does not have types and operates with plain objects, reflection is not supported.

If you are using Viewi with another framework, you should provide an adapter for the HTTP client to enable API calls during SSR. We have examples of how to do so and adapters for a couple of frameworks. Need another one - you can request it on GitHub.

Viewi generates your JavaScript project automatically and allows you to customize it.
So you are not limited strictly to PHP and you can extend your front-end with any JavaScript library you want, just like with any other JS framework.

See it yourself:

[PHP Components](https://github.com/viewi/dev-project/tree/main/viewi-app/Components)

[Generated JavaScript](https://github.com/viewi/dev-project/tree/main/viewi-app/js)

If you like the idea, welcome to Viewi!