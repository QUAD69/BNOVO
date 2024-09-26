<?php
declare(strict_types=1);

namespace App\Forms;

use App\Helpers\Country;
use App\Models\Guest;
use Phalcon\Filter\Validation\Validator\Email as EmailValidator;
use Phalcon\Filter\Validation\Validator\Numericality;
use Phalcon\Filter\Validation\Validator\Regex;
use Phalcon\Filter\Validation\Validator\StringLength;
use Phalcon\Filter\Validation\Validator\Uniqueness;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;

class GuestComposeForm extends Form
{
    public function initialize(): void
    {
        $firstName = new Text('first_name');

        $firstName->addValidator(new StringLength([
            'min' => 2,
            'max' => 50
        ]));

        $this->add($firstName);

        $lastName = new Text('last_name');

        $lastName->addValidator(new StringLength([
            'min' => 2,
            'max' => 50
        ]));

        $this->add($lastName);

        $country = new Text('country');

        $country->addValidator(new Regex([
            'pattern' => '/[A-Z]{2}/',
            'message' => 'Field country must be specified in 2-digit iso format',
            'allowEmpty' => true
        ]));

        $this->add($country);

        $email = new Email('email');

        $email->addValidator(new EmailValidator());

        $email->addValidator(new Uniqueness([
            'model' => new Guest(),
            'attribute' => 'email'
        ]));

        $email->addValidator(new StringLength([
            'min' => 6,
            'max' => 50
        ]));

        $this->add($email);

        $phone = new Numeric('phone');

        $phone->addValidator(new Numericality());

        $phone->addValidator(new Uniqueness([
            'model' => new Guest(),
            'attribute' => 'phone'
        ]));

        $phone->addValidator(new StringLength([
            'min' => 8,
            'max' => 20
        ]));

        $this->add($phone);
    }

    public function isValid($data = null, $entity = null, array $whitelist = []): bool
    {
        if (parent::isValid($data, $entity, $whitelist)) {
            if (empty($this->data['country'])) {
                $this->data['country'] = Country::resolveByPhone($this->data['phone']);
            }

            return true;
        }

        return false;
    }
}