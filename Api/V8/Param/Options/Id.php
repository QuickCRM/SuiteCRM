<?php
namespace Api\V8\Param\Options;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

#[\AllowDynamicProperties]
class Id extends BaseOption
{
    /**
     * @inheritdoc
     */
    public function add(OptionsResolver $resolver)
    {
        // support de $sugar_config['strict_id_validation'] = false;
        $idValidator = new \SuiteCRM\Utility\SuiteValidator();
        $pattern = $idValidator->getIdValidationPattern();

        $resolver
            ->setRequired('id')
            ->setAllowedTypes('id', 'string')
            ->setAllowedValues('id', $this->validatorFactory->createClosure([
                new Assert\Regex($pattern)
            ]));
    }
}
