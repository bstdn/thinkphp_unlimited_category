<?php
namespace Home\Controller;
use Think\Controller;
class CateController extends Controller {
    
    /**
     * 列表
     */
    public function index() {
        $this->display();
    }

    /**
     * 添加
     */
    public function add() {
        if(IS_POST) {
            $this->_add_post();
        } else {
            $this->_add_get();
        }
    }

    protected function _add_post() {
    }

    protected function _add_get() {
        $this->display();
    }

    /**
     * 编辑
     */
    public function edit() {
        if(IS_POST) {
            $this->_edit_post();
        } else {
            $this->_edit_get();
        }
    }

    protected function _edit_post() {
    }

    protected function _edit_get() {
        $this->display();
    }

    /**
     * 删除
     */
    public function del() {
    }
}
