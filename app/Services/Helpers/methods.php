<?php

/**
 * Get the query string.
 *
 * @param  array  $query
 * @return  array
 */
function getQueryString(array $query)
{
    $queryString = array_merge( request()->query(), $query);

    $filteredQuery = array_except($queryString, ['page']);

    return $filteredQuery;
}

/**
 * Remove the query string.
 *
 * @param  string $filter
 * @return  array
 */
function removeQueryString($filter)
{
    $queryString = request()->query();

    $filteredQuery = array_except($queryString, [$filter, 'page']);

    return $filteredQuery;
}

/**
 * Get active class.
 *
 * @param  string $value1
 * @param  string $value2
 * @return string
 */
function getActiveClass($value1, $value2)
{
    return $value1 === $value2 ? 'active' : '';
}

/**
 * Get selected option.
 *
 * @param  string $value1
 * @param  string $value2
 * @return string
 */
function getSelected($value1 , $value2)
{
    return $value1 == $value2 ? 'selected' : '';
}