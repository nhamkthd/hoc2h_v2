@extends('admin.layouts.master')
@section('content')
<style type="text/css">
.jstree-anchor {
  /*enable wrapping*/
  white-space : normal !important;
  /*ensure lower nodes move down*/
  height : auto !important;
}
</style>
<link rel="stylesheet" href="{{ asset('js/flugin/treejs/dist/themes/default/style.min.css') }}" />
<script src="{{ asset('js/flugin/treejs/dist/jstree.min.js') }}"></script>
<script>
  $(function () {
    // 6 create an instance when the DOM is ready
    $('#jstree').jstree({
      'core' : {
        "themes" : {
          "responsive" : true,
          "dots" : true, 
          "icons" : true  },
          'data' : {
            'url' : '/admin/api/category/list',
          },
          'check_callback' : function (operation, node, node_parent, node_position, more) {
            return true;
          },
        },
        "plugins" : ["json_data", "contextmenu", "dnd", "search", "state", "types","unique"],
        'types' : {
          'default' : {
            'icon' : 'fa fa-hand-o-right'
          },
          'f-open' : {
            'icon' : 'fa fa-folder-open fa-fw'
          },
          'f-closed' : {
            'icon' : 'fa fa-folder fa-fw'
          }
        }
      });
    $('#jstree').on('create_node.jstree', function (e, data) {
      $.ajax({
        url: '/admin/category/create',
        type: 'POST',
        data: {parent_id: (data.node.parent=="#")?0:data.node.parent,title:data.node.text},
        success:function (res) {
          data.instance.set_id(data.node, res.id);
        }
      })
    }).on('delete_node.jstree', function (e, data) {
      $.ajax({
        url: '/admin/category/'+data.node.id,
        type: 'DELETE',
          success:function (data) {
        }
      })
    }).on('rename_node.jstree', function (e, data) {
      console.log(data.node.id);
      $.ajax({
        url: '/admin/category/show/'+data.node.id,
        type: 'POST',
        data: {'parent_id': (data.node.parent=="#")?0:data.node.parent,'title':data.node.text},
        success:function (data) {
        }
      })
    }).bind("move_node.jstree", function(e, data) {
      console.log(data);
      $.ajax({
        url: '/admin/category/show/'+data.node.id,
        type: 'POST',
        data: {'parent_id': (data.node.parent=="#")?0:data.node.parent,'title':data.node.text},
        success:function (data) {
        }
      })
    }).on('open_node.jstree', function (event, data) {
      data.instance.set_type(data.node,'f-open');
    }).on('close_node.jstree', function (event, data) {
      data.instance.set_type(data.node,'f-closed');
    }).on('loaded.jstree', function() {
        $('#jstree').jstree('open_all');
    }).jstree();
});
</script>
<section class="content-header">
  <h1>
    Category
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Category</li>
  </ol>
</section>
<!-- list account -->
<section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Quản lý danh mục</h3>
        </div>
        <div class="box-body">
          <div id="jstree">
          </div>
        </div>
      </div>
      <!-- /.box -->

    </section>
@stop