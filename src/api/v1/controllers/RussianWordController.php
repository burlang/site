<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use app\api\v1\components\Controller;
use app\api\v1\resources\RussianWordListResource;
use app\api\v1\resources\RussianWordTranslationsResource;
use app\models\RussianWord;
use app\models\SearchData;
use yii\web\NotFoundHttpException;

class RussianWordController extends Controller
{
    public function actionSearch(string $q): RussianWordListResource
    {
        $q = trim($q);
        if ($q === '') {
            return new RussianWordListResource([]);
        }
        $words = RussianWord::find()
            ->select('name')
            ->filterWhere(['like', 'name', "{$q}%", false])
            ->orderBy('name')
            ->limit(10)
            ->asArray()
            ->column();

        return new RussianWordListResource($words);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionTranslate(string $q): RussianWordTranslationsResource
    {
        $q = trim($q);
        $word = RussianWord::findOne(['name' => $q]);
        if (!$word) {
            SearchData::add($q, SearchData::TYPE_RUSSIAN);
            throw new NotFoundHttpException('Слово не найдено');
        }

        return new RussianWordTranslationsResource($word->translations);
    }

    /**
     * @return array<string, array<int, string>>
     */
    protected function verbs(): array
    {
        return [
            'search' => ['GET'],
            'translate' => ['GET'],
        ];
    }
}
