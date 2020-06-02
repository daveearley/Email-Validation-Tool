<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

/**
 * Adapted from: https://github.com/GromNaN/MailCheck
 */
class MisspelledEmailValidator extends Validator implements ValidatorInterface
{
    private const MINIMUM_WORD_DISTANCE_DOMAIN = 2;
    private const MINIMUM_WORD_DISTANCE_TLD = 1;

    public function getValidatorName(): string
    {
        return 'possible_email_correction'; // @codeCoverageIgnore
    }

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
        if ($domainSuggestion = $this->findDomainSuggestion()) {
            return str_replace(
                $this->getEmailAddress()->getHostPart(),
                $domainSuggestion,
                $this->getEmailAddress()->asString()
            );
        }

        if ($topLevelDomainSuggestion = $this->findTopLevelDomainSuggestion()) {
            return str_replace(
                $this->getEmailAddress()->getTopLevelDomainPart(),
                $topLevelDomainSuggestion,
                $this->getEmailAddress()->asString()
            );
        }

        return '';
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

    private function findClosestWord(string $stringToCheck, array $wordsToCheck, int $minimumDistance): string
    {
        if (in_array($stringToCheck, $wordsToCheck)) {
            return $stringToCheck;
        }

        $closestMatch = '';
        foreach ($wordsToCheck as $testedWord) {
            $distance = levenshtein($stringToCheck, $testedWord);
            if ($distance <= $minimumDistance) {
                $minimumDistance = $distance - 1;
                $closestMatch = $testedWord;
            }
        }

        return $closestMatch;
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
}