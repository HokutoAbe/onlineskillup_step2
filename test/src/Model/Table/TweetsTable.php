<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class TweetsTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('sentence', 'つぶやきを入力してください。')
            ->add('sentence', [
              'maxLength' => [
                'rule' => ['maxLength', 140],
                'message' => 'つぶやきは140文字以下で入力してください',
              ],
            ])
            ;
    }
    public function samePass($value, $data){
        debug($data['data']);
        return (bool) ($value == $data['data']['passwordRe']);
    }
    public static function alphaNumeric($value, $data) {
        return (bool) preg_match('/^[a-zA-Z0-9]+$/', $value);
    }
    public static function alphaNumericBar($value, $data) {
        return (bool) preg_match('/^[a-zA-Z0-9\-\_]+$/', $value);
    }
    public static function alphaNumericBarEm($value, $data) {
        return (bool) preg_match('/^([a-zA-Z0-9\-\_]|[^\x01-\x7E\xA1-\xDF])+$/', $value);
    }
    

}
?>