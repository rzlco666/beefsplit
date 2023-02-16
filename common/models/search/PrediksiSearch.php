<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Prediksi;

/**
 * PrediksiSearch represents the model behind the search form about `common\models\Prediksi`.
 */
class PrediksiSearch extends Prediksi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_algoritma', 'id_user'], 'integer'],
            [['nama', 'deskripsi', 'dataset_name', 'dataset_save_name', 'date_created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Prediksi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_algoritma' => $this->id_algoritma,
            'date_created' => $this->date_created,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['like', 'dataset_name', $this->dataset_name])
            ->andFilterWhere(['like', 'dataset_save_name', $this->dataset_save_name]);

        return $dataProvider;
    }
}
