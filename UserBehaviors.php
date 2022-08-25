<?php
namespace budipratama\behaviors;

use yii\base\InvalidCallException;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use Yii;
/**
 * This is just an example.
 */
class UserBehaviors extends AttributeBehavior
{
    /**
     * @var string the attribute that will receive Yii::$app->user->id value
     * Set this property to false if you do not want to record the creation time.
     */
    public $createdAtAttribute = 'first_user';
    /**
     * @var string the attribute that will receive Yii::$app->user->id value.
     * Set this property to false if you do not want to record the update time.
     */
    public $updatedAtAttribute = 'last_user';
    /**
     * {@inheritdoc}
     *
     * In case, when the value is `null`, the result of the value Yii::$app->user->id
     * will be used as value.
     */
    public $value;


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->createdAtAttribute, $this->updatedAtAttribute],
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->updatedAtAttribute,
            ];
        }
    }

    /**
     * {@inheritdoc}
     *
     * In case, when the [[value]] is `null`, the result of the value Yii::$app->user->id
     * will be used as value.
     */
    protected function getValue($event)
    {
        if ($this->value === null) {
            return Yii::$app->user->identity->username;
        }

        return parent::getValue($event);
    }

    /**
     * Updates a Yii::$app->user->id attribute to the current user id.
     * @param string $attribute the name of the attribute to update.
     * @throws InvalidCallException if owner is a new record (since version 2.0.6).
     */
    public function touch($attribute)
    {
        /* @var $owner BaseActiveRecord */
        $owner = $this->owner;
        if ($owner->getIsNewRecord()) {
            throw new InvalidCallException('Updating the Yii::$app->user->id is not possible on a new record.');
        }
        $owner->updateAttributes(array_fill_keys((array) $attribute, $this->getValue(null)));
    }
}
