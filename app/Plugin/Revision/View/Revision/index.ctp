<h3>Revision page</h3>
<br/>
<?php if(!empty($dataList)):?>
    <?php if ($flag == 1):?>
        <div>
            <div>
                <span><b>Model : </b><i><?php echo $dataList[0]['Revisions']['model']?></i></span><br/>
                <span><b>Object ID : </b><i><?php echo $dataList[0]['Revisions']['object_id']?></i></span>
            </div>
            <br/>
            <div class="text-danger">Current Data :</div>
            <?php $this->RevisionHelper->showData($dataFirst['Revisions']['data'])?>
        </div>
        <br/>
    <?php endif;?>
<div class="row col-lg-12 col-sm-12 table-responsive">
    <table class="table table-condensed table-bordered">
        <thead class="blo">
            <tr>
                <th><?= __("Old Data")?></th>
                <th><?= __("Created Time")?></th>
                <?php if ($flag==1) :?>
                    <th><?= __("Restore")?></th>
                <?php endif?>
            </tr>
        </thead>
        <tbody>
            <?php if ($flag == 1){$temp = 1;} else $temp = 0;?>
            <?php for($i = $temp; $i<count($dataList); $i++): ?>
                <tr>
                    <td>
                        <?php $this->RevisionHelper->showData($dataList[$i]['Revisions']['data'])?>
                    </td>
                    <td><?php echo $dataList[$i]['Revisions']['created_time']?></td>
                    <?php if ($flag==1) :?>
                        <td><?php echo $this->Html->link('Restore', Router::url(array('plugin'=>'Revision','controller'=>'Revision',$dataList[$i]['Revisions']['id'])), array('class'=>'btn btn-success'))?></td>
                    <?php endif?>
                </tr>
            <?php endfor?>
        </tbody>
        <tfoot>
        <?php if ($this->Paginator->param('pageCount') > 1): ?>
            <tr>
                <td colspan='6'>
                    <?php
                    echo $this->Paginator->pagination(array('ul' => 'pagination'));?>
                </td>
            </tr>
        <? endif; ?>
        </tfoot>
    </table>
</div>
<?php else :?>
    <br/>
<div class="text-danger">No revision data yet !!!</div>
<?php endif;?>