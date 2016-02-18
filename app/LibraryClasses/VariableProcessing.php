<?php namespace App\LibraryClasses;

class VariableProcessing {
	public function transliterate($input) {
        $gost = array(
            "Є" => "YE", "І" => "I", "Ѓ" => "G", "і" => "i", "№" => "-", "є" => "ye", "ѓ" => "g",
            "А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Д" => "D",
            "Е" => "E", "Ё" => "YO", "Ж" => "ZH",
            "З" => "Z", "И" => "I", "Й" => "J", "К" => "K", "Л" => "L",
            "М" => "M", "Н" => "N", "О" => "O", "П" => "P", "Р" => "R",
            "С" => "S", "Т" => "T", "У" => "U", "Ф" => "F", "Х" => "X",
            "Ц" => "C", "Ч" => "CH", "Ш" => "SH", "Щ" => "SHH", "Ъ" => "'",
            "Ы" => "Y", "Ь" => "", "Э" => "E", "Ю" => "YU", "Я" => "YA",
            "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d",
            "е" => "e", "ё" => "yo", "ж" => "zh",
            "з" => "z", "и" => "i", "й" => "j", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "x",
            "ц" => "c", "ч" => "ch", "ш" => "sh", "щ" => "shh", "ъ" => "",
            "ы" => "y", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
            " " => "-", "," => "_", "!" => "_", "@" => "_",
            "#" => "-", "$" => "", "%" => "", "^" => "", "&" => "", "*" => "",
            "(" => "", ")" => "", "+" => "", "=" => "", ";" => "", ":" => "",
            ".jpg" => "", ".jpeg" => "", "/" => "-", "." => "-"
        );
        $input = trim($input, "\x00..\x1F");
        $input = trim($input, "-");
        $input = trim($input, "_");
        return strtr($input, $gost);
    }
    public function requestProcessing($input, $files) {
        if(($files->all()!=array())&&$input->images->has(0)){
            $images = array_merge($input['images'], $files->all());
            $input['images'] = implode(",", $images);
        }
        elseif(isset($input->images[0])) {
            $input['images'] = implode(",", $input['images']);
        }
        elseif($files->all()!=array()) {
            $images = $files->all();
            $input['images'] = implode(",", $images);
        }
        $input['slug'] = $this->transliterate($input['slug']);
        return $input;
    }
    public function fileProcessing($files) {
        dd($files);

    }

}
