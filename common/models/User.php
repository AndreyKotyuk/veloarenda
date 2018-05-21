<?php
namespace common\models;

use common\traits\ActiveRecordTrait;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use dektrium\user\models\User as BaseUser;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property int $role
 * @property bool $isUser
 * @property bool $isModerator
 * @property bool $isAdmin
 */
class User extends BaseUser implements IdentityInterface
{
    use ActiveRecordTrait;
    // User roles const
    const ROLE_USER = 10;
    const ROLE_MODERATOR = 20;
    const ROLE_ADMIN = 30;

    /**
     * @return array
     */
    public function rules(): array
    {
        $rules = parent::rules();
        // role rules
        $rules['roleType'] = ['role', 'integer'];
        $rules['roleDefault'] = ['role', 'default', 'value' => self::ROLE_USER];
        $rules['roleRange'] = ['role', 'in', 'range' => [
            self::ROLE_USER,
            self::ROLE_MODERATOR,
            self::ROLE_ADMIN
        ]];
//        $rules['roleRange'] = ['role', 'in', 'range' => [self::ROLE_USER], 'on' => self::SCENARIO_REGISTER];
//        $rules['roleConnectDefault'] = ['role', 'default', 'value' => null, 'on' => self::SCENARIO_CONNECT];
        // status rules
//        $rules['statusType'] = ['status', 'integer'];
//        $rules['statusDefault'] = ['status', 'default', 'value' => self::STATUS_TRAINEE, 'when' => function () {
//            return $this->role == self::ROLE_SPECIALIST;
//        }];
//        $rules['statusRange'] = ['status', 'in', 'range' => [self::STATUS_TRAINEE, self::STATUS_EXPERT]];
//        $rules['isStrictStatus'] = ['!is_status_blocked', 'boolean'];
//        $rules['isStrictStatusDefault'] = ['!is_status_blocked', 'default', 'value' => false];
        return $rules;
    }

    /**
     * @return bool Whether the user is an client or not.
     */
    public function getIsUser(): bool
    {
        return $this->role == User::ROLE_USER;
    }

    /**
     * @return bool Whether the user is an specialist or not.
     */
    public function getIsModerator(): bool
    {
        return $this->role == User::ROLE_MODERATOR;
    }

    /**
     * @return bool
     */
    public function getIsAdmin(): bool
    {
        return $this->role == User::ROLE_ADMIN;
    }
}
