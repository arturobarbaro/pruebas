<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrenamientos".
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $actividad_id
 * @property string $anotacion
 * @property string $fecha
 * @property int $duracion
 *
 * @property Actividades $actividad
 * @property Usuarios $usuario
 */
class Entrenamientos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entrenamientos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'actividad_id'], 'required'],
            [['usuario_id', 'actividad_id', 'duracion'], 'default', 'value' => null],
            [['usuario_id', 'actividad_id', 'duracion'], 'integer'],
            [['fecha'], 'safe'],
            [['anotacion'], 'string', 'max' => 255],
            [['actividad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Actividades::className(), 'targetAttribute' => ['actividad_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'actividad_id' => 'Actividad ID',
            'anotacion' => 'Anotacion',
            'fecha' => 'Fecha',
            'duracion' => 'Duracion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividad()
    {
        return $this->hasOne(Actividades::className(), ['id' => 'actividad_id'])->inverseOf('entrenamientos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('entrenamientos');
    }
}
