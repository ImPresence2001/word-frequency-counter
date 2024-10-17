<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_text = strval($_POST['text']);

    $ignore_word_list = ['the', 'and', 'in', 'is', 'it', 'to', 'of', 'a', 'for', 'on', 'with', 'as', 'that', 'by', 'at', 'be', 'this', 'from', 'or', 'an', 'if'];

    function word_extraction_tokenizer(string $user_text, array $ignore_word_list): array {
        $user_text = strtolower($user_text);
        $user_text = preg_replace('/[^\w\s]/', '', $user_text);

        $words = preg_split('/\s+/', $user_text);

        $filtered_words = array_filter($words, function($word) use ($ignore_word_list) {
            return !in_array($word, $ignore_word_list) && !empty($word);
        });

        return $filtered_words;
    }

    $word_list = word_extraction_tokenizer($user_text, $ignore_word_list);

    function word_frequency_calculator(array $word_list): array {
        return array_count_values($word_list); 
    }

    $word_frequency_list = word_frequency_calculator($word_list);

    $user_limit = (int)$_POST['limit'];  // Ensure this is an integer

    function limit_word_frequencies(array $word_frequency_list, int $user_limit): array {
        if ($user_limit < 1) {
            throw new InvalidArgumentException("Limit must be at least 1. Given limit: " . $user_limit);
        }
        arsort($word_frequency_list);
        return array_slice($word_frequency_list, 0, $user_limit, true);
    }

    $limited_list = limit_word_frequencies($word_frequency_list, $user_limit);

    $user_order = strval($_POST['sort']);

    function sort_word_frequencies(array $limited_list, string $user_order): array {
        if ($user_order !== 'asc' && $user_order !== 'desc') {
            throw new InvalidArgumentException("Invalid order specified. Use 'asc' or 'desc'.");
        }

        if ($user_order === 'asc') {
            asort($limited_list); 
        } else {
            arsort($limited_list); 
        }

        return $limited_list;
    }

    $sorted_list = sort_word_frequencies($limited_list, $user_order);

    $result = [];
    
    foreach ($sorted_list as $word => $frequency) {
        $results[] = "$word: $frequency";
    }

    echo json_encode($results);
    
}
