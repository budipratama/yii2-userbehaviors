User Behaviors
==============
User Behaviors

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist budipratama/yii2-userbehaviors "@dev"
```

or add

```
"budipratama/yii2-userbehaviors": "@dev"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :



 ```php
 use budipratama\behaviors\UserBehaviors;
 
  public function behaviors()
  {
      return [
            [
                'class' => UserBehaviors::class
            ],
      ];
  }
  ```