<?php
    const LOGIN_PAGE_PATH = '../../crud/';
    require_once '../../crud/auth.php';

    require_once '../../config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../crud/dist/bootstrap-5.2.3/css/bootstrap.min.css">
    <style>
        th, td {
            vertical-align: middle;
        },
        .bt {
            border-top: 2px solid #aaa !important;
        }
        .br {
            border-right: 2px solid #aaa !important;
        }
        .bb, table.result tbody tr:last-child td {
            border-bottom: 2px solid #aaa !important;
        }
        .bl {
            border-left: 2px solid #aaa !important;
        }
    </style>
    <title>Result</title>
</head>
<body>

    <script src="../../crud/dist/bootstrap-5.2.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>