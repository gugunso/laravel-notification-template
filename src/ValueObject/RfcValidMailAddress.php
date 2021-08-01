<?php

namespace Gugunso\LaravelNotificationTemplate\ValueObject;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Support\Facades\App;
use Swift_RfcComplianceException;

/**
 * Class ValidMailAddress
 * @package Gugunso\LaravelNotificationTemplate\ValueObject
 */
class RfcValidMailAddress extends StringValue
{
    /**
     * RfcValidMailAddress constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    /**
     * @param string $value
     * @throws Swift_RfcComplianceException
     */
    protected function setValue(string $value): void
    {
        /** @var EmailValidator $validator serializeされないよう、プロパティとして持たせずにここでインスタンス取得 */
        $validator = App::make(EmailValidator::class);
        if (!$validator->isValid($value, App::make(RFCValidation::class))) {
            throw new Swift_RfcComplianceException('Invalid mail address.');
        }
        $this->value = $value;
    }
}