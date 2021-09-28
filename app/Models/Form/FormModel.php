<?php

namespace App\Models\Form;

use Illuminate\Support\Facades\Validator;

class FormModel
{
    protected $validationRules;
    protected $inputData;
    protected $validator;
    protected $messages;

    public function __construct($input)
    {
        $this->inputData = $input;
    }

    public function isValid()
    {
        $this->validator = Validator::make($this->inputData, $this->validationRules, $this->messages);
        return $this->validator->fails();
    }

    public function getErrors()
    {
        return $this->validator->errors()->all();
    }

}
