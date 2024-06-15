<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use app\api\v1\components\Controller;
use app\models\BuryatTranslation;
use app\models\BuryatWord;
use app\models\SearchData;
use app\services\SearchDataService;
use yii\web\NotFoundHttpException;

class BuryatWordController extends Controller
{
    /** @phpstan-ignore missingType.iterableValue */
    public function actionSearch(string $q): array
    {
        return BuryatWord::find()
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
    public function actionTranslate(
        SearchDataService $searchDataService,
        string $q
    ): array {
        try {
            $word = $this->getWord($q);
            return [
                'translations' => array_map(
                    static fn (BuryatTranslation $translation) => ['value' => $translation->name],
                    $word->translations
                ),
            ];
        } catch (NotFoundHttpException $exception) {
            $searchDataService->add($q, SearchData::TYPE_BURYAT);
            throw $exception;
        }
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

    /**
     * @throws NotFoundHttpException
     */
    private function getWord(string $value): BuryatWord
    {
        $word = BuryatWord::findOne(['name' => $value]);
        if (!$word) {
            throw new NotFoundHttpException('Слово не найдено');
        }
        return $word;
    }
}
