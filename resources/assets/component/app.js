layui.use(['table', 'select', 'treetable','jquery'], function () {
  var $ = layui.jquery;
  var table = layui.table;
  var tableConfig = layadmin.config.table;
  var tableGlobalSet = {
    parseData: eval(tableConfig.parseData),
    response: {
      statusName: tableConfig.response.statusName,
      statusCode: tableConfig.response.statusCode,
    },
    defaultToolbar: tableConfig.defaultToolbar,
    page: tableConfig.page,
    skin: tableConfig.skin,
    even: tableConfig.even,
  }

  var pageConfig = layadmin.current.config;// 页面配置
  var pageId = layadmin.current.id;

  var bootstrap = new function(){
    this.select = function () {
      layui.select.config(layadmin.config.select);
    };

    this.table = function (pageTableConfig) {
      layui.each(pageTableConfig.cols[0], function (key, item) {
        if (item.templet !== undefined && layui._typeof(item.templet) === 'string' && item.templet.startsWith('(') && item.templet.endsWith(')')) {
          item.templet = eval(item.templet)
          pageTableConfig.cols[0][key] = item
        }
      })

      table.set(tableGlobalSet);
      table.render(pageTableConfig);
    };

    this.tableEvent = function (pageConfig) {
      // 表格头事件
      table.on(`toolbar(${layadmin.current.id})`, function (obj) {
        if (!layadmin.current.actions.hasOwnProperty(obj.event)) {
          console.error('表格头：[' + obj.event + ']事件未监听')
          return;
        }

        layadmin.current.actions[obj.event]($(`button[lay-event='${obj.event}']`).data());
      });

      // 展开搜索
      if (pageConfig.components.search !== undefined && pageConfig.components.search.items.length > 3) {
        layui.util.event('lay-active', {
          searchExpand: function () {
            let pageSession = layui.sessionData(pageId);

            var $this = layui.$(this);
            var $form = $this.parents('.layui-form').first();

            if (pageSession.expand === undefined || pageSession.expand === true) {
              layui.sessionData(pageId, {
                key: 'expand',
                value: false
              })

              $this.html('收起 <i class="layui-icon layui-icon-up"></i>');
              var $elem = $form.find('.layui-hide');
              $elem.attr('expand-show', '');
              $elem.removeClass('layui-hide');
            } else {
              layui.sessionData(pageId, {
                key: 'expand',
                value: true
              })

              $this.html('展开 <i class="layui-icon layui-icon-down"></i>');
              $form.find('[expand-show]').addClass('layui-hide');
            }
          }
        });
      }
    };

    this.treeTable = function (pageTableConfig) {
      pageTableConfig.parseData = tableGlobalSet.parseData;

      layui.treetable.render(pageTableConfig);
    };
  }

  try {
    // 全局配置下拉参数
    bootstrap.select();

    // 全局配置表格参数
    if (pageConfig.layout === 'table' || pageConfig.layout === 'treetable') {
      const pageTableConfig = pageConfig.components.table.config || false;
      if (!pageTableConfig) {
        throw new Error('表格配置参数错误！')
      }

      if (pageConfig.layout === 'table') {
        bootstrap.table(pageTableConfig);
        bootstrap.tableEvent(pageConfig);
      }

      if (pageConfig.layout === 'treetable') {
        bootstrap.treeTable(pageTableConfig)
      }
    }
  } catch (exception) {
    layui.hint().error(exception.message)
  }
})
