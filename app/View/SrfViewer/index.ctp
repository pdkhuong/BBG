<h3>Available Reports</h3>
<hr>
<table>
    <tr>
        <th>Report Name</th>
    </tr>
    <?php foreach ($reports as $rpt) { ?>
        <tr>
            <td>
                <?php
                echo $this->Html->link(
                    $rpt['name'],
                    array('controller' => 'SrfViewer', 'action' => 'view', '?' => array('rpt' => $rpt['link']))
                );
                ?>
            </td>
        </tr>
    <?php } ?>
</table>