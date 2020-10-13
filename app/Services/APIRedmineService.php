<?php

namespace App\Services;

class APIRedmineService {

    const ANALYTIC = 17;
    const CODING   = 15;
    const UTTEST   = 16;
    const RELEASE  = 7;
    const REVIEW   = 5;
    const FEATURE  = 2;

    const TICKET_TESTING = 72478;

    public static function createPackageTicket() {
        $m         = new self;
        $res       = $m->createTicket('Test Issue_' . time(), self::TICKET_TESTING, self::FEATURE);
        $parent_id = (json_decode($res)->issue->id);

        $issues = [
            $parent_id
        ];
        foreach ($issues as $issue) {
            $parentId = $issue;
            $m->createTicket('[] Understanding Spec', $parentId, self::ANALYTIC);
            $m->createTicket('[] Coding', $parentId, self::CODING);
            $m->createTicket('[] UT-Test', $parentId, self::UTTEST);
            $m->createTicket('[] Release', $parentId, self::RELEASE);
            $m->createTicket('[] Review', $parentId, self::REVIEW);
        }

    }

    private function createTicket(string $subject, int $parentId = null, int $tracker_id = null) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://redmine.lampart-vn.com/projects/sns-tool/issues.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => "{\r\n  \"issue\": {    \r\n    \"tracker_id\": \"" . $tracker_id . "\", \r\n    \"subject\": \"" . $subject . "\",\r\n    \"parent_issue_id\":" . $parentId . "\r\n  }\r\n}",
            CURLOPT_HTTPHEADER     => [
                "X-Redmine-API-Key: 8b0db9a4c8b107d39f9ccc22c7828e0816f30270",
                "Content-Type: application/json",
                "Cookie: _redmine_session=BAh7BkkiD3Nlc3Npb25faWQGOgZFVEkiJTNkMmM2MDQzMzE3MjUxZTUxZDY2OTYyZjkwNjkyOTJhBjsAVA%3D%3D--c1e45ad584fd966281a44574b08e8e4fca3725c9"
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

}
