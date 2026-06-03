<?php
/**
 * Delivery Calculator for Bifolding Door Builder
 * Based on distance from factory: DY2 8UB (Dudley, West Midlands)
 * 
 * Logic:
 * - Free within 10 miles
 * - Greater London = Zone (Standard delivery with price tiers)
 * - Central London = Bespoke
 * - Scotland = Bespoke
 * - Price tiers: +150 / +200 / +250 miles
 */

class Delivery_Calculator {
    
    private $factory_postcode = 'DY2 8UB';
    private $factory_lat = 52.5080;
    private $factory_lng = -2.0872;
    
    // Price tiers based on distance
    private $distance_tiers = [
        ['min' => 0,    'max' => 10,    'price' => 0],      // Free local
        ['min' => 10.1, 'max' => 150,   'price' => 150],    // 10-150 miles
        ['min' => 150.1,'max' => 200,   'price' => 200],    // 150-200 miles
        ['min' => 200.1,'max' => 250,   'price' => 250],    // 200-250 miles
        ['min' => 250.1,'max' => 9999,  'price' => 300],    // 250+ miles
    ];
    
    // Greater London areas (standard delivery, not bespoke)
    private $greater_london_zones = [
        'name' => 'Greater London',
        'postcodes' => [
            'BR', 'CR', 'DA', 'E', 'EC', 'EN', 'HA', 'IG', 'KT', 'N', 'NW', 'RM', 'SE', 'SM', 'SW', 'TW', 'UB', 'W', 'WC'
        ]
    ];
    
    // Central London (bespoke delivery required)
    private $central_london_zones = [
        'name' => 'Central London',
        'postcodes' => ['EC1', 'EC2', 'EC3', 'EC4', 'WC1', 'WC2', 'W1', 'SW1', 'SE1']
    ];
    
    // Scotland (bespoke delivery required)
    private $scotland_zones = [
        'name' => 'Scotland',
        'postcodes' => ['AB', 'DD', 'DG', 'EH', 'FK', 'G', 'HS', 'IV', 'KA', 'KW', 'KY', 'ML', 'PA', 'PH', 'TD', 'ZE']
    ];
    
    // Special remote areas (bespoke delivery required)
    private $bespoke_zones = [
        'Isle of Man' => ['IM'],
        'Isle of Wight' => ['PO30', 'PO31', 'PO32', 'PO33', 'PO34', 'PO35', 'PO36', 'PO37', 'PO38', 'PO39', 'PO40', 'PO41'],
        'Northern Ireland' => ['BT'],
        'Channel Islands' => ['GY', 'JE'],
        'Isles of Scilly' => ['TR21', 'TR22', 'TR23', 'TR24', 'TR25'],
        'Outer Hebrides' => ['HS'],
        'Orkney' => ['KW15', 'KW16', 'KW17'],
        'Shetland' => ['ZE'],
    ];
    
