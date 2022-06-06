/*
$output .= html_writer::div('', '', array('id' => 'chartDiv'));
$output .= html_writer::start_tag('form', array('action' => 'javascript:void(0);'));

$output .= html_writer::label('Session ID:' . $sessionID.'   ', '', array('id' =>'sessionid','value' => $sessionID));
$output .= html_writer::end_tag('label');

$output .= html_writer::label('Chart Type:', '', array('for' =>'type'));
$output .= html_writer::end_tag('label');

$output .= html_writer::start_tag('select', array('id' => 'charttype', 'name' => 'type'));

$output .= html_writer::start_tag('option', array('value' => 'none'));
$output .= "--- choose a chart ---";
$output .= html_writer::end_tag('option');

$output .= html_writer::start_tag('option', array('value' => 'pie'));
$output .= "Pie-Chart";
$output .= html_writer::end_tag('option');

$output .= html_writer::start_tag('option', array('value' => 'bar'));
$output .= "Bar-Chart";
$output .= html_writer::end_tag('option');

$output .= html_writer::start_tag('option', array('value' => 'doughnut'));
$output .= "Doughnut-Chart";
$output .= html_writer::end_tag('option');

$output .= html_writer::start_tag('option', array('value' => 'unknown'));
$output .= "Unknown-Chart";
$output .= html_writer::end_tag('option');

$output .= html_writer::end_tag('select');

$output .= html_writer::end_tag('form');
$output .= html_writer::end_div();

$output .= html_writer::end_div();




$output .= html_writer::div('', 'container', null);
$output .= html_writer::div('', 'chartwrapper', null);
$output .= html_writer::start_tag('canvas', array('id' => 'apiChart'));
$output .= html_writer::end_tag('canvas');
$output .= html_writer::end_div();
$output .= html_writer::end_div();
*/


$output .= '	<div>
    <form action="javascript:void(0);">
        <input type="hidden" id="sessionid" value="'.$sessionID.'">

        <label for="type">Chart Type:</label>


        <select id="charttype" name="type">
            <option value="none">--- choose a chart ---</option>
            <option value="pie">Pie-Chart</option>
            <option value="bar">Bar-Chart</option>
            <option value="doughnut">Doughnut-Chart</option>
            <option value="unknown">Unknown-Chart</option>
        </select>




    </form>
</div>
<div class="container">
    <div class="chartwrapper">
        <canvas id="apiChart"></canvas>
    </div>
</div>
';