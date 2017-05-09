<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendWechatMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate wechat menu';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $wechat = app('wechat');
        $menu = $wechat->menu;
        $button = [
            [
                'type' => 'view',
                'name' => '互助平台',
                'url'  => 'http://cjfpersonal.com'
            ],
            [
                'name' => '地图',
                'sub_button' => [
                    [
                        'type' => 'view',
                        'name' => '活动',
                        'url'  => 'http://cjfpersonal.com'
                    ],
                    [
                        'type' => 'view',
                        'name' => '社团',
                        'url'  => 'http://cjfpersonal.com'
                    ]

                ]
            ],
            [
                'name' => '课程',
                'sub_button' => [
                    [
                        'type' => 'view',
                        'name' => '课程签到',
                        'url'  => 'http://cjfpersonal.com'
                    ],
                    [
                        'type' => 'view',
                        'name' => '课程发起签到',
                        'url'  => 'http://cjfpersonal.com'
                    ]
                ]
            ]
        ];
        $menu->add($button);
        $this->info('successful');
    }
}
