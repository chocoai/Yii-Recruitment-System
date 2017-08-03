<?php
Yii::app()->clientScript->registerScript('upload', "
        $('#input-file').ace_file_input({
            style: 'well',
            btn_choose: '点击选择文件',
            btn_change: null,
            droppable: true,
            thumbnail: 'small',
            allowExt: ['xls'],
            allowMime: ['application/vnd.ms-excel'],
        });
        $('#input-file').on('file.error.ace', function (ev, info) {
            if (info.error_count['ext'] || info.error_count['mime']) bootbox.alert('无效的文件类型!请选择表格xls文件!');
        });
        $('#import-submit').click(function(){
            var filePath=$('input[name=file]').val();
            if(filePath==undefined || $.trim(filePath)==''){
                bootbox.alert('请选择上传文件!');
                return false;
            }else{
                $('#import-form').submit();
            }
        });
");
?>

<div tabindex="-1" class="modal" id="import-modal" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="blue bigger">导入</h4>
            </div>

            <?php $form = $this->beginWidget('CActiveForm', array(
                'action' => Yii::app()->createUrl('interview/feedback/import'),
                'method' => 'POST',
                'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'import-form'),
            )); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <input type="file" id="input-file" name="file">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-sm">
                    <i class="ace-icon fa fa-times"></i>
                    取消
                </button>

                <button class="btn btn-sm btn-primary" id="import-submit">
                    <i class="ace-icon fa fa-check"></i>
                    保存
                </button>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>