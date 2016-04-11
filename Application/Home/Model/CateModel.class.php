<?php

/**
 * Created by Stefan Ho.
 * User: Stefan <xiugang.he@chukou1.com>
 * Date: 2016-04-10 20:48
 */
namespace Home\Model;

use Think\Model;

class CateModel extends Model {

    /**
     * 组合一维数组
     * @param $cate
     * @param string $html
     * @param int $pid
     * @param int $level
     * @return array
     */
    public function unlimitedForLevel($cate, $html = '--', $pid = 0, $level = 0) {
        $arr = array();
        foreach($cate as $v) {
            if($v['pid'] == $pid) {
                $v['level'] = $level + 1;
                $v['html'] = str_repeat($html, $level);
                $arr[] = $v;
                $arr = array_merge($arr, self::unlimitedForLevel($cate, $html, $v['id'], $level + 1));
            }
        }

        return $arr;
    }

    /**
     * 组合多维数组
     * @param $cate
     * @param string $name
     * @param int $pid
     * @return array
     */
    public function unlimitedForLayer($cate, $name = 'child', $pid = 0) {
        $arr = array();
        foreach($cate as $v) {
            if($v['pid'] == $pid) {
                $v[$name] = self::unlimitedForLayer($cate, $name, $v['id']);
                $arr[] = $v;
            }
        }

        return $arr;
    }

    /**
     * 传递一个子分类ID返回所有的父级分类
     * @param $cate
     * @param $id
     * @return array
     */
    public function getPerents($cate, $id) {
        $arr = array();
        foreach($cate as $v) {
            if($v['pid'] == $id) {
                $arr[] = $v;
                $arr = array_merge(self::getPerents($cate, $v['pid']), $arr);
            }
        }

        return $arr;
    }

    /**
     * 传递一个父级ID返回所有子级分类ID
     * @param $cate
     * @param $pid
     * @return array
     */
    public function getChildsId($cate, $pid) {
        $arr = array();
        foreach($cate as $v) {
            if($v['pid'] == $pid) {
                $arr[] = $v['id'];
                $arr = array_merge($arr, self::getChildsId($cate, $v['id']));
            }
        }

        return $arr;
    }

    /**
     * 传递一个父分类ID返回所有的子级分类
     * @param $cate
     * @param $pid
     * @return array
     */
    public function getChilds($cate, $pid) {
        $arr = array();
        foreach($cate as $v) {
            if($v['pid'] == $pid) {
                $arr[] = $v;
                $arr = array_merge($arr, self::getChilds($cate, $v['id']));
            }
        }

        return $arr;
    }
}
