layui.use(['table', 'select', 'treetable','jquery'], function () {
  var $ = layui.jquery;

  try {
    let layadmin = layui.sessionData('layadmin');

    layui.select.config(layadmin.config.select);

    var pageId = layadmin.current.id;
    var pageConfig = layadmin[pageId];// 页面配置

    if (pageConfig === undefined) {
      throw new Error('页面配置参数错误！')
    }

    app[pageId]['actions'] = {}

    if (pageConfig.layout === 'table' || pageConfig.layout === 'treetable') {
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

      const pageTableConfig = pageConfig.components.table.config || false;
      if (!pageTableConfig) {
        throw new Error('表格配置参数错误！')
      }

      layui.each(pageTableConfig.cols[0], function (key, item) {
        if (item.templet !== undefined && layui._typeof(item.templet) === 'string' && item.templet.startsWith('(') && item.templet.endsWith(')')) {
          item.templet = eval(item.templet)
          pageTableConfig.cols[0][key] = item
        }
      })

      table.set(tableGlobalSet);

      if (pageConfig.layout === 'table') {
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

        table.render(pageTableConfig);

        // 表格头事件
        table.on(`toolbar(${pageId})`, function (obj) {
          if (!app[pageId]['actions'].hasOwnProperty(obj.event)) {
            console.error('表格头：[' + obj.event + ']事件未监听')
            return;
          }

          app[pageId]['actions'][obj.event]($(`button[lay-event='${obj.event}']`).data());
        });
      } else if (pageConfig.layout === 'treetable') {
        pageTableConfig.parseData = tableGlobalSet.parseData;

        layui.treetable.render(pageTableConfig);
      }
    }
  } catch (exception) {
    layui.hint().error(exception.message)
  }
})
