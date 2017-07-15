<?php

namespace EmailValidation\Validations;

/**
 * Adapted from: https://github.com/GromNaN/MailCheck
 */
class MisspelledEmailValidator extends Validator
{
    const MINIMUM_WORD_DISTANCE_DOMAIN = 2;
    const MINIMUM_WORD_DISTANCE_TLD = 1;

    /**
     * @return string
     */
    public function getValidatorName(): string
    {
        return 'possible_email_correction'; // @codeCoverageIgnore
    }

    /**
     * @return string
     */
    public function getResultResponse(): string
    {
        if (!$this->getEmailAddress()->isValidEmailAddressFormat()) {
            return ''; // @codeCoverageIgnore
        }

        $suggestion = $this->findEmailAddressSuggestion();
        if ($suggestion === $this->getEmailAddress()->asString()) {
            return ''; // @codeCoverageIgnore
        }

        return $suggestion;
    }

    /**
     * @return string
     */
    private function findEmailAddressSuggestion(): string
    {
        $email = $this->getEmailAddress();
        $domainSuggestion = $this->findDomainSuggestion();
        if ($this->findDomainSuggestion()) {
            return str_replace($email->getHostPart(), $domainSuggestion, $email->asString());
        }

        $topLevelDomainSuggestion = $this->findTopLevelDomainSuggestion();
        if ($this->findTopLevelDomainSuggestion()) {
            return str_replace($email->getTopLevelDomainPart(), $topLevelDomainSuggestion, $email->asString());
        }

        return '';
    }

    /**
     * @return bool|null|string
     */
    private function findTopLevelDomainSuggestion()
    {
        $topLevelDomain = $this->getEmailAddress()->getTopLevelDomainPart();
        $possibleTopLevelMatch = $this->findClosestWord(
            $topLevelDomain,
            $this->getEmailDataProvider()->getTopLevelDomains(),
            self::MINIMUM_WORD_DISTANCE_TLD
        );

        return $topLevelDomain === $possibleTopLevelMatch ? null : $possibleTopLevelMatch;
    }

    /**
     * @return bool|null|string
     */
    private function findDomainSuggestion()
    {
        $domain = $this->getEmailAddress()->getHostPart();
        $possibleMatch = $this->findClosestWord(
            $domain,
            $this->getEmailDataProvider()->getEmailProviders(),
            self::MINIMUM_WORD_DISTANCE_DOMAIN
        );

        return $domain === $possibleMatch ? null : $possibleMatch;
    }

    /**
     * @param string $stringToCheck
     * @param array $wordsToCheck
     * @param int $minimumDistance
     * @return string|bool
     */
    private function findClosestWord(string $stringToCheck, array $wordsToCheck, int $minimumDistance): string
    {
        if (in_array($stringToCheck, $wordsToCheck)) {
            return $stringToCheck;
        }

        $closestMatch = false;
        foreach ($wordsToCheck as $testedWord) {
            $distance = levenshtein($stringToCheck, $testedWord);
            if ($distance <= $minimumDistance) {
                $minimumDistance = $distance - 1;
                $closestMatch = $testedWord;
            }
        }

        return $closestMatch;
    }
}