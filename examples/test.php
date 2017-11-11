<?php
error_reporting(E_ALL);

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    include __DIR__ . '/../vendor/autoload.php';
} else {
    include __DIR__ . '/../src/Constant.php';
    include __DIR__ . '/../src/Util.php';
    include __DIR__ . '/../src/Mock.php';
}

use qlwz\mock\Mock;
use qlwz\mock\Util;

function mock_dtd_examples($demo)
{
    return json_encode(Mock::mock(json_decode($demo)), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}

function JSON_stringify($results)
{
    $result = [];
    foreach ($results as $tmp) {
        if (is_array($tmp) || is_object($tmp)) {
            $tmp = json_encode($tmp);
        } elseif (is_bool($tmp)) {
            $tmp = $tmp ? 'true' : 'false';
        } elseif (!($tmp === '' || strpos($tmp, '//') === 0) && is_string($tmp)) {
            $tmp = '"' . $tmp . '"';
        }
        $result[] = $tmp;
    }
    return join("\n", $result);
}

function mock_dpd_examples($demos)
{
    $result = [];
    foreach ($demos as $cmd) {
        $tmp = $cmd;
        if ($cmd === '' || strpos($cmd, '//') === 0) {
            //$tmp = $cmd;
        } elseif (strpos($cmd, 'Mock::mock(') === 0) {
            $tmp = Mock::mock(substr($cmd, 12, strlen($cmd) - 14));
        } elseif (strpos($cmd, 'mock_random_') === 0) {
            $function = substr($cmd, 0, strpos($cmd, '('));
            $p        = substr($cmd, strpos($cmd, '(') + 1);
            $p2       = substr($p, 0, strrpos($p, ')'));
            if ($p2) {
                $params = Util::getParam($p2);
            } else {
                $params = [];
            }
            if (function_exists($function)) {
                $tmp = call_user_func_array($function, $params);
            }
        }
        $result[] = $tmp;
    }
    return $result;
}

function mock_dpd_examples_img($demos)
{
    $result = mock_dpd_examples($demos);
    foreach ($result as $key => $image) {
        if (strpos($image, 'http') === 0 || strpos($image, 'data:image') === 0) {
            $result[$key] = '<img class="mb10 mr10" src="' . $image . '">';
        } else {
            unset ($result[$key]);
        }
    }
    return $result;
}

$dtd = include __DIR__ . '/data.dtd.php';
$dpd = include __DIR__ . '/data.dpd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Util::loadFunction();
    $obj   = isset ($_POST['obj']) ? $_POST['obj'] : '';
    $type  = isset ($_POST['type']) ? $_POST['type'] : '';
    $name  = isset ($_POST['name']) ? $_POST['name'] : '';
    $index = isset ($_POST['index']) ? $_POST['index'] : '';
    if ($obj == 'dtd') {
        $data = $dtd;
    } elseif ($obj == 'dpd') {
        $data = $dpd;
    } else {
        echo json_encode(['code' => -1]);
        exit ();
    }

    if (!isset ($data[$type])) {
        echo json_encode(['code' => -2]);
        exit ();
    }

    if (!isset ($data[$type][$name])) {
        echo json_encode(['code' => -3]);
        exit ();
    }

    $ary = ['code' => 1];

    if ($obj == 'dtd') {
        if (!isset ($data[$type][$name][$index])) {
            echo json_encode(['code' => -4]);
            exit ();
        }
        $ary['data'] = mock_dtd_examples($data[$type][$name][$index]);
    } elseif ($obj == 'dpd') {
        if ($type == 'Image') {
            $ary['data'] = array_values(mock_dpd_examples_img($data[$type][$name]));
        } else {
            $ary['data'] = mock_dpd_examples($data[$type][$name]);
        }
    }
    echo json_encode($ary);
    exit ();
}

$url = basename(__FILE__);
include 'template.html';
