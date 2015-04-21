<div class="row fileupload-buttonbar">
    <div class="span7">
        <span class="btn btn-success fileinput-button">
            <i class="glyphicon glyphicon-plus"></i>
            <span><?php echo $this->t('1#Add files|0#Choose Image', $this->multiple); ?></span>
            <?php
            if ($this->hasModel())
                echo CHtml::activeFileField($this->model, $this->attribute, $htmlOptions);
            else echo CHtml::fileField($name, $this->value, $htmlOptions);
            ?>
        </span>
        <?php if ($this->multiple) { ?>
            <button type="submit" class="btn btn-primary start">
                <i class="glyphicon glyphicon-upload"></i>
                <span>Upload all</span>
            </button>
            <button type="reset" class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span>Cancel all</span>
            </button>
<!--            <button type="button" class="btn btn-danger delete">
                <i class="glyphicon glyphicon-trash"></i>
                <span>Delete</span>
            </button>-->
            <!--<input type="checkbox" class="toggle">-->
        <?php } ?>
    </div>
</div>
<div class="fileupload-loading"></div>
<table class="table table-striped">
    <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
</table>