<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libros".
 *
 * @property int $id
 * @property string $isbn
 * @property string $titulo
 * @property int|null $num_pags
 */
class Libros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'libros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'safe'],
            [['isbn', 'titulo'], 'required'],
            [['num_pags'], 'default', 'value' => null],
            [['num_pags'], 'integer', 'min' => 0],
            [['isbn'], 'string', 'max' => 13],
            [['titulo'], 'string', 'max' => 255],
            [['titulo'], 'trim'],
            [['isbn'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'isbn' => 'ISBN',
            'titulo' => 'Título',
            'num_pags' => 'Núm. págs.',
        ];
    }
}
