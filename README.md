Chat GPT
===========
[OpenAI](https://openai.com)

[Lib OpenAI](https://github.com/orhanerday/open-ai)

See all methods: https://github.com/orhanerday/open-ai#documentation


[![Latest Stable Version](https://poser.pugx.org/panix/mod-chatgpt/v/stable)](https://packagist.org/packages/panix/mod-chatgpt)
[![Total Downloads](https://poser.pugx.org/panix/mod-chatgpt/downloads)](https://packagist.org/packages/panix/mod-chatgpt)
[![Monthly Downloads](https://poser.pugx.org/panix/mod-chatgpt/d/monthly)](https://packagist.org/packages/panix/mod-chatgpt)
[![Daily Downloads](https://poser.pugx.org/panix/mod-chatgptwgt-tinymce/d/daily)](https://packagist.org/packages/panix/mod-chatgpt)
[![Latest Unstable Version](https://poser.pugx.org/panix/mod-chatgpt/v/unstable)](https://packagist.org/packages/panix/mod-chatgpt)
[![License](https://poser.pugx.org/panix/mod-chatgpt/license)](https://packagist.org/packages/panix/mod-chatgpt)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer require --prefer-dist panix/yii2-chatgpt "*"
```

or add

```
"panix/mod-chatgpt": "*"
```

Add config file
```php
<?php
    'components' => [
        'chatgpt' => [
            'class' => 'panix\ext\chatgpt\ChatGPT',
            'apikey' => 'YOUR_API_KEY', //required
            'org' => 'ORGANIZATION_KEY' // not required
        ],
        //...
    ]
?>
```
to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by :

```php
<?php
$gpt = Yii::$app->chatgpt->completion([
    'model' => 'text-davinci-003',
    'prompt' => 'Hello',
    'temperature' => 0.9,
    'max_tokens' => 150,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6,
]);
print_r($gpt);
?>
```

