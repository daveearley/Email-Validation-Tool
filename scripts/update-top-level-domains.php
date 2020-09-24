#!/usr/bin/env php

<?php

/*
 * To update top level domains from the command line run:
 * $ ./update-top-level-domains.php
 */

$topLevelDomainsLocation = 'https://data.iana.org/TLD/tlds-alpha-by-domain.txt';

$topLevelDomains = file_get_contents($topLevelDomainsLocation);

if (!is_string($topLevelDomains)) { die('Failed to fetch domains'); }

$topLevelDomains = preg_split('/\r\n|\r|\n/', $topLevelDomains);
array_shift($topLevelDomains);

if (!is_array($topLevelDomains)) { die('Unable to parse domains'); }

$exportedArray = '[' . PHP_EOL;

foreach ($topLevelDomains as $domain) {
    if (! empty($domain)) {
        $domain = strtolower($domain);
        $exportedArray .= "    '{$domain}'," . PHP_EOL;
    }
}

$exportedArray .= ']';

$phpFileTemplate = <<<TEMPLATE
<?php

/**
 * @see https://data.iana.org/TLD/tlds-alpha-by-domain.txt
 */
 
return {$exportedArray};
 
TEMPLATE;

$writeToFile = file_put_contents('../src/data/top-level-domains.php', $phpFileTemplate);

if (!$writeToFile) { die('Failed to write to file'); }

echo "Successfully Fetched Top Level Domains";
exit();
