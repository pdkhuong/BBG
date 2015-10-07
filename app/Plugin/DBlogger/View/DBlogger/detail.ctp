<pre style="background-color: #FFFFFF">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?= __('Type')?></th>
                    <th><?= __('AdminID')?></th>
                    <th><?= __('Refer')?></th>
                    <th><?= __('Message')?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $logs['LogModel']['type'] ?></td>
                    <td><?php echo $logs['LogModel']['admin_id'] ?></td>
                    <td><?php echo $logs['LogModel']['refer'] ?></td>
                    <td><?php echo $logs['LogModel']['message'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>

</pre>
