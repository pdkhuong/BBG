<?php
echo $this->Html->script('d3', array('inline'=>false));
echo $this->Html->script('rickshaw', array('inline'=>false));
echo $this->Html->script('sf_module_report', array('inline'=>false));
echo $this->Html->script('jquery.fixedheadertable', array('inline'=>false));

echo $this->Html->css('sf_module_report', array('inline'=>false));
echo $this->Html->css('sf_module_layout', array('inline'=>false));
echo $this->Html->css('jquery.fixedheadertable', array('inline'=>false));
?>
<?php
$dataUrl = $this->Html->url(array(
        "controller" => "SrfDataSets",
        "?" => array(
            "rpt"=>$reportId,
        ),
        "ext" => "json"
    ));

foreach ($report->parameters->parameter as $param) {
    $paramName = $param['name'];
    $paramType = $param->type;
    if(strcasecmp($paramType, "select") == 0){
        $valueType = $param->valuetype;
        echo "<div style='width:200px; float:left; margin-right:20px;'>";
        echo "<label for='$paramName'>$param->display</label>";
        echo "<select style='width:200px; float:left; margin-right:20px;' class='form-control srfparam' id='$paramName'>";
        if(strcasecmp($valueType, "preset") == 0){
            foreach($param->keyvalues->keyvalue as $keyValue){
                echo "<option value='$keyValue->id'>$keyValue->display</option>";
            }
        }
        echo "</select>";
        echo "</div>";

        if(strcasecmp($valueType, "query") == 0){
            $queryName = $param->query->queryname;
            $map = $param->query->map;
            echo "
            <script type='text/javascript'>
                setDropdownValue('$paramName', '$dataUrl', '$queryName', null, $map);
            </script>
            ";
        }
    }
    else{
        echo "<div style='width:200px; float:left; margin-right:20px;'>";
        echo "<label for='$paramName'>$param->display</label>";
        echo "<input type='text' class='srfparam' id='$paramName'/>";
        echo "</div>";
    }
}

?>
<br style="clear:both">
<button id="btn_show" class="btn btn-primary">Show Report</button>
<?php
echo $report->layout->container;
?>

<script type="text/javascript">
    <?php
        foreach($report->layout->types->type as $type){
            $legendcontainer = $type->legendid;
            if(!is_null($legendcontainer) && strlen($legendcontainer)>0) {$legendcontainer = "legendcontainer: '$legendcontainer',";}
            $yaxislabel = $type->yaxislabel;
            if(!is_null($yaxislabel) && strlen($yaxislabel) > 0){$yaxislabel = "yaxislabel: $yaxislabel,";}
            echo "
                var report$type->id = new sf_module_report({
                    'container': '$type->id',
                    'charttype': '$type->type',
                    $legendcontainer
                    $yaxislabel";
            if(isset($type->otheroptions)){
                foreach($type->otheroptions->children() as $key=>$value){
                    echo "
                        $key: $value,
                    ";
                }
            }
            echo "});
            ";
            if(isset($type->subcharts)){
            foreach($type->subcharts->subchart as $sub){
                $subLegendContainer = $sub->legendid;
                if(!is_null($subLegendContainer) && strlen($subLegendContainer)>0) {$subLegendContainer = "legendcontainer: '$subLegendContainer',";}
                $subYAxisLabel = $sub->yaxislabel;
                if(!is_null($subYAxisLabel) && strlen($subYAxisLabel) > 0){$subYAxisLabel = "yaxislabel: $subYAxisLabel,";}
                echo "
                    var subreport$sub->id = new sf_module_report({
                        'container': '$sub->id',
                        'charttype': '$sub->type',
                        $subLegendContainer
                        $subYAxisLabel";
                if(isset($sub->otheroptions)){
                    foreach($sub->otheroptions->children() as $key=>$value){
                        echo "
                            $key: $value,
                        ";
                    }
                }
                echo "});
                ";
            }
            }
        }
    ?>
    $("#btn_show").click(function () {
        var params = {};
        $('.srfparam').each(function () {
            params[$(this).attr('id')] = $(this).val();
        });

        <?php
            foreach($report->layout->types->type as $type){
                $reportHtmlId = "report$type->id";
                $dataUrl = $this->Html->url(array(
                    "controller" => "SrfDataSets",
                    "?" => array(
                        "rpt"=>$reportId,
                        ),
                    "ext" => "json"
                ));
                $queryName = $type->data->query;
                $map = $type->data->map;

                if(is_null($map) || strlen($map)==0) {$map = "return query;";}
                else{$map = "return { $map };";}

                if(isset($type->subcharts)){
                    $childFunc = "$reportHtmlId.interactiveFunction = function(label){";
                    $childParams = "{";
                    if(isset($type->subcharts)){
                        foreach($type->subcharts->subchart as $sub){
                            $subReportId = "subreport$sub->id";
                            foreach($sub->parameters->parameter as $childParam){
                                $passParamName = (string) $childParam->attributes()->name;
                                $passParamValue = (string) $childParam;
                                $childParams .= "\"$passParamName\":$passParamValue, ";
                            }
                            $childParams .= "}";

                            $childMap = (string)$sub->map;
                            $childQueryName = $sub->query;
                            if(is_null($childMap) || strlen($childMap)==0) {$childMap = "return query;";}
                            else{$childMap = "return { $childMap };";}

                            $childFunc .= "
                                $subReportId.setAjax({
                                    url: '$dataUrl',
                                    queryname: '$childQueryName',
                                    params: $childParams,
                                    mapfunction: function(query){ $childMap },
                                });
                                $subReportId.refresh();
                            ";

                        }
                        $childFunc .= "};";
                    }
                }
                if(!isset($childFunc)) {
                    $childFunc = "";
                }

                echo "
                $reportHtmlId.setAjax({
                    url: '$dataUrl',
                    queryname: '$queryName',
                    params: params,
                    mapfunction: function(query){ $map },
                });
                $childFunc
                $reportHtmlId.refresh();
                ";
            }
        ?>

        <?php
            echo "setInterval(function(){";
            foreach($report->layout->types->type as $type){
                echo "report$type->id.refresh();";
                if(isset($type->subcharts)){
                    foreach($type->subcharts->subchart as $sub){
                        echo "subreport$sub->id.refresh();";
                    }
                }
            }
            echo "}, 3000);";
        ?>
    });
</script>