<?php
    const EVENT_SLUGS = [
        'production',
        'swimsuit',
        'long-gown',
        'preliminary-qa'
    ];

    if(!defined('EVENT_SLUGS'))
        exit();

    const LOGIN_PAGE_PATH = '../../crud/';
    require_once '../../crud/auth.php';

    require_once '../../config/database.php';
    require_once '../../models/Admin.php';
    require_once '../../models/Team.php';
    require_once '../../models/Event.php';

    // initialize titles
    $titles = ['1', '2', '3', '4', '5'];

    // initialize admin
    $admin = new Admin();

    // initialize events
    $event1 = Event::findBySlug(EVENT_SLUGS[0]);
    $event2 = Event::findBySlug(EVENT_SLUGS[1]);
    $event3 = Event::findBySlug(EVENT_SLUGS[2]);
    $event4 = Event::findBySlug(EVENT_SLUGS[3]);

    // initialize category
    $category_title = $event1->getCategory()->getTitle();

    // tabulate events
    $result1 = $admin->tabulate($event1);
    $result2 = $admin->tabulate($event2);
    $result3 = $admin->tabulate($event3);
    $result4 = $admin->tabulate($event4);

    // process result
    $result = [];
    $unique_total_ranks    = [];
    $unique_total_percentages_rank = [];
    $unique_total_percentages_average = [];
    $unique_adjusted_ranks = [];
    foreach($event1->getAllTeams() as $team) {
        $team_key = 'team_'.$team->getId();

        // get $event1 rank and average
        $rank1       = 0;
        $average1    = 0;
        $percentage_rank1 = 0;
        $percentage_average1 = 0;
        if(isset($result1['teams'][$team_key])) {
            $rank1    = $result1['teams'][$team_key]['rank']['final']['fractional'];
            $average1 = $result1['teams'][$team_key]['ratings']['average'];
            $percentage_rank1 = (100 - $rank1) * 0.10;
            $percentage_average1 = $average1 * 0.10;
        }

        // get $event2 rank and average
        $rank2       = 0;
        $average2    = 0;
        $percentage_rank2 = 0;
        $percentage_average2 = 0;
        if(isset($result2['teams'][$team_key])) {
            $rank2    = $result2['teams'][$team_key]['rank']['final']['fractional'];
            $average2 = $result2['teams'][$team_key]['ratings']['average'];
            $percentage_rank2 = (100 - $rank2) * 0.20;
            $percentage_average2 = $average2 * 0.20;
        }

        // get $event3 rank and average
        $rank3       = 0;
        $average3    = 0;
        $percentage_rank3 = 0;
        $percentage_average3 = 0;
        if(isset($result3['teams'][$team_key])) {
            $rank3    = $result3['teams'][$team_key]['rank']['final']['fractional'];
            $average3 = $result3['teams'][$team_key]['ratings']['average'];
            $percentage_rank3 = (100 - $rank3) * 0.30;
            $percentage_average3 = $average3 * 0.30;
        }

        // get $event4 rank and average
        $rank4       = 0;
        $average4    = 0;
        $percentage_rank4 = 0;
        $percentage_average4 = 0;
        if(isset($result4['teams'][$team_key])) {
            $rank4    = $result4['teams'][$team_key]['rank']['final']['fractional'];
            $average4 = $result4['teams'][$team_key]['ratings']['average'];
            $percentage_rank4 = (100 - $rank4) * 0.40;
            $percentage_average4 = $average4 * 0.40;
        }

        // get total rank, average, & percentage
        $total_rank    = $rank1 + $rank2 + $rank3 + $rank4;
        $total_average = ($average1 + $average2 + $average3 + $average4) / sizeof(EVENT_SLUGS);
        $total_percentage_rank = $percentage_rank1 + $percentage_rank2 + $percentage_rank3 + $percentage_rank4;
        $total_percentage_average = $percentage_average1 + $percentage_average2 + $percentage_average3 + $percentage_average4;

        // push $total_rank to $unique_total_ranks
        if(!in_array($total_rank, $unique_total_ranks))
            $unique_total_ranks[] = $total_rank;

        if (!in_array($total_percentage_rank, $unique_total_percentages_rank))
            $unique_total_percentages_rank[] = $total_percentage_rank;

        if (!in_array($total_percentage_average, $unique_total_percentages_average))
            $unique_total_percentages_average[] = $total_percentage_average;

        // append to $result
        $result[$team_key] = [
            'info'   => $team->toArray(),
            'inputs' => [
                EVENT_SLUGS[0] => [
                    'rank'    => $rank1,
                    'average' => $average1,
                    'percentage_rank' => $percentage_rank1,
                    'percentage_average' => $percentage_average1
                ],
                EVENT_SLUGS[1] => [
                    'rank'    => $rank2,
                    'average' => $average2,
                    'percentage_rank' => $percentage_rank2,
                    'percentage_average' => $percentage_average2
                ],
                EVENT_SLUGS[2] => [
                    'rank'    => $rank3,
                    'average' => $average3,
                    'percentage_rank' => $percentage_rank3,
                    'percentage_average' => $percentage_average3
                ],
                EVENT_SLUGS[3] => [
                    'rank'    => $rank4,
                    'average' => $average4,
                    'percentage_rank' => $percentage_rank4,
                    'percentage_average' => $percentage_average4
                ]
            ],
            'average' => $total_average,
            'percentage_average' => $total_percentage_average,
            'rank' => [
                'total'    => $total_percentage_rank,
                'dense'    => 0,
                'initial'  => 0,
                'adjusted' => 0,
                'final' => [
                    'dense'      => 0,
                    'fractional' => 0
                ]
            ],
            'title' => ''
        ];
    }

    // sort $unique_total_ranks
    rsort($unique_total_percentages_rank);

    // gather $rank_group (for getting fractional rank)
    $rank_group = [];
    foreach($result as $team_key => $team) {
        // get dense rank
        $dense_rank = 1 + array_search($team['rank']['total'], $unique_total_percentages_rank);
        $result[$team_key]['rank']['dense'] = $dense_rank;

        // push $team_key to $rank_group
        $key_rank = 'rank_' . $dense_rank;
        if(!isset($rank_group[$key_rank]))
            $rank_group[$key_rank] = [];
        $rank_group[$key_rank][] = $team_key;
    }

    // get initial fractional rank
    $ctr = 0;
    for($i = 0; $i < sizeof($unique_total_percentages_rank); $i++) {
        $key = 'rank_' . ($i + 1);
        $group = $rank_group[$key];
        $size = sizeof($group);
        $initial_rank = $ctr + ((($size * ($size + 1)) / 2) / $size);

        // write $fractional_rank to $group members
        for($j = 0; $j < $size; $j++) {
            $result[$group[$j]]['rank']['initial'] = $initial_rank;

            // compute adjusted average
            $adjusted_rank = $initial_rank - ($result[$group[$j]]['average'] * 0.01);
            $result[$group[$j]]['rank']['adjusted'] = $adjusted_rank;

            // push to $unique_adjusted_ranks
            if(!in_array($adjusted_rank, $unique_adjusted_ranks))
                $unique_adjusted_ranks[] = $adjusted_rank;
        }

        $ctr += $size;
    }

    // sort $unique_adjusted_ranks
    sort($unique_adjusted_ranks);

    // gather $rank_group (for getting fractional rank)
    $rank_group = [];
    foreach($result as $team_key => $team) {
        // get dense rank
        $dense_rank = 1 + array_search($team['rank']['adjusted'], $unique_adjusted_ranks);
        $result[$team_key]['rank']['final']['dense'] = $dense_rank;

        // push $key to $rank_group
        $key_rank = 'rank_' . $dense_rank;
        if(!isset($rank_group[$key_rank]))
            $rank_group[$key_rank] = [];
        $rank_group[$key_rank][] = $team_key;
    }

    // get final fractional rank
    $unique_final_fractional_ranks = [];
    $ctr = 0;
    for($i = 0; $i < sizeof($unique_adjusted_ranks); $i++) {
        $key = 'rank_' . ($i + 1);
        $group = $rank_group[$key];
        $size = sizeof($group);
        $final_fractional_rank = $ctr + ((($size * ($size + 1)) / 2) / $size);

        // push to $unique_final_fractional_ranks
        if(!in_array($final_fractional_rank, $unique_final_fractional_ranks))
            $unique_final_fractional_ranks[] = $final_fractional_rank;

        // write $fractional_rank to $group members
        for($j = 0; $j < $size; $j++) {
            $result[$group[$j]]['rank']['final']['fractional'] = $final_fractional_rank;
        }

        $ctr += $size;
    }

    // sort $unique_final_fractional_ranks
    sort($unique_final_fractional_ranks);

    // determine tops
    $tops_ordered   = [];
    $tops_unordered = [];
    $i = 0;
    foreach($titles as $title) {
        // update title of $unique_total_percentages[$i]'th team
        foreach($result as $team_key => $team) {
            if($team['rank']['final']['fractional'] == $unique_final_fractional_ranks[$i]) {
                $result[$team_key]['title'] = $titles[$i];
                $tops_ordered[]   = $team['info']['id'];
                $tops_unordered[] = $team['info']['id'];
            }
        }

        $i += 1;
        if($i >= sizeof($unique_final_fractional_ranks))
            break;
    }

    // sort $tops_ordered
    sort($tops_ordered);

    // shuffle $tops_unordered (deterministic)
    mt_srand(615829437);
    shuffle($tops_unordered);
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
    <title>Top <?= sizeof($titles) ?> | <?= $category_title ?></title>
