<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WechatEvent extends Model
{
    public static function eventHandle($message)
    {
        return call_user_func([new self(), static::StringToMethod($message->EventKey)], $message);
    }

    public function unicodeDecode($data)
    {
        $word = json_decode(preg_replace_callback('/&#(\d{5});/', create_function('$dec', 'return \'\\u\'.dechex($dec[1]);'), '"'.$data.'"'));
        return $word;
    }

    public function postToSign()
    {
        $post = new WechatPost("orginal","http://lz.goszu.com/tp5/public/index.php/lewei/","szu",file_get_contents("php://input"));
        echo $post->result();
        exit();
    }

    public static function StringToMethod($string)
    {
        switch ($string) {
            case '签到打卡':
                return 'signCard';
            default:
                return 'other';
        }
    }

    public function other()
    {
        return '欢迎您关注校友共享圈公众号';
    }

    public function signCard($message)
    {
        $this->postToSign();
        exit;
    }
}
