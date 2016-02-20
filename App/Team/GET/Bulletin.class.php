<?php

namespace App\Team\GET;

/**
 * 公告栏
 */
class Bulletin extends Content {

    /**
     * 查看公告栏详情
     */
    public function view(){
        $id = $this->isG('id', '请选择您要查看的公告');
        $content = \Model\Content::findContent('bulletin', $id, 'bulletin_id');
        if(empty($content)){
            $this->error('公告不存在');
        }
        $this->assign($content);
        $this->display();
    }

}