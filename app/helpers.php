<?php

use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\Rating;
use App\Models\Cart;
use App\Models\OnlineTrainingRating;


if (!function_exists('allState')) {
    function allState()
    {
        return $state = [
            "LND" => "London, City of",
            "ABE" => "Aberdeen City",
            "ABD" => "Aberdeenshire",
            "ANS" => "Angus",
            "AGB" => "Argyll and Bute",
            "CLK" => "Clackmannanshire",
            "DGY" => "Dumfries and Galloway",
            "DND" => "Dundee City",
            "EAY" => "East Ayrshire",
            "EDU" => "East Dunbartonshire",
            "ELN" => "East Lothian",
            "ERW" => "East Renfrewshire",
            "EDH" => "Edinburgh, City of",
            "ELS" => "Eilean Siar",
            "FAL" => "Falkirk",
            "FIF" => "Fife",
            "GLG" => "Glasgow City",
            "HLD" => "Highland",
            "IVC" => "Inverclyde",
            "MLN" => "Midlothian",
            "MRY" => "Moray",
            "NAY" => "North Ayrshire",
            "NLK" => "North Lanarkshire",
            "ORK" => "Orkney Islands",
            "PKN" => "Perth and Kinross",
            "RFW" => "Renfrewshire",
            "SCB" => "Scottish Borders",
            "ZET" => "Shetland Islands",
            "SAY" => "South Ayrshire",
            "SLK" => "South Lanarkshire",
            "STG" => "Stirling",
            "WDU" => "West Dunbartonshire",
            "WLN" => "West Lothian",
            "ANN" => "Antrim and Newtownabbey",
            "AND" => "Ards and North Down",
            "ABC" => "Armagh City, Banbridge and Craigavon",
            "BFS" => "Belfast City",
            "CCG" => "Causeway Coast and Glens",
            "DRS" => "Derry and Strabane",
            "FMO" => "Fermanagh and Omagh",
            "LBC" => "Lisburn and Castlereagh",
            "MEA" => "Mid and East Antrim",
            "MUL" => "Mid-Ulster",
            "NMD" => "Newry, Mourne and Down",
            "BDG" => "Barking and Dagenham",
            "BNE" => "Barnet",
            "BEX" => "Bexley",
            "BEN" => "Brent",
            "BRY" => "Bromley",
            "CMD" => "Camden",
            "CRY" => "Croydon",
            "EAL" => "Ealing",
            "ENF" => "Enfield",
            "GRE" => "Greenwich",
            "HCK" => "Hackney",
            "HMF" => "Hammersmith and Fulham",
            "HRY" => "Haringey",
            "HRW" => "Harrow",
            "HAV" => "Havering",
            "HIL" => "Hillingdon",
            "HNS" => "Hounslow",
            "ISL" => "Islington",
            "KEC" => "Kensington and Chelsea",
            "KTT" => "Kingston upon Thames",
            "LBH" => "Lambeth",
            "LEW" => "Lewisham",
            "MRT" => "Merton",
            "NWM" => "Newham",
            "RDB" => "Redbridge",
            "RIC" => "Richmond upon Thames",
            "SWK" => "Southwark",
            "STN" => "Sutton",
            "TWH" => "Tower Hamlets",
            "WFT" => "Waltham Forest",
            "WND" => "Wandsworth",
            "WSM" => "Westminster",
            "BNS" => "Barnsley",
            "BIR" => "Birmingham",
            "BOL" => "Bolton",
            "BRD" => "Bradford",
            "BUR" => "Bury",
            "CLD" => "Calderdale",
            "COV" => "Coventry",
            "DNC" => "Doncaster",
            "DUD" => "Dudley",
            "GAT" => "Gateshead",
            "KIR" => "Kirklees",
            "KWL" => "Knowsley",
            "LDS" => "Leeds",
            "LIV" => "Liverpool",
            "MAN" => "Manchester",
            "NET" => "Newcastle upon Tyne",
            "NTY" => "North Tyneside",
            "OLD" => "Oldham",
            "RCH" => "Rochdale",
            "ROT" => "Rotherham",
            "SLF" => "Salford",
            "SAW" => "Sandwell",
            "SFT" => "Sefton",
            "SHF" => "Sheffield",
            "SOL" => "Solihull",
            "STY" => "South Tyneside",
            "SHN" => "St. Helens",
            "SKP" => "Stockport",
            "SND" => "Sunderland",
            "TAM" => "Tameside",
            "TRF" => "Trafford",
            "WKF" => "Wakefield",
            "WLL" => "Walsall",
            "WGN" => "Wigan",
            "WRL" => "Wirral",
            "WLV" => "Wolverhampton",
            "BKM" => "Buckinghamshire",
            "CAM" => "Cambridgeshire",
            "CMA" => "Cumbria",
            "DBY" => "Derbyshire",
            "DEV" => "Devon",
            "DOR" => "Dorset",
            "ESX" => "East Sussex",
            "ESS" => "Essex",
            "GLS" => "Gloucestershire",
            "HAM" => "Hampshire",
            "HRT" => "Hertfordshire",
            "KEN" => "Kent",
            "LAN" => "Lancashire",
            "LEC" => "Leicestershire",
            "LIN" => "Lincolnshire",
            "NFK" => "Norfolk",
            "NYK" => "North Yorkshire",
            "NTH" => "Northamptonshire",
            "NTT" => "Nottinghamshire",
            "OXF" => "Oxfordshire",
            "SOM" => "Somerset",
            "STS" => "Staffordshire",
            "SFK" => "Suffolk",
            "SRY" => "Surrey",
            "WAR" => "Warwickshire",
            "WSX" => "West Sussex",
            "WOR" => "Worcestershire",
            "BAS" => "Bath and North East Somerset",
            "BDF" => "Bedford",
            "BBD" => "Blackburn with Darwen",
            "BPL" => "Blackpool",
            "BGW" => "Blaenau Gwent",
            "BCP" => "Bournemouth, Christchurch and Poole",
            "BRC" => "Bracknell Forest",
            "BGE" => "Bridgend [Pen-y-bont ar Ogwr GB-POG]",
            "BNH" => "Brighton and Hove",
            "BST" => "Bristol, City of",
            "CAY" => "Caerphilly [Caerffili GB-CAF]",
            "CRF" => "Cardiff [Caerdydd GB-CRD]",
            "CMN" => "Carmarthenshire [Sir Gaerfyrddin GB-GFY]",
            "CBF" => "Central Bedfordshire",
            "CGN" => "Ceredigion [Sir Ceredigion]",
            "CHE" => "Cheshire East",
            "CHW" => "Cheshire West and Chester",
            "CWY" => "Conwy",
            "CON" => "Cornwall",
            "DAL" => "Darlington",
            "DEN" => "Denbighshire [Sir Ddinbych GB-DDB]",
            "DER" => "Derby",
            "DUR" => "Durham, County",
            "ERY" => "East Riding of Yorkshire",
            "FLN" => "Flintshire [Sir y Fflint GB-FFL]",
            "GWN" => "Gwynedd",
            "HAL" => "Halton",
            "HPL" => "Hartlepool",
            "HEF" => "Herefordshire",
            "AGY" => "Isle of Anglesey [Sir Ynys Môn GB-YNM]",
            "IOW" => "Isle of Wight",
            "IOS" => "Isles of Scilly",
            "KHL" => "Kingston upon Hull",
            "LCE" => "Leicester",
            "LUT" => "Luton",
            "MDW" => "Medway",
            "MTY" => "Merthyr Tydfil [Merthyr Tudful GB-MTU]",
            "MDB" => "Middlesbrough",
            "MIK" => "Milton Keynes",
            "MON" => "Monmouthshire [Sir Fynwy GB-FYN]",
            "NTL" => "Neath Port Talbot [Castell-nedd Port Talbot GB-CTL]",
            "NWP" => "Newport [Casnewydd GB-CNW]",
            "NEL" => "North East Lincolnshire",
            "NLN" => "North Lincolnshire",
            "NSM" => "North Somerset",
            "NBL" => "Northumberland",
            "NGM" => "Nottingham",
            "PEM" => "Pembrokeshire [Sir Benfro GB-BNF]",
            "PTE" => "Peterborough",
            "PLY" => "Plymouth",
            "POR" => "Portsmouth",
            "POW" => "Powys",
            "RDG" => "Reading",
            "RCC" => "Redcar and Cleveland",
            "RCT" => "Rhondda Cynon Taff [Rhondda CynonTaf]",
            "RUT" => "Rutland",
            "SHR" => "Shropshire",
            "SLG" => "Slough",
            "SGC" => "South Gloucestershire",
            "STH" => "Southampton",
            "SOS" => "Southend-on-Sea",
            "STT" => "Stockton-on-Tees",
            "STE" => "Stoke-on-Trent",
            "SWA" => "Swansea [Abertawe GB-ATA]",
            "SWD" => "Swindon",
            "TFW" => "Telford and Wrekin",
            "THR" => "Thurrock",
            "TOB" => "Torbay",
            "TOF" => "Torfaen [Tor-faen]",
            "VGL" => "Vale of Glamorgan, The [Bro Morgannwg GB-BMG]",
            "WRT" => "Warrington",
            "WBK" => "West Berkshire",
            "WIL" => "Wiltshire",
            "WNM" => "Windsor and Maidenhead",
            "WOK" => "Wokingham",
            "WRX" => "Wrexham [Wrecsam GB-WRC]",
            "YOR" => "York",
        ];
    }
}

