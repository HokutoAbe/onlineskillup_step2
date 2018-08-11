<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', '名前を入力してください。')
            ->notEmpty('userid', 'ユーザー名を入力してください。')
            ->notEmpty('password', 'パスワードを入力してください。')
            ->notEmpty('passwordRe', 'パスワード(確認用)を入力してください。')
            ->notEmpty('mailaddress', 'メールアドレスを入力してください。')
            ->add('username', [
              'minLength' => [
                'rule' => ['minLength', 4],
                'message' => '名前は4文字以上で入力してください',
              ],
              'maxLength' => [
                'rule' => ['maxLength', 20],
                'message' => '名前は20文字以下で入力してください',
              ],
              'str' => [
                'rule' => [$this, 'alphaNumericBarEm'],
                'message' => '名前は全角文字,半角英数字,-,_で入力してください。',
              ]
            ])
            ->add('userid', [
              'minLength' => [
                'rule' => ['minLength', 4],
                'message' => 'ユーザー名は4文字以上で入力してください',
              ],
              'maxLength' => [
                'rule' => ['maxLength', 20],
                'message' => 'ユーザー名は20文字以下で入力してください',
              ],
              'str' => [
                'rule' => [$this, 'alphaNumericBar'],
                'message' => 'ユーザー名は半角英数字,-,_で入力してください。',
              ],
              'unique' => [
                 'rule' => 'validateUnique',
                 'provider' => 'table',
                 'message' => '入力したユーザーはすでに存在しています。'
              ]
            ])
            ->add('password', [
              'minLength' => [
                'rule' => ['minLength', 4],
                'message' => 'パスワードは4文字以上で入力してください',
              ],
              'maxLength' => [
                'rule' => ['maxLength', 8],
                'message' => 'パスワードは8文字以下で入力してください',
              ],
              'str' => [
                'rule' => [$this, 'alphaNumeric'],
                'message' => 'パスワードは半角英数字で入力してください。',
              ]
            ])
            ->add('password', 'custom', [
              'rule' => [$this, 'samePass'],
              'message' => 'パスワードが一致しません。'
            ])
            ->add('mailaddress', [
              'maxLength' => [
                'rule' => ['maxLength', 100],
                'message' => 'ユーザー名は100文字以下で入力してください',
              ]
            ])
            ->email('mailaddress',false,'メールアドレスで入力してください。')
            ;
    }
    public function samePass($value, $data){
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