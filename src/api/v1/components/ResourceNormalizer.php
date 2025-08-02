<?php

declare(strict_types=1);

namespace app\api\v1\components;

use app\api\v1\resources\ResourceInterface;
use yii\base\ActionFilter;

class ResourceNormalizer extends ActionFilter
{
    /** @phpstan-ignore missingType.generics */
    public function afterAction($action, $result): mixed
    {
        if ($result instanceof ResourceInterface) {
            return $result->toArray();
        }

        return $result;
    }
}
