<?php
/** @var array|object $data */
/** @var bool $showJsonDebug */

use \Stationer\Graphite\G;

if (isset($data)) {
    headers_sent() || header('Content-type: application/json');

    if (isset($showJsonDebug) && $showJsonDebug === true
        && (is_array($data) || is_a($data, 'stdClass'))
    ) {
        $queryData = G::$M->getQueries();

        $loadTime  = round(microtime(true) - G::$G['startTime'], 4);
        $queryTime = round($queryData[0][0], 4);
        $_debug    = [
            'loadTime'        => $loadTime,
            'memoryUsage'     => round(memory_get_usage() / 1024 / 1024, 2),
            'peakMemoryUsage' => round(memory_get_peak_usage() / 1024 / 1024, 2),
            'queryTime'       => $queryTime,
            'phpTime'         => $loadTime - $queryTime
        ];

        if (isset($GLOBALS['_Profiler'])) {
            $profile = [
                'times' => [],
                'marks' => []
            ];

            $GLOBALS['_Profiler']->mark('View');
            $profileData = $GLOBALS['_Profiler']->get();

            foreach ($profileData as $label => $marks) {
                $mark = end($marks);
                if (0 == $marks[0]['timer']) {
                    $marks[0]['timer'] = $mark['time'] - $marks[1]['time'];
                }

                $obj                = [
                    'label'    => $label,
                    'duration' => sprintf('%.5f', $marks[0]['timer']),
                    'memory'   => round($mark['memory'] / 1048576, 2),
                    'time'     => sprintf('%.8f', $mark['time']),
                    'location' => $mark['location']
                ];
                $profile['times'][] = $obj;
            }

            foreach ($profileData as $label => $marks) {
                for ($i = 1; $i < count($marks); $i++) {
                    $mark = $marks[$i];

                    $obj = [
                        'label'    => $label,
                        'duration' => sprintf('+%.5f', $mark['duration']),
                        'memory'   => round($mark['memory'] / 1048576, 2),
                        'time'     => sprintf('%.8f', $mark['time']),
                        'location' => $mark['location']
                    ];

                    $profile['marks'][] = $obj;
                }
            }

            $_debug['profile'] = $profile;
        }

        if (is_array($data)) {
            $data['_debug'] = $_debug;
        } else {
            $data->_debug = $_debug;
        }
    }

    if (isset($jsonp)) {
        $output = $jsonp.'('.json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT).');';
    } else {
        $output = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    headers_sent() || header('Content-Length: '.strlen($output));
    headers_sent() || header('Connection: close');

    echo $output;

    // Only flush() if we're not being buffered.
    if (ob_get_level() == 0) {
        flush();
    }
}
