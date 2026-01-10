<?php

declare(strict_types=1);

namespace app\api\v1\components;

use app\api\v1\resources\ResourceInterface;
use yii\base\ActionFilter;

/** @phpstan-ignore-next-line missingType.generics */
class ResourceNormalizer extends ActionFilter
{
    public function afterAction($action, $result): mixed
    {
        if ($result instanceof ResourceInterface) {
            return $result->toArray();
        }

        return $result;
    }
}