// rating calculation
if (!function_exists('ratingCal')) {
    function ratingCal($product_id)
    {
        $rating = Rating::where('product_id', $product_id)->get();
        $ratingCount = $rating->count();
        $ratingSum = $rating->sum('rating');
        $avgRating = 0;
        if ($ratingCount != 0)
            $avgRating = $ratingSum / $ratingCount;

        $result['ratingCount'] = number_format($ratingCount);
        $result['avgRating'] = number_format($avgRating, 1);

        return $result;
    }
}

// rating calculation
if (!function_exists('onlineTrainingRatingCal')) {
    function onlineTrainingRatingCal($online_training_id)
    {
        $rating = OnlineTrainingRating::where('online_training_id', $online_training_id)->get();
        $ratingCount = $rating->count();
        $ratingSum = $rating->sum('rating');
        $avgRating = 0;
        if ($ratingCount != 0)
            $avgRating = $ratingSum / $ratingCount;

        $result['ratingCount'] = number_format($ratingCount);
        $result['avgRating'] = number_format($avgRating, 1);

        return $result;
    }
}

// order product rating given or not
if (!function_exists('orderProductRating')) {
    function orderProductRating($user_id, $booking_number, $product_id)
    {
        $rating = Rating::where(['user_id' => $user_id, 'order_number' => $booking_number, 'product_id' => $product_id])->first();

        return $rating;
    }
}

