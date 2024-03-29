<?php
/**
 * Created by PhpStorm.
 * author: harris
 * Date: 3/27/19
 * Time: 9:51 AM
 */

namespace App\Services\ApiLogs;

use App\models\PartnerLogsApi;
use Jenssegers\Agent\Agent;

class ApiLogProcessor
{


    public function __invoke(array $record)
    {
        $agent = new Agent();

        $os = $agent->platform();
        $osVersion = $agent->version($os);
        $browser = $agent->browser();
        $bsVersion = $agent->version($browser);
        $robot = $agent->robot();
        if ($agent->isRobot()) {
            $type = PartnerLogsApi::ROBOT;
        } elseif ($agent->isDesktop()) {
            $type = PartnerLogsApi::DESKSTOP;
        } elseif ($agent->isTablet()) {
            $type = PartnerLogsApi::TABLET;
        } elseif ($agent->isMobile()) {
            $type = PartnerLogsApi::MOBILE;
        } elseif ($agent->isPhone()) {
            $type = PartnerLogsApi::PHONE;
        } else {
            $type = PartnerLogsApi::OTHER;
        }
        $messageArr = json_decode($record['message'],true);
        $record['extra'] = [
            'user_id' => auth()->user() ? auth()->user()->id : NULL,
            'origin' => request()->headers->get('origin'),
            'ip' => request()->ip(),
            'ips' => json_encode(request()->ips()),
            'user_agent' => request()->server('HTTP_USER_AGENT'),
            'lang' => json_encode($agent->languages()),
            'device' => $agent->device(),
            'os' => $os,
            'browser' => $browser,
            'bs_version' => $bsVersion,
            'device_type' => $type,
        ];
        if ($osVersion) {
            $record['extra']['os_version'] = $osVersion;
        }
        if ($robot) {
            $record['extra']['robot'] = $robot;
        }
        if (isset($messageArr['input'])) {
            $record['extra']['inputs'] = json_encode($messageArr['input']);
        }
        if (isset($messageArr['route'])) {
            $record['extra']['route'] = json_encode($messageArr['route']);
            $record['message'] = '网络操作信息';
        }
        return $record;
    }
}
