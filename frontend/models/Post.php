<?php

namespace frontend\models;

use Yii;
use yii\db\Query;
use frontend\models\PostTag;
use yii\data\SqlDataProvider;

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
    public $tagsList;
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
            [['tagsList'],'safe'],
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

    public function insertPost($request)
    {
      $this->title = $request['title'];
      $this->description = $request['description'];
      $this->category_id = $request['category_id'];
      $this->user_id = Yii::$app->user->getId();
      return $this->save() ? $this->insertTags($request) : false;
    }

    public function insertTags($request)
    {
      if(is_array($request['tags'])) {
        foreach ($request['tags'] as $tag_id) {
            $newTag = new PostTag();
            $newTag->post_id = $this->id;
            $newTag->tag_id = $tag_id;
            $newTag->save();
        }
        return $newTag;
      }
      return true;
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

    public function getAllCategories()
    {
        return Category::find()->select('name')->indexBy('id')->column();
    }

    public function getAllTags()
    {
        return Tag::find()->select('name')->indexBy('id')->column();
    }

    public function getTagsByPostID($id)
    {
        $sql = 'select tag.name
              from tag inner join post_tag
              on post_tag.tag_id = id
              where post_tag.post_id = :ID';
        $dataProvider = new SqlDataProvider([
             'sql' => $sql,
             'params' => [':ID' => $id],
             'pagination' => [
                  'pageSize' => 20,
             ],
           ]);

        $tags = $dataProvider->getModels();
        $tags_list = implode(' , ', array_map(function ($entry) {
          return $entry['name'];
        }, $tags));
        return $tags_list;
    }
}
