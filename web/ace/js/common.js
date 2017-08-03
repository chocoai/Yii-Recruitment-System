var localsystem = {
    daterangepicker: {
        zh_CN: {
            applyLabel: '确定',
            cancelLabel: '取消',
            fromLabel: '开始日期',
            toLabel: '结束日期',
            monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            daysOfWeek: ['日', '一', '二', '三', '四', '五', '六']
        },
    },
    init: function () {

        $(document).ajaxSuccess(function (event, xhr, options) { //AJAX请求修改浏览器URL
	   window.history.replaceState(null, null, options.url);
        });

        $(document).on("click", ".ajax-link", function () { //A链接变AJAX请求
            var url = $(this).attr('href');
            var title = $(this).attr('data-original-title');
            bootbox.confirm('确认' + title + '？', function (result) {
                if (result) {
                    $.get(url, {}, function () {
                        var gid = $('.list-view').attr('id');
                        gid == undefined ? '' : $.fn.yiiListView.update(gid);
                        var gid = $('.igrid-view').attr('id');
                        gid == undefined ? '' : $.fn.yiiGridView.update(gid);
                    });
                }
            });
            return false;
        });
        $(document).on("click", ".clear-form", function () { //清空表单
            var from = $(this).closest("form");
            $(':input', from)
                .not(':button, :submit, :reset, :hidden')
                .val('')
                .removeAttr('checked')
                .removeAttr('selected');
        });
    },
    include_css: function (path) {//包含加载CSS文件
        //
        if (path == null || typeof(path) != 'string') return;
        var link = document.createElement('link');
        link.type = 'text/css';
        link.rel = 'stylesheet';
        link.href = path;
        $.ajaxSetup({cache: true});
        $('head').append(link);
    },
    include_js: function (path) {//包含加载JS文件
        if (path == null || typeof(path) != 'string') return;
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.charset = 'utf-8';
        script.src = path;
        $.ajaxSetup({cache: true});
        $('head').append(script);
    },
    picker: function () {//日期选择控件
        localsystem.include_css(PING_URL + '/ace/css/datepicker.css');
        localsystem.include_js(PING_URL + '/ace/js/date-time/bootstrap-datepicker.min.js');
        localsystem.include_js(PING_URL + '/ace/js/date-time/locales/bootstrap-datepicker.zh-CN.js');
        $('.date-picker').datepicker({
            language: 'zh-CN',
            autoclose: true,
            todayHighlight: true,
            todayBtn: true
        });
    },
    range_picker: function () {//日期区间选择控件
        localsystem.include_css(PING_URL + '/ace/css/daterangepicker.css');
        localsystem.include_js(PING_URL + '/ace/js/date-time/moment.min.js');
        localsystem.include_js(PING_URL + '/ace/js/date-time/daterangepicker.min.js');
        $('.range-picker').daterangepicker({
            format: 'YYYY/MM/DD',
            locale: localsystem.daterangepicker.zh_CN
        });
    },
    timepicker: function () {//时间选择控件
        localsystem.include_css(PING_URL + '/ace/css/bootstrap-timepicker.css');
        localsystem.include_js(PING_URL + '/ace/js/date-time/bootstrap-timepicker.min.js');
        $('.data-timepicker').timepicker({
            minuteStep: 30,
            showSeconds: false,
            showMeridian: false,
            defaultTime: false
        }).next().on(ace.click_event, function () {
            $(this).prev().focus();
        });
    },
};

$(document).ready(function () {
    localsystem.init();
});
