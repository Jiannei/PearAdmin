layui.use(['form', 'button', 'popup','sliderVerify'], function () {
  var form = layui.form;
  var button = layui.button;
  var popup = layui.popup;
  var sliderVerify = layui.sliderVerify;

  var slider = sliderVerify.render({
    elem: '#slider',
  })

  // 登 录 提 交
  form.on('submit(login)', function (data) {
    /// 验证
    /// 登录
    /// 动画
    if (slider.isOk()) {
      button.load({
        elem: '.login',
        time: 1000,
        done: function () {
          popup.success("登录成功", function() {
            location.href = "code.html"
          });
        }
      });
    }else{
      layer.msg("请先通过滑块验证");
    }

    return false;
  });
})
