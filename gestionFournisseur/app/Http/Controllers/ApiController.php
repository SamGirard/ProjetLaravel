<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function fetchRegions()
    {
        $client = new Client([
            'verify' => false,
        ]);

        $sql = 'https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT DISTINCT "regadm" FROM "19385b4e-5503-4330-9e59-f998f5918363"';

        $response = $client->request('GET', $sql);
        $data = json_decode($response->getBody()->getContents());

        return $data;
    }

    public function fetchVille(string $region)
    {
        $client = new Client([
            'verify' => false,
        ]);

        $sql = 'https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT "munnom", "regadm" FROM "19385b4e-5503-4330-9e59-f998f5918363" WHERE "regadm" = \'' . $region . '\'';

        $response = $client->request('GET', $sql);
        $data = json_decode($response->getBody()->getContents());

        return $data;
    }

    public function fetchAllVille()
    {
        $client = new Client([
            'verify' => false,
        ]);

        $sql = 'https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT DISTINCT "munnom", "regadm" FROM "19385b4e-5503-4330-9e59-f998f5918363"';

        $response = $client->request('GET', $sql);
        $data = json_decode($response->getBody()->getContents());

        return $data;
    }


    public function fetchFromNeq(string $neq)
    {
        $client = new Client([
            'verify' => false,
        ]);

        $sql = 'https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT * FROM "32f6ec46-85fd-45e9-945b-965d9235840a" WHERE "NEQ" = \'' . $neq . '\'';

        $response = $client->request('GET', $sql);

        $data = json_decode($response->getBody()->getContents());

        return $data;
    }

    private function readUNSPSCFile(callable $processRow)
    {
        $filePath = storage_path('../app/unspsc.csv');

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        try {
            $handle = fopen($filePath, "r");
            $header = fgetcsv($handle);

            $data = [];
            while (($row = fgetcsv($handle, 10000, ";")) !== false) {
                $result = $processRow($row);
                if ($result !== null) {
                    $data[] = $result;
                }
            }
            fclose($handle);

            $distinctData = array_unique($data);

            return response()->json(array_values($distinctData));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function fetchUNSPSCSegment()
    {
        return $this->readUNSPSCFile(function ($row) {
            return isset($row[0], $row[2]) ? $row[0] . " - " . $row[2] : null;
        });
    }

    public function fetchUNSPSCFamily(string $segment)
    {
        return $this->readUNSPSCFile(function ($row) use ($segment) {
            return (isset($row[0], $row[3], $row[5]) && $row[0] === $segment)
                ? $row[3] . " - " . $row[5]
                : null;
        });
    }

    public function fetchUNSPSCClass(string $family)
    {
        return $this->readUNSPSCFile(function ($row) use ($family) {
            return (isset($row[3], $row[6], $row[8]) && $row[3] === $family)
                ? $row[6] . " - " . $row[8]
                : null;
        });
    }

    public function fetchUNSPSCComodity(string $class)
    {
        return $this->readUNSPSCFile(function ($row) use ($class) {
            return (isset($row[6], $row[9], $row[11]) && $row[6] === $class)
                ? $row[9] . " - " . $row[11]
                : null;
        });
    }

    public function fetchUNSPSCComodityFromName(int $start, int $number, Request $request)
    {
        $commodity = $request->query('comodity', '');

        $jsonResponse = $this->readUNSPSCFile(function ($row) use ($commodity) {
            if (is_null($commodity) || $commodity === '') {
                return isset($row[9], $row[11]) ? $row[9] . " - " . $row[11] : null;
            }

            return (isset($row[9], $row[11]) && strpos(strtolower($row[9]) . " - " . strtolower($row[11]), strtolower($commodity)) !== false)
                ? $row[9] . " - " . $row[11]
                : null;
        });

        $results = json_decode($jsonResponse->getContent(), true);

        $filteredResults = array_filter($results, fn($value) => $value !== null);

        return array_slice($filteredResults, $start, $number);
    }

    public function fetchServices(Request $request)
    {
        $filePath = storage_path('../app/familleUnspscs.csv');
    
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }
    
        try {
            $search = $request->query('search', '');
            $offset = $request->query('offset', 0);
            $limit = $request->query('limit', 50);
    
            $handle = fopen($filePath, "r");
            $data = [];
            fgetcsv($handle, 25000, ";");
            while (($row = fgetcsv($handle, 25000, ";")) !== false) {
                if (!empty($row[3]) && $row[3] !== "Code UNSPSC") {
                    $item = [
                        'categorie' => $row[0],
                        'code_categorie' => $row[1],
                        'description_categorie' => $row[2],
                        'code_unspsc' => $row[3],
                        'description_unspsc' => $row[4],
                        'description_detaillee_code_unspsc' => $row[5],
                        'code_cat' => $row[6],
                    ];
                    if (stripos($item['description_unspsc'], $search) !== false) {
                        $data[] = $item;
                    }
                }
            }
            fclose($handle);
    
            $distinctData = array_map('unserialize', array_unique(array_map('serialize', $data)));
    
            return response()->json(array_slice(array_values($distinctData), $offset, $limit));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    



}
