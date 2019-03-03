<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actividades".
 *
 * @property int $id
 * @property string $actividad
 * @property string $gastocalorico
 *
 * @property Entrenamientos[] $entrenamientos
 */
class Actividades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'actividades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['actividad', 'gastocalorico'], 'required'],
            [['gastocalorico'], 'number'],
            [['actividad'], 'string', 'max' => 255],
            [['actividad'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'actividad' => 'Actividad',
            'gastocalorico' => 'Gastocalorico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntrenamientos()
    {
        return $this->hasMany(Entrenamientos::className(), ['actividad_id' => 'id'])->inverseOf('actividad');
    }
}
