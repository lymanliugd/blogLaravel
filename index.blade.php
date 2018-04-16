@extends('layouts.admin')
@section('content')
    
    <div class="crumb_warp">
        
        <i class="fa fa-home"></i> <a href="{{url('admin.info')}}">Home</a> &raquo; categories
    </div>
   
    <div class="search_wrap">
        <form action="" method="post">
            <table class="search_tab">
                <tr>
                    <th width="120">options:</th>
                    <td>
                        <select onchange="javascript:location.href=this.value;">
                            <option value="">all</option>
                            <option value="http://www.baidu.com">baidu</option>
                            <option value="http://www.sina.com">sina</option>
                        </select>
                    </td>
                    <th width="70">keywords:</th>
                    <td><input type="text" name="keywords" placeholder="keywords"></td>
                    <td><input type="submit" name="sub" value="search"></td>
                </tr>
            </table>
        </form>
    </div>
   
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="#"><i class="fa fa-plus"></i>add</a>
                    <a href="#"><i class="fa fa-recycle"></i>delete</a>
                    <a href="#"><i class="fa fa-refresh"></i>update</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">sort</th>
                        <th class="tc" width="5%">ID</th>
                        <th>category name</th>
                        <th>title</th>
                        <th>views</th>
                        <th>operate</th>
                    </tr>

                    @foreach($data as $v)
                    <tr>
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,{{$v->cate_id}})" value="{{$v->cate_order}}">
                        </td>
                        <td class="tc">{{$v->cate_id}}</td>
                        <td>
                            <a href="#">{{$v->cate_subname}}</a>
                        </td>
                        <td>{{$v->cate_title}}</td>
                        <td>{{$v->cate_view}}</td>
                        <td>
                            <a href="#">modify</a>
                            <a href="#">delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>


                <div class="page_nav">
                    <div>
                        <a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">first</a>
                        <a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">previous</a>
                        <a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>
                        <a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>
                        <span class="current">8</span>
                        <a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>
                        <a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a>
                        <a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">next</a>
                        <a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">last</a>
                        <span class="rows">11 条记录</span>
                    </div>
                </div>



                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    

    <script>
        function changeOrder(obj, cate_id) {
            var cate_order = $(obj).val();
            $.post("{{url('admin/cate/changeOrder')}}",
                {'_token':'{{csrf_token()}}','cate_id':cate_id,'cate_order':cate_order},
                function (data) {
                    if(data.status == 0){
                        layer.msg(data.msg,{icon:6});//layer.layui.com 弹窗库
                    }
                    else{
                        layer.msg(data.msg,{icon:5});
                    }
            });
        }
    </script>
@endsection
