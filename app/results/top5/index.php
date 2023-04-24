<?php
    const LOGIN_PAGE_PATH = '../../crud/';
    require_once '../../crud/auth.php';

    // involved events
    const EVENTS = [
        [
            'slug'    => 'production',
            'percent' => 10
        ],
        [
            'slug'    => 'swimsuit',
            'percent' => 20
        ],
        [
            'slug'    => 'long-gown',
            'percent' => 30
        ],
        [
            'slug'    => 'preliminary-qa',
            'percent' => 40
        ]
    ];

    require_once '../../config/database.php';
    require_once '../../models/Admin.php';
    require_once '../../models/Team.php';
    require_once '../../models/Event.php';

    // initialize titles
    $titles = ['1', '2', '3', '4', '5'];

    // initialize admin
    $admin = new Admin();

    // initialize events
    $event_1 = Event::findBySlug(EVENTS[0]['slug']);
    $event_2 = Event::findBySlug(EVENTS[1]['slug']);
    $event_3 = Event::findBySlug(EVENTS[2]['slug']);
    $event_4 = Event::findBySlug(EVENTS[3]['slug']);

    // initialize category
    $competition_title = $event_1->getCategory()->getCompetition()->getTitle();

    // tabulate events
    $result_1 = $admin->tabulate($event_1);
    $result_2 = $admin->tabulate($event_2);
    $result_3 = $admin->tabulate($event_3);
    $result_4 = $admin->tabulate($event_4);

    // process result
    $result = [];
    $unique_total_rank_ave_equivs = [];
    $unique_total_percentages = [];
    $unique_adjusted_ranks = [];
    foreach(Team::all() as $team) {
        $team_key = 'team_'.$team->getId();

        // get $event_1 rank and average
        $average_1        = 0;
        $average_equiv_1  = 0;
        $rank_1           = 0;
        $rank_ave_1       = 0;
        $rank_ave_equiv_1 = 0;
        if(isset($result_1['teams'][$team_key])) {
            $average_1        = $result_1['teams'][$team_key]['ratings']['average'];
            $average_equiv_1  = $average_1 * (EVENTS[0]['percent'] / 100.0);
            $rank_1           = $result_1['teams'][$team_key]['rank']['final']['fractional'];
            $rank_ave_1       = 100 - $rank_1;
            $rank_ave_equiv_1 = $rank_ave_1 * (EVENTS[0]['percent'] / 100.0);
        }

        // get $event_2 rank and average
        $average_2        = 0;
        $average_equiv_2  = 0;
        $rank_2           = 0;
        $rank_ave_2       = 0;
        $rank_ave_equiv_2 = 0;
        if(isset($result_2['teams'][$team_key])) {
            $average_2        = $result_2['teams'][$team_key]['ratings']['average'];
            $average_equiv_2  = $average_2 * (EVENTS[1]['percent'] / 100.0);
            $rank_2           = $result_2['teams'][$team_key]['rank']['final']['fractional'];
            $rank_ave_2       = 100 - $rank_2;
            $rank_ave_equiv_2 = $rank_ave_2 * (EVENTS[1]['percent'] / 100.0);
        }

        // get $event_3 rank and average
        $average_3        = 0;
        $average_equiv_3  = 0;
        $rank_3           = 0;
        $rank_ave_3       = 0;
        $rank_ave_equiv_3 = 0;
        if(isset($result_3['teams'][$team_key])) {
            $average_3        = $result_3['teams'][$team_key]['ratings']['average'];
            $average_equiv_3  = $average_3 * (EVENTS[2]['percent'] / 100.0);
            $rank_3           = $result_3['teams'][$team_key]['rank']['final']['fractional'];
            $rank_ave_3       = 100 - $rank_3;
            $rank_ave_equiv_3 = $rank_ave_3 * (EVENTS[2]['percent'] / 100.0);
        }

        // get $event_4 rank and average
        $average_4        = 0;
        $average_equiv_4  = 0;
        $rank_4           = 0;
        $rank_ave_4       = 0;
        $rank_ave_equiv_4 = 0;
        if(isset($result_4['teams'][$team_key])) {
            $average_4        = $result_4['teams'][$team_key]['ratings']['average'];
            $average_equiv_4  = $average_4 * (EVENTS[3]['percent'] / 100.0);
            $rank_4           = $result_4['teams'][$team_key]['rank']['final']['fractional'];
            $rank_ave_4       = 100 - $rank_4;
            $rank_ave_equiv_4 = $rank_ave_4 * (EVENTS[3]['percent'] / 100.0);
        }

        // compute totals
        $total_average_equiv  = $average_equiv_1  + $average_equiv_2  + $average_equiv_3  + $average_equiv_4;
        $total_rank_ave_equiv = $rank_ave_equiv_1 + $rank_ave_equiv_2 + $rank_ave_equiv_3 + $rank_ave_equiv_4;

        // push $total_rank_ave_equiv to $unique_total_rank_ave_equivs
        if(!in_array($total_rank_ave_equiv, $unique_total_rank_ave_equivs))
            $unique_total_rank_ave_equivs[] = $total_rank_ave_equiv;

        // append to $result
        $result[$team_key] = [
            'info'   => $team->toArray(),
            'inputs' => [
                EVENTS[0]['slug'] => [
                    'average'        => $average_1,
                    'average_equiv'  => $average_equiv_1,
                    'rank'           => $rank_1,
                    'rank_ave'       => $rank_ave_1,
                    'rank_ave_equiv' => $rank_ave_equiv_1
                ],
                EVENTS[1]['slug'] => [
                    'average'        => $average_2,
                    'average_equiv'  => $average_equiv_2,
                    'rank'           => $rank_2,
                    'rank_ave'       => $rank_ave_2,
                    'rank_ave_equiv' => $rank_ave_equiv_2
                ],
                EVENTS[2]['slug'] => [
                    'average'        => $average_3,
                    'average_equiv'  => $average_equiv_3,
                    'rank'           => $rank_3,
                    'rank_ave'       => $rank_ave_3,
                    'rank_ave_equiv' => $rank_ave_equiv_3
                ],
                EVENTS[3]['slug'] => [
                    'average'        => $average_4,
                    'average_equiv'  => $average_equiv_4,
                    'rank'           => $rank_4,
                    'rank_ave'       => $rank_ave_4,
                    'rank_ave_equiv' => $rank_ave_equiv_4
                ]
            ],
            'average' => $total_average_equiv,
            'rank' => [
                'total'    => $total_rank_ave_equiv,
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

    // sort $unique_total_rank_ave_equivs
    rsort($unique_total_rank_ave_equivs);

    // gather $rank_group (for getting fractional rank)
    $rank_group = [];
    foreach($result as $team_key => $team) {
        // get dense rank
        $dense_rank = 1 + array_search($team['rank']['total'], $unique_total_rank_ave_equivs);
        $result[$team_key]['rank']['dense'] = $dense_rank;

        // push $team_key to $rank_group
        $key_rank = 'rank_' . $dense_rank;
        if(!isset($rank_group[$key_rank]))
            $rank_group[$key_rank] = [];
        $rank_group[$key_rank][] = $team_key;
    }

    // get initial fractional rank
    $ctr = 0;
    for($i = 0; $i < sizeof($unique_total_rank_ave_equivs); $i++) {
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
        // update title of $unique_final_fractional_ranks[$i]'th team
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
    mt_srand(318579462);
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
    <title>Top <?= sizeof($titles) ?> | <?= $competition_title ?></title>
</head>
<body>
    <div class="p-1">
        <table class="table table-bordered result">
            <thead class="bt">
                <tr class="table-secondary">
                    <th colspan="3" rowspan="3" class="text-center bt br bl bb">
                        <h1 class="m-0">TOP <?= sizeof($titles) ?></h1>
                        <h5><?= $competition_title ?></h5>
                    </th>
                    <th colspan="3" class="text-center text-success bt br">
                        <h5 class="m-0"><?= $event_1->getTitle() ?></h5>
                    </th>
                    <th colspan="3" class="text-center text-success bt br">
                        <h5 class="m-0"><?= $event_2->getTitle() ?></h5>
                    </th>
                    <th colspan="3" class="text-center text-success bt br">
                        <h5 class="m-0"><?= $event_3->getTitle() ?></h5>
                    </th>
                    <th colspan="3" class="text-center text-success bt br">
                        <h5 class="m-0"><?= $event_4->getTitle() ?></h5>
                    </th>
                    <th rowspan="3" class="text-center bl bt br bb">
                        TOTAL
                    </th>
                    <th rowspan="3" class="text-center bl bt br bb">
                        <span class="opacity-50">INITIAL<br>RANK</span>
                    </th>
                    <th rowspan="3" class="text-center bl bt br bb">
                        FINAL<br>RANK
                    </th>
                    <th rowspan="3" class="text-center bl bt br bb">
                        SLOT
                    </th>
                </tr>
                <tr class="table-secondary">
                    <th colspan="2" class="text-center bl"><span class="opacity-75">Average</span></th>
                    <th rowspan="2" class="bb br text-center"><h5 class="m-0"><?= EVENTS[0]['percent'] ?>%</h5></th>

                    <th colspan="2" class="text-center bl"><span class="opacity-75">Average</span></th>
                    <th rowspan="2" class="bb br text-center"><h5 class="m-0"><?= EVENTS[1]['percent'] ?>%</h5></th>

                    <th colspan="2" class="text-center bl"><span class="opacity-75">Average</span></th>
                    <th rowspan="2" class="bb br text-center"><h5 class="m-0"><?= EVENTS[2]['percent'] ?>%</h5></th>

                    <th colspan="2" class="text-center bl"><span class="opacity-75">Average</span></th>
                    <th rowspan="2" class="bb br text-center"><h5 class="m-0"><?= EVENTS[3]['percent'] ?>%</h5></th>
                </tr>
                <tr class="table-secondary">
                    <th colspan="2" class="bb text-center">Rank / Equiv.</th>
                    <th colspan="2" class="bb text-center">Rank / Equiv.</th>
                    <th colspan="2" class="bb text-center">Rank / Equiv.</th>
                    <th colspan="2" class="bb text-center">Rank / Equiv.</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($result as $team_key => $team) { ?>
                <tr<?= $team['title'] !== '' ? ' class="table-warning"' : '' ?>>
                    <!-- number -->
                    <td rowspan="2" class="pe-3 fw-bold bl bb" align="right">
                        <h3 class="m-0">
                            <?= $team['info']['number'] ?>
                        </h3>
                    </td>

                    <!-- avatar -->
                    <td rowspan="2" class="bb" style="width: 56px;">
                        <img
                            src="../../crud/uploads/<?= $team['info']['avatar'] ?>"
                            alt="<?= $team['info']['number'] ?>"
                            style="width: 56px; border-radius: 100%"
                        >
                    </td>

                    <!-- name -->
                    <td rowspan="2" class="br bb">
                        <h6 class="text-uppercase m-0"><?= $team['info']['name'] ?></h6>
                        <small class="m-0"><?= $team['info']['location'] ?></small>
                    </td>

                    <!-- event1 average -->
                    <td colspan="2" class="pe-3" align="right"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[0]['slug']]['average'], 2) ?></span></td>
                    <td align="right" class="pe-3 br text-secondary fw-bold"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[0]['slug']]['average_equiv'], 2) ?></span></td>

                    <!-- event2 average -->
                    <td colspan="2" class="pe-3" align="right"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[1]['slug']]['average'], 2) ?></span></td>
                    <td align="right" class="pe-3 br text-secondary fw-bold"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[1]['slug']]['average_equiv'], 2) ?></span></td>

                    <!-- event3 average -->
                    <td colspan="2" class="pe-3" align="right"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[2]['slug']]['average'], 2) ?></span></td>
                    <td align="right" class="pe-3 br text-secondary fw-bold"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[2]['slug']]['average_equiv'], 2) ?></span></td>

                    <!-- event4 average -->
                    <td colspan="2" class="pe-3" align="right"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[3]['slug']]['average'], 2) ?></span></td>
                    <td align="right" class="pe-3 br text-secondary fw-bold"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[3]['slug']]['average_equiv'], 2) ?></span></td>

                    <!-- total average -->
                    <td class="br pe-3 text-secondary fw-bold" align="right"><?= number_format($team['average'], 2) ?></td>

                    <!-- initial rank (spacer) -->
                    <td class="br"></td>

                    <!-- final rank (spacer) -->
                    <td class="br"></td>

                    <!-- slot -->
                    <td rowspan="2" class="bb br text-center" style="line-height: 1.1; vertical-align: bottom">
                        <h4 class="m-0"><?= $team['title'] ?></h4>
                    </td>
                </tr>

                <tr<?= $team['title'] !== '' ? ' class="table-warning"' : '' ?>>
                    <!-- event1 rank -->
                    <td align="right" class="bb pe-3 text-primary"><?= number_format($team['inputs'][EVENTS[0]['slug']]['rank'], 2) ?></td>
                    <td align="right" class="bb pe-3 text-primary"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[0]['slug']]['rank_ave'], 2) ?></span></td>
                    <td align="right" class="bb br pe-3 text-primary fw-bold"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[0]['slug']]['rank_ave_equiv'], 2) ?></span></td>

                    <!-- event2 rank -->
                    <td align="right" class="bb pe-3 text-primary"><?= number_format($team['inputs'][EVENTS[1]['slug']]['rank'], 2) ?></td>
                    <td align="right" class="bb pe-3 text-primary"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[1]['slug']]['rank_ave'], 2) ?></span></td>
                    <td align="right" class="bb br pe-3 text-primary fw-bold"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[1]['slug']]['rank_ave_equiv'], 2) ?></span></td>

                    <!-- event3 rank -->
                    <td align="right" class="bb pe-3 text-primary"><?= number_format($team['inputs'][EVENTS[2]['slug']]['rank'], 2) ?></td>
                    <td align="right" class="bb pe-3 text-primary"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[2]['slug']]['rank_ave'], 2) ?></span></td>
                    <td align="right" class="bb br pe-3 text-primary fw-bold"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[2]['slug']]['rank_ave_equiv'], 2) ?></span></td>

                    <!-- event4 rank -->
                    <td align="right" class="bb pe-3 text-primary"><?= number_format($team['inputs'][EVENTS[3]['slug']]['rank'], 2) ?></td>
                    <td align="right" class="bb pe-3 text-primary"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[3]['slug']]['rank_ave'], 2) ?></span></td>
                    <td align="right" class="bb br pe-3 text-primary fw-bold"><span class="opacity-75"><?= number_format($team['inputs'][EVENTS[3]['slug']]['rank_ave_equiv'], 2) ?></span></td>

                    <!-- total rank -->
                    <td class="br bb pe-3 text-primary fw-bold" align="right"><?= number_format($team['rank']['total'], 2) ?></td>

                    <!-- initial rank -->
                    <td class="br bb pe-3 fw-bold" align="right"><h5 class="m-0 opacity-50"><?= number_format($team['rank']['initial'], 2) ?></h5></td>

                    <!-- final rank -->
                    <td class="br bb pe-3 fw-bold" align="right"><h5 class="m-0"><?= number_format($team['rank']['final']['fractional'], 2) ?></h5></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <!-- Judges -->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <?php foreach($event_1->getAllJudges() as $judge) { ?>
                    <div class="col-md-3">
                        <div class="mt-5 pt-3 text-center">
                            <h6 class="mb-0"><?= $judge->getName() ?></h6>
                        </div>
                        <div class="text-center">
                            <p class="mb-0">
                                Judge <?= $judge->getNumber() ?>
                                <?php if($judge->isChairmanOfEvent($event_1)) { ?>
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
                    <h4 class="opacity-75"><?= $competition_title ?></h4>
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
                    <h4 class="opacity-75"><?= $competition_title ?></h4>
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
    </div>

    <script src="../../crud/dist/bootstrap-5.2.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>