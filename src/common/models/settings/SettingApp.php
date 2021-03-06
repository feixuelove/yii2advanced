<?php

namespace common\models\settings;

use Yii;
use yii\helpers\Url;

class SettingApp extends BaseModel
{
    public $name;
    public $logo;
    public $favicon;

    public function rules()
    {
        return [
            [['name', 'logo', 'favicon'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '网站名称',
            'logo' => '网站logo',
            'favicon' => '网站favicon',
        ];
    }

    public function attributeHints()
    {
        return [
            'logo' => '建议大小：高度60px，宽度随意，png文件',
            'favicon' => '建议大小：16*16，ico文件',
        ];
    }

    public static function attributeDefaultValue()
    {
        return [
            'name' => Yii::$app->name,
            'logo' => Url::to('@web/images/logo.png'),
            'favicon' => Url::to('@web/favicon.ico'),
        ];
    }
}
