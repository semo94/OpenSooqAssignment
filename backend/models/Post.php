<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $user_id
 * @property integer $category_id
 * @property string $updated_at
 * @property string $created_at
 *
 * @property Category $category
 * @property User $user
 * @property PostTag[] $postTags
 * @property Tag[] $tags
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'user_id', 'category_id'], 'required'],
            [['user_id', 'category_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['title', 'description'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('post_tag', ['post_id' => 'id']);
    }

    public function getDublicated(){
      $query = new Query();
      $provider = new ActiveDataProvider([
          'query' => $query->select('title, description, COUNT(*)')
                  ->from('post')
                  ->groupBy('title , description')
                  ->having('COUNT(*) > 1'),
          'pagination' => [
              'pageSize' => 20,
          ],
      ]);
      return $provider;
    }

    public function deleteOldPosts(){
      $query = 'delete from post_tag where post_id in (SELECT id from post where created_at < ADDDATE(NOW(),-3));
                delete from post where created_at < ADDDATE(NOW(),-3);';
      $command = Yii::$app->db->createCommand($query);
      $command->execute();

    }
}
