<?php
/**
 * @author Nicolas Charlotn
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class InvalidClipUrl
 * @package App\Validator\Constraints
 * @Annotation
 */
class ValidClipUrl extends Constraint
{
    public $message = 'The url "{{ url }}" is not a valid twitch clip url.';

    public function validatedBy()
    {
       return \get_class($this).'Validator';
    }
}