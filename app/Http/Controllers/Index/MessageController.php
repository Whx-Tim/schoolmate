<?php

namespace App\Http\Controllers\Index;

use App\Events\UserGetMessageList;
use App\Http\Requests\StoreMessageRequest;
use App\Model\Message;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{

    /**
     * @api {get} message/list/{send_to} 获取消息列表
     * @apiName getMessagesList
     * @apiGroup Message
     *
     * @apiSuccess {Number} id 消息id
     * @apiSuccess {String} content 消息内容
     * @apiSuccess {Number=0,1} readed 已读状态，0：未读，1：已读
     * @apiSuccess {Number} send_to 消息接受用户id
     * @apiSuccess {Number} send_from 消息发送用户id
     * @apiSuccess {Date}   created_at 创建时间/发送时间
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "操作成功",
     *         "data": {
     *         }
     *     }
     */
    public function getList($send_to)
    {
        $messages = Message::getList(Auth::id(), $send_to);
        $form_user = Auth::user()->info;
        $to_user   = User::find($send_to)->info ? : false;
        event(new UserGetMessageList($send_to));

        return $this->ajaxResponse(0, '操作成功', compact('messages', 'form_user', 'to_user'));
    }

    /**
     * @api {post} message/store 发送消息
     * @apiName SendMessage
     * @apiGroup Message
     *
     * @apiParam {String} content 消息内容
     * @apiParam {Number} send_to 消息接受用户id
     *
     * @apiSuccess {Number} id 消息id
     * @apiSuccess {String} content 消息内容
     * @apiSuccess {Number=0,1} readed 已读状态，0：未读，1：已读
     * @apiSuccess {Number} send_to 消息接受用户id
     * @apiSuccess {Number} send_from 消息发送用户id
     * @apiSuccess {Date}   created_at 创建时间/发送时间
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "操作成功",
     *         "data": {
     *         }
     *     }
     */
    public function store(StoreMessageRequest $request)
    {
        $data = $request->except(['_token', '_method']);
        $data['send_from'] = Auth::id();
        $message = Message::create($data);
        $pusher = $this->initPusher();
        $content = $message->content;

        $pusher->trigger('message-channel', 'message-event-'.$request->input('send_to').'-'.Auth::id(), compact('content'));
        $pusher->trigger('message-channel', 'message-event-'.$request->input('send_to'), ['user_id' => Auth::id()]);
        return $this->ajaxResponse(0, '发送成功', compact('message'));
    }

    /**
     * @api {get} message/user/list 获取聊天用户列表
     * @apiName getUserList
     * @apiGroup Message
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "加载成功",
     *         "data": {
     *         }
     *     }
     */
    public function userList()
    {
        $messages = Message::select('send_to','send_from')->where('send_from',Auth::id())->with('to_user.info')->distinct()->get();
        $messages = $messages->each(function ($message) {
            $message->readed = Message::where([
                'send_from' => $message->send_to,
                'send_to'   => $message->send_from,
                'readed'    => 0
            ])->count();
        });

        return $this->ajaxResponse(0, '加载成功', compact('messages'));
    }

    /**
     * @api {get} message/out/{send_to} 退出聊天
     * @apiName outChat
     * @apiGroup Message
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "退出成功",
     *         "data": {
     *         }
     *     }
     */
    public function outChat($send_to)
    {
        event(new UserGetMessageList($send_to));

        return $this->ajaxResponse(0, '退出成功');
    }
}
