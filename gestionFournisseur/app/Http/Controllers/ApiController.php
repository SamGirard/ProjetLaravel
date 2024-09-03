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
      
        $sql = 'https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT "munnom", "regadm" FROM "19385b4e-5503-4330-9e59-f998f5918363"';

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

}
