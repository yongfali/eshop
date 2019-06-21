<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController
{

    /**
     * [index eshop商城首页展示]
     * @return [type] [description]
     */
    public function index(){
        //获取商城导航菜单
        $menu = D('FirstMenu')->getHomeMenu();
        //获取所有消息列表
        $field = array('id,title,modify_time');
        //公告列表
        $note = D('Information')->getInfoLists(3,10,$field);
        //资讯列表
        $infomation = D('Information')->getInfoLists(1,10,$field);
        //优惠活动列表
        $discountInfo = D('Information')->getInfoLists(2,10,$field);
        //获取商城所有商品信息
        $goodList = D('Goodnav')->getGoodLists();
        //模板赋值
        $this->assign('menu',$menu);
        $this->assign('note',$note);
        $this->assign('infomation',$infomation);
        $this->assign('discountInfo',$discountInfo);
        $this->assign('goodList',$goodList);
        $this->display();
    }

   /**
    * [notes 网站消息列表的显示]
    * @return [type] [description]
    */
    public  function notes(){
    	$this->display();
    }

    /**
     * [infoLists 更多消息列表显示]
     * @return [type] [description]
     */
    public function infoLists(){
        $type = I('get.type');
        $dic = array('note','info','discount');
        if(!in_array($type, $dic)){
            E('页面不存在！');
        }
        switch ($type) {
            case 'note':
                $where['type'] = 3;
                break;
            case 'info':
                $where['type'] = 1;
                break;
            default:
                $where['type'] = 2;
                break;
        }
        $where['is_show'] = 1;
        //获取对应消息列表的数量
        $count = D('Information')->infoListNum($where);
        $page = getpage($count,10);
        //分页查询
        $infoList = D('Information')->where($where)
        ->order('modify_time desc')
        ->limit($page->firstRow,$page->listRows)
        ->select();
        if(IS_AJAX){
            $this->assign('infoList', $infoList);
            $this->assign('page', $page->show());
            $html = $this->fetch('Index/infoListAjaxPage');
            $this->ajaxReturn($html);
        }
        $this->assign('infoList',$infoList);
        $this->assign('page', $page->show()); 
        $this->assign('infoType',$type);
        $this->display('Index/info');
    }

   /**
    * [infoDetail 消息具体内容显示]
    * @return [type] [description]
    */
    public function infoDetail(){
        $infoList = D('Information')->infoDetail();
        $this->assign('infoList',$infoList);
    	$this->display();
    }

   /**
    * [moreGoods 同类商品更多显示列表]
    * @return [type] [description]
    */
    public function moreGoods(){
        $fmenu = I('get.fmenu',0,'intval');
        is_num($fmenu);
        $where['w_fid'] = $fmenu;
        if(isset($_GET['smenu'])){
             $smenu = I('get.smenu',0,'intval');
             is_num($smenu);
             $where['s_fid'] = $smenu;
             $this->assign('smenu',$smenu);
        }
        if(isset($_GET['tmenu'])){
             $tmenu = I('get.tmenu',0,'intval');
             is_num($tmenu);
             $where['w_tid'] = $tmenu;
             $this->assign('tmenu',$tmenu);
        }
        $this->assign('fmenu',$fmenu);
        $where['status'] = 1;
        $where['g.is_exam'] = 1;
        $where['is_legal'] = 1;
        $where['g.is_forbid'] = 0;
        $where['stock'] = array('gt',1);
        $count = D('Goodnav')->alias('n')
        ->join('eshop_good as g on n.goodId = g.id')
        ->where($where)
        ->count();
        $page = getpage($count,15);
        $goodList = D('Goodnav')->alias('n')
        ->join('eshop_good as g on n.goodId = g.id')
        ->join('eshop_shop as s on s.id = n.shopId')
        ->where($where)
        ->field(
            array(
                'n.goodId,n.shopId,n.w_fid,
                g.name name,g.shopPrice,g.place,g.good_log,g.count,
                s.name shopName'
                )
            )
        ->order(array('modify_recenet'=>'desc'))
        ->limit($page->firstRow, $page->listRows)
        ->select();
        if(IS_AJAX){
            $this->assign('goodList',$goodList);
            $this->assign('page', $page->show());
            $html = $this->fetch('Index/moreGoodsAjaxPage');
            $this->ajaxReturn($html);
        }
        //浏览记录获取
        $history = D('Good')->getGoodsHistory();
        $this->assign('goodList',$goodList);
        $this->assign('history',$history);
        $this->assign('page', $page->show()); 
        $this->display();
    }

    /**
     * [goodsOrder 按单价或销量排序商品列表]
     * @return [type] [description]
     */
    public function goodsOrder(){
        if(!IS_AJAX){
            E('页面不存在！');
        }
        $type = I('post.type',0,'intval');
        $status = I('post.status'); 
        $ptype = I('post.ptype');
        //搜索页面下的排序
        if($ptype == 'search'){
            $goodName = I('post.name');
            $where['g.name'] = array('like',"%".$goodName."%");
        }
        //更多详情列表下的排序
        else{
            $where['w_fid'] = I('post.fmenu',0,'intval');
            $this->assign('fmenu',I('post.fmenu',0,'intval'));
            if(I('post.smenu',0,'intval')){
                $where['w_sid'] = I('post.smenu',0,'intval');
                $this->assign('smenu',I('post.smenu',0,'intval'));
            }
            if(I('post.tmenu',0,'intval')){
                $where['w_tid'] = I('post.tmenu',0,'intval');
                $this->assign('tmenu',I('post.tmenu',0,'intval'));
            }
        }
        switch ($type) {
            case 2:
                $order = array('shopPrice' => $status);
                break;
            case 3:
                $order = array('count' => $status);
                break;
            default:
                $order = array('modify_recenet' => 'desc');
                break;
        }
        $where['status'] = 1;
        $where['g.is_exam'] = 1;
        $where['g.is_legal'] = 1;
        $where['g.is_forbid'] = 0;
        $count = D('Goodnav')->alias('n')
        ->join('eshop_good as g on n.goodId = g.id')
        ->where($where)
        ->count();
        //分页显示还有bug，因此调大页面数量避免该Bug后期修复
        $page = getpage($count,15);
        $goodList = D('Goodnav')->alias('n')
        ->join('eshop_good as g on n.goodId = g.id')
        ->join('eshop_shop as s on s.id = n.shopId')
        ->where($where)
        ->field(
            array(
                'n.goodId,n.shopId,n.w_fid,
                g.name goodName,g.shopPrice,g.place,g.good_log,g.count,
                s.name shopName'
                )
            )
        ->order(array('modify_recenet'=>'desc'))
        ->limit($page->firstRow, $page->listRows)
        ->order($order)
        ->select();
        //模板赋值
        $this->assign('goodList',$goodList);
        $this->assign('page', $page->show());
        $html = $this->fetch('Index/moreGoodsAjaxPage');
        $this->ajaxReturn($html);
    }

   /**
    * [goodsInfo 商品详情页面展示]
    * @return [type] [description]
    */
    public function goodsInfo(){
        is_num(I('get.id'));
        $goodId = I('get.id');
        //保存浏览记录
        goodsHistory($goodId);
        $where = array('id' => $goodId);
        //获取店铺的ID
        $shopId = D('Goodnav')->getShopIdByGoodId($goodId);
        //获取店铺基本信息
        $field = array('id,name,logo,qrcode,service_qq,server_tel,rank');
        $shopInfo = D('Shop')->getShopInfos($shopId['shopid'],$field);
        //获取商品基本信息
        $goodInfo = D('Good')->where($where)->field('id,goodnumber,name,marketPrice,shopPrice,place,stock,good_log')->find();
        // 获取商品图册
        $goodImgs = D('Good')->alias('g')->field('i.*')->join('eshop_goodimg as i on g.id = i.goodId')->where("g.id = $goodId")->select();
        //获取商品标签详情
        $goodLable = D('Goodinfo')->getLableContetn($goodId);
        //获取商品评论
        $goodComment = D('Goodcomment')->getGoodComments($goodId);
        //获取商品专享服务内容
        $goodService = D('Good')->alias('g')->join('eshop_goodservice as s on g.id = s.goodId')->field('s.content')->where("g.id = $goodId and s.is_show = 1")->select();
        //浏览记录获取
        $history = D('Good')->getGoodsHistory();
        //获取店主推荐商品列表
        $where1 = array('shopId' => $shopId['shopid'],'is_recomend' =>1);
        $recomendGoods = D('Goodnav')->getHostGoods($where1,4); 
        //店铺商品，服务，物流评分获取
        $goodScore = D('Goodcomment')->shopScoreAverage($shopId['shopid']);
        $logisticsSocre = D('Goodcomment')->shopScoreAverage($shopId['shopid'],2);
        $serviceScore = D('Goodcomment')->shopScoreAverage($shopId['shopid'],3);
        //可能喜欢的商品列表获取
        $likeGoods = D('Good')->getMayLikeGoods($goodId);
        //模板赋值
        $this->assign('shopInfo',$shopInfo);
        $this->assign('goodInfo',$goodInfo);
        $this->assign('goodImgs',$goodImgs);
        $this->assign('goodLable',$goodLable);
        $this->assign('goodComment',$goodComment);
        $this->assign('goodService',$goodService);
        $this->assign('goodScore',$goodScore);
        $this->assign('logisticsSocre',$logisticsSocre);
        $this->assign('serviceScore',$serviceScore);
        $this->assign('history',$history);
        $this->assign('recomendGoods',$recomendGoods);
        $this->assign('likeGoods',$likeGoods);
        $this->display();
    }
}