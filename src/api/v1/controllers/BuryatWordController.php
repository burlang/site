<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use app\api\v1\components\Controller;
use app\api\v1\resources\BuryatWordListResource;
use app\api\v1\resources\BuryatWordTranslationsResource;
use app\models\BuryatWord;
use app\models\SearchData;
use yii\web\NotFoundHttpException;

class BuryatWordController extends Controller
{
    public function actionSearch(string $q): BuryatWordListResource
    {
        $q = trim($q);
        $words = BuryatWord::find()
            ->select('name')
            ->filterWhere(['like', 'name', "{$q}%", false])
            ->orderBy('name')
            ->limit(10)
            ->asArray()
            ->column();

        return new BuryatWordListResource($words);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionTranslate(string $q): BuryatWordTranslationsResource
    {
        $q = trim($q);
        $word = BuryatWord::findOne(['name' => $q]);
        if (!$word) {
            SearchData::add($q, SearchData::TYPE_BURYAT);
            throw new NotFoundHttpException('Слово не найдено');
        }

        return new BuryatWordTranslationsResource($word->translations);
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
