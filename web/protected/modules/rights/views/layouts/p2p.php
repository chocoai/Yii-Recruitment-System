<?php $this->beginContent(Rights::module()->appLayout); ?>
    <style type="text/css">
        #rights .span-12{
            margin-left: 0;
            width: 470px;
            float: left;
        }
        #rights .span-11{
            float: left;
            width:430px;
        }
    </style>
    <div id="rights">
        <?php $this->renderPartial('/_flash'); ?>
        <?php echo $content; ?>
    </div>
<?php $this->endContent(); ?>