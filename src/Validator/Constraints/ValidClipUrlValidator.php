<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Validator\Constraints;

use App\Validator\Constraints\ValidClipUrl;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class ValidClipUrlValidator
 * @package App\Validator
 */
class ValidClipUrlValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if(!$constraint instanceof ValidClipUrl) {
            throw new UnexpectedTypeException($constraint, ValidClipUrl::class);
        }

        if(!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $match = strpos($value, 'https://clips.twitch.tv/');

        if($match === false) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ url }}', $value)
                ->addViolation();
        }
    }
}