layui.use(['form', 'http', 'popup', 'context', 'util'], function () {
    let form = layui.form;
    let http = layui.http;
    let popup = layui.popup;
    let context = layui.context;
    var util = layui.util;

    let layadmin = JSON.parse(context.get('layadmin'));

    let actions = {
        fetchPageConfig: function () {
            http.ajax({
                url: '/admin/page/config?referer=' + layadmin.referer,
                type: 'get',
                success: function (response) {
                    if (response.status === 'success') {
                        form.val('tool-debug', {config: JSON.stringify(response.data, null, 4)})
                        layui.$('#Lay-debug').focus();
                    } else {
                        popup.failure(response.message);
                    }
                },
                error: function (e, code) {
                    http.ajax.logError(e)
                }
            })
        },
        updatePageConfig: function (data) {
            http.ajax({
                url: '/admin/page/config',
                type: 'put',
                contentType: 'application/x-www-form-urlencoded',
                data: data,
                success: function (response) {
                    if (response.status === 'success') {
                        popup.success(response.message, function () {
                            parent.layer.close(parent.layer.getFrameIndex(window.name));//关闭当前页
                            top.layui.admin.refreshThis()
                        });
                    } else {
                        popup.failure(response.message);
                    }
                },
                error: function (e, code) {
                    http.ajax.logError(e)
                }
            })
        }
    }

    actions.fetchPageConfig();

    util.event('lay-active', {
        restore: function (othis) {
            actions.fetchPageConfig();
        }
    })

    // 修改父级页面的配置
    form.on('submit(tool-debug-submit)', function (data) {
        req = data.field
        req.page = layadmin.referer

        actions.updatePageConfig(req);
    });
})