<?php

namespace app\modules\api\v1\controllers;

use app\models\RussianWord;
use app\models\SearchData;
use app\modules\api\v1\components\Controller;
use app\modules\api\v1\transformer\RussianWordsTransformer;
use app\modules\api\v1\transformer\RussianWordTranslationsTransformer;
use app\services\SearchDataService;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use yii\web\NotFoundHttpException;

class RussianWordController extends Controller
{
    private const SEARCH_LIMIT = 10;

    public function actionSearch(string $q): array
    {
        $words = RussianWord::find()
            ->filterWhere(['like', 'name', $q . '%', false])
            ->orderBy('name')
            ->limit(self::SEARCH_LIMIT)
            ->all();
        return (new Manager())
            ->createData(new Collection($words, new RussianWordsTransformer()))
            ->toArray()['data'];
    }

    /**
     * @param string $q
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionTranslate(
        SearchDataService $searchDataService,
        string $q
    ): array {
        try {
            $word = $this->getWord($q);
            return (new Manager())
                ->createData(new Item($word, new RussianWordTranslationsTransformer()))
                ->toArray()['data'];
        } catch (NotFoundHttpException $exception) {
            $searchDataService->add($q, SearchData::TYPE_RUSSIAN);
            throw $exception;
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function verbs(): array
    {
        return [
            'search' => ['GET'],
            'translate' => ['GET'],
        ];
    }

    /**
     * @param string $name
     * @return RussianWord
     * @throws NotFoundHttpException
     */
    private function getWord(string $name): RussianWord
    {
        $word = RussianWord::findOne(['name' => $name]);
        if (!$word) {
            throw new NotFoundHttpException('Слово не найдено');
        }
        return $word;
    }
}
