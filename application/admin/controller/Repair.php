<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\5\13 0013
 * Time: 11:43
 */

namespace app\admin\controller;



use function com\PclZipUtilPathReduction;
use think\Db;

class Repair extends Admin
{
    public function index()
    {
       $list = Db::table('tprepair')->paginate(3,true);
//       var_dump($repair);die;
        $this->assign('list',$list);
        $this->assign('meta_title', '菜单列表');
        return $this->fetch();
    }


    //新增保修
    public function add()
    {

        if (request()->isPost()) {
//            $Menu = model('Menu');
            $r=request()->post();
            $repair = new \app\admin\model\Repair();
            $repair->data([
                'name'  =>  $r['name'],
                'tel' =>  $r['tel'],
                'address'=>$r['address'],
                'content'=>$r['content'],
                'title'=>$r['title'],
                'time'=>$r['time'],
            ]);
            $repair->save();
            $this->success('新增成功','repair/index');
//            return $this->fetch ( 'repair/index' );
        }else{

            return $this->fetch();
        }

    }

    //修改

    public function edit($id){
        if($this->request->isPost()){
            $r=request()->post();
            $repair = new \app\admin\model\Repair();
            $repair->where('id','=',$id)->data([
                'name'  =>  $r['name'],
                'tel' =>  $r['tel'],
                'address'=>$r['address'],
                'content'=>$r['content'],
                'title'=>$r['title'],
                'time'=>$r['time'],
            ]);
            $repair->save();
            $this->success('修改成功','repair/index');
//            return $this->fetch ( 'repair/index' );
        } else {
            $info = array();
            /* 获取数据 */
            $info = \think\Db::name('repair')->find($id);
            $this->assign('info', $info);
            $this->meta_title = '编辑导航';
            return $this->fetch();
        }
    }


    //修改的保存
    public function update(){


    }




    //删除
    public function del($id){
       \app\admin\model\Repair::destroy($id);
            $this->success('删除成功');
    }


}