// order product rating given or not
if (!function_exists('userCartPro')) {
    function userCartPro($user_id, $product_id, $cart_id)
    {
        $product_qnt = Cart::where('id', '!=', $cart_id)->where(['user_id' => $user_id, 'product_id' => $product_id])->sum('quantity');

        return $product_qnt;
    }
}


// // time difference calculation
// if (!function_exists('timeDiff')) {
//     function timeDiff($dateTime)
//     {
//         $datetime1 = new DateTime();
//         $datetime2 = new DateTime($dateTime);
//         $interval = $datetime1->diff($datetime2);
//         $year = $interval->format('%y');
//         $month = $interval->format('%m');
//         $days = $interval->format('%a');
//         $hour = $interval->format('%h');
//         $min = $interval->format('%i');
//         $sec = $interval->format('%s');
//         $time_diff = "";
//         if ($year) {
//             $time_diff = $interval->format('%y years %m months %a days %h hours %i minutes');
//         } elseif ($month) {
//             $time_diff = $interval->format('%m months %a days %h hours %i minutes');
//         } elseif ($days) {
//             $time_diff = $interval->format('%a days %h hours %i minutes');
//         } elseif ($hour) {
//             $time_diff = $interval->format('%h hours %i minutes');
//         } elseif ($min) {
//             $time_diff = $interval->format('%i minutes');
//         } elseif ($sec) {
//             $time_diff = $interval->format('%s seconds');
//         }
//         return $time_diff;
//     }
// }




// // get pay stack a/c current balance
// if (!function_exists('currentBalance')) {
//     function currentBalance()
//     {
//         $curl = curl_init();

//         curl_setopt_array($curl, array(
//             CURLOPT_URL => "https://api.paystack.co/balance",
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_ENCODING => "",
//             CURLOPT_MAXREDIRS => 10,
//             CURLOPT_TIMEOUT => 30,
//             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//             CURLOPT_CUSTOMREQUEST => "GET",
//             CURLOPT_HTTPHEADER => array(
//                 "Authorization: Bearer " . env('PAYSTACK_SECRET_KEY'),
//                 "Cache-Control: no-cache",
//             ),
//         ));

//         $result = curl_exec($curl);
//         $response = json_decode($result);

//         $err = curl_error($curl);
//         curl_close($curl);

//         if ($err) {
//             echo $err;
//         } else {
//             $balance = $response->data[0]->balance;
//             $len = strlen($balance);
//             $current = substr($balance, 0, $len - 2);
//             $delimal = substr($balance, $len - 2, $len);
//             $original_balance = $current . "." . $delimal;
//             // dd((float)$original_balance);
//             return (float)$original_balance;
//         }
//     }
// }
