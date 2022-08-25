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
UserBehaviors automatically fills the specified attributes with the current username login.
To use UserBehaviors, insert the following code your ActiveRecord class:  
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
By default, UserBehaviors will fill the first_user and last_user attributes with the current username when created row the associated AR object is being inserted. it will fill the last_user attribute with the username when the AR object is being updated. The user value is obtained by username.
Because attribute values will be set automatically by this behavior, they are usually not user input and should therefore not be validated, i.e. first_user and last_user should not appear in the rules() method of the model.
For the above implementation to work with MySQL database, please declare the columns(first_user, last_user) as varchar(50).
If your attribute names are different, you may configure the $createdAtAttribute, $updatedAtAttribute and $value properties like the following:
 ```php 
  public function behaviors()
  {
      return [
            [
                'class' => UserBehaviors::class,
                'createdAtAttribute' => 'first_userid',
                'updatedAtAttribute' => 'last_userid',
                'value' => function(){
                    return \Yii::$app->user->id;
                }
            ],
      ];
  } 
  ```