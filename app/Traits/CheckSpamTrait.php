<?php
namespace App\Traits;

trait CheckSpamTrait
{
    /**
     * Check spam commets
     * @param string $text
     * @param array $spamPharases
     * @return string (spam words)
     */

    
    public function checkSpam(string $text, array $spamPharases  = []) : string {
        $spamWords = [];
        foreach ($spamPharases as $phrase) {
            // The text contains the phrase - it's a spam!
            if (stripos(trim($text), trim($phrase)) !== false) $spamWords[] = trim($phrase);
        }
        return implode(',', $spamWords);
    }
}
