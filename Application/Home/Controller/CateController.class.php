<?php

/**
 * Created by Stefan Ho.
 * User: Stefan <xiugang.he@chukou1.com>
 * Date: 2016-04-10 12:08
 */
namespace Home\Controller;

use Think\Controller;

class CateController extends Controller {

    /**
     * 列表
     */
    public function index() {
        if(IS_POST) {
            $this->_index_post();
        } else {
            $this->_index_get();
        }
    }

    protected function _index_post() {
        $CateModel = M('Cate');
        foreach(I('post.') as $id => $sort) {
            $CateModel->save(array('id' => $id, 'sort' => $sort));
        }

        $this->redirect('index');
    }

    protected function _index_get() {
        $CateModel = D('Cate');
        $CateData = $CateModel->select();
        $CateList = $CateModel->unlimitedForLevel($CateData);

        $this->list = $CateList;
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
        $result = M('Cate')->add(I('post.'));
        if($result) {
            $this->success('保存成功', U('Cate/index'));
        } else {
            $this->error('保存失败');
        }
    }

    protected function _add_get() {
        $CateModel = D('Cate');
        $CateData = $CateModel->select();
        $CateList = $CateModel->unlimitedForLevel($CateData);
        $id = I('get.id');

        $this->list = $CateList;
        $this->id = $id;
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
        $data = I('post.');
        if($data['id'] == $data['pid']) {
            $this->error('不能选择自己');
        }
        $CateModel = M('Cate');
        $result = $CateModel->save($data);
        if($result) {
            $this->success('保存成功', U('Cate/index'));
        } else {
            $this->error('保存失败');
        }
    }

    protected function _edit_get() {
        $CateModel = D('Cate');
        $CateData = $CateModel->select();
        $CateList = $CateModel->unlimitedForLevel($CateData);
        $id = I('get.id');
        $data = $CateModel->find($id);
        if(!$data) {
            $this->error('记录不存在');
        }

        $this->list = $CateList;
        $this->data = $data;
        $this->display();
    }

    /**
     * 删除
     */
    public function del() {
        $CateModel = M('Cate');
        $id = I('get.id');
        $data = $CateModel->find($id);
        if(!$data) {
            $this->error('记录不存在');
        }
        $childData = $CateModel->where(array('pid' => $data['id']))->find();
        if($childData) {
            $this->error('请先删除子类');
        }

        $result = $CateModel->delete($id);
        if($result) {
            $this->success('保存成功', U('Cate/index'));
        } else {
            $this->error('保存失败');
        }
    }
}
