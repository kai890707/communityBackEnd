<?php

namespace App\Models\Form;

class ImageValidation extends FormModel
{
    protected $validationRules = [
        'img' => 'mimes:jpg,png,gif,svg,bmp,jpeg|max:5120',
        'carousel.*' => 'mimes:jpg,png,gif,svg,bmp,jpeg|max:5120'
    ];
    protected $messages = [
        'img.mimes' => '圖片格式不正確 必須為以下格式jpg, png, gif, svg, bmp, jpeg！',
        'img.max' => '圖片過大, 最大為4MB！',
        'carousel.*.mimes' => '圖片格式不正確 必須為以下格式jpg, png, gif, svg, bmp, jpeg！',
        'carousel.*.max' => '圖片過大, 最大為4MB！',
    ];

    public function __construct($input)
    {
        $this->inputData = $input;
    }
}