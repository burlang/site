<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use app\api\v1\components\Controller;
use app\models\RussianTranslation;
use app\models\RussianWord;
use app\models\SearchData;
use yii\web\NotFoundHttpException;

class RussianWordController extends Controller
{
    /** @phpstan-ignore missingType.iterableValue */
    public function actionSearch(string $q): array
    {
        return RussianWord::find()
            ->select(['value' => 'name'])
            ->filterWhere(['like', 'name', $q . '%', false])
            ->orderBy('name')
            ->limit(10)
            ->asArray()
            ->all();
    }

    /**
     * @return array<string, array<array<string, string>>>
     * @throws NotFoundHttpException
     */
    public function actionTranslate(string $q): array
    {
        $q = trim($q);
        $word = RussianWord::findOne(['name' => $q]);
        if (!$word) {
            SearchData::store($q, SearchData::TYPE_RUSSIAN);
            throw new NotFoundHttpException('Слово не найдено');
        }

        return [
            'translations' => array_map(
                static fn (RussianTranslation $translation) => ['value' => $translation->name],
                $word->translations
            ),
        ];
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
