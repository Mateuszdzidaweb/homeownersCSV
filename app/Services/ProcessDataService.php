<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class ProcessDataService
{
    private array $validTitles = ['Mr', 'Mrs', 'Mister', 'Ms', 'Dr', 'Prof'];

    public function parseFromCvs(array $rows): array
    {
        try {
            $rows = array_slice($rows, 1);
            $parsedNames = [];

            foreach ($rows as $row) {
                $parsed = $this->parseName($row);

                if (is_array(reset($parsed))) {
                    $parsedNames = array_merge($parsedNames, $parsed);
                } else {
                    $parsedNames[] = $parsed;
                }
            }

        } catch (\Exception $e) {
            \Log::error('Error parsing CSV: '.$e->getMessage());
        }

        return $parsedNames;
    }

    public function parseName(string $name): array
    {

        try {
            $people = [];

            $words = $this->prepareNames($name);
            $currentPerson = $this->initializePerson();
            $lastName = null;

            $count = count($words);

            for ($i = 0; $i < $count; $i++) {

                $word = $this->trimRows($words[$i]);

                if ($this->checkIfTitle($word)) {
                    // Save the previous person
                    $this->addPerson($currentPerson, $lastName, $people);
                    $currentPerson = $this->initializePerson($word, $lastName);
                    // Start a new person with the title
                } elseif ($i === $count - 1) {
                    $lastName = $word;
                    $currentPerson['last_name'] = $word;
                } else {
                    $this->processNameParts($currentPerson, $word);
                }
            }

            $this->addPerson($currentPerson, $lastName, $people);

            // If last name is not found for a person, use the default one
            $this->assignLastNameToPerson($people, $lastName);

        } catch (\Exception $e) {
            \Log::error('Error parsing name: '.$e->getMessage());
        }

        return $people;
    }

    private function prepareNames(string $name): array
    {
        try {

            $words = preg_split('/\s+/', trim($name));

            return array_values(array_filter($words, function ($word) {
                // Remove ("and", "&") from each row
                return ! in_array(strtolower($word), ['and', '&']);
            }));

        } catch (\Exception $e) {
            \Log::error('Error preparing name: '.$e->getMessage());

            return [];
        }

    }

    private function trimRows(string $name): string
    {
        try {
            // Trim leading periods and trailing commas
            $cleanedWord = rtrim(ltrim($name, '.'), ',');

            return rtrim($cleanedWord, '.');

        } catch (\Exception $e) {

            \Log::error('Error trimming name: '.$e->getMessage());

            return $name;
        }

    }

    private function checkIfTitle(string $name): bool
    {
        return in_array($name, $this->validTitles);
    }

    private function initializePerson(?string $title = null, ?string $last_name = null): array
    {

        try {
            $person = [
                'title' => $title,
                'first_name' => null,
                'initial' => null,
                'last_name' => $last_name,
            ];

        } catch (\Exception $e) {
            Log::error('Error initializing person: '.$e->getMessage());
        }

        return $person;
    }

    private function addPerson(array &$currentPerson, ?string $lastName = null, array &$people = []): void
    {

        try {
            // Add the current person to the list if they have a title or first name
            if ($currentPerson['title'] !== null || $currentPerson['first_name'] !== null) {
                if ($currentPerson['last_name'] === null && $lastName !== null) {
                    $currentPerson['last_name'] = $lastName;
                }
                $people[] = $currentPerson;
            }

        } catch (\Exception $e) {
            Log::error('Error adding person: '.$e->getMessage());
        }

    }

    private function processNameParts(array &$currentPerson, string $word): void
    {

        try {
            // Assign first name or initial based on the word
            if ($currentPerson['first_name'] === null && strlen($word) > 1) {
                $currentPerson['first_name'] = $word;
            } elseif ($currentPerson['initial'] === null && strlen($word) === 1) {
                $currentPerson['initial'] = $word;
            } else {
                $currentPerson['last_name'] = trim(($currentPerson['last_name'] ?? '').' '.$word);
            }

        } catch (\Exception $e) {
            Log::error('Error processing name parts: '.$e->getMessage());
        }

    }

    private function assignLastNameToPerson(array &$people, ?string $lastName): void
    {
        try {
            foreach ($people as &$person) {
                if ($person['last_name'] === null && $lastName !== null) {
                    $person['last_name'] = $lastName;
                }
            }

        } catch (\Exception $e) {
            Log::error('Error assigning last name to person: '.$e->getMessage());
        }
    }
}
