<?php
require_once("../../config.php");

$type = optional_param('type', false, PARAM_TEXT);

$response_code = 200;
$status = 'success';
$msg = 'Chartdata successfully fetched';
$data = array();
$options = array();








switch ($type)
{
	case 'pie':
		$data = array(
			'labels' => array('Strength', 'Skill', 'Health', 'Speed', 'Luck'),
			'datasets' => array(
				array(
					'label' => 'Point',
					'backgroundColor' => array(
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
					),
					'data' => array(10, 20, 35, 30, 10) 
				)
			)
        );
		$options = array(
			'animation' => array(
				'animateScale' => true
            )
		);
		break;
	case 'doughnut': 
		$data = array(
			'labels' => array('Strength', 'Skill', 'Health', 'Speed', 'Luck'),
			'datasets' => array(
				array(
					'label' => 'Point',
					'backgroundColor' => array(
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
					),
					'data' => array(10, 20, 35, 30, 10)
				)
			)
		);
		$options = array(
			'animation' => array(
				'animateScale' => true
            )
		);
		break;
	case 'bar':
		$data = array(
			'labels' => array('Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'),
			'datasets' => array(
				array(
					'label' => '# of Votes',
					'data' => array(12, 19, 3, 5, 2, 3),
					'backgroundColor' => array(
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(255, 159, 64, 0.2)'
					),
					'borderColor' => array(
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					),
					'borderWidth' => 1
				)
			)
		);
		$options = array(
			'scales' => array(
				'y' => array(
					'beginAtZero' => true
				)
            )
		);
		break;
	default:
		$response_code = 404;
		$status = 'error';
		if( empty($type) ) {
			$msg = 'Missing Parameter type.';
		} else {
			$msg = 'Unknown Chart Type "' . $type . '".';
		}
		break;
}























http_response_code($response_code);
header('Content-Type: application/json');
$response = array(
	'meta' => array(
		'status' => $status,
		'msg' => $msg
	),
	'data' => array(
		'charttype' => $type,
		'chartdata' => $data,
		'chartoptions' => $options
	)
);
echo json_encode($response, JSON_PRETTY_PRINT);
exit;