    /**
     * Calculate delivery charge based on postcode
     */
    public function calculate_delivery($customer_postcode) {
        $result = [
            'price' => 0,
            'zone' => 'Standard',
            'distance' => 0,
            'bespoke' => false,
            'message' => ''
        ];
        
        // Clean postcode
        $customer_postcode = strtoupper(preg_replace('/\s+/', '', $customer_postcode));
        $factory_postcode = strtoupper(preg_replace('/\s+/', '', $this->factory_postcode));
        
        // Check if it's the factory location
        if ($customer_postcode === $factory_postcode) {
            $result['distance'] = 0;
            $result['zone'] = 'Factory (Free)';
            $result['price'] = 0;
            $result['bespoke'] = false;
            $result['message'] = 'Free collection from factory';
            return $result;
        }
        
        // ===== STEP 1: Check for BESPOKE ZONES first =====
        
        // Check Central London (bespoke)
        if ($this->is_central_london($customer_postcode)) {
            $result['zone'] = 'Central London';
            $result['bespoke'] = true;
            $result['price'] = 0;
            $result['message'] = 'Bespoke delivery required for Central London. Please contact our sales team.';
            return $result;
        }
        
        // Check Scotland (bespoke)
        if ($this->is_scotland($customer_postcode)) {
            $result['zone'] = 'Scotland';
            $result['bespoke'] = true;
            $result['price'] = 0;
            $result['message'] = 'Bespoke delivery required for Scotland. Please contact our sales team.';
            return $result;
        }
        
        // Check other bespoke zones (Islands, etc.)
        $bespoke_zone = $this->check_other_bespoke_zones($customer_postcode);
        if ($bespoke_zone) {
            $result['zone'] = $bespoke_zone;
            $result['bespoke'] = true;
            $result['price'] = 0;
            $result['message'] = "Bespoke delivery required for {$bespoke_zone}. Please contact our sales team.";
            return $result;
        }
        
        // ===== STEP 2: Calculate distance =====
        $distance = $this->get_distance($factory_postcode, $customer_postcode);
        $result['distance'] = round($distance, 1);
        
        // ===== STEP 3: Check for Greater London (standard delivery with price tiers) =====
        if ($this->is_greater_london($customer_postcode)) {
            $result['zone'] = 'Greater London';
            $result['price'] = $this->get_price_by_distance($distance);
            $result['bespoke'] = false;
            $result['message'] = $this->get_price_message($result['price'], $distance);
            return $result;
        }
        
        // ===== STEP 4: Standard delivery based on distance =====
        $result['price'] = $this->get_price_by_distance($distance);
        $result['zone'] = $this->get_zone_name_by_distance($distance);
        $result['bespoke'] = false;
        $result['message'] = $this->get_price_message($result['price'], $distance);
        
        return $result;
    }
    
