<?php

namespace App\Models\Form;

class PostValidation extends FormModel
{
    protected $validationRules = [
        'title' => 'required',
        // 'content' => 'required'
    ];
    protected $messages = [
        'title.required' => '文章發佈需要標題!',
        // 'content.required' => '文章發佈需要內容!',
    ];

    public function __construct($input)
    {
        $this->inputData = $input;
    }
}
