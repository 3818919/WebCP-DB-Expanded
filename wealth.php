<?php

$pagetitle = 'Top 100 Wealthiest Players';

require 'common.php';

$sql = "SELECT 
            c.name AS name, 
            c.title AS title, 
            c.guild AS guild, 
            c.gender AS gender, 
            c.level AS level,
            c.goldbank,
            c.inventory
        FROM characters c 
        WHERE c.admin = 0 
        ORDER BY c.level DESC, c.goldbank DESC  -- Order by level and then by goldbank
        LIMIT 500";  // Increased limit to 500

$characters = webcp_db_fetchall($sql);

foreach ($characters as &$character) {
    $character['total_gold'] = getGoldFromInventory($character['inventory']) + $character['goldbank'];
    $character['total_gold'] = (int)$character['total_gold'];  // Ensure total_gold is an integer
    if ($character['total_gold'] === 0) {
        $character['total_gold'] = null;  // Set total_gold to null if it's zero
    }
    $character['name'] = ucfirst($character['name']);
    $character['gender'] = $character['gender'] ? 'Male' : 'Female';
    $character['title'] = empty($character['title']) ? '-' : ucfirst($character['title']);
    $character['guild'] = empty($character['guild']) ? Null : $character['guild'];
    
}
unset($character);

// Debugging: Check for non-numeric values
foreach ($characters as $character) {
    if (!is_numeric($character['total_gold'])) {
        error_log("Non-numeric total_gold found for character: " . $character['name']);
    }
}

// Re-sort characters by total_gold in descending order after processing
usort($characters, function($a, $b) {
    return (int)$b['total_gold'] - (int)$a['total_gold'];  // Cast to int to ensure numeric values
});

$characters = array_slice($characters, 0, 100);
$tpl->characters = $characters;

// Execute the template for the topwealth list
$tpl->Execute('wealth');

function getGoldFromInventory($inventory) {
    $totalGold = 0;
    $items = explode(';', trim($inventory, ';')); // Ensure no trailing semicolon
    foreach ($items as $item) {
        if (empty($item)) continue;
        list($itemId, $quantity) = explode(',', $item);
        if ($itemId == '1') {  // Assuming '1' is the item_id for gold
            $totalGold += (int)$quantity;
        }
    }
    return $totalGold;
}