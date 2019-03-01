<?php
namespace app\admin\model;
use think\Model;
class AuthRule extends Model
{
    public function authRuleTree(){
        $authRuleres = $this->order('sort')->select();
        return $this->sort($authRuleres);
    }

    public function sort($data,$pid=0,$level=0){
        static $arr = array();
        foreach ($data as $k => $v) {
            if ($v['pid'] == $pid) {
                $v['dataid'] = $this->getparentid($v['id']);
                $arr[] = $v;
                $this->sort($data,$v['id']);
            }
        }
        return $arr;
    }


    public function getchilrenid($authRuleId){
        $authRuleRes = $this->select();
        return $this->_getchilrenid($authRuleRes,$authRuleId);
    }

    public function _getchilrenid($authRuleRes,$authRuleId){
        static $arr = array();
        foreach ($authRuleRes as $k => $v) {
            if ($v['pid'] == $authRuleId) {
                $arr[] = $v['id'];
                $this->_getchilrenid($authRuleRes,$v['id']);
            }
        }
        return $arr;
    }

    public function getparentid($authRuleId){
        $authRuleRes = $this->select();
        return $this->_getparentid($authRuleRes,$authRuleId,True);
    }

    public function _getparentid($authRuleRes,$authRuleId,$clear=False){
        static $arr = array();
        if ($clear) {
            $arr = array();
        }
        foreach ($authRuleRes as $k => $v) {
            if ($v['id'] == $authRuleId) {
                $arr[] = $v['id'];
                $this->_getparentid($authRuleRes,$v['pid']);
            }
        }

        asort($arr);
        $arrStr = implode('-', $arr);
        return $arrStr;
    }
}