    /**
     * Check if postcode is in Central London (bespoke)
     */
    private function is_central_london($postcode) {
        foreach ($this->central_london_zones['postcodes'] as $london_code) {
            if (strpos($postcode, $london_code) === 0) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Check if postcode is in Scotland (bespoke)
     */
    private function is_scotland($postcode) {
        foreach ($this->scotland_zones['postcodes'] as $scottish_code) {
            if (strpos($postcode, $scottish_code) === 0) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Check if postcode is in Greater London (standard delivery)
     */
    private function is_greater_london($postcode) {
        foreach ($this->greater_london_zones['postcodes'] as $london_code) {
            if (strpos($postcode, $london_code) === 0) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Check other bespoke zones (islands, etc.)
     */
    private function check_other_bespoke_zones($postcode) {
        foreach ($this->bespoke_zones as $zone_name => $codes) {
            foreach ($codes as $code) {
                if (strpos($postcode, $code) === 0) {
                    return $zone_name;
                }
            }
        }
        return false;
    }
    
    /**
     * Get price based on distance
     */
    private function get_price_by_distance($distance) {
        // Free within 10 miles
        if ($distance <= 10) {
            return 0;
        }
        
        // Apply price tiers
        foreach ($this->distance_tiers as $tier) {
            if ($distance >= $tier['min'] && $distance <= $tier['max']) {
                return $tier['price'];
            }
        }
        
        return 300; // Default max price
    }
    
    /**
     * Get zone name based on distance
     */
    private function get_zone_name_by_distance($distance) {
        if ($distance <= 10) {
            return 'Local (Free)';
        } elseif ($distance <= 150) {
            return 'Zone A - Regional';
        } elseif ($distance <= 200) {
            return 'Zone B - National';
        } elseif ($distance <= 250) {
            return 'Zone C - Extended';
        } else {
            return 'Zone D - Remote';
        }
    }
    
    /**
     * Get price message
     */
    private function get_price_message($price, $distance) {
        if ($price === 0) {
            return 'Free delivery within 10 miles';
        } else {
            return "Delivery: £{$price} (Distance: " . round($distance, 1) . " miles)";
        }
    }
    
    /**
     * Get distance between two UK postcodes
     * Using approximate coordinates for UK postcode areas
     */
    private function get_distance($from, $to) {
        // If same postcode, distance is 0
        if ($from === $to) {
            return 0;
        }
        
        // Get approximate coordinates for postcode areas
        $coordinates = $this->get_postcode_coordinates($to);
        
        if (!$coordinates) {
            return 150; // Default fallback
        }
        
        // Calculate distance using Haversine formula
        return $this->calculate_distance(
            $this->factory_lat,
            $this->factory_lng,
            $coordinates['lat'],
            $coordinates['lng']
        );
    }
    
    /**
     * Get approximate coordinates for UK postcode areas
     */
    private function get_postcode_coordinates($postcode) {
        // Extract area code (first 1-2 letters)
        preg_match('/^[A-Z]+/', $postcode, $matches);
        $area = $matches[0] ?? '';
        
        // Approximate coordinates for UK areas
        $coordinates = [
            // West Midlands (Factory area)
            'DY' => ['lat' => 52.5080, 'lng' => -2.0872], // Dudley
            'B'  => ['lat' => 52.4862, 'lng' => -1.8904], // Birmingham
            'WV' => ['lat' => 52.5862, 'lng' => -2.1280], // Wolverhampton
            'WS' => ['lat' => 52.5640, 'lng' => -1.9790], // Walsall
            'WR' => ['lat' => 52.1930, 'lng' => -2.2210], // Worcester
            'CV' => ['lat' => 52.4080, 'lng' => -1.5100], // Coventry
            
            // Midlands
            'LE' => ['lat' => 52.6360, 'lng' => -1.1330], // Leicester
            'NG' => ['lat' => 52.9540, 'lng' => -1.1550], // Nottingham
            'DE' => ['lat' => 52.9220, 'lng' => -1.4760], // Derby
            'ST' => ['lat' => 53.0250, 'lng' => -2.1760], // Stoke
            'SY' => ['lat' => 52.7080, 'lng' => -2.7540], // Shrewsbury
            'HR' => ['lat' => 52.0560, 'lng' => -2.7160], // Hereford
            'GL' => ['lat' => 51.8670, 'lng' => -2.2440], // Gloucester
            
            // South East
            'OX' => ['lat' => 51.7520, 'lng' => -1.2570], // Oxford
            'HP' => ['lat' => 51.7080, 'lng' => -0.8160], // High Wycombe
            'SL' => ['lat' => 51.5110, 'lng' => -0.6110], // Slough
            'UB' => ['lat' => 51.5460, 'lng' => -0.4000], // Uxbridge
            'HA' => ['lat' => 51.5890, 'lng' => -0.3190], // Harrow
            
            // London Areas
            'N'  => ['lat' => 51.5600, 'lng' => -0.1050], // North London
            'NW' => ['lat' => 51.5400, 'lng' => -0.2050], // North West London
            'E'  => ['lat' => 51.5200, 'lng' => -0.0500], // East London
            'SE' => ['lat' => 51.4700, 'lng' => -0.0500], // South East London
            'SW' => ['lat' => 51.4800, 'lng' => -0.1500], // South West London
            'W'  => ['lat' => 51.5100, 'lng' => -0.2000], // West London
            'WC' => ['lat' => 51.5170, 'lng' => -0.1200], // Central London
            'EC' => ['lat' => 51.5200, 'lng' => -0.1000], // Central London
            'BR' => ['lat' => 51.4030, 'lng' => 0.0180],  // Bromley
            'CR' => ['lat' => 51.3750, 'lng' => -0.1000], // Croydon
            'KT' => ['lat' => 51.3900, 'lng' => -0.3000], // Kingston
            'TW' => ['lat' => 51.4500, 'lng' => -0.3300], // Twickenham
            'SM' => ['lat' => 51.3500, 'lng' => -0.2000], // Sutton
            'EN' => ['lat' => 51.6500, 'lng' => -0.0800], // Enfield
            'IG' => ['lat' => 51.5600, 'lng' => 0.0800],  // Ilford
            'RM' => ['lat' => 51.5700, 'lng' => 0.1800],  // Romford
            'DA' => ['lat' => 51.4400, 'lng' => 0.1500],  // Dartford
            'ME' => ['lat' => 51.3800, 'lng' => 0.5300],  // Medway
            'TN' => ['lat' => 51.1300, 'lng' => 0.2600],  // Tunbridge Wells
            'RH' => ['lat' => 51.1800, 'lng' => -0.1800], // Redhill
            'GU' => ['lat' => 51.2400, 'lng' => -0.5900], // Guildford
            'RG' => ['lat' => 51.4500, 'lng' => -0.9700], // Reading
            
            // South Coast
            'SO' => ['lat' => 50.9200, 'lng' => -1.3800], // Southampton
            'PO' => ['lat' => 50.8000, 'lng' => -1.0800], // Portsmouth
            'BN' => ['lat' => 50.8300, 'lng' => -0.1500], // Brighton
            
            // South West
            'TR' => ['lat' => 50.2600, 'lng' => -5.0500], // Truro
            'PL' => ['lat' => 50.3700, 'lng' => -4.1400], // Plymouth
            'EX' => ['lat' => 50.7200, 'lng' => -3.5300], // Exeter
            'TQ' => ['lat' => 50.4700, 'lng' => -3.5300], // Torquay
            'TA' => ['lat' => 51.0200, 'lng' => -3.1000], // Taunton
            'BA' => ['lat' => 51.3800, 'lng' => -2.3600], // Bath
            'BS' => ['lat' => 51.4500, 'lng' => -2.5800], // Bristol
            
            // Wales
            'CF' => ['lat' => 51.4800, 'lng' => -3.1800], // Cardiff
            'NP' => ['lat' => 51.6500, 'lng' => -3.0200], // Newport
            'SA' => ['lat' => 51.6200, 'lng' => -3.9400], // Swansea
            
            // North West
            'M'  => ['lat' => 53.4800, 'lng' => -2.2400], // Manchester
            'L'  => ['lat' => 53.4000, 'lng' => -2.9900], // Liverpool
            'PR' => ['lat' => 53.7600, 'lng' => -2.7000], // Preston
            'BD' => ['lat' => 53.7900, 'lng' => -1.7600], // Bradford
            'HD' => ['lat' => 53.6500, 'lng' => -1.7800], // Huddersfield
            'DN' => ['lat' => 53.5200, 'lng' => -1.1300], // Doncaster
            
            // North East
            'NE' => ['lat' => 54.9700, 'lng' => -1.6100], // Newcastle
            'SR' => ['lat' => 54.9000, 'lng' => -1.3800], // Sunderland
            'DH' => ['lat' => 54.7700, 'lng' => -1.5700], // Durham
            'TS' => ['lat' => 54.5700, 'lng' => -1.2300], // Middlesbrough
            'CA' => ['lat' => 54.8900, 'lng' => -2.9400], // Carlisle
            
            // Scotland
            'EH' => ['lat' => 55.9500, 'lng' => -3.1800], // Edinburgh
            'G'  => ['lat' => 55.8600, 'lng' => -4.2500], // Glasgow
            'KY' => ['lat' => 56.1100, 'lng' => -3.1600], // Kirkcaldy
            'DD' => ['lat' => 56.4600, 'lng' => -2.9700], // Dundee
            'AB' => ['lat' => 57.1400, 'lng' => -2.0900], // Aberdeen
            'IV' => ['lat' => 57.4700, 'lng' => -4.2200], // Inverness
            'KW' => ['lat' => 58.4300, 'lng' => -3.0900], // Wick
            'PA' => ['lat' => 55.9500, 'lng' => -5.0000], // Argyll
            'PH' => ['lat' => 56.3900, 'lng' => -3.4300], // Perth
            
            // Remote
            'ZE' => ['lat' => 60.1500, 'lng' => -1.1400], // Shetland
            'HS' => ['lat' => 58.2100, 'lng' => -6.3800], // Outer Hebrides
            'IM' => ['lat' => 54.2300, 'lng' => -4.5500], // Isle of Man
        ];
        
        return $coordinates[$area] ?? null;
    }
    
    /**
     * Calculate distance between two coordinates using Haversine formula
     */
    private function calculate_distance($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + 
                cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        
        return $miles;
    }
}