</head>
<body>
<table class="table table-bordered result">
    <thead>
    <tr class="table-secondary">
        <th colspan="3" rowspan="3" class="text-center bt br bl">
            <h1 class="m-0">TOP <?= sizeof($titles) ?></h1>
            <h5><?= $category_title ?></h5>
        </th>
        <th colspan="3" class="text-center text-success bt br" style="width: 11%">
            <?= $event1->getTitle() ?>
        </th>
        <th colspan="3" class="text-center text-success bt br" style="width: 11%">
            <?= $event2->getTitle() ?>
        </th>
        <th colspan="3" class="text-center text-success bt br" style="width: 11%">
            <?= $event3->getTitle() ?>
        </th>
        <th colspan="3" class="text-center text-success bt br" style="width: 11%">
            <?= $event4->getTitle() ?>
        </th>
        <th rowspan="3" class="text-center bl bt br">
            <span class="opacity-75">TOTAL<br>AVERAGE<br>%</span>
        </th>
        <th rowspan="3" class="text-center text-info bl bt br">
            <span class="opacity-75">TOTAL<br>RANK<br>%</span>
        </th>
        <th rowspan="3" class="text-center bl bt br">
            <span class="opacity-50">INITIAL<br>RANK</span>
        </th>
        <th rowspan="3" class="text-center bl bt br">
            FINAL<br>RANK
        </th>
        <th rowspan="3" class="text-center bl bt br">
            SLOT
        </th>
    </tr>
    <tr class="table-secondary">
        <th colspan="3" class="text-center bl br">10%</th>
        <th colspan="3" class="text-center bl br">20%</th>
        <th colspan="3" class="text-center bl br">30%</th>
        <th colspan="3" class="text-center bl br">40%</th>
    </tr>
    <tr class="table-secondary">
        <th class="text-center bl"><span class="opacity-75">Ave.<br>%</span></th>
        <th class="text-center text-info text-opacity-75">Rank<br>%</th>
        <th class="text-center text-primary br">Rank</th>

        <th class="text-center bl"><span class="opacity-75">Ave.<br>%</span></th>
        <th class="text-center text-info text-opacity-75">Rank<br>%</th>
        <th class="text-center text-primary br">Rank</th>

        <th class="text-center bl"><span class="opacity-75">Ave.<br>%</span></th>
        <th class="text-center text-info text-opacity-75">Rank<br>%</th>
        <th class="text-center text-primary br">Rank</th>

        <th class="text-center bl"><span class="opacity-75">Ave.<br>%</span></th>
        <th class="text-center text-info text-opacity-75">Rank<br>%</th>
        <th class="text-center text-primary br">Rank</th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach($result as $team_key => $team) { ?>
        <tr<?= $team['title'] !== '' ? ' class="table-warning"' : '' ?>>
            <!-- number -->
            <td class="pe-3 fw-bold bl" align="right">
                <h4 class="m-0">
                    <?= $team['info']['number'] ?>
                </h4>
            </td>

            <!-- avatar -->
            <td style="width: 72px;">
                <img
                    src="../../crud/uploads/<?= $team['info']['avatar'] ?>"
                    alt="<?= $team['info']['number'] ?>"
                    style="width: 100%; border-radius: 100%"
                >
            </td>

            <!-- name -->
            <td class="br">
                <h6 class="text-uppercase m-0"><?= $team['info']['name'] ?></h6>
                <small class="m-0"><?= $team['info']['location'] ?></small>
            </td>

            <!-- event1 -->
            <td class="text-center" align="right">
                <span class="opacity-75">
                    <?= number_format($team['inputs'][EVENT_SLUGS[0]]['percentage_average'], 2) ?>
                </span>
            </td>
            <td class="text-info text-center">
                <?= number_format($team['inputs'][EVENT_SLUGS[0]]['percentage_rank'], 2) ?>
            </td>
            <td class="pe-3 text-primary br" align="right">
                <?= number_format($team['inputs'][EVENT_SLUGS[0]]['rank'], 2) ?>
            </td>

            <!-- event2 -->
            <td class="text-center" align="right">
                <span class="opacity-75">
                    <?= number_format($team['inputs'][EVENT_SLUGS[1]]['percentage_average'], 2) ?>
                </span>
            </td>
            <td class="text-info text-center">
                <?= number_format($team['inputs'][EVENT_SLUGS[1]]['percentage_rank'], 2) ?>
            </td>
            <td class="pe-3 text-primary br" align="right">
                <?= number_format($team['inputs'][EVENT_SLUGS[1]]['rank'], 2) ?>
            </td>

            <!-- event3 -->
            <td class="text-center" align="right">
                <span class="opacity-75">
                    <?= number_format($team['inputs'][EVENT_SLUGS[2]]['percentage_average'], 2) ?>
                </span>
            </td>
            <td class="text-info text-center">
                <?= number_format($team['inputs'][EVENT_SLUGS[2]]['percentage_rank'], 2) ?>
            </td>
            <td class="pe-3 text-primary br" align="right">
                <?= number_format($team['inputs'][EVENT_SLUGS[2]]['rank'], 2) ?>
            </td>

            <!-- event4 -->
            <td class="text-center" align="right">
                <span class="opacity-75">
                    <?= number_format($team['inputs'][EVENT_SLUGS[3]]['percentage_average'], 2) ?>
                </span>
            </td>
            <td class="text-info text-center">
                <?= number_format($team['inputs'][EVENT_SLUGS[3]]['percentage_rank'], 2) ?>
            </td>
            <td class="pe-3 text-primary br" align="right">
                <?= number_format($team['inputs'][EVENT_SLUGS[3]]['rank'], 2) ?>
            </td>

            <!-- general average -->
<!--            <td class="pe-3 bl br fw-bold text-center">-->
<!--                <span class="opacity-75">-->
<!--                    --><?//= number_format($team['average'], 2) ?>
<!--                </span>-->
<!--            </td>-->

            <!-- total average -->
            <td class="pe-3 bl br fw-bold text-center">
                <span class="opacity-75">
                    <?= number_format($team['percentage_average'], 2) ?>
                </span>
            </td>

            <!--   total percentage rank -->
            <td class="pe-3 text-info text-center fw-bold bl br fw-bold">
                <?= number_format($team['rank']['total'], 2) ?>
            </td>

            <!-- initial rank -->
            <td class="pe-3 bl br fw-bold" align="right">
                <span class="opacity-50"><?= number_format($team['rank']['initial'], 2) ?></span>
            </td>

            <!--  final rank -->
            <td class="pe-3 bl br fw-bold" align="right">
                <?= number_format($team['rank']['final']['fractional'], 2) ?>
            </td>

            <!-- title -->
            <td class="bl br fw-bold" align="center" style="line-height: 1.1">
                <h4 class="ma-0"><?= $team['title'] ?></h4>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<!-- Judges -->
<div class="container-fluid">
    <div class="row justify-content-center">
        <?php foreach($event1->getAllJudges() as $judge) { ?>
            <div class="col-md-4">
                <div class="mt-5 pt-3 text-center">
                    <h6 class="mb-0"><?= $judge->getName() ?></h6>
                </div>
                <div class="text-center">
                    <p class="mb-0">
                        Judge <?= $judge->getNumber() ?>
                        <?php if($judge->isChairmanOfEvent($event1)) { ?>
                            * (Chairman)
                        <?php } ?>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Summary -->
<div class="container-fluid mt-5" style="page-break-before: always;">
    <div class="row">
        <!-- unordered -->
        <div class="col-md-6" align="center">
            <h4 class="opacity-75"><?= $category_title ?></h4>
            <h1>TOP <?= sizeof($titles) ?> in Random Order</h1>
            <h4>FOR ANNOUNCEMENT</h4>
            <div style="width: 80%;">
                <table class="table table-bordered mt-3">
                    <tbody>
                    <?php
                    foreach($tops_unordered as $team_id) {
                        $team = $result['team_'.$team_id];
                        ?>
                        <tr>
                            <!-- number -->
                            <td class="pe-3 fw-bold text-center">
                                <h3 class="m-0">
                                    <?= $team['info']['number'] ?>
                                </h3>
                            </td>

                            <!-- avatar -->
                            <td style="width: 72px;">
                                <img
                                        src="../../crud/uploads/<?= $team['info']['avatar'] ?>"
                                        alt="<?= $team['info']['number'] ?>"
                                        style="width: 100%; border-radius: 100%"
                                >
                            </td>

                            <!-- name -->
                            <td>
                                <h6 class="text-uppercase m-0"><?= $team['info']['name'] ?></h6>
                                <small class="m-0"><?= $team['info']['location'] ?></small>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ordered -->
        <div class="col-md-6" align="center">
            <h4 class="opacity-75"><?= $category_title ?></h4>
            <h1>TOP <?= sizeof($titles) ?> in Proper Order</h1>
            <h4>FOR FINAL Q & A</h4>
            <div style="width: 80%;">
                <table class="table table-bordered mt-3">
                    <tbody>
                    <?php
                    foreach($tops_ordered as $team_id) {
                        $team = $result['team_'.$team_id];
                        ?>
                        <tr>
                            <!-- number -->
                            <td class="pe-3 fw-bold text-center">
                                <h3 class="m-0">
                                    <?= $team['info']['number'] ?>
                                </h3>
                            </td>

                            <!-- avatar -->
                            <td style="width: 72px;">
                                <img
                                        src="../../crud/uploads/<?= $team['info']['avatar'] ?>"
                                        alt="<?= $team['info']['number'] ?>"
                                        style="width: 100%; border-radius: 100%"
                                >
                            </td>

                            <!-- name -->
                            <td>
                                <h6 class="text-uppercase m-0"><?= $team['info']['name'] ?></h6>
                                <small class="m-0"><?= $team['info']['location'] ?></small>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../../crud/dist/bootstrap-5.2.